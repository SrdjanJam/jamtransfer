<?

require_once '../../config.php';

require_once '../../db/db.class.php';
require_once '../../db/v4_Services.class.php';
require_once '../../db/v4_Terminals.class.php';
require_once '../../db/v4_Places.class.php';
require_once '../../db/v4_Routes.class.php';
require_once '../../db/v4_DriverRoutes.class.php';
require_once '../../db/v4_AuthUsers.class.php';
require_once '../../db/v4_Vehicles.class.php';
require_once '../../db/v4_VehicleTypes.class.php';
require_once '../../db/v4_Articles.class.php';
$dbT = new DataBaseMysql();
$s  = new v4_Services();
$t  = new v4_Terminals();
$pl  = new v4_Places();
$r  = new v4_Routes();
$dr = new v4_DriverRoutes();
$au = new v4_AuthUsers();
$v  = new v4_Vehicles();
$vt = new v4_VehicleTypes();
$sa = new v4_Articles();


$routes=array();
$PlaceID=ltrim($_REQUEST["PlaceID"]);
$pl->getRow($PlaceID);
$terminalname=$pl->getPlaceNameEN();
$terminalnameurl=$pl->getPlaceNameSEO();
$t->getRow($PlaceID);
$imageurl="https://jamtransfer.com".$t->getImageMP();
$rWhere = "WHERE (FromID = '".$PlaceID."' or ToID = '".$PlaceID."') AND Approved = '1' AND RouteID in (SELECT `TopRouteID` FROM `v4_TopRoutes` WHERE Main=1)";
	$routes = $r->getKeysBy('RouteID', "ASC", $rWhere);

