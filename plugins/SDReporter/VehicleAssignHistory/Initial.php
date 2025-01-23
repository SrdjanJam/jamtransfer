<?
require_once '../../../config.php';
require_once ROOT . '/db/v4_SubVehiclesAH.class.php';
require_once ROOT . '/db/v4_AuthUsers.class.php';
require_once ROOT . '/db/v4_SubVehicles.class.php';

$db = new v4_SubVehiclesAH();
$au = new v4_AuthUsers();
$sv = new v4_SubVehicles();

$keyName = 'ID';
$ItemName='AssignTime ';
$type='Active'; 


#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'AssignTime' // dodaj ostala polja!
);