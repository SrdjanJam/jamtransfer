<?
	require_once '../../config.php';
	require_once ROOT . '/db/v4_Places.class.php';
	require_once ROOT . '/db/v4_Routes.class.php';
	$pl = new v4_Places();
	$rt = new v4_Routes();

	$route_arr=explode("-",$_REQUEST['Route']);
	$fromID=$route_arr[0];
	$toID=$route_arr[1];
	
	$pl->getRow($fromID);
	$fromName=$pl->getPlaceNameEN();
	$pl->getRow($toID);
	$toName=$pl->getPlaceNameEN();
	
	$rt->setFromID($fromID);
	$rt->setToID($toID);
	$rt->setRouteNameEN($fromName."-".$toName);
	$rt->setRouteName($fromName."-".$toName);
	$rt->saveAsNew();
?>





