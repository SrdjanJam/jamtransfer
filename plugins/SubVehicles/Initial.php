<?
require_once '../../config.php';
require_once ROOT . '/db/v4_SubVehicles.class.php';
require_once ROOT . '/db/v4_VehicleTypes.class.php';
$db = new v4_SubVehicles();
$vt = new v4_VehicleTypes();
$dbT = new DataBaseMysql();

$keyName = 'VehicleID';
$ItemName='VehicleDescription ';
$selectactive='Active';

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

