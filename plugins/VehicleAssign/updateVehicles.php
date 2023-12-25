<?
	require_once '../../config.php';
	date_default_timezone_set('Europe/Paris');	
	$datetime=date('Y-m-d H:i:s');
	$q2 = "UPDATE `v4_SubVehicles` SET `AssignSDID`=".$_REQUEST['SubDriverID'].",`AssignTime`='".$datetime."' WHERE VehicleID=".$_REQUEST['SubVehicleID'];		
	$r = $db->RunQuery($q2);
