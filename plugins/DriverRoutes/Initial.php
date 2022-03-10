<?
require_once '../../config.php';
require_once ROOT . '/db/v4_DriverRoutes.class.php';
$db = new v4_DriverRoutes();
$keyName = 'ID';
$ItemName='RouteName ';

#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'RouteID', // dodaj ostala polja!
	'RouteName'
);