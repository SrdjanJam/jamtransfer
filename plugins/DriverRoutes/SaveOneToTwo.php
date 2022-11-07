<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
$dbT->RunQuery("UPDATE `v4_DriverRoutes` SET `OneToTwo`='".$_REQUEST['OneToTwo']."' WHERE `RouteID`=".$_REQUEST['RouteID']." AND `OwnerID`=".$_SESSION['UseDriverID']);	
	
echo 2;

	