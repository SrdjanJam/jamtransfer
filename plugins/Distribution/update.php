<?
	require_once '../../config.php';
	$q = "UPDATE `v4_OrderDetails` SET `SubDriver`=".$_REQUEST['SubDriverID'].",
		`Car`=".$_REQUEST['SubVehicleID']."
		WHERE `DetailsID`=".$_REQUEST['DetailsID'];
	$r = $db->RunQuery($q);
	
	// slanje whatsapp poruka
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_AuthUsers.class.php';
	$od = new v4_OrderDetails();
	$au = new v4_AuthUsers();	
	$au->getRow($_REQUEST['SubDriverID']);
	$od->getRow($_REQUEST['DetailsID']);
	$phone=$au->getAuthUserMob();
	$message="Your new or changed transfer ".$od->getOrderID() . "-" . $od->getTNo() .". Login on https://wis.jamtransfer.com/ and see details.";
	send_whatsapp_message($phone,$message);	

	

	