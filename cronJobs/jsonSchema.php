<?
// CronJob azurira json Schema. FAQ i html
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");

$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";


//require_once $root.'/config.php';
require_once $root.'/common/functions/f.php';
require_once $root.'/db/db.class.php';
require_once $root.'/db/v4_Services.class.php';
require_once $root.'/db/v4_Terminals.class.php';
require_once $root.'/db/v4_Places.class.php';
require_once $root.'/db/v4_Routes.class.php';
require_once $root.'/db/v4_TopRoutes.class.php';
require_once $root.'/db/v4_DriverRoutes.class.php';
require_once $root.'/db/v4_AuthUsers.class.php';
require_once $root.'/db/v4_Vehicles.class.php';
require_once $root.'/db/v4_VehicleTypes.class.php';
require_once $root.'/db/v4_Articles.class.php';
require_once $root.'/db/v4_CoInfo.class.php';
$dbT = new DataBaseMysql();
$s  = new v4_Services();
$t  = new v4_Terminals();
$pl  = new v4_Places();
$r  = new v4_Routes();
$tr  = new v4_TopRoutes();
$dr = new v4_DriverRoutes();
$au = new v4_AuthUsers();
$v  = new v4_Vehicles();
$vt = new v4_VehicleTypes();
$sa = new v4_Articles();
$ci = new v4_CoInfo();