$transferDate   = date("Y-m-d",time()+3600*24*3);
$transferTime   = "12:00";
$returnDate     = '';
$returnTime     = '';
$terminal=array();
if (count($routes)>0) {	
	$toproutes = array(); 
	foreach ($routes as $rt) {
		$r->getRow($rt);
		$Km=$r->getKm();
		$Duration=$r->getDuration();
		$fromID=$pl->getRow($r->getFromID());
		$from=$pl->getPlaceNameSEO();
		$fromPlace=$pl->getPlaceNameEN();
		$fromCountry=$pl->getCountryNameEN();
		$toID=$pl->getRow($r->getToID());
		$to=$pl->getPlaceNameSEO();
		$toPlace=$pl->getPlaceNameEN();
		$toCountry=$pl->getCountryNameEN();
		$Link="https://jamtransfer.com/taxi-transfers-from-".$from."-to-".$to;		
		// Izlazni podaci koje koriste skripte za display
		$drivers = array(); // podaci o vozacima

		// ODAVDE KRECE
		$drWhere = "WHERE RouteID=".$rt;
		// check for drivers for the route 
		$driverRouteKeys = $dr->getKeysBy('RouteID', "ASC", $drWhere);
		$services=array();
		if (count($driverRouteKeys) > 0) {
			// ako su pronadjene DriverRoutes, obradi svaku
			foreach($driverRouteKeys as $dri => $rowId) {
				$dr->getRow($rowId);
				$RouteID=$dr->getRouteID();
				$OwnerID = $dr->getOwnerID();
				if($au->getRow($OwnerID)===false) continue;
				$au->getRow($OwnerID);
				if($au->getActive()<>1) continue;
				// check for Services
				$serviceKeys = $s->getKeysBy("ServiceID", "ASC", "WHERE RouteID = {$RouteID} AND OwnerID = {$OwnerID}");
				if(count($serviceKeys) > 0) { 
					foreach($serviceKeys as $si => $sId) {
						$s->getRow($sId);
						$DriversPrice = $s->getServicePrice1();
						if ($DriversPrice==0) continue;
						$ServiceID = $s->getServiceID();
						$Correction= $s->getCorrection();
						$v->getRow($s->getVehicleID());
						$VehicleTypeID  = $v->getVehicleTypeID();
						$VehicleCapacity= $v->getVehicleCapacity();
						$VehicleID      = $v->getVehicleID();
						$ReturnDiscount = $v->getReturnDiscount();
						$vt->getRow($VehicleTypeID);
						$Vehicle = getVehicleTypeName($v->getVehicleTypeID()); 
	
						/*

							Ovdje upada dio sa izracunavanjem cijena ovisno o:
							- return discount
							- danu u tjednu
							- sezoni
							- je li nocna voznja

							Sve te faktore treba prikazati kupcu kao dodatak na osnovnu cijenu.
							Ako je Return transfer, Surcharges vraca zbrojene dodatke za oba transfera!

						*/
						$SurCategory    = $s->getSurCategory();
						$DRSurCategory  = $dr->getSurCategory();
						$VSurCategory   = $v->getSurCategory();
						$sur = array();
						$sur = Adds($OwnerID, $SurCategory, $s->getServicePrice1(),
										  $transferDate, $transferTime,
										  $returnDate, $returnTime,
										  $RouteID, $VehicleID, $ServiceID,
										  $VSurCategory, $DRSurCategory
										  );
									  
						$Driver=$OwnerID." ".$users[$OwnerID]->AuthUserRealName;	
						$min=1+$sur['MinPercent']/100;				  
						$max=1+$sur['MaxPercent']/100;

						$Provision = getProvision($DriversPrice, $s->getOwnerID(), $VehicleClass);
						$ProvisionMin = getProvision($DriversPrice*$min, $s->getOwnerID(), $VehicleClass);
						$ProvisionMax = getProvision($DriversPrice*$max, $s->getOwnerID(), $VehicleClass);
						$f=1+$Provision/100;
						$f_min=1+$ProvisionMin/100;
						$f_max=1+$ProvisionMax/100;
						$FinalPrice = $DriversPrice*$f;
						$FinalPriceMin = $DriversPrice*$min*$f_min;
						$FinalPriceMax = $DriversPrice*$max*$f_max;
						/*
						** KRAJ OBRADE CIJENA
						*/
						$services[] = array(	
							'Driver'        => $Driver,
							'Vehicle'       => $Vehicle,
							'MaxPax'       	=> $VehicleCapacity,
							'finalPrice'    => $FinalPrice,
							'minPrice'      => $FinalPriceMin,
							'maxPrice'      => $FinalPriceMax,
							'Sort'			=> (1000+$VehicleTypeID)." ".(10000+nf($FinalPriceMin)),
							'PriceAdds' => $sur );
					} // end foreach services
					usort($services, function($a, $b) {
						return $a['Sort'] > $b['Sort'];
					});
					$comp="";
					foreach ($services as $key => $service) {
						if ($comp==$service['Vehicle']) unset($services[$key]);
						else $comp=$service['Vehicle'];	
					}		
					foreach ($services as $key =>$serv) {
						unset($services[$key]['Sort']);
						unset($services[$key]['Driver']);
						unset($services[$key]['RouteID']);
						unset($services[$key]['PriceAdds']['MinPercent']);
						unset($services[$key]['PriceAdds']['MaxPercent']);
						if (count($services[$key]['PriceAdds'])==0) unset($services[$key]['PriceAdds']);
					}
				}
			}
		}
		$toproutes[] = array(
				'RouteID'           => $RouteID,
				'FromPlace'         => $fromPlace,
				'ToPlace'         	=> $toPlace,
				'FromCountry'       => $fromCountry,
				'ToCountry'       	=> $toCountry,
				'Link'         		=> $Link,
				'Km'                => $Km,
				'Duration'          => $Duration,
				'Services'			=> $services);
	}
	usort($toproutes, function($a, $b) {
		return $a['RouteID'] > $b['RouteID'];
	});
	$comp="";
		

	foreach ($toproutes as $key =>$c) {
		unset($toproutes[$key]['RouteID']);
	}	
		
	$terminal['Name']=$terminalname;
	$terminal['Image']=$imageurl;
	$terminal['ValidTo']=date("Y-m-d",time()+3600*24*92);
	$tripAdvisor=getTripAdvisorData();
	$terminal['ratingValue']=number_format($tripAdvisor['value'],2);
	$terminal['ratingCount']=number_format($tripAdvisor['count'],0);
	$terminal['faq']=getFAQ($sa);
	$terminal['Routes']=$toproutes;
}
$generator = new JAMTransferSchemaGenerator();

//$schemas = $generator->generateSchemaFromJSON($terminal);
$schemas = [];
// Generiši schema za svaku rutu
foreach ($terminal['Routes'] as $route) {
	if (empty($route['Services'])) continue;
	
	$schema = $generator->createTravelActionSchema($route, $terminal);
	if ($schema) {
		$schemas[] = $schema;
	}
}

