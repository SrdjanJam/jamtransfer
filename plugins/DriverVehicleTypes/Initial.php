<?
require_once '../../config.php';
require_once ROOT . '/db/v4_VehicleTypes.class.php';
$db = new v4_VehicleTypes();
$dbT = new DataBaseMysql();

$keyName = 'VehicleTypeID';
$ItemName='VehicleTypeName ';

#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'VehicleTypeID', // dodaj ostala polja!
	'VehicleTypeName'
);