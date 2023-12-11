<?
/*
	napomena za Surcharges:
	0 - nema
	1 - global + OwnerID
	2 - route + OwnerID + RouteID
	3 - vehicle + OwnerID + VehicleID
	4 - service + OwnerID + ServiceID

	Podatak se nalazi u SurCategory polju, plus ova ostala polja za lookup.

	Logika je:
	- ako je u Services SurCategory 0,
	- pogledaj u Vehicles. Ako je i tamo nula,
	- pogledaj u Routes. Ako je i tamo nula,
	- pogledaj u SurGlobal

	Ovo bi trebalo pametnije rijesit.
	Kod odabira surcharges bi trebalo u sve upisat kategoriju.
	Npr. ako vozac na profilu stavi Global, onda bi u sva njegova vozila, rute i services
	trebalo odmah upisat 1.
	Ako kasnije na neku rutu stavi Route surcharges, onda bi u sve Services za tu rutu
	trebalo upisat 2.
	Ako stavi samo za neko vozilo, onda bi u sve Services za to vozilo trebalo stavit 3.
	Ako stavi samo za jednu uslugu, onda tu ide 4.

	Tako bi se odmah moglo znat di triba gledat.

	Ako nesto kasnije promijeni, postupak bi treba bit isti.
	Npr. ako za neko vozilo stavi da nema surcharges, a prije je bilo,
	onda bi za sve Services od toga vozila trebalo stavit 0, ako je prije bilo 3.
	Ako je bilo 4, onda ne dirat.


*/

require_once '../config.php';

require_once '../db/db.class.php';
require_once '../db/v4_Services.class.php';
require_once '../db/v4_Places.class.php';
require_once '../db/v4_Routes.class.php';
require_once '../db/v4_DriverRoutes.class.php';
require_once '../db/v4_AuthUsers.class.php';
require_once '../db/v4_Vehicles.class.php';
require_once '../db/v4_VehicleTypes.class.php';


//echo '<pre>'; print_r($_POST); echo '</pre>';
$dbT = new DataBaseMysql();

$s  = new v4_Services();
$r  = new v4_Routes();
$dr = new v4_DriverRoutes();
$au = new v4_AuthUsers();
$v  = new v4_Vehicles();
$vt = new v4_VehicleTypes();


$routes=array();
$PlaceID=$_REQUEST["PlaceID"];
if ($_REQUEST['RouteID']>-1) $routes[]=$_REQUEST['RouteID'];
else {
$rWhere = "WHERE (FromID = '".$PlaceID."' or ToID = '".$PlaceID."') AND Approved = '1'";
	$routes = $r->getKeysBy('RouteID', "ASC", $rWhere);
}	

$transferDate   = $_REQUEST['TransferDate'];
$transferTime   = $_REQUEST['TransferTime'];
$only   = $_REQUEST['Only'];
if (isset($_REQUEST['AgentID'])) $AgentID = $_REQUEST['AgentID'];
else $AgentID =0;

$returnDate     = '';
$returnTime     = '';