$where = " WHERE `LastChange`>'0000-00-00' AND `LastChange`< (NOW()- INTERVAL 15 DAY)";
$tkeys= $t->getKeysBy("LastChange ASC","Limit 1", $where);
foreach ($tkeys as $tk) {
	$routes=array();
	$pl->getRow($tk);
	$terminalname=$pl->getPlaceNameEN();
	$terminalnameurl=$pl->getPlaceNameSEO();
	$t->getRow($tk);
	$imageurl="https://jamtransfer.com".$t->getImageMP();
	$mainroutes = $tr->getKeysBy("TopRouteID", "ASC", "WHERE Main=1");
	$rWhere = "WHERE (FromID = '".$tk."' or ToID = '".$tk."') AND Approved = '1' AND RouteID in (SELECT `TopRouteID` FROM `v4_TopRoutes`)";
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
			$NameURL=$from."-to-".$to;	
				
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
							
							$Provision = getProvision($DriversPrice, $s->getOwnerID(), $VehicleClass);
							$CalculatedPrice = $DriversPrice+$DriversPrice*$Provision/100;
							$sur = Adds($OwnerID, $SurCategory, $CalculatedPrice,
											  $transferDate, $transferTime,
											  $returnDate, $returnTime,
											  $RouteID, $VehicleID, $ServiceID,
											  $VSurCategory, $DRSurCategory
											  );
										  
							$Driver=$OwnerID." ".$users[$OwnerID]->AuthUserRealName;	
							$min=1+$sur['MinPercent']/100;				  
							$max=1+$sur['MaxPercent']/100;

							$FinalPrice = number_format($CalculatedPrice,0);
							$FinalPriceMin = number_format($CalculatedPrice*$min,0);
							$FinalPriceMax = number_format($CalculatedPrice*$max,0);
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
					'NameURL'         	=> $NameURL,
					'Km'                => $Km,
					'Duration'          => $Duration,
					'Services'			=> $services);
		}
		usort($toproutes, function($a, $b) {
			return $a['RouteID'] > $b['RouteID'];
		});
		$comp="";
			

		/*foreach ($toproutes as $key =>$c) {
			unset($toproutes[$key]['RouteID']);
		}*/	
			
		$terminal['Name']=$terminalname;
		$terminal['Image']=$imageurl;
		$terminal['ValidTo']=date("Y-m-d",time()+3600*24*180);
		$tripAdvisor=getTripAdvisorData($ci);
		$terminal['ratingValue']=number_format($tripAdvisor['value'],2);
		$terminal['ratingCount']=number_format($tripAdvisor['count'],0);
		$terminal['faq']=getFAQ($sa);
		$terminal['Routes']=$toproutes;
	}
	$generator = new JAMTransferSchemaGenerator();
	// Generiši Popular Routes Section
	$prs='<div class="route-grid">';
	foreach ($terminal['Routes'] as $route) {
		if (empty($route['Services']) || !in_array($route['RouteID'],$mainroutes) ) continue;
		$minimum=100000;
		foreach($route['Services'] as $s) {
			if ($s['minPrice']<$minimum) $minimum=$s['minPrice'];	
		}	
		$prs.='<div class="route-item">';
		$prs.='<a href="'.$route['Link'].'" class="route-link">'.$route['FromPlace'].' to '.$route['ToPlace'].'</a>';
		$prs.='<div class="route-details">Distance: '.$route['Km'].' km | Duration: '.$route['Duration'].' min | From €'.number_format($minimum,0).'</div>';
		$prs.='</div>';	
	}
	$prs.='</div>';	
	// Zamena <!-- Popular Routes Section -->
	$filename=$root.'/site_terminals/'.$terminalnameurl.'.html';
	$file_handle = fopen($filename, "r");
	$html_content = fread($file_handle, filesize($filename));
	fclose($file_handle);
	$pattern = '/<div class="route-item">.*?<\/div>\s*<\/div>/s';
	$replacement = '';
	$result = preg_replace($pattern, $replacement, $html_content);
	
	$pattern = '/(<div class="route-grid">).*?(<\/div>\s*?)(?=\s*<\/div>)/s';
	$result2 = preg_replace($pattern, $prs, $result, 1);
	unlink($root.'/site_terminals/'.$terminalnameurl.'.html');
	$fp = fopen($root.'/site_terminals/'.$terminalnameurl.'.html', 'w');
	fwrite($fp, $result2);

	// generisanje i snimanje schema terminala i main ruta
	$schemaTerminal="";
	foreach ($terminal['Routes'] as $route) {
		$schema = $generator->createTravelActionSchema($route, $terminal);
		$schemaRoute="";
		$schemaRoute.='<script type="application/ld+json">';
		$schemaRoute.=json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		$schemaRoute.='</script>' . PHP_EOL;
		if (in_array($route['RouteID'],$mainroutes)) $schemaTerminal.=$schemaRoute;
		$faqSchema= $generator->generateFAQSchema($terminal,$route['NameURL'],$mainroutes,$route['RouteID']);
		$schemaRoute.='<script type="application/ld+json">';
		$schemaRoute.=json_encode($faqSchema, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		$schemaRoute.='</script>' . PHP_EOL;	
		ob_start(); 
		echo $schemaRoute;
		$schemaPrint = ob_get_contents();
		ob_end_clean();
		unlink($root.'/schemas/'.$route['NameURL'].'.html');
		$fp = fopen($root.'/schemas/'.$route['NameURL'].'.html', 'w');
		fwrite($fp, $schemaPrint);	
	}
	$faqSchema = $generator->generateFAQSchema($terminal,$terminalnameurl,$mainroutes,0);
	$schemaTerminal.='<script type="application/ld+json">';
	$schemaTerminal.=json_encode($faqSchema, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	$schemaTerminal.='</script>' . PHP_EOL;

	ob_start(); 
	echo $schemaTerminal;
	$schemaPrint = ob_get_contents();
	ob_end_clean();
	unlink($root.'/schemas/'.$terminalnameurl.'.html');
	
	$fp = fopen($root.'/schemas/'.$terminalnameurl.'.html', 'w');
	fwrite($fp, $schemaPrint);
	
	$t->setLastChange(date("Y-m-d"));	
	$t->saveRow();
	//echo date("Y-m-d");

	/*if ($fp) echo "<div class='success'>JSON shema formatted!</div>";
	else echo "<div class='error'>JSON shema not formatted!</div>";*/
}

// Dodavanje dogovorene provizije na osnovnu cijenu
function getProvision($price, $ownerid, $VehicleClass = 1) {
	$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';

    require_once $root.'/db/db.class.php';
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
            }
            // PREMIUM CLASS
            if($VehicleClass >= 11 and $VehicleClass < 21) {
                if      ($priceR >= $d->PR1Low and $priceR <= $d->PR1Hi) $provision=$d->PR1Percent ;
                else if ($priceR >= $d->PR2Low and $priceR <= $d->PR2Hi) $provision=$d->PR2Percent ;
                else if ($priceR >= $d->PR3Low and $priceR <= $d->PR3Hi) $provision=$d->PR3Percent ;
            }
            // FIRST CLASS
            if($VehicleClass >= 21) {
                if      ($priceR >= $d->FR1Low and $priceR <= $d->FR1Hi) $provision=$d->FR1Percent ;
                else if ($priceR >= $d->FR2Low and $priceR <= $d->FR2Hi) $provision=$d->FR2Percent ;
                else if ($priceR >= $d->FR3Low and $priceR <= $d->FR3Hi) $provision=$d->FR3Percent ;
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
	$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
    require_once $root.'/db/db.class.php';
    $dbT = new DataBaseMysql();

    $w = $dbT->RunQuery("SELECT * FROM v4_VehicleTypes WHERE VehicleTypeID = '{$vehicleTypeID}'");
    $v = $w->fetch_object();

    return $v->VehicleTypeName;
}

function calculateSpecialDates($OwnerID, $amount, $transferDate, $transferTime, $returnDate='', $returnTime='') {
	$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';

    if( empty($OwnerID) or empty($amount) or empty($transferDate)  or empty($transferTime) ) return 0;

    require_once $root.'/db/db.class.php';
    require_once $root.'/db/v4_SpecialDates.class.php';
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
	$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
    // Variables
    $sur = array();
    $finished = false;
    for($i=1; $i<=4;$i++) {
		switch($i) {
			case '4':
				require_once $root.'/db/v4_SurGlobal.class.php';
				$sc = new v4_SurGlobal();

				$sck = $sc->getKeysBy('ID', 'asc', ' WHERE OwnerID = ' . $OwnerID);
				if (count($sck) > 0) $sc->getRow($sck[0]);
				break;
			case '2':
				require_once $root.'/db/v4_SurVehicle.class.php';
				$sc = new v4_SurVehicle();
				$where = ' WHERE OwnerID = ' . $OwnerID . ' AND VehicleID = ' . $VehicleID;
				$sck = $sc->getKeysBy('ID', 'asc', $where);
				if (count($sck) > 0) {
					$sc->getRow($sck[0]);
				}
				break;
			case '3':
				require_once $root.'/db/v4_SurRoute.class.php';
				$sc = new v4_SurRoute();
				$where = ' WHERE OwnerID = ' . $OwnerID . ' AND DriverRouteID = ' . $RouteID;
				$sck = $sc->getKeysBy('DriverRouteID', 'asc', $where);
				if (count($sck) > 0) {
					$sc->getRow($sck[0]);
				}
				break;
			case '1':
				require_once $root.'/db/v4_SurService.class.php';
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
		require_once $root.'/db/v4_SpecialDates.class.php';
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

function getTripAdvisorData($ci) {
	$ci->getRow(2);
	$ta['value']=$ci->getta_rate();
	$ta['count']=$ci->getta_number();
	/*$ta['value']=4.5;
	$ta['count']=636;*/
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
		
		$additionalProperty[] = [
			'@type' => 'PropertyValue',
			'propertyID' => 'price-formula',
			'name' => 'Pricing Formula',
			'value' => 'multiplicative-special-days',
            'description' => 'Regular adds are summed, then special day multiplier is applied'			
		];
		
		if ($service['PriceAdds']['SpecialDates']) {
			foreach ($service['PriceAdds']['SpecialDates'] as $key=>$adds) {
				$additionalProperty[] = [
					'@type' => 'PropertyValue',
					'propertyID' => 'special-day-multiplier',
					'name' => 'Price Adds for '.$key,
					'value' => $adds."%"
				];	
			}
		}		
		if ($service['PriceAdds']['NightPrice']) {
			foreach ($service['PriceAdds']['NightPrice'] as $key=>$adds) {
				$additionalProperty[] = [
					'@type' => 'PropertyValue',
					'propertyID' => 'regular-add',
					'name' => 'Price Adds for '.$key,
					'value' => $adds."%"
				];	
			}
		}			
		if ($service['PriceAdds']['WeekdaysAdds']) {
			foreach ($service['PriceAdds']['WeekdaysAdds'] as $key=>$adds) {
				$additionalProperty[] = [
					'@type' => 'PropertyValue',
					'propertyID' => 'regular-add',					
					'name' => 'Price Adds for '.$key,
					'value' => $adds."%"
				];	
			}
		}			
		if ($service['PriceAdds']['SeasonsAdds']) {
			foreach ($service['PriceAdds']['SeasonsAdds'] as $key=>$adds) {
				$additionalProperty[] = [
					'@type' => 'PropertyValue',
					'propertyID' => 'regular-add',					
					'name' => 'Price Adds for '.$key,
					'value' => $adds."%"
				];	
			}
		}	
		return $additionalProperty;	
	}
	private function createOfferFromService($service, $route, $jsonData) {
		$priceInfo['basic']=number_format($service['finalPrice'],2);
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
			$priceCalculationMethod = [
					'@type' => 'PropertyValue',
					'name' => 'Price Calculation Method',
					'value'=> 'additive',
					'description' => 'All percentage adds are applied to base price and summed'
				];
            $offer['priceSpecification'] = [
                '@type' => 'PriceSpecification',
                'Price' => $priceInfo['basic'],
                'minPrice' => $priceInfo['min'],
                'maxPrice' => $priceInfo['max'],
                'priceCurrency' => 'EUR',
				//'priceCalculationMethod' => $priceCalculationMethod				
				'description' => 'Price calculation: BasePrice × (1 + SUM(regular_adds)) × (1 + special_day_add)'
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
    
    function generateFAQSchema($jsonData,$nameurl,$mainroutes,$id) {
		$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
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
        foreach ($routes as $route) {
			if (($id==0 && in_array($route['RouteID'],$mainroutes)) || $id==$route['RouteID']) {
				$minPrice = $this->getMinPrice($route['Services']);
				$addPrice = $this->getAddPrice($route['Services']);
				$fromLocation=$route['FromPlace'];
				$toLocation=$route['ToPlace'];
				// FAQ o ceni
				/*$faqItems[] = [
					'@type' => 'Question',
					'name' => "How much does airport taxi transfer from {$fromLocation} to {$toLocation} cost?",
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text' => "Transfer from {$fromLocation} to {$toLocation} starts at €{$minPrice}. 
						We offer various vehicle types including standard and premium options with different passenger capacities. ".$addPrice
					]
				];*/
				
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
		
		$faqhtml.='
			<style>
				.faq-section {
					margin: 40px 0;
					padding: 20px;
					background: #fff;
					border-radius: 10px;
					border: 1px solid #e2e8f0;
				}
				
				.faq-section h3 {
					color: #4a5568;
					margin-top: 0;
					margin-bottom: 20px;
					font-size: 1.5em;
					border-bottom: 2px solid #3182ce;
					padding-bottom: 10px;
				}
				
				.faq-item {
					margin-bottom: 15px;
					border: 1px solid #e2e8f0;
					border-radius: 8px;
					overflow: hidden;
				}
				
				.faq-question {
					background-color: #f7fafc;
					padding: 18px 20px;
					cursor: pointer;
					display: block;
					font-weight: 600;
					color: #2d3748;
					transition: background-color 0.3s ease;
				}
				
				.faq-question:hover {
					background-color: #edf2f7;
				}
				
				.faq-checkbox {
					display: none;
				}
				
				.faq-answer {
					max-height: 0;
					overflow: hidden;
					transition: max-height 0.3s ease;
					background-color: #fff;
				}
				
				.faq-checkbox:checked ~ .faq-answer {
					max-height: 1500px;
				}
				
				.faq-answer-content {
					padding: 20px;
					color: #4a5568;
					line-height: 1.8;
				}
				
				.price-detail {
					margin: 8px 0;
					padding: 8px 12px;
					background-color: #f7fafc;
					border-left: 3px solid #3182ce;
					border-radius: 4px;
				}
				
				.season-surcharge {
					color: #d69e2e;
					font-weight: 600;
					font-size: 0.9em;
				}
			</style>

			<div class="faq-section">
				<h3>Frequently Asked Questions</h3>
		';
		$index=0;
		foreach ($faqItems as $row) {
			$index++;
			$faq.="<strong>".$row['name']."</strong><br>".$row['acceptedAnswer']['text']."<br>";
			
			$faqhtml.='<div class="faq-item">';
			$faqhtml.='<input type="checkbox" id="faq'.$index.'" class="faq-checkbox">';
			$faqhtml.='<label for="faq'.$index.'" class="faq-question">'.$row['name'].'</label>';
			$faqhtml.='<div class="faq-answer">';
			$faqhtml.='<div class="faq-answer-content">'.$row['acceptedAnswer']['text'].'</div>';
			$faqhtml.='</div>';
			$faqhtml.='</div>';	
		}
		$faqhtml.='</div>';	
		if ($id==0) $baseURL=$root.'/faq/'.$nameurl.'.html';
		else $baseURL=$root.'/faq/routes/'.$id.'.html';
		unlink($baseURL);
		$fp = fopen($baseURL, 'w');
		fwrite($fp, $faqhtml);		
		
		
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



