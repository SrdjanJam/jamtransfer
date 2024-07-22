<?
	require_once '../../config.php';
	$q = "UPDATE `v4_OrderDetails` SET `SubDriver`=".$_REQUEST['SubDriverID'].",
		`Car`=".$_REQUEST['SubVehicleID']."
		WHERE `DetailsID`=".$_REQUEST['DetailsID'];
	$r = $db->RunQuery($q);
	
	// slanje mail-ova?
	
	

	