<?
@session_start();
require_once '../../../config.php';
$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";
require_once ROOT . '/db/sb_Routes.class.php';
require_once ROOT . '/db/sb_Vehicles.class.php';
require_once ROOT . '/db/v4_DriverTerminals.class.php';
require_once ROOT . '/db/sb_Basic.class.php';
$rt = new sb_Routes();
$vh = new sb_Vehicles();
$dt = new v4_DriverTerminals();
$bs = new sb_Basic();
$vehicles=array();
$responce=array();
$booking_line=json_decode($_REQUEST['line']);
$booking_distance=$_REQUEST['distance'];
$booking_duration=$_REQUEST['duration'];

//dobavljanje drivera za terminal
$where=" WHERE TerminalID=".$_REQUEST['terminalid'];
$dtk=$dt->getKeysBy("TerminalID","",$where);

if (count($dtk)>0) {
	$did=array(0);
	foreach ($dtk as $key) {
		$dt->getRow($key);
		$where=" WHERE OwnerID=".$dt->getDriverID();
		$rtk=$rt->getKeysBy("RouteID","",$where);
		// nalazenje najslicnije rute datog partnera
		// najslicnija ruta je ruta koja ima najvise poklapanja podruta sa zadatom rutom
		if (count($rtk)>0) {
			$max_line=0;
			$max_route_id=0;
			foreach ($rtk as $key) {
				$rt->getRow($key);
				$route_line=json_decode($rt->getLine());
				$counter=0;
				foreach ($route_line as $rl) {
					if (in_array($rl,$booking_line)) $counter++;
				}
				if ($counter>$max_line) {
					$max_line=$counter;
					$max_route_id=$rt->getRouteID();
				}	
			}
			$where=" WHERE RouteID=".$max_route_id;
			$rtk=$rt->getKeysBy("RouteID","",$where);
			$rt->getRow($rtk[0]);
			$route_distance=$rt->getDistance();
			$route_duration=$rt->getDuration();
			$distance_coef=$booking_distance/$route_distance;
			$duration_coef=$booking_duration/$route_duration;
			// koeficijent korekcije je srednja vrednost relativnih odnosa distance i vremena puta
			$coef=($distance_coef+$duration_coef)/2;
			// bazicna cena se koriguje sa koficijentom
			$driverPriceBasic=$rt->getPrice()*$coef;
			$vprices=json_decode($rt->getVPrices());
			$vp_arr=array();
			// koriguju se cene po vozilima sa koeficijentom
			foreach ($vprices as $vp) {
				$vp_arr[$vp[0]]=$vp[1]*$coef;
			}	
			$driverVPricesBasic=$vp_arr;
			
			// koeficijent za korigovanje cene prema price rules
			$where=" WHERE OwnerID=".$dt->getDriverID();
			$bsk=$bs->getKeysBy("OwnerID","",$where);
			if (count($bsk)==1) {
				$bs->getRow($bsk[0]);
				$rules=json_decode($bs->getPriceRules());
			}	
			$day=date("N",strtotime($_REQUEST['date']." ".$_REQUEST['time']));
			if ($day==7) $day=0;
			$hour=ltrim(date("H",strtotime($_REQUEST['date']." ".$_REQUEST['time'])),"0");
			if (empty($hour)) $hour=0;
			$rules_coef=(100+$rules[$hour][$day])/100;
			$return=1;
			// rules koificijent ako ima povratni transfer
			if (isset($_REQUEST['timeR']) && !empty($_REQUEST['timeR'])) {
				$return=2;
				$dayR=date("N",strtotime($_REQUEST['dateR']." ".$_REQUEST['timeR']));
				if ($dayR==7) $dayR=0;
				$hourR=ltrim(date("H",strtotime($_REQUEST['dateR']." ".$_REQUEST['timeR'])),"0");
				if (empty($hourR)) $hourR=0;
				$rules_coefR=(100+$rules[$hourR][$dayR])/100;
				$rules_coef=($rules_coef+$rules_coefR)/2;
			}
			//dobavljanje vozila od drajvera
			$where=" WHERE OwnerID=".$dt->getDriverID();
			$vhk=$vh->getKeysBy("VehicleID","",$where);
			$_REQUEST['paxNo']=$_REQUEST['paxNo']+$_REQUEST['children']+$_REQUEST['infants'];
			if (count($vhk)>0) {
				foreach ($vhk as $key) {
					$carNo=1;
					$vh->getRow($key);
					//korigovanje bazicne cene sa koficijentom vozila
					//$driverPriceVehicle=$vh->getPriceCoeff()*$driverPriceBasic;
					// izvlacenje cene za vozilo
					$driverPriceVehicle=$driverVPricesBasic[$key];
					// korigovanje sa koeficijentom za price rules
					$driverPriceFull=$driverPriceVehicle*$rules_coef;
					//korigovanje cene, ako je return
					$price=$driverPriceFull*$return;	
					// izracunavanje potrebnog broja vozila
					if ($vh->getMaxPax()>=$_REQUEST['paxNo']) $carNo=1;	
					else if ($vh->getMaxPax()*2>=$_REQUEST['paxNo']) $carNo=2;	
					else if ($vh->getMaxPax()*3>=$_REQUEST['paxNo']) $carNo=3;	
					else continue;
					if ($vh->getType()==1) $vehicleName="Standard ".$vh->getMaxPax()." pax. * ".$carNo;
					if ($vh->getType()==2) $vehicleName="Premium ".$vh->getMaxPax()." pax. * ".$carNo;
					if ($vh->getType()==3) $vehicleName="First Class ".$vh->getMaxPax()." pax. * ".$carNo;					
					//postavljanje cene korigovane sa brojem vozila 
					$vehicles[$vehicleName]["Prices"][]=$price*$carNo;	
					// izracunavanje maximalne i minimalne cene to tipu vozila	
					$max=max($vehicles[$vehicleName]["Prices"]);
					$min=min($vehicles[$vehicleName]["Prices"]);
					// postavljanje medijalne cene i njeno uvecanje za proviziju
					// umesto medijalne cene moze da se postavi ili maksimalna ili minimalna cena ili nesto izmedju prema ponderu
					$vehicles[$vehicleName]["Price"]=($max+$min)/2*(1+returnProvision2(($max+$min)/2,0,0)/100);
					$vehicles[$vehicleName]["VehicleName"]=$vehicleName;
				}
			}
		}
	}
}
$res = json_encode($vehicles);
echo $_GET['callback'] . '(' . $res. ')';