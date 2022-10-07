<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
$result = $dbT->RunQuery("UPDATE `v4_DriverRoutes` SET `SurCategory`='".$_REQUEST['SurCategory']."' WHERE `RouteID`=".$_REQUEST['RouteID']." AND `OwnerID`=".$_SESSION['UseDriverID']);


	