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

error_reporting(E_PARSE);
define("DEBUG", 0);

@session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/LoadLanguage.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/f/f.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/db.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_Services.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_Routes.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_DriverRoutes.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_AuthUsers.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_Vehicles.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_VehicleTypes.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_DriverPrices.class.php';




//echo '<pre>'; print_r($_POST); echo '</pre>';
$db = new DataBaseMysql();

$s 	= new v4_Services();
$r 	= new v4_Routes();
$dr = new v4_DriverRoutes();
$au = new v4_AuthUsers();
$v	= new v4_Vehicles();
$vt = new v4_VehicleTypes();

$dp = new v4_DriverPrices();

// Request u varijable
// ako se kasnije nesto promijeni, ovako je lakse 

$FromID	= $_REQUEST['FromID'];
$ToID 	= $_REQUEST['ToID'];
$PaxNo	= $_REQUEST['PaxNo'];

$transferDate 	= $_REQUEST['transferDate'];
$transferTime 	= $_REQUEST['transferTime'];

if($_REQUEST['returnTransfer'] == 1) {
	$returnDate		= $_REQUEST['returnDate'];
	$returnTime		= $_REQUEST['returnTime'];
	$returnTransfer = $_REQUEST['returnTransfer'];
}
else {
	$returnTransfer = 0;
	$returnDate = '';
	$returnTime = '';
}

// Izlazni podaci koje koriste skripte za display 
$cars = array(); // podaci o vozilima
$drivers = array(); // podaci o vozacima
$carsErrorMessage = array(); // greske

# check if such route exists
$routesKeys = $r->getKeysBy('RouteID','asc',"WHERE (FromID = {$FromID} AND ToID = {$ToID}) OR (FromID = {$ToID} AND ToID = {$FromID})");


