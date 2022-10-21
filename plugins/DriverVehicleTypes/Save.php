<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
if ($_REQUEST['DriverVehicle']==0) $result = $dbT->RunQuery("DELETE FROM `v4_Vehicles` WHERE `VehicleTypeID`=".$_REQUEST['VehicleTypeID']." AND `OwnerID`=".$_SESSION['UseDriverID']);
if ($_REQUEST['DriverVehicle']==1) $result = $dbT->RunQuery("INSERT IGNORE INTO `v4_Vehicles`(`VehicleTypeID`,`OwnerID`,`SurCategory`) VALUES (".$_REQUEST['VehicleTypeID'].",".$_SESSION['UseDriverID'].",1)");
	
echo $_REQUEST['DriverVehicl'];

	