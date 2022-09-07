<?
require_once '../../config.php';
require_once ROOT . '/db/v4_SubVehicles.class.php';
$db = new v4_SubVehicles();
$dbT = new DataBaseMysql();

$keyName = 'VehicleID';
$ItemName='VehicleDescription ';
#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'VehicleID',
	'VehicleDescription',
	'VehicleCapacity'
);

