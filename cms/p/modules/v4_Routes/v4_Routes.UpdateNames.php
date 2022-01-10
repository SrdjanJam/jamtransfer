<?
	header('Content-Type: text/HTML; charset=utf-8');
	header( 'Content-Encoding: none; ' );//disable apache compressed

	ob_end_flush();
	ob_start();
	set_time_limit(0);

	error_reporting(E_PARSE);
 
	# init libs
	require_once ROOT . '/cms/config.php';
	require_once ROOT.'/db/db.class.php';
	require_once ROOT.'/f/f.php';
	
	$db = new DataBaseMysql();

	$q = "SELECT * FROM v4_Routes";
	$w = $db->RunQuery($q);
	
	$total = $w->num_rows;
	$i = 1;

	PrepareProgress();	
	
	while($r = $w->fetch_object() ) {
		
		$routeName = addslashes( getPlaceName ($r->FromID) ).' - '.addslashes( getPlaceName($r->ToID) );
		
		
		$q1 = "UPDATE v4_Routes SET RouteName = '{$routeName}' WHERE RouteID = {$r->RouteID}";
		$success = $db->RunQuery($q1);
		//if($success) echo 'Route '.$routeName.' updated.<br>';
		//else echo 'Route '.$routeName.' NOT updated.<br>';
		
		$q2 = "UPDATE v4_DriverRoutes SET RouteName = '{$routeName}' WHERE RouteID = {$r->RouteID}";
		$success2 = $db->RunQuery($q2);
		//if($success2) echo 'Driver Route '.$routeName.' updated.<br>';
		//else echo 'Driver Route '.$routeName.' NOT updated.<br>';
		
		ShowProgress($i, $total);
		$i++;		
	}
	
	echo '<br><br>Finished.';