// Generiši FAQ schema
$faqSchema = $generator->generateFAQSchema($terminal);
if ($faqSchema) {
	$schemas[] = $faqSchema;
}
foreach ($faqSchema['mainEntity'] as $row) {
	$faq.="<strong>".$row['name']."</strong><br>".$row['acceptedAnswer']['text']."<br>";
}
if ($schemas) {
	ob_start(); 
    foreach ($schemas as $schema) {
        echo '<script type="application/ld+json">';
        echo json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        echo '</script>' . PHP_EOL;
    }
	$schemaPrint = ob_get_contents();
	ob_end_clean();
	unlink(ROOT.'/schemas/'.$terminalnameurl.'.html');
	$fp = fopen(ROOT.'/schemas/'.$terminalnameurl.'.html', 'w');
	fwrite($fp, $schemaPrint);
	echo $faq;
	/*if ($fp) echo "<div class='success'>JSON shema formatted!</div>";
	else echo "<div class='error'>JSON shema not formatted!</div>";*/
} 	
//else echo "<div class='error'>JSON shema not formatted!</div>";


// Dodavanje dogovorene provizije na osnovnu cijenu
function getProvision($price, $ownerid, $VehicleClass = 1) {
    require_once '../../db/db.class.php';
    $dbT = new DataBaseMysql();

        // ako je u decimalama, zaokruzi na cijeli broj
        // npr. 299.20 treba zaokruziti na 299 radi toga sto su usporedne cijene na cijeli broj
        // 100-299, pa onda 300-9999
        // pa ako se ide usporediti onda je 299.20 vece od 299, ali je i manje od 300
        // i onda nece upasti ni u jedan if
        $priceR = round($price, 0, PHP_ROUND_HALF_DOWN); 

        # Driver
        $q = "SELECT * FROM v4_AuthUsers
                    WHERE AuthUserID = '" .$ownerid."'
                    ";
        $w = $dbT->RunQuery($q);
        $d = mysqli_fetch_object($w);

        if($d->AuthUserID == $ownerid) {
            // STANDARD CLASS
            if($VehicleClass < 11) {
                if      ($priceR >= $d->R1Low and $priceR <= $d->R1Hi) $provision=$d->R1Percent ;
                else if ($priceR >= $d->R2Low and $priceR <= $d->R2Hi) $provision=$d->R2Percent ;
                else if ($priceR >= $d->R3Low and $priceR <= $d->R3Hi) $provision=$d->R3Percent ;
                else $provision=$price;
            }
            // PREMIUM CLASS
            if($VehicleClass >= 11 and $VehicleClass < 21) {
                if      ($priceR >= $d->PR1Low and $priceR <= $d->PR1Hi) $provision=$d->PR1Percent ;
                else if ($priceR >= $d->PR2Low and $priceR <= $d->PR2Hi) $provision=$d->PR2Percent ;
                else if ($priceR >= $d->PR3Low and $priceR <= $d->PR3Hi) $provision=$d->PR3Percent ;
                else $provision=$price;
            }
            // FIRST CLASS
            if($VehicleClass >= 21) {
                if      ($priceR >= $d->FR1Low and $priceR <= $d->FR1Hi) $provision=$d->FR1Percent ;
                else if ($priceR >= $d->FR2Low and $priceR <= $d->FR2Hi) $provision=$d->FR2Percent ;
                else if ($priceR >= $d->FR3Low and $priceR <= $d->FR3Hi) $provision=$d->FR3Percent ;
                else $provision=$price;
            }
        }
        if ($provision==0) {
			$priceCalc= 25.5-$price*0.0125+$price*$price*0.00000242;
			if ($priceCalc<10) $priceCalc=10;
			if ($price<40) $priceCalc=1000/$price;
			$provision=$priceCalc;				
		}	
		return $provision;
}

function vehicleTypeName($vehicleTypeID) {
    require_once '../../db/db.class.php';
    $dbT = new DataBaseMysql();

    $w = $dbT->RunQuery("SELECT * FROM v4_VehicleTypes WHERE VehicleTypeID = '{$vehicleTypeID}'");
    $v = $w->fetch_object();

    return $v->VehicleTypeName;
}

