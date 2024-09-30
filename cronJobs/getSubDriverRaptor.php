<?
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");

$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";

require_once $root . '/db/v4_AuthUsers.class.php';

$db = new DataBaseMysql();
$au = new v4_AuthUsers();
	
	$ownerID=876;
		
	// izvlacenje vozila iz Raptora
	$link='https://api.giscloud.com/rest/1/vehicles.json?api_key=4a27e4227a88de0508aa9fa2e4c57144&app_instance_id=107495';
	$json = file_get_contents($link); 
	$obj = json_decode($json,true);	
	$db->RunQuery('TRUNCATE TABLE `v4_SubVehiclesDrivers`');	
	foreach ($obj['data'] as $o1) {
		$link2='https://api.giscloud.com/rest/1/vehicles/'.$o1['id'].'/drivers.json?api_key=4a27e4227a88de0508aa9fa2e4c57144&app_instance_id=107495';
		$json2 = file_get_contents($link2); 
		$obj2 = json_decode($json2,true);	
		foreach ($obj2['data'] as $o2) {
			if (empty($o2['stop_t'])) {
				$query="INSERT INTO `v4_SubVehiclesDrivers`( `OwnerID`, `RVehicleID`, `RVehicleName`, `RDriverID`) VALUES (
				".$ownerID.",
				".$o1['id'].",
				'".$o1['mark']."',
				".$o2['driver_id']."
				)";
				$db->RunQuery($query);				
			}
		}		

	}
