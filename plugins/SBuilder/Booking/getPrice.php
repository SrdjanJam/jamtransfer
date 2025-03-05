<?
@session_start();
require_once '../../../config.php';
$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";
require_once ROOT . '/db/sb_Routes.class.php';
require_once ROOT . '/db/sb_Vehicles.class.php';
require_once ROOT . '/db/v4_DriverTerminals.class.php';
$rt = new sb_Routes();
$vh = new sb_Vehicles();
$dt = new v4_DriverTerminals();
$vehicles=array();
$responce=array();
$booking_line=json_decode($_REQUEST['line']);
$booking_distance=$_REQUEST['distance']=55;
$booking_duration=$_REQUEST['duration']=45;

//dobavljanje drivera za terminal
$where=" WHERE TerminalID=".$_REQUEST['terminalid'];
$dtk=$dt->getKeysBy("TerminalID","",$where);

if (count($dtk)>0) {
	$did=array(0);
	foreach ($dtk as $key) {
		$dt->getRow($key);
		$where=" WHERE OwnerID=".$dt->getDriverID();
		$rtk=$rt->getKeysBy("RouteID","",$where);
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
			$coef=($distance_coef+$duration_coef)/2;
			$price=$rt->getPrice()*$coef;
			// korigovanje cene prema price rules
							//$_REQUEST['date'];
							//$_REQUEST['time'];
							//$_REQUEST['dateR'];
							//$_REQUEST['timeR'];

			//dobavljanje vozila od drajvera
			$where=" WHERE OwnerID=".$dt->getDriverID();
			$vhk=$vh->getKeysBy("VehicleID","",$where);
			if (count($vhk)>0) {
				foreach ($vhk as $key) {
					$vh->getRow($key);
					if ($vh->getMaxPax()>=$_REQUEST['paxNo']) {
						$vehicle=(array) $vh->fieldValues();
						$vehicle["Picture"]=base64_encode($vehicle["Picture"]);
						$vehicle["Price"]=$vh->getPriceCoeff()*$price;
						$vehicle["CarNo"]=1;
						$vehicles[]=$vehicle;
					}	
					else if ($vh->getMaxPax()*2>=$_REQUEST['paxNo']) {
						$vehicle=(array) $vh->fieldValues();
						$vehicle["Picture"]=base64_encode($vehicle["Picture"]);						
						$vehicle["Price"]=$vh->getPriceCoeff()*$price*2;
						$vehicle["CarNo"]=2;
						$vehicles[]=$vehicle;
					}
				}
			}
		}
	}
}
$res = json_encode($vehicles);
echo $_GET['callback'] . '(' . $res. ')';