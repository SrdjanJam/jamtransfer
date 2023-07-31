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

$RouteID		= $_REQUEST['RouteID'];
$transferDate   = $_REQUEST['TransferDate'];
$transferTime   = $_REQUEST['TransferTime'];
if (isset($_REQUEST['AgentID'])) $AgentID = $_REQUEST['AgentID'];
else $AgentID =0;

$returnDate     = '';
$returnTime     = '';


// Izlazni podaci koje koriste skripte za display
$cars = array(); // podaci o vozilima
$drivers = array(); // podaci o vozacima
$carsErrorMessage = array(); // greske

// ODAVDE KRECE

$drWhere = "WHERE RouteID = '".$RouteID."' AND Active = '1'";
if (isset($_SESSION['UseDriverID']) && $_SESSION['UseDriverID']>0) $drWhere .= " AND OwnerID=".$_SESSION['UseDriverID'];
// check for drivers for the route 
$driverRouteKeys = $dr->getKeysBy('OwnerID', "ASC", $drWhere);
if (count($driverRouteKeys) == 0) {
	//$carsErrorMessage['title'] = $NO_DRIVERS;
	//$carsErrorMessage['text'] = $NO_DRIVERS_EXT;
}
else {
	// ako su pronadjene DriverRoutes, obradi svaku
	foreach($driverRouteKeys as $dri => $rowId) {
		$dr->getRow($rowId);
		if($dr->getFromID() == $FromID  and $dr->getOneToTwo() == '0') break;
		if($dr->getFromID() == $ToID  and $dr->getTwoToOne() == '0') break;
		$OwnerID = $dr->getOwnerID();
		if($au->getRow($OwnerID)===false) break;
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
								  $dr->getID(), $VehicleID, $ServiceID,
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
				$Provision = returnProvision($DriversPriceAdd, $s->getOwnerID(), $VehicleClass);
				$Provision2 = returnProvision2($DriversPriceAdd, $s->getOwnerID(), $VehicleClass);
				$FinalPrice = $DriversPriceAdd+$DriversPriceAdd*$Provision/100;
				$FinalPrice2 = $DriversPriceAdd+$DriversPriceAdd*$Provision2/100;
				
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

				$statusComp="";	
				if($au->getActive() == 0) $statusComp="<i>-Not active</i>";
				if($DriversPrice < 1) $statusComp="<i>-No price</i>";
				if(isVehicleOffDuty($VehicleID, $transferDate)) $statusComp="<i>-Off duty</i>";
				if ($statusComp=="" && !isset($_REQUEST['type'])) {
					$DriverCompanyFormated="<button data-ownerid='".$OwnerID."' data-vehicletype='".$VehicleTypeID."' data-driverprice='".$DriversPrice."' class='selectowner' type='button'>".$DriverCompany."</button>";
					$FinalPriceFormated="<button data-ownerid='".$OwnerID."' data-vehicletype='".$VehicleTypeID."' data-driverprice='".$DriversPrice."' data-price='".nf($FinalPrice)."' class='selectprice' type='button'>".nf($FinalPrice)."</button>";
					if ($contractPrice>0) $DriverCompanyFormated="<button data-ownerid='".$OwnerID."' data-vehicletype='".$VehicleTypeID."' data-driverprice='".$DriversPrice."' class='selectowner' type='button'>".$DriverCompany." CONTRACT</button>";
				}
				else {
					$DriverCompanyFormated=$DriverCompany;
					$FinalPriceFormated=nf($FinalPrice);
				}	
				
				$cars[] = array(
					'RouteID'           => $RouteID,
					'OwnerID'           => $OwnerID,
					'DriverCompany'     => $DriverCompanyFormated,
					'StatusCompany'     => $statusComp,
					'ProfileImage'      => $ProfileImage,
					'ServiceID'         => $ServiceID,
					'VehicleID'         => $VehicleID,
					'VehicleTypeID'     => $VehicleTypeID,
					'VehicleName'       => $VehicleName,
					'VehicleImage'      => $VehicleImage,
					'VehicleCapacity'   => $VehicleCapacity,
					'VehicleClass'      => $VehicleClass,
					'WiFi'              => $WiFi,
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
					'Duration'          => $Duration,
					'BasePrice'         => nf( round($BasePrice,2) )
				);
			} // end foreach services
		}// end else
	} // end foreach DriverRoutes
}

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
// proviyija prema funkciji
function returnProvision2($price, $ownerid, $VehicleClass = 1) {
	$priceCalc= 25.5-$price*0.0125+$price*$price*0.00000242;
	if ($priceCalc<10) $priceCalc=10;
	return $priceCalc;		
}
function vehicleTypeName($vehicleTypeID) {
    require_once '../db/db.class.php';
    $dbT = new DataBaseMysql();

    $w = $dbT->RunQuery("SELECT * FROM v4_VehicleTypes WHERE VehicleTypeID = '{$vehicleTypeID}'");
    $v = $w->fetch_object();

    return $v->VehicleTypeName;
}

function isVehicleOffDuty($vehicleID, $transferDate) {
    $cnt = 0;
    require_once '../db/db.class.php';
    $dbT = new DataBaseMysql();

    $r = $dbT->RunQuery("SELECT * FROM v4_OffDuty WHERE VehicleID = '".$vehicleID."' ORDER BY ID ASC");

    while($o = $r->fetch_object()) {

        if( isInDateRange($o->StartDate, $o->EndDate, $transferDate) ) {

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