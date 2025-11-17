<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Services.class.php';
require_once ROOT . '/db/v4_Routes.class.php';
require_once ROOT . '/db/v4_VehicleTypes.class.php';
$db = new v4_Services();
$rt = new v4_Routes();
$vt = new v4_VehicleTypes();
$dbT = new DataBaseMysql();

$keyName = 'ServiceID';
$ItemName='ServiceID ';

#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'ServiceID' // dodaj ostala polja!
);