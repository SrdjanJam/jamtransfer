<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);

# init libs
require_once ROOT . '/db/db.class.php';
require_once ROOT . '/db/v4_Places.class.php';
require_once ROOT . '/db/v4_Routes.class.php';
require_once ROOT . '/db/v4_DriverRoutes.class.php';


# init vars
$out = array();


# init class
$p  = new v4_Places();
$r  = new v4_Routes();
$dr = new v4_DriverRoutes();
$db = new DataBaseMysql();

$PlaceID = $_REQUEST['PlaceID'];

$deleted = 0;

# delete Place
$p->deleteRow($PlaceID);


// sve Routes u sistemu koje imaju trazeni PlaceID, bilo kao FromID ili kao ToID
$rKeys = $r->getKeysBy('RouteID', 'asc', ' WHERE FromID = '.$PlaceID.' OR ToID = '.$PlaceID);

if(count($rKeys) > 0) {

	foreach ($rKeys as $nn => $id) {
		// pokupi podatke za rutu
		$r->getRow($id);
		$RouteID = $r->getRouteID();

		// vidi postoji li ruta u DriverRoutes
		$drKeys = $dr->getKeysBy('RouteID', 'asc', " WHERE RouteID = '".$RouteID."'");

		foreach($drKeys as $xx => $drID) {

			// izbrisi sve Services za tu Rutu
			$q = "DELETE FROM  v4_Services WHERE RouteID ='".$RouteID."'";
			$db->RunQuery($q);

			$dr->deleteRow($drID); // izbrisi rutu iz DriverRoutes
			$deleted += 1;
		}
		
		// izbrisi iz v4_Routes glavnu rutu
		$r->deleteRow($RouteID);
	}

} 

$out[] = 'Place deleted, deleted Routes:'.$deleted;

# send output back
$output = json_encode($out);
echo $_GET['callback'] . '(' . $output . ')';