if (isset($_REQUEST["LongD"]) && $_REQUEST["LongD"]>0 && isset($_REQUEST["LattD"]) && $_REQUEST["LattD"]>0) {
	$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";
	$url='https://api.openrouteservice.org/v2/directions/driving-car?api_key='.$api_key.'&start='.$_REQUEST["Long"].','.$_REQUEST["Latt"].'&end='.$_REQUEST["LongD"].','.$_REQUEST["LattD"];		
	$json = file_get_contents($url);   
	$obj="";
	$obj = json_decode($json,true);				 	
	$Km=0;
	if ($json) {
		$Km=($obj['features'][0]['properties']['segments'][0]['distance'])/1000;
		$Duration=nf(($obj['features'][0]['properties']['segments'][0]['duration'])/60);
	}
	$pl = new v4_Places();
	if ($_REQUEST["PlaceID"]==0) {
		$url2='https://api.openrouteservice.org/geocode/reverse?api_key='.$api_key.'&point.lon='.$_REQUEST["Long"].'&point.lat='.$_REQUEST["Latt"];
		$json2 = file_get_contents($url2);   
		$obj2="";
		$obj2 = json_decode($json2,true);
		$locF=$obj2['features'][0]['properties']['locality'];
	}	
	else {
		$pl->getRow($_REQUEST["PlaceID"]);
		$locF=$pl->getPlaceNameEN();
	}
	$url3='https://api.openrouteservice.org/geocode/reverse?api_key='.$api_key.'&point.lon='.$_REQUEST["LongD"].'&point.lat='.$_REQUEST["LattD"];
	$json3 = file_get_contents($url3);   
	$obj3="";
	$obj3 = json_decode($json3,true);
	$locT=$obj3['features'][0]['properties']['locality'];
	$RouteName=$locF."-".$locT;

	if ($Km>0) {
		$qDT = "SELECT DriverID,TerminalID FROM v4_DriverTerminals";
		$wDT = $db->RunQuery($qDT);
		while($pDT = mysqli_fetch_object($wDT)) {
			$pl->getRow($pDT->TerminalID);
			$distance=vincentyGreatCircleDistance($pl->Latitude, $pl->Longitude, $_REQUEST["Latt"], $_REQUEST["Long"], $earthRadius = 6371000);
			if ($distance<200) $drivers[]=$pDT->DriverID;
			$distance=vincentyGreatCircleDistance($pl->Latitude, $pl->Longitude, $_REQUEST["LattD"], $_REQUEST["LongD"], $earthRadius = 6371000);
			if ($distance<200) $drivers[]=$pDT->DriverID;
		}
		$drivers=array_unique($drivers);
		if (count($drivers)>0) {
			foreach ($drivers as $d)
			{
				$driver_ids .= $d. ",";
			}
			$driver_ids = substr($driver_ids,0,strlen($driver_ids)-1);	
			$vWhere=" WHERE OwnerID in (".$driver_ids.") ";
			$vehicleKeys = $v->getKeysBy('VehicleID', "ASC", $vWhere);
			foreach ($vehicleKeys as $key) {
				$v->getRow($key);
				$OwnerID=$v->getOwnerID();
				$PriceKm=$v->getPriceKm();
				if ($PriceKm==0) {
					$APriceKm=number_format(getAveragePrice($OwnerID,$key),2);
					$v->setPriceKm($APriceKm); 
					//$statusComapny=" Avg. price/KM is ".$APriceKm;
				}	
				else {
					//$statusComapny=" Price/KM is ".$PriceKm;
					$APriceKm=0;
				}	
				if ($v->getPriceKm()>0) { 
					//echo $v->getOwnerID()."/".$v->getVehicleTypeID()."/".$v->getPriceKm()*$Km."<br>";
					$VehicleName    = getVehicleTypeName( $v->getVehicleTypeID() );
					$VehicleTypeID  = $v->getVehicleTypeID();
					$VehicleCapacity= $v->getVehicleCapacity();
					$WiFi           = $v->getAirCondition();
					$VehicleID      = $v->getVehicleID();
					$ReturnDiscount = $v->getReturnDiscount();
					$vt->getRow($VehicleTypeID);
					$VehicleClass   = $vt->getVehicleClass();
					$VehicleDescription = getVehicleDescription( $v->getVehicleTypeID() ); 
					$VehicleImage = '';
					$SurCategory    = 1;
					$DRSurCategory  = 1;
					$VSurCategory   = $v->getSurCategory();		
					$BasicPrice=$v->getPriceKm()*$Km;
					$sur = Surcharges($OwnerID, $SurCategory, $BasicPrice,
									  $transferDate, $transferTime,
									  $returnDate, $returnTime,
									  0, $VehicleID, 0,
									  $VSurCategory, $DRSurCategory
									  );
			  
					$addToPrice = $sur['MonPrice'] +
									$sur['TuePrice'] +
									$sur['WedPrice'] +
									$sur['ThuPrice'] +
									$sur['FriPrice'] +
									$sur['SatPrice'] +
									$sur['SunPrice'] +
									$sur['S1Price'] +
									$sur['S2Price'] +
									$sur['S3Price'] +
									$sur['S4Price'] +
									$sur['S5Price'] +
									$sur['S6Price'] +
									$sur['S7Price'] +
									$sur['S8Price'] +
									$sur['S9Price'] +
									$sur['S10Price'] +
									$sur['NightPrice'];	
					$DriversPrice = $BasicPrice;
					$DriversPriceAdd = $DriversPrice + $addToPrice;
					$specialDatesPrice = calculateSpecialDates($OwnerID,$DriversPriceAdd,$transferDate, $transferTime);
					$DriversPriceAdd2 = $DriversPriceAdd+$specialDatesPrice;
					$addToPrice=$addToPrice+$specialDatesPrice;
					$Provision = returnProvision($DriversPriceAdd2, $OwnerID, $VehicleClass);
					$Provision2 = returnProvision2($DriversPriceAdd2, $OwnerID, $VehicleClass);
					$FinalPrice = $DriversPriceAdd2+$DriversPriceAdd2*$Provision/100;
					$FinalPrice2 = $DriversPriceAdd2+$DriversPriceAdd2*$Provision2/100;
					// zaokruzenje cijena
					$FinalPrice = nf( round($FinalPrice,2) );
					$FinalPrice2 = nf( round($FinalPrice2,2) );

					$au->getRow($OwnerID);
					$DriverCompany = $au->getAuthUserCompany();
					$DriverCompanyFormated=$DriverCompany;
					$FinalPriceFormated=nf($FinalPrice);
						
					
					$sortHelpClass      = 1000+$VehicleTypeID;
					$sortBy = $RouteID.$sortHelpClass.$FinalPrice;				
					$cars[] = array(
						'RouteID'           => $RouteID,
						'RouteName'         => $RouteName,
						'OwnerID'           => $OwnerID,
						'DriverCompany'     => $DriverCompanyFormated,
						'StatusCompany'     => " Price/km",
						'Contract'     		=> "",
						'ProfileImage'      => $ProfileImage,
						'ServiceID'         => $ServiceID,
						'VehicleID'         => $VehicleID,
						'VehicleTypeID'     => $VehicleTypeID,
						'VehicleName'       => $VehicleName,
						'VehicleImage'      => $VehicleImage,
						'VehicleCapacity'   => $VehicleCapacity,
						'VehicleClass'      => $VehicleClass,
						'WiFi'              => $WiFi,
						'VehicleSort'       => $sortBy,
						'VehicleDescription'=> $VehicleDescription,
						'FinalPrice'        => $FinalPriceFormated, // cijena sa svim dodacima
						'FinalPrice2'        => nf($FinalPrice2), // cijena sa svim dodacima
						'DriversPrice'      => nf($DriversPrice), // cista vozacka cijena
						'OneWayPrice'       => nf($OneWayPrice), // cijena za jedan smjer sa dodacima
						'AddToPrice'       => nf($addToPrice), // dodaci na cenu
						'Provision'       => nf($Provision), // dodaci na cenu
						'Provision2'       => nf($Provision2), // dodaci na cenu
						'Rating'            => $Rating,
						'NightPrice'        => $sur['NightPrice'],
						'MonPrice'          => $sur['MonPrice'],
						'TuePrice'          => $sur['TuePrice'],
						'WedPrice'          => $sur['WedPrice'],
						'ThuPrice'          => $sur['ThuPrice'],
						'FriPrice'          => $sur['FriPrice'],
						'SatPrice'          => $sur['SatPrice'],
						'SunPrice'          => $sur['SunPrice'],
						'S1Price'           => $sur['S1Price'],
						'S2Price'           => $sur['S2Price'],
						'S3Price'           => $sur['S3Price'],
						'S4Price'           => $sur['S4Price'],
						'S5Price'           => $sur['S5Price'],
						'S6Price'           => $sur['S6Price'],
						'S7Price'           => $sur['S7Price'],
						'S8Price'           => $sur['S8Price'],
						'S9Price'           => $sur['S9Price'],
						'S10Price'          => $sur['S10Price'],
						'SpecialDatesPrice'  => $specialDatesPrice,
						'Km'                => $Km,
						'PriceKm'           => $PriceKm,
						'APriceKm'          => $APriceKm,
						'Km'                => $Km,
						'Duration'          => $Duration,
						'BasePrice'         => nf( round($BasePrice,2) )
					);	
				}
			}	
		}
	}	
}

