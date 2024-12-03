<?
	header("Content-type: image/jpeg");
	require '../../../config.php';
	error_reporting(E_ALL);
	if (!isset($_REQUEST['VehicleID']) or $_REQUEST['VehicleID'] == 0) {
		$img = file_get_contents(ROOT . '/i/'.$_REQUEST["default"].'.jpg');
		echo $img;
		die();
	} else {
		require_once ROOT . '/db/sb_Vehicles.class.php';
		$vh = new sb_Vehicles();	
		$vh->getRow($_REQUEST['VehicleID']);
		header("Content-type: jpg");
		echo $vh->getPicture();
	}	