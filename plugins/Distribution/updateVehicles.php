<?
	require_once '../../config.php';
	
	$q1 = "DELETE FROM `v4_SubVehiclesSubDrivers` WHERE `SubVehicleID`=".$_REQUEST['SubVehicleID']." OR `SubDriverID`=".$_REQUEST['SubDriverID'];
	$r = $db->RunQuery($q1);
	if ($_REQUEST['SubVehicleID']>0 && $_REQUEST['SubDriverID']>0) {
		$q2 = "INSERT INTO `v4_SubVehiclesSubDrivers`(`OwnerID`, `SubVehicleID`, `SubDriverID`) VALUES ('".$_SESSION['UseDriverID']."','".$_REQUEST['SubVehicleID']."','".$_REQUEST['SubDriverID']."')";
		$r = $db->RunQuery($q2);
	}
	

	