else {
	$cars_all = array(); 
	foreach ($routes as $rt) {
		$routes_ids=
		$routes_ids .= $rt. ",";
	}
	$routes_ids = substr($routes_ids,0,strlen($routes_ids)-1);	
	// Izlazni podaci koje koriste skripte za display
	$cars = array(); // podaci o vozilima
	if (count($routes)>0) {
		$drivers = array(); // podaci o vozacima
		$carsErrorMessage = array(); // greske

		// ODAVDE KRECE
		$drWhere = "WHERE RouteID in (".$routes_ids.") AND Active = '1'";
		if (isset($_SESSION['UseDriverID']) && $_SESSION['UseDriverID']>0) $drWhere .= " AND OwnerID=".$_SESSION['UseDriverID'];
		// check for drivers for the route 
		$driverRouteKeys = $dr->getKeysBy('RouteID', "ASC", $drWhere);
		if (count($driverRouteKeys) == 0) {
			//$carsErrorMessage['title'] = $NO_DRIVERS;
			//$carsErrorMessage['text'] = $NO_DRIVERS_EXT;
		}
		else {
			// ako su pronadjene DriverRoutes, obradi svaku
			foreach($driverRouteKeys as $dri => $rowId) {
				$statusCompP=""; // za crvene, neostvarive
				$dr->getRow($rowId);
				//echo $rowId;
				//echo "<br>";
				$RouteID=$dr->getRouteID();
				$r->getRow($RouteID);
				$RouteName=$r->getRouteName();
				$Km=$r->getKm();
				
				if($dr->getFromID() == $FromID  and $dr->getOneToTwo() == '0') $statusCompP="<i>-No direction</i>";
				$OwnerID = $dr->getOwnerID();
				if($au->getRow($OwnerID)===false) continue;
				// Driver Profiles iz v4_AuthUsers
				$DriverCompany = $au->getAuthUserCompany();
				// check for Services
				$serviceKeys = $s->getKeysBy("ServiceID", "ASC", "WHERE RouteID = {$RouteID} AND OwnerID = {$OwnerID} AND Active = '1'");
				if(count($serviceKeys) == 0) { // not found
					$carsErrorMessage['title'] = $NO_VEHICLES;
					$carsErrorMessage['text'] =  $NO_VEHICLES_EXT;
				}
				else { // found
					foreach($serviceKeys as $si => $sId) {
						$s->getRow($sId);
						$ServiceID = $s->getServiceID();
						$Correction= $s->getCorrection();
						$v->getRow($s->getVehicleID());
						$VehicleName    = getVehicleTypeName( $v->getVehicleTypeID() );
						$VehicleTypeID  = $v->getVehicleTypeID();
						$VehicleCapacity= $v->getVehicleCapacity();
						$WiFi           = $v->getAirCondition();
						$VehicleID      = $v->getVehicleID();
						$ReturnDiscount = $v->getReturnDiscount();
						$vt->getRow($VehicleTypeID);
						$VehicleClass   = $vt->getVehicleClass();
						$VehicleDescription = getVehicleDescription( $v->getVehicleTypeID() ); // do 2017-11-23 je bilo $vt->getDescription(); -R
						$VehicleImage = '';
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
						$sur = Surcharges($OwnerID, $SurCategory, $s->getServicePrice1(),
										  $transferDate, $transferTime,
										  $returnDate, $returnTime,
										  $RouteID, $VehicleID, $ServiceID,
										  $VSurCategory, $DRSurCategory
										  );
						$addToPrice =   $sur['MonPrice'] +
										$sur['TuePrice'] +
										$sur['WedPrice'] +
										$sur['ThuPrice'] +
										$sur['FriPrice'] +
										$sur['SatPrice'] +
										$sur['SunPrice'] +
										$sur['S1Price'] +
										$sur['S2Price'] +
										$sur['S3Price'] +
										$sur['S4Price'] +
										$sur['S5Price'] +
										$sur['S6Price'] +
										$sur['S7Price'] +
										$sur['S8Price'] +
										$sur['S9Price'] +
										$sur['S10Price'] +
										$sur['NightPrice'];
						$DriversPrice = $s->getServicePrice1();
						$DriversPriceAdd = $DriversPrice + $addToPrice;
						$specialDatesPrice = calculateSpecialDates($OwnerID,$DriversPriceAdd,$transferDate, $transferTime);
						$DriversPriceAdd2 = $DriversPriceAdd+$specialDatesPrice;
						$addToPrice=$addToPrice+$specialDatesPrice;
						$Provision = returnProvision($DriversPriceAdd2, $s->getOwnerID(), $VehicleClass);
						$Provision2 = returnProvision2($DriversPriceAdd2, $s->getOwnerID(), $VehicleClass);
						$FinalPrice = $DriversPriceAdd2+$DriversPriceAdd2*$Provision/100;
						$FinalPrice2 = $DriversPriceAdd2+$DriversPriceAdd2*$Provision2/100;
						
						$contractPrice=getContractPrice($VehicleTypeID, $RouteID, $AgentID);
						if ($contractPrice>0) {
							$FinalPrice=$contractPrice;
							$Provision=0;
							$contractDriverPrice=getContractDriverPrice($ServiceID);
							if ($contractDriverPrice>0) {
								$DriversPrice=$contractDriverPrice;
								$addToPrice=0;
							}	
						}	
						
						// zaokruzenje cijena
						$FinalPrice = nf( round($FinalPrice,2) );
						$FinalPrice2 = nf( round($FinalPrice2,2) );

						/*
						** KRAJ OBRADE CIJENA
						*/

						$contract="";
						$statusComp=$statusCompP; // preuzima status po drajver ruti;
						if($au->getActive() == 0) $statusComp="<i>-Not active</i>";
						if($DriversPrice < 1) $statusComp="<i>-No price</i>";
						if(isVehicleOffDuty($VehicleID, $transferDate,$transferTime)) $statusComp="<i>-Off duty</i>";
						if ($statusComp=="" && !isset($_REQUEST['type'])) {
							if ($contractPrice>0) {
								$contract=" contract Agent";
								if ($contractDriverPrice>0) $contract.=", Driver";
							}	
							$DriverCompanyFormated="<button data-ownerid='".$OwnerID."' data-vehicletype='".$VehicleTypeID."' data-driverprice='".$DriversPriceAdd."' class='selectowner' type='button'>".$DriverCompany."</button>";
							$FinalPriceFormated="<button data-ownerid='".$OwnerID."' data-vehicletype='".$VehicleTypeID."' data-driverprice='".$DriversPriceAdd."' data-price='".nf($FinalPrice)."' class='selectprice' type='button'>".nf($FinalPrice)."</button>";
						}
						else {
							$DriverCompanyFormated=$DriverCompany;
							$FinalPriceFormated=nf($FinalPrice);
						}	
						
						$sortHelpClass      = 1000+$VehicleTypeID;
						$sortBy = $RouteID.$sortHelpClass.$FinalPrice;				
						$cars[] = array(
							'RouteID'           => $RouteID,
							'RouteName'           => $RouteName,
							'OwnerID'           => $OwnerID,
							'DriverCompany'     => $DriverCompanyFormated,
							'StatusCompany'     => $statusComp,
							'Contract'     		=> $contract,
							'ProfileImage'      => $ProfileImage,
							'ServiceID'         => $ServiceID,
							'VehicleID'         => $VehicleID,
							'VehicleTypeID'     => $VehicleTypeID,
							'VehicleName'       => $VehicleName,
							'VehicleImage'      => $VehicleImage,
							'VehicleCapacity'   => $VehicleCapacity,
							'VehicleClass'      => $VehicleClass,
							'WiFi'              => $WiFi,
							'VehicleSort'       => $sortBy,
							'VehicleDescription'=> $VehicleDescription,
							'FinalPrice'        => $FinalPriceFormated, // cijena sa svim dodacima
							'FinalPrice2'        => nf($FinalPrice2), // cijena sa svim dodacima
							'DriversPrice'      => nf($DriversPrice), // cista vozacka cijena
							'OneWayPrice'       => nf($OneWayPrice), // cijena za jedan smjer sa dodacima
							'AddToPrice'       => nf($addToPrice), // dodaci na cenu
							'Provision'       => nf($Provision), // dodaci na cenu
							'Provision2'       => nf($Provision2), // dodaci na cenu
							'Rating'            => $Rating,
							'NightPrice'        => $sur['NightPrice'],
							'MonPrice'          => $sur['MonPrice'],
							'TuePrice'          => $sur['TuePrice'],
							'WedPrice'          => $sur['WedPrice'],
							'ThuPrice'          => $sur['ThuPrice'],
							'FriPrice'          => $sur['FriPrice'],
							'SatPrice'          => $sur['SatPrice'],
							'SunPrice'          => $sur['SunPrice'],
							'S1Price'           => $sur['S1Price'],
							'S2Price'           => $sur['S2Price'],
							'S3Price'           => $sur['S3Price'],
							'S4Price'           => $sur['S4Price'],
							'S5Price'           => $sur['S5Price'],
							'S6Price'           => $sur['S6Price'],
							'S7Price'           => $sur['S7Price'],
							'S8Price'           => $sur['S8Price'],
							'S9Price'           => $sur['S9Price'],
							'S10Price'          => $sur['S10Price'],
							'SpecialDatesPrice'  => $specialDatesPrice,
							'Km'                => $Km,
							'PriceKm'           => 0,
							'APriceKm'          => 0,
							'Duration'          => $Duration,
							'BasePrice'         => nf( round($BasePrice,2) )
						);
					} // end foreach services
				}// end else
			} // end foreach DriverRoutes
		}
	}	
	
	$cnt=0;
	foreach ($cars as $car) {
		if	($car['Contract']<>"") $cnt++;
	}	
	if ($cnt>0) {
		foreach ($cars as $key => $car) {
			if	($car['Contract']=="") 	unset($cars[$key]);
		}	
	}
	if ($only=="true") {
		foreach ($cars as $key => $car) {
			if	($car['StatusCompany']<>"") unset($cars[$key]);
		}	

		usort($cars, function($a, $b) {
			return $a['VehicleSort'] <=> $b['VehicleSort'];
		});

		$vtid=0;	
		foreach ($cars as $key => $car) {
			if ($vtid==$car['VehicleTypeID']) unset($cars[$key]);
			else $vtid=$car['VehicleTypeID'];
		}	
	}
}
ob_start(); 
MakeCSV($cars);
$csv = ob_get_contents();
ob_end_clean();
unlink(ROOT.'/plugins/Dashboard/Routes_Prices.csv');
//echo $csv;
$fp = fopen(ROOT.'/plugins/Dashboard/Routes_Prices.csv', 'w');
fwrite($fp, $csv);

	
$cars = json_encode($cars);
echo $_GET['callback'] . '(' . $cars. ')';

