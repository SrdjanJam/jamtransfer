<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
$dbT->RunQuery("UPDATE `v4_DriverRoutes` SET `Active`='".$_REQUEST['Active']."' WHERE `RouteID`=".$_REQUEST['RouteID']." AND `OwnerID`=".$_SESSION['UseDriverID']);	
echo $_REQUEST['Active'];

	