function calculateSpecialDates($OwnerID, $amount, $transferDate, $transferTime, $returnDate='', $returnTime='') {

    if( empty($OwnerID) or empty($amount) or empty($transferDate)  or empty($transferTime) ) return 0;

    require_once '../../db/db.class.php';
    require_once '../../db/v4_SpecialDates.class.php';
    $sd = new v4_SpecialDates();

    $add1 = 0;
    $add2 = 0;
    
    $keys = $sd->getKeysBy("ID", "ASC", " WHERE OwnerID = '" . $OwnerID ."'");
    if( count($keys) > 0) {
        foreach($keys as $nn => $ID) {
            $sd->getRow($ID);

            if( inDateTimeRange($sd->getSpecialDate(), $sd->getStartTime(), $sd->getSpecialDate(), $sd->getEndTime(), $transferDate, $transferTime) ) {
                $add1 = nf($amount * $sd->getCorrectionPercent() / 100);
            }
            if($returnDate != '' and $returnTime != '') {
                if( inDateTimeRange($sd->getSpecialDate(), $sd->getStartTime(), $sd->getSpecialDate(), $sd->getEndTime(), $returnDate, $returnTime) ) {
                 $add2 = nf($amount * $sd->getCorrectionPercent() / 100);
                }
            }
        }
    }
    // zbroji oba transfera
    return $add1 + $add2;
}

