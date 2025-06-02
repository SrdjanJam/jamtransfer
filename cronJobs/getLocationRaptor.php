<?
//error_reporting(E_ALL); 
$root='/home/jamtrans/laravel/public/cms.jamtransfer.com';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/db/db.class.php';
require_once $root . '/db/v4_AuthUsers.class.php';
require_once $root . '/db/v4_SubVehicles.class.php';

$db = new DataBaseMysql();
$au = new v4_AuthUsers();
$sv = new v4_SubVehicles();
	
	
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://integration.raptor-fleet.com:50111/get_current_location_records?user_id=jamtransferWS01user&user_psw=HGvmvX5kxghlFod9N9oxd3PWHj49');
//curl_setopt($ch, CURLOPT_URL, 'https://wis.taxifrom.com/raptor.php?object=location');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$response = curl_exec($ch);
curl_close($ch);

$obj = json_decode($response,true);	
$locations=array();	

foreach ($obj['records'] as $rec) {
	$arr=array();
	$arr['long']=$rec['longitude'];
	$arr['lat']=$rec['latitude'];
	$arr['angle']=$rec['angle'];
	$arr['speed']=$rec['speed'];
	$locations[$rec['vehicle_id']]=$arr;
}	



$where=" WHERE `OwnerID` in (556,843,876) and `Active`=1 and RaptorID>0";
$svk=$sv->getKeysBy("VehicleID","",$where);
foreach ($svk as $key) {
	$sv->getRow($key);
	$rid=$sv->getRaptorID();
	$locations[$rid]['VehicleID']=$sv->getVehicleID();
	$locations[$rid]['SDID']=$sv->getAssignSDID();
}

date_default_timezone_set("Europe/Paris");	
$device='raptor';
foreach ($locations as $key=>$loc) {

	if ($loc['long']+$loc['lat']>0 && isset($loc['SDID'])) {
		$key='5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb';
		$url='https://api.openrouteservice.org/geocode/reverse?api_key='.$key.'&point.lon='.$loc['long'].'&point.lat='.$loc['lat'];   
		$json2 = file_get_contents($url);   
		$obj=array();
		$obj = json_decode($json2,true);
		if (!in_array(gettype($obj),array('array','object'))) $obj=array();
		if (count($obj)>0) {	
			$lngX=$obj['features'][0]['geometry']['coordinates'][0];
			$latX=$obj['features'][0]['geometry']['coordinates'][1];
			$label=$obj['features'][0]['properties']['label'];
			$label=str_replace('\'','',$label);
		} else {
			$lngX=0;
			$latX=0;
			$label='';
		}	

		$query="INSERT INTO `v4_UserLocations`( `UserID`, `Device`, `Time`, `Lat`, `Lng`, `Lat2`, `Lng2`, `label` ) 
			VALUES (
				".$loc['SDID'].",
				'".$device."',			
				".time().",
				".$loc['lat'].",
				".$loc['long'].",
				".$latX.",			
				".$lngX.",			
				'".$label."'			 
			)";
			
		$db->RunQuery($query);
	}		
}	
$deltime=time()-24*3600;
$sqldel='DELETE FROM `v4_UserLocations` WHERE `Time`<'.$deltime;
$db->RunQuery($sqldel);
