<?
require_once '../../config.php';
require_once ROOT . '/db/v4_AgentPrices.class.php';
require_once ROOT . '/db/v4_AuthUsers.class.php';
require_once ROOT . '/db/v4_VehicleTypes.class.php';
require_once ROOT . '/db/v4_Routes.class.php';
$db = new v4_AgentPrices();
$au = new v4_AuthUsers();
$vt = new v4_VehicleTypes();
$rt = new v4_Routes();
$keyName = 'ID';
$ItemName='ID ';
#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'ID',
	'AgentID' // dodaj ostala polja!
);