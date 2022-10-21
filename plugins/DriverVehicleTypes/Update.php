<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
$result = $dbT->RunQuery("UPDATE `v4_Vehicles` SET `SurCategory`='".$_REQUEST['SurCategory']."' WHERE `VehicleTypeID`=".$_REQUEST['VehicleTypeID']." AND `OwnerID`=".$_SESSION['UseDriverID']);


	