// izracun dodataka na cijene za booking formu
function Adds($OwnerID, $SurCategory, $base, $tDate, $tTime, $rDate='', $rTime='',
                     $RouteID='', $VehicleID='', $ServiceID='',
                     $VSurCategory='', $DRSurCategory='') {

    // Variables
    $sur = array();
    $finished = false;
    for($i=1; $i<=4;$i++) {
		switch($i) {
			case '4':
				require_once ROOT.'/db/v4_SurGlobal.class.php';
				$sc = new v4_SurGlobal();

				$sck = $sc->getKeysBy('ID', 'asc', ' WHERE OwnerID = ' . $OwnerID);
				if (count($sck) > 0) $sc->getRow($sck[0]);
				break;
			case '2':
				require_once ROOT.'/db/v4_SurVehicle.class.php';
				$sc = new v4_SurVehicle();
				$where = ' WHERE OwnerID = ' . $OwnerID . ' AND VehicleID = ' . $VehicleID;
				$sck = $sc->getKeysBy('ID', 'asc', $where);
				if (count($sck) > 0) {
					$sc->getRow($sck[0]);
				}
				break;
			case '3':
				require_once ROOT.'/db/v4_SurRoute.class.php';
				$sc = new v4_SurRoute();
				$where = ' WHERE OwnerID = ' . $OwnerID . ' AND DriverRouteID = ' . $RouteID;
				$sck = $sc->getKeysBy('DriverRouteID', 'asc', $where);
				if (count($sck) > 0) {
					$sc->getRow($sck[0]);
				}
				break;
			case '1':
				require_once ROOT.'/db/v4_SurService.class.php';
				$sc = new v4_SurService();
				$where = ' WHERE OwnerID = ' . $OwnerID . ' AND ServiceID = ' . $ServiceID;
				$sck = $sc->getKeysBy('ID', 'asc', $where);
				if (count($sck) > 0) {
					$sc->getRow($sck[0]);
				}
				break;
		}
		$minPercent=0;
		$maxPercent=0;
		require_once ROOT.'/db/v4_SpecialDates.class.php';
		$sd = new v4_SpecialDates();
		$start=date("Y-m-d",time());
		$where = ' WHERE OwnerID = ' . $OwnerID . ' AND SpecialDate > "'.$start.'"';
		$sdk = $sd->getKeysBy('ID', 'asc', $where);
		if (count($sdk) > 0) {
			$specialdates=array();
			foreach ($sdk as $key) {
				$sd->getRow($key);
				$time=$sd->getSpecialDate()." from ".$sd->getStartTime()." to ".$sd->getEndTime();
				$specialdates[$time]=$sd->getCorrectionPercent();
			}
			$sur['SpecialDates']=$specialdates;
			if(min($specialdates)<0) $minPercent+=min($specialdates);
			$maxPercent+=max($specialdates);
		}	
		if(
			// service surcharges
			($i == 1 and $SurCategory == 4) or
			// route surcharges
			($i == 3 and $DRSurCategory == 3) or
			// vehicle surcharges
			($i == 2 and $VSurCategory == 2) or

			// global surcharges
			(($i == 4 and $SurCategory == 1) and
			($i == 4 and $VSurCategory == 1) and
			($i == 4 and $DRSurCategory == 1) )
		) {

			if ($sc->getNightPercent()<>0) { 
				$NightStart=$sc->getNightStart();
				$NightEnd=$sc->getNightEnd();
				$NightPrice='Night from '.$NightStart.' to '.$NightEnd; 
				$sur['NightPrice'][$NightPrice] = $sc->getNightPercent();
				if($sc->getNightPercent()<0) $minPercent+=$sc->getNightPercent();
				else $maxPercent+=$sc->getNightPercent();
			}				
			
			$days=array();
			if ($sc->getMonPercent()<>0) $days['Monday'] = $sc->getMonPercent();
			if ($sc->getTuePercent()<>0) $days['Tuesday'] = $sc->getMonPercent();
			if ($sc->getWedPercent()<>0) $days['Wednesday'] = $sc->getWedPercent();
			if ($sc->getThuPercent()<>0) $days['Thursday'] = $sc->getThuPercent();
			if ($sc->getFriPercent()<>0) $days['Friday'] = $sc->getFriPercent();
			if ($sc->getSatPercent()<>0) $days['Saturday'] = $sc->getSatPercent();
			if ($sc->getSunPercent()<>0) $days['Sunday'] = $sc->getSunPercent();
			if (count($days)>0) {
				$sur['WeekdaysAdds']=$days;
				if(min($days)<0) $minPercent+=min($days);
				$maxPercent+=max($days);
			}

			$seasons=array();
			if ($sc->getS1Percent()<>0) { 
				$SeasonStart=$sc->getS1Start();
				$SeasonEnd=$sc->getS1End();
				$SeasonPrice='Season 1 from '.$SeasonStart.' to '.$SeasonEnd; 
				$seasons[$SeasonPrice] = $sc->getS1Percent();
			}				
			if ($sc->getS2Percent()<>0) { 
				$SeasonStart=$sc->getS2Start();
				$SeasonEnd=$sc->getS2End();
				$SeasonPrice='Season 2 from '.$SeasonStart.' to '.$SeasonEnd; 
				$seasons[$SeasonPrice] = $sc->getS2Percent();
			}	
			if ($sc->getS3Percent()<>0) { 
				$SeasonStart=$sc->getS3Start();
				$SeasonEnd=$sc->getS3End();
				$SeasonPrice='Season 3 from '.$SeasonStart.' to '.$SeasonEnd; 
				$seasons[$SeasonPrice] = $sc->getS3Percent();
			}				
			if ($sc->getS4Percent()<>0) { 
				$SeasonStart=$sc->getS4Start();
				$SeasonEnd=$sc->getS4End();
				$SeasonPrice='Season 4 from '.$SeasonStart.' to '.$SeasonEnd; 
				$seasons[$SeasonPrice] = $sc->getS4Percent();
			}				
			if ($sc->getS5Percent()<>0) { 
				$SeasonStart=$sc->getS5Start();
				$SeasonEnd=$sc->getS5End();
				$SeasonPrice='Season 5 from '.$SeasonStart.' to '.$SeasonEnd; 
				$seasons[$SeasonPrice] = $sc->getS5Percent();
			}				
			if ($sc->getS6Percent()<>0) { 
				$SeasonStart=$sc->getS6Start();
				$SeasonEnd=$sc->getS6End();
				$SeasonPrice='Season 6 from '.$SeasonStart.' to '.$SeasonEnd; 
				$seasons[$SeasonPrice] = $sc->getS6Percent();
			}				
			if ($sc->getS7Percent()<>0) { 
				$SeasonStart=$sc->getS7Start();
				$SeasonEnd=$sc->getS7End();
				$SeasonPrice='Season 7 from '.$SeasonStart.' to '.$SeasonEnd; 
				$seasons[$SeasonPrice] = $sc->getS7Percent();
			}				
			if ($sc->getS8Percent()<>0) { 
				$SeasonStart=$sc->getS8Start();
				$SeasonEnd=$sc->getS8End();
				$SeasonPrice='Season 8 from '.$SeasonStart.' to '.$SeasonEnd; 
				$seasons[$SeasonPrice] = $sc->getS8Percent();
			}				
			if ($sc->getS9Percent()<>0) { 
				$SeasonStart=$sc->getS9Start();
				$SeasonEnd=$sc->getS9End();
				$SeasonPrice='Season 9 from '.$SeasonStart.' to '.$SeasonEnd; 
				$seasons[$SeasonPrice] = $sc->getS9Percent();
			}				
			if ($sc->getS10Percent()<>0) { 
				$SeasonStart=$sc->getS10Start();
				$SeasonEnd=$sc->getS10End();
				$SeasonPrice='Season 10 from '.$SeasonStart.' to '.$SeasonEnd; 
				$seasons[$SeasonPrice] = $sc->getS10Percent();
			}
			if (count($seasons)>0) {
				$sur['SeasonsAdds']=$seasons;
				if(min($seasons)<0) $minPercent+=min($seasons);
				$maxPercent+=max($seasons);
			}			
		}
    }
	$sur['MinPercent']=$minPercent;
	$sur['MaxPercent']=$maxPercent;
	
    return $sur;
}