// Dodavanje dogovorene provizije na osnovnu cijenu
function returnProvision($price, $ownerid, $VehicleClass = 1) {
    require_once '../db/db.class.php';
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
                if      ($priceR >= $d->R1Low and $priceR <= $d->R1Hi) return $d->R1Percent ;
                else if ($priceR >= $d->R2Low and $priceR <= $d->R2Hi) return $d->R2Percent ;
                else if ($priceR >= $d->R3Low and $priceR <= $d->R3Hi) return $d->R3Percent ;
                else return $price;
            }
            // PREMIUM CLASS
            if($VehicleClass >= 11 and $VehicleClass < 21) {
                if      ($priceR >= $d->PR1Low and $priceR <= $d->PR1Hi) return $d->PR1Percent ;
                else if ($priceR >= $d->PR2Low and $priceR <= $d->PR2Hi) return $d->PR2Percent ;
                else if ($priceR >= $d->PR3Low and $priceR <= $d->PR3Hi) return $d->PR3Percent ;
                else return $price;
            }
            // FIRST CLASS
            if($VehicleClass >= 21) {
                if      ($priceR >= $d->FR1Low and $priceR <= $d->FR1Hi) return $d->FR1Percent ;
                else if ($priceR >= $d->FR2Low and $priceR <= $d->FR2Hi) return $d->FR2Percent ;
                else if ($priceR >= $d->FR3Low and $priceR <= $d->FR3Hi) return $d->FR3Percent ;
                else return $price;
            }
        }
        return '0';
}

