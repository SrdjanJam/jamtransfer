<?
require_once '../../config.php';
require_once ROOT . '/db/v4_SubActivity.class.php';
require_once ROOT . '/db/v4_AuthUsers.class.php';
require_once ROOT . '/db/v4_Actions.class.php';
require_once ROOT . '/db/v4_Request.class.php';
require_once ROOT . '/db/v4_SubVehicles.class.php';

$db = new v4_SubActivity();
$ac = new v4_Actions();
$dbf = new DataBaseMysql(); // Check


$keyName = 'ID';
$ItemName='DisplayOrder ';
$type='Active'; 

#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'Title' // dodaj ostala polja!
);