function getTripAdvisorData() {
	// api key
	// curl
	// json to array
	$ta['value']=4.5;
	$ta['count']=634;
	return $ta;
}

function getFAQ($sa) {
	$where="WHERE Scheme=1 ";
	$sak=$sa->getKeysBy('ID', '', $where);
	$faqs=array();
	if (count($sak)>0) {
		foreach ($sak as $key) {
			$sa->getRow($key);
			$row['question']=$sa->getTitle();
			$row['answer']=$sa->getArticle();
			$faqs[]=$row;
		}	
	}	
	return $faqs;
}	

class JAMTransferSchemaGenerator {
    

	
    public function generateSchemaFromJSON($jsonData) {
        $schemas = [];
        
        // Generiši schema za svaku rutu
        foreach ($jsonData['Routes'] as $route) {
            if (empty($route['Services'])) continue;
            
            $schema = $this->createTravelActionSchema($route, $jsonData);
            if ($schema) {
                $schemas[] = $schema;
            }
        }
        
        // Generiši FAQ schema
		$faqSchema = $this->generateFAQSchema($jsonData);
        if ($faqSchema) {
            $schemas[] = $faqSchema;
        }
        
        return $schemas;
    }    
	
    function createTravelActionSchema($route, $jsonData) {
        $fromLocation = $route['FromPlace'];
        $toLocation = $route['ToPlace'];
        $fromCountry = $route['FromCountry'];
        $toCountry = $route['ToCountry'];
		$areaServed = $fromCountry;
		if ($fromCountry<>$toCountry) $areaServed .= ", ".$toCountry;
        
        if (empty($toLocation)) return null;
        
        // Kreiraj offers iz services
        $offers = [];
        foreach ($route['Services'] as $service) {
            $offer = $this->createOfferFromService($service, $route, $jsonData);
            if ($offer) {
                $offers[] = $offer;
            }
        }
        
        if (empty($offers)) return null;
        
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'TaxiService',
            'name' => "{$fromLocation} to {$toLocation}  Transfer",
            'description' => "Airport taxi transfer from {$fromLocation} to {$toLocation}",
            'areaServed' => $areaServed,
            /*'fromLocation' => [
                '@type' => $this->determineLocationType($fromLocation),
                'name' => $fromLocation,
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressCountry' => $fromCountry
                ]
            ],
            
            'toLocation' => [
                '@type' => $this->determineLocationType($toLocation),
                'name' => $toLocation,
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressCountry' => $toCountry
                ]
            ],*/
            
            'provider' => [
                '@type' => 'Organization',
                'name' => 'JAMTransfer',
                'url' => 'https://jamtransfer.com',
                'logo' => 'https://wis.jamtransfer.com/i/logo.png'
            ],
            
			'aggregateRating'=> [
				'@type' => 'AggregateRating',
				'ratingValue' => $jsonData["ratingValue"],
				'bestRating' => '5',
				'worstRating' => '1',
				'ratingCount' => $jsonData["ratingCount"]
			],			
				
            'offers' => $offers
        ];
        
        // Dodaj dodatne informacije ako postoje
        $additionalProperties = [];
        
        if (!empty($route['Km']) && $route['Km'] !== '0') {
            $additionalProperties[] = [
                '@type' => 'PropertyValue',
                'name' => 'Distance',
                'value' => $route['Km'] . 'km'
            ];
        }
        
        if (!empty($route['Duration']) && $route['Duration'] !== '0') {
            $additionalProperties[] = [
                '@type' => 'PropertyValue',
                'name' => 'Duration',
                'value' => $this->formatDuration($route['Duration'])
            ];
        }
        
        $additionalProperties[] = [
            '@type' => 'PropertyValue',
            'name' => 'Available 24/7',
            'value' => 'true'
        ];
        
        if (!empty($additionalProperties)) {
            $schema['additionalProperty'] = $additionalProperties;
        }
        
