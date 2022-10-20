<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
if ($_REQUEST['DriverRoute']==0) $result = $dbT->RunQuery("DELETE FROM `v4_DriverRoutes` WHERE `RouteID`=".$_REQUEST['RouteID']." AND `OwnerID`=".$_SESSION['UseDriverID']);
if ($_REQUEST['DriverRoute']==1) $result = $dbT->RunQuery("INSERT IGNORE INTO `v4_DriverRoutes`(`RouteID`,`OwnerID`,`SurCategory`) VALUES (".$_REQUEST['RouteID'].",".$_SESSION['UseDriverID'].",1)");
	
echo $_REQUEST['DriverRoute'];

	