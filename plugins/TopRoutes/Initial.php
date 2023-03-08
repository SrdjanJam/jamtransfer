<?
require_once '../../config.php';
require_once ROOT . '/db/v4_TopRoutes.class.php';
require_once ROOT . '/db/v4_Routes.class.php';

$db = new v4_TopRoutes();
$dbT = new DataBaseMysql();
$dbR = new v4_Routes();

$keyName = 'TopRouteID';
$ItemName='TopRouteID ';
// Check:
// $ItemName='PlaceNameEN ';
// $type='PlaceType';
#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'TopRouteID', // dodaj ostala polja!
	'Main' // dodaj ostala polja!
);

