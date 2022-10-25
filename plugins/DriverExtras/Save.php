<?

header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
if ($_REQUEST['DriverExtras']==0) $result = $dbT->RunQuery("DELETE FROM `v4_Extras` WHERE `ServiceID`=".$_REQUEST['ExtrasID']." AND `OwnerID`=".$_SESSION['UseDriverID']);
if ($_REQUEST['DriverExtras']==1) $result = $dbT->RunQuery("INSERT IGNORE INTO `v4_Extras`(`ServiceID`,`OwnerID`) VALUES (".$_REQUEST['ExtrasID'].",".$_SESSION['UseDriverID'].")");
	
echo $_REQUEST['DriverVehicl'];

	