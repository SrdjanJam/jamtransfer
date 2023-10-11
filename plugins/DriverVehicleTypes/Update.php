<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
if (isset($_REQUEST['SurCategory'])) $result = $dbT->RunQuery("UPDATE `v4_Vehicles` SET `SurCategory`='".$_REQUEST['SurCategory']."' WHERE `VehicleTypeID`=".$_REQUEST['VehicleTypeID']." AND `OwnerID`=".$_SESSION['UseDriverID']);
if (isset($_REQUEST['ReturnDiscount'])) $result = $dbT->RunQuery("UPDATE `v4_Vehicles` SET `ReturnDiscount`='".$_REQUEST['ReturnDiscount']."' WHERE `VehicleTypeID`=".$_REQUEST['VehicleTypeID']." AND `OwnerID`=".$_SESSION['UseDriverID']);


	