function vehicleTypeName($vehicleTypeID) {
    require_once '../db/db.class.php';
    $dbT = new DataBaseMysql();

    $w = $dbT->RunQuery("SELECT * FROM v4_VehicleTypes WHERE VehicleTypeID = '{$vehicleTypeID}'");
    $v = $w->fetch_object();

    return $v->VehicleTypeName;
}

function isVehicleOffDuty($vehicleID, $transferDate, $transferTime) {
    $cnt = 0;
    require_once '../db/db.class.php';
    $dbT = new DataBaseMysql();

    $r = $dbT->RunQuery("SELECT * FROM v4_OffDuty WHERE VehicleID = '".$vehicleID."' ORDER BY ID ASC");

    while($o = $r->fetch_object()) {

        if( inDateTimeRange($o->StartDate, $o->StartTime, $o->EndDate, $o->EndTime, $transferDate, $transferTime) ) {

            $cnt += 1;
        }

    }

    if($cnt >= 1) return true;
    else return false;
}

function calculateSpecialDates($OwnerID, $amount, $transferDate, $transferTime, $returnDate='', $returnTime='') {

    if( empty($OwnerID) or empty($amount) or empty($transferDate)  or empty($transferTime) ) return 0;

    require_once '../db/db.class.php';
    require_once '../db/v4_SpecialDates.class.php';
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

function getContractPrice($VehicleTypeID, $RouteID, $AgentID) {
    require_once '../db/db.class.php';
    $dbT = new DataBaseMysql();
	$q5 = "SELECT * FROM v4_AgentPrices
			WHERE RouteID = ".$RouteID." AND VehicleTypeID = ".$VehicleTypeID." AND AgentID = ".$AgentID;
	$result = $dbT->RunQuery($q5);
	$cp = mysqli_fetch_object($result);
	
	if (count($cp)>0) {
		return $cp->Price;
	}	
	else return 0;
}

function getContractDriverPrice($ServiceID) {
	require_once '../db/v4_Services.class.php';
	$db = new v4_Services();	
	$db->getRow($ServiceID);
	return $db->getServicePrice2();											
}

function MakeCSV($cars_all) {

	require_once $_SERVER['DOCUMENT_ROOT'] .'/db/db.class.php';
	$db = new DataBaseMysql();
	#===

	// Delimiter
	$dlm = ";";
	
	# CSV first row
	echo 
		'Route Name'.$dlm.
		'Driver Company'.$dlm.
		'Price/km'.$dlm.
		'Avg.Price/km'.$dlm.
		'Type'.$dlm.
		'Neto'.$dlm.
		'Adds'.$dlm.		
		'Provision'.$dlm.		
		'Final'.$dlm.
		'Km'.$dlm.
		"\n";
	


	foreach ($cars_all as $car){
		echo 
			$car['RouteName'].$dlm.
			$car['DriverCompany'].$dlm.
			$car['VehicleTypeID'].$dlm.
			$car['PriceKm'].$dlm.
			$car['APriceKm'].$dlm.
			$car['DriversPrice'].$dlm.
			$car['AddToPrice'].$dlm.		
			$car['Provision'].$dlm.		
			$car['FinalPrice'].$dlm.
			$car['Km'].$dlm.
			"\n";
	}	

}

function vincentyGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  return $angle * $earthRadius / 1000;
}	

function getAveragePrice ($OwnerID,$VehicleID) {
	require_once '../db/db.class.php';
    $dbT = new DataBaseMysql();
	$q6 = "SELECT sum(ServicePrice1) as ServicePrice, sum(Km) as SKm FROM v4_Routes,v4_Services 
			WHERE ServicePrice1>0 AND Km>0 AND v4_Services.OwnerID = ".$OwnerID." AND VehicleID = ".$VehicleID." AND v4_Routes.RouteID = v4_Services.RouteID";
	$result = $dbT->RunQuery($q6);
	if (count($result)>0) {
		$ap = mysqli_fetch_object($result);
		if ($ap->ServicePrice>0) return $ap->ServicePrice/$ap->SKm;
		else return 0;
	}
}