        return $schema;
    }
    
    private function createAdditionalPropertyFromService($service) {
        // Dodaj kapacitet
		$additionalProperty = [
			[
				'@type' => 'PropertyValue',
				'name' => 'Passenger Capacity',
				'value' => $service['MaxPax'] . ' passengers'
			]
		];
		
		// Dodaj kategoriju vozila
		$category = $this->extractVehicleCategory($service['Vehicle']);
		if ($category) {
			$additionalProperty[] = [
				'@type' => 'PropertyValue',
				'name' => 'Vehicle Category',
				'value' => $category
			];
		}
		
		if ($service['PriceAdds']['SpecialDates']) {
			foreach ($service['PriceAdds']['SpecialDates'] as $key=>$adds) {
				$additionalProperty[] = [
					'@type' => 'PropertyValue',
					'name' => 'Price Adds for '.$key,
					'value' => $adds."%"
				];	
			}
		}		
		if ($service['PriceAdds']['NightPrice']) {
			foreach ($service['PriceAdds']['NightPrice'] as $key=>$adds) {
				$additionalProperty[] = [
					'@type' => 'PropertyValue',
					'name' => 'Price Adds for '.$key,
					'value' => $adds."%"
				];	
			}
		}			
		if ($service['PriceAdds']['WeekdaysAdds']) {
			foreach ($service['PriceAdds']['WeekdaysAdds'] as $key=>$adds) {
				$additionalProperty[] = [
					'@type' => 'PropertyValue',
					'name' => 'Price Adds for '.$key,
					'value' => $adds."%"
				];	
			}
		}			
		if ($service['PriceAdds']['SeasonsAdds']) {
			foreach ($service['PriceAdds']['SeasonsAdds'] as $key=>$adds) {
				$additionalProperty[] = [
					'@type' => 'PropertyValue',
					'name' => 'Price Adds for '.$key,
					'value' => $adds."%"
				];	
			}
		}	
		return $additionalProperty;	
	}
	private function createOfferFromService($service, $route, $jsonData) {
		$priceInfo['min']=number_format($service['minPrice'],2);
		$priceInfo['max']=number_format($service['maxPrice'],2);
        if ($priceInfo['min'] === 0) return null;
        $offer = [
            '@type' => 'Offer',
            'name' => $service['Vehicle'],
            'priceCurrency' => 'EUR',
            'validThrough' => $jsonData['ValidTo'],
            'availability' => 'InStock',
            'description' => $service['Vehicle'] . ' - Professional airport transfer service',
            'url' => $route['Link'] ?? 'https://jamtransfer.com'
        ];
        
        // Dodaj cenu ili price range
        if ($priceInfo['max'] && $priceInfo['max'] > $priceInfo['min']) {
            $offer['priceSpecification'] = [
                '@type' => 'PriceSpecification',
                'minPrice' => $priceInfo['min'],
                'maxPrice' => $priceInfo['max'],
                'priceCurrency' => 'EUR'
            ];
        } else {
            $offer['price'] = $priceInfo['min'];
        }
		$additionalProperty = $this->createAdditionalPropertyFromService($service);
        if ($additionalProperty) {
            $offer['additionalProperty'] = $additionalProperty;
        }
        // Dodaj kapacitet
		/*$offer['additionalProperty'] = [
			[
				'@type' => 'PropertyValue',
				'name' => 'Passenger Capacity',
				'value' => $service['MaxPax'] . ' passengers'
			]
		];
		
		// Dodaj kategoriju vozila
		$category = $this->extractVehicleCategory($service['Vehicle']);
		if ($category) {
			$offer['additionalProperty'][] = [
				'@type' => 'PropertyValue',
				'name' => 'Vehicle Category',
				'value' => $category
			];
		}*/
        return $offer;
    }
    
    function generateFAQSchema($jsonData) {
        $faqItems = [];
        $processedRoutes = [];
        
        // Uzmi top 5 ruta sa najmanjim cenama
        $routes = array_filter($jsonData['Routes'], function($route) {
            return !empty($route['Services']);
        });
        usort($routes, function($a, $b) {
            $priceA = $this->getMinPrice($a['Services']);
            $priceB = $this->getMinPrice($b['Services']);
            return $priceA <=> $priceB;
        });	
        $topRoutes = array_slice($routes, 0, 10);
        foreach ($topRoutes as $route) {

            $minPrice = $this->getMinPrice($route['Services']);
            $addPrice = $this->getAddPrice($route['Services']);
            $fromLocation=$route['FromPlace'];
            $toLocation=$route['ToPlace'];
            // FAQ o ceni
            $faqItems[] = [
                '@type' => 'Question',
                'name' => "How much does airport taxi transfer from {$fromLocation} to {$toLocation} cost?",
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => "Transfer from {$fromLocation} to {$toLocation} starts at €{$minPrice}. 
					We offer various vehicle types including standard and premium options with different passenger capacities. ".$addPrice
                ]
            ];
            
            // FAQ o trajanju
            if (!empty($route['Duration']) && $route['Duration'] !== '0') {
                $duration = $this->formatDuration($route['Duration']);
                $distance = !empty($route['Km']) && $route['Km'] !== '0' ? " ({$route['Km']}km)" : '';
                
                $faqItems[] = [
                    '@type' => 'Question',
                    'name' => "How long does airport taxi transfer from {$fromLocation} to {$toLocation} take?",
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => "The transfer from {$fromLocation} to {$toLocation} takes approximately {$duration}{$distance} depending on traffic conditions."
                    ]
                ];
            }
            
            $processedRoutes[] = $route['RouteName'];
        }
		$faqs=$jsonData['faq'];
		foreach ($faqs as $f) {
			$faqItems[] = [
                '@type' => 'Question',
                'name' => $f['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $f['answer']
                ]
            ];	
		}	
        if (empty($faqItems)) return null;
        
        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $faqItems
        ];
    }
    
    private function extractVehicleCategory($vehicleName) {
        if (stripos($vehicleName, 'Standard') !== false) return 'Standard';
        if (stripos($vehicleName, 'Premium') !== false) return 'Premium';
        if (stripos($vehicleName, 'First Class') !== false) return 'First Class';
        return null;
    }
    
    private function determineLocationType($locationName) {
        $lower = strtolower($locationName);
        if (strpos($lower, 'airport') !== false) return 'Airport';
        //if (strpos($lower, 'port') !== false) return 'SeaPort';
        if (strpos($lower, 'station') !== false) return 'TrainStation';
        return 'Place';
    }
    
    private function formatDuration($minutes) {
        $mins = intval($minutes);
        if ($mins === 0) return '';
        
        $hours = floor($mins / 60);
        $remainingMins = $mins % 60;
        
        if ($hours > 0 && $remainingMins > 0) {
            return "{$hours}h {$remainingMins}min";
        } elseif ($hours > 0) {
            return "{$hours}h";
        } else {
            return "{$mins}min";
        }
    }
    
    private function getMinPrice($services) {
        $minPrice = PHP_INT_MAX;        
        foreach ($services as $service) {
            if ($service['minPrice'] > 0 && $service['minPrice'] < $minPrice) {
                $minPrice = $service['minPrice'];
            }
        }
        return $minPrice === PHP_INT_MAX ? 0 : $minPrice;
    }    
	
	private function getAddPrice($services)	{
		$addsOnPrice="";
		foreach ($services as $service) {
			$addsOnPrice.="<br>".$service['Vehicle']." Price is: €".$service['finalPrice'].".";
			if (isset($service['PriceAdds']) && count($service['PriceAdds'])>0) {
				$addsOnPrice.="<br>".$service['Vehicle']." Adds to the price are: ";
				if (isset($service['PriceAdds']['SpecialDates']) && count($service['PriceAdds']['SpecialDates'])>0) {
					$adds=$service['PriceAdds']['SpecialDates'];
					foreach ($adds as $key=>$add) {
						if ($add > 0) $addsOnPrice.=$key." / ".$add."%, ";  
					}
				}		 
				if (isset($service['PriceAdds']['NightPrice']) && count($service['PriceAdds']['NightPrice'])>0) {
					$adds=$service['PriceAdds']['NightPrice'];
					foreach ($adds as $key=>$add) {
						if ($add > 0) $addsOnPrice.=$key." / ".$add."%, ";  
					}
				}				
				if (isset($service['PriceAdds']['WeekdaysAdds']) && count($service['PriceAdds']['WeekdaysAdds'])>0) {
					$adds=$service['PriceAdds']['WeekdaysAdds'];
					foreach ($adds as $key=>$add) {
						if ($add > 0) $addsOnPrice.=$key." / ".$add."%, ";  
					}
				}						
				if (isset($service['PriceAdds']['SeasonsAdds']) && count($service['PriceAdds']['SeasonsAdds'])>0) {
					$adds=$service['PriceAdds']['SeasonsAdds'];
					foreach ($adds as $key=>$add) {
						if ($add > 0) $addsOnPrice.=$key." / ".$add."%, ";  
					}
				}
				$addsOnPrice=substr($addsOnPrice, 0, strlen($addsOnPrice) - 2);
			}	
		}	
        return $addsOnPrice;
    }
}



