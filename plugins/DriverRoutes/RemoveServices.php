<?
	$q = "DELETE FROM  v4_Services WHERE  OwnerID ='".$_SESSION['UseDriverID']."' AND RouteID ='".$_REQUEST['RouteID']."'";
	$dbT->RunQuery($q);	
