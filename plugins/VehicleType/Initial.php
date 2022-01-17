<?
require_once ROOT . '/db/v4_VehicleTypes.class.php';
$db = new v4_VehicleTypes();
$keyName = 'VehicleTypeID';
$ItemName='VehicleTypeName ';
#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'VehicleTypeID' // dodaj ostala polja!
);