if(count($routesKeys) == 0) {
	$carsErrorMessage['title'] = ROUTE_NOT_FOUND;
	$carsErrorMessage['text'] =  CHECK_FROM_TO;
}
else {
	foreach($routesKeys as $ki => $id) {

		$r->getRow($id);
		$Km = $r->getKm();
		
		$drWhere = "WHERE RouteID = {$id} AND Active = '1'";
		
		// check for drivers for the route
		$driverRouteKeys = $dr->getKeysBy('OwnerID', "ASC", $drWhere);
		if (count($driverRouteKeys) == 0) {
			$carsErrorMessage['title'] = NO_DRIVERS;
			$carsErrorMessage['text'] = NO_DRIVERS_EXT;
		}
		else {
			
			// ako su pronadjene DriverRoutes, obradi svaku
			foreach($driverRouteKeys as $dri => $rowId) {
				
				if($dr->getRow($rowId)===false) {
					break;
				}
				
				$OwnerID = $dr->getOwnerID();

				if($au->getRow($OwnerID)===false) break;

				// Driver Profiles iz v4_AuthUsers
				//$Driver = $au->getAuthUserName();
				$DriverCompany = $au->getAuthUserCompany();
				$ProfileImage = 'http://team.taxido.net/' . $au->getImage();
				if($au->getImage() == '') $ProfileImage = 'i/noImage.png';
			
				// ovo je sranje, jer se izgleda ne moze vjerovati getRow funkciji
				// ona ne vraca false ako ne nadje pravi slog!
				// zato ova usporedba
				//if($OwnerID !== $au->getAuthUserID()) break;	
				if(DEBUG) {
					$driverPricesKeys = $dp->getKeysBy('ID', "ASC", "WHERE RouteID = '" . $id .
					"' AND DriverID = '" . $OwnerID ."'");
					foreach( $driverPricesKeys as $cnt => $ID) 
					{
						$dp->getRow($ID);
						echo $au->getAuthUserRealName(). ' ' . $dp->getVehicleTypeID() . ' ' . 
						$dp->getSinglePrice() . '<br>';
		
					}
				} // END DEBUG


			

				
				// check for Services
				$serviceKeys = $s->getKeysBy("ServiceID", "ASC", "WHERE RouteID = {$id} AND OwnerID = {$OwnerID}");
				if(count($serviceKeys) == 0) {
					$carsErrorMessage['title'] = NO_VEHICLES;
					$carsErrorMessage['text'] =  NO_VEHICLES_EXT;
				}
				else {
					foreach($serviceKeys as $si => $sId) {
						$s->getRow($sId);
						$ServiceID = $s->getServiceID();
						//
						if (DEBUG) echo $ServiceID . '<br>';
						if (DEBUG) echo $OwnerID . '<br>';
						//
						$Correction= $s->getCorrection();
						
						$v->getRow($s->getVehicleID());
						
						$VehicleName 	= $v->getVehicleName();
						$VehicleTypeID 	= $v->getVehicleTypeID();
						$VehicleCapacity= $v->getVehicleCapacity();
						$VehicleID 		= $v->getVehicleID();
						$VehicleImageRoot = "http://" . $_SERVER['HTTP_HOST'];
							
						/*
						if ($VehicleCapacity <= 3) $vehicleImageFile = '/i/cars/sedan.png';
						else if ($VehicleCapacity <= 4) $vehicleImageFile = '/i/cars/taxi.png';
						else if ($VehicleCapacity <= 8) $vehicleImageFile = '/i/cars/minivan.png';
						else if ($VehicleCapacity <= 15) $vehicleImageFile = '/i/cars/minibus.png';
						else if ($VehicleCapacity > 15) $vehicleImageFile = '/i/cars/bus.png';
						*/


						$vt->getRow($VehicleTypeID);
						$VehicleClass	= $vt->getVehicleClass();

						if ($VehicleClass == '1') $vehicleImageFile = '/i/cars/sedan.jpg';
						else if ($VehicleClass == '2') $vehicleImageFile = '/i/cars/minivans.jpg';
						else if ($VehicleClass == '3') $vehicleImageFile = '/i/cars/minivanl.jpg';
						else if ($VehicleClass == '4') $vehicleImageFile = '/i/cars/minibusl.jpg';	
						else if ($VehicleClass == '5' or $VehicleClass == '6') 	$vehicleImageFile = '/i/cars/bus.jpg';	

						else if ($VehicleClass == '11') $vehicleImageFile = '/i/cars/sedan_p.jpg';
						else if ($VehicleClass == '12') $vehicleImageFile = '/i/cars/minivans_p.jpg';
						else if ($VehicleClass == '13') $vehicleImageFile = '/i/cars/minivanl_p.jpg';
						else if ($VehicleClass == '14') $vehicleImageFile = '/i/cars/minibusl_p.jpg';	
						else if ($VehicleClass == '15' or $VehicleClass == '16') 	$vehicleImageFile = '/i/cars/bus_p.jpg';							

						else if ($VehicleClass == '21') $vehicleImageFile = '/i/cars/sedan_l.jpg';
						else if ($VehicleClass == '22') $vehicleImageFile = '/i/cars/minivans_l.jpg';
						else if ($VehicleClass == '23') $vehicleImageFile = '/i/cars/minivanl_l.jpg';
						else if ($VehicleClass == '24') $vehicleImageFile = '/i/cars/minibusl_l.jpg';	
						else if ($VehicleClass == '25' or $VehicleClass == '26') 	$vehicleImageFile = '/i/cars/bus_l.jpg';

						
						$VehicleImage = $VehicleImageRoot.$vehicleImageFile;
						
						//$PriceKm	= $v->getPriceKm();
						
						//$OneWayPrice = $PriceKm * $Km + $Correction;
						
						// OVdje se uzima u obzir nasa provizija
						$OneWayPrice = calculateBasePrice($s->getServicePrice1(), $s->getOwnerID() );
						
						if($returnTransfer) $BasePrice = $OneWayPrice * 2;
						else $BasePrice = $OneWayPrice;
						
						// sortiranje top drivera ispred ostalih
						// kako mora biti sortirano i po cijeni
						// onda se cijena mnozi sa 11-rating (tako da ako je rating 10, mnozi se sa 1)
						// znaci ako je rating veci, rating cijena je manja
						// pa vozac izlazi ispred
						$Rating = $BasePrice * (11 - ShowRatings($OwnerID));

						// ako je vozilo dovoljno veliko,
						// spremi podatke i profil
						if($VehicleCapacity >= $PaxNo) {

/*

	Ovdje upada dio sa izracunavanjem cijena ovisno o:
	- return discount
	- coupon code discount
	- danu u tjednu
	- sezoni
	- je li nocna voznja

	Sve te faktore treba prikazati kupcu kao dodatak na osnovnu cijenu.

*/
							$SurCategory 	= $s->getSurCategory();
							$DRSurCategory 	= $dr->getSurCategory();
							$VSurCategory 	= $v->getSurCategory();
							$sur = array();
							$sur = Surcharges($OwnerID, $SurCategory, $OneWayPrice, 
											  $transferDate, $transferTime, 
											  $returnDate, $returnTime, 
											  $dr->getID(), $VehicleID, $ServiceID,
  											  $VSurCategory, $DRSurCategory
											  );
	
	
							
/*
** KRAJ OBRADE CIJENA
*/							
							// Za isti tip vozila prikazi samo najpovoljniju cijenu
							$keyFound = '';
							foreach($cars as $key => $niz) {
								if($niz['VehicleTypeID'] == $VehicleTypeID and $niz['BasePrice'] > 0) {
									$keyFound = $key;
									break;
								}
							}

							$okToAdd = true;
							
							if( $keyFound !== '') {
						
								if( count($cars) > 0) {
									
									if($BasePrice > 0) {
										if( $cars[$keyFound]['VehicleTypeID'] == $VehicleTypeID) {
											
											//logit($cars[$keyFound]['VehicleTypeID'].'|'. $VehicleTypeID);
											
											if($cars[$keyFound]['BasePrice'] > $BasePrice ) {// izbaci skuplje 
												unset($cars[$keyFound]);
												$okToAdd = true;
												//echo '<br> Adding: '.$VehicleTypeID . ' ' . $BasePrice;
											} else if($BasePrice > $cars[$keyFound]['BasePrice']) {
												//unset($cars[$keyFound]);
												$okToAdd = false;
												//echo '<br> NotAdding: '.$VehicleTypeID . ' ' . $BasePrice;
											
											} else if($BasePrice == $cars[$keyFound]['BasePrice']) {
												//unset($cars[$keyFound]);
												$okToAdd = false;
												//echo '<br> NotAdding: '.$VehicleTypeID . ' ' . $BasePrice;
											}
										} else {
											$okToAdd = true;
											//echo '<br> Adding: '.$VehicleTypeID . ' ' . $BasePrice;
										}
									} else { $okToAdd = false;}
								}
							}

							/* potrebno je prikazati neto cijenu umisto base i price cijena (#762) */
							$DriverPrice = '';
							$sklQuery = "WHERE RouteID = '" . $id . "' AND OwnerID = '" . $OwnerID ."' AND VehicleTypeID = '" . $VehicleTypeID . "'";
							$skl = $s->getKeysBy('ServiceID', "ASC", $sklQuery);
							$s->getRow($skl[0]);
							$DriverPrice = $s->getServicePrice1();

							$TotalPrice = nf($BasePrice + $sur['NightPrice'] + 
															$sur['MonPrice'] + 
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
															$sur['S10Price']);
							if ($TotalPrice == 0) $okToAdd = false;

							if($okToAdd) {
								
								$cars[] = array(
									'RouteID'			=> $id,
									'OwnerID'			=> $OwnerID,
									'DriverCompany'		=> $DriverCompany,
									'VehicleTypeID' 	=> $VehicleTypeID,
									'Max'				=> $vt->getMax(),
									'VehicleClass'		=> $vt->getVehicleClass(),
									'VehicleTypeName'	=> $vt->getVehicleTypeNameEN(),
									'BasePrice'			=> nf($BasePrice),
									'DriverPrice'		=> $DriverPrice,
									'Price'				=> $TotalPrice
								);
							}
						}

					} // end foreach services

				}// end else

			} // end foreach DriverRoutes

		}
	}

	/* SORT $cars prvo po tipu vozila, pa najjeftinijem vozilu */
	foreach ($cars as $key => $row) {
		$VVehicleTypeID[$key] = $row['VehicleTypeID'];
		$DDriverPrice[$key] = $row['DriverPrice'];
	}
	array_multisort($DDriverPrice, SORT_ASC, $VVehicleTypeID, SORT_ASC, $cars);


	$cars = json_encode($cars);
	echo $_GET['callback'] . '(' . $cars. ')';
}

