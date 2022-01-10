<?
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
	
	
	$rKeys = $r->getKeysBy('RouteID', 'asc');
	
	foreach($rKeys as $rn => $RouteID) {
		
		$r->getRow($RouteID);
		
		// ako FromID ili ToID place ne postoji u v4_Places
		// znaci da je taj place izbrisan
		// pa ni njegove rute ne smiju ostati 
		
		if( noPlace($r->getFromID()) or noPlace( $r->getToID()) ) {
			
			// izbrisi rutu
			$r->deleteRow($RouteID);
			
			// i sve DriverRoutes za tu rutu
			$q = "DELETE FROM v4_DriverRoutes WHERE RouteID = '" . $RouteID . "'";
			$db->RunQuery($q);
			
			echo $RouteID . ' Deleted <br>';
		}
		
	}
	

	// funkcija ima inverznu logiku!	
	function noPlace($PlaceID) {

		global $p; // class

		if($p->getRow($PlaceID) === false) return true; // nema u v4_Places, getRow vratio false
		else return false; // ima u v4_Places
	}
