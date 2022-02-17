<?
	session_start();
	require_once '../../db/db.class.php';
	if (isset($_SESSION['AuthUserID'])) $userID=$_SESSION['AuthUserID'];
	else $userID=0;	
	if (!isset($_REQUEST['lat'])) $_REQUEST['lat']=1;
	if (!isset($_REQUEST['lng'])) $_REQUEST['lng']=1;	
	$db = new DataBaseMySql();
	$query="INSERT INTO `v4_UserLocations`( `UserID`, `Time`, `Lat`, `Lng`) 
		VALUES (
			".$userID.",
			".time().",
			".$_REQUEST['lat'].",
			".$_REQUEST['lng']."
		)";
	$db->RunQuery($query);