if(count($cars) == 0) {
	$carsErrorMessage['title'] = NO_VEHICLES;
	$carsErrorMessage['text'] =  TOO_SMALL;
} else {
	$sort1 = subval_sort($cars,'VehicleCapacity');
	$cars  = subval_sort($sort1,'BasePrice'); 
	
	foreach($cars as $key => $data) {
		
	}
}




function ShowRatings($userId) {
	require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_Ratings.class.php';
	
	$r = new v4_Ratings();
	
	$r->getRow($userId);
	
	if($r->getVotes() > 0)	return $r->getAverage() / $r->getVotes();
	else return '0';
	
	
}


// Dodavanje dogovorene provizije na osnovnu cijenu
function calculateBasePrice($price, $ownerid) {
	global $db;
	
		# Driver
		$q = "SELECT * FROM v4_AuthUsers
					WHERE AuthUserID = '" .$ownerid."' 
					";
		$w = $db->RunQuery($q);
		
		$d = mysqli_fetch_object($w);
		
		if($d->AuthUserID == $ownerid) {

		if ($price >= $d->R1Low and $price <= $d->R1Hi) return $price + ($price*$d->R1Percent / 100);
		else if ($price >= $d->R2Low and $price <= $d->R2Hi) return $price + ($price*$d->R2Percent / 100);
		else if ($price >= $d->R3Low and $price <= $d->R3Hi) return $price + ($price*$d->R3Percent / 100);
		else return $price;
		}
		
		return '0';	
}

