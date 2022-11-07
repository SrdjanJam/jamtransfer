<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
require_once '../../db/v4_Vehicles.class.php';
require_once '../../db/v4_Services.class.php';
require_once '../../db/v4_AuthUsers.class.php';
	
$v  = new v4_Vehicles();
$s  = new v4_Services();
$au = new v4_AuthUsers();

# get AuthUser data
$au->getRow($_SESSION['UseDriverID']);
# we only need ReturnDiscount
$ReturnDiscount = $au->getReturnDiscount();
# no need for this anymore
$au->endv4_AuthUsers();
if ($_REQUEST['DriverRoute']==0) {
	$result = $dbT->RunQuery("DELETE FROM `v4_DriverRoutes` WHERE `RouteID`=".$_REQUEST['RouteID']." AND `OwnerID`=".$_SESSION['UseDriverID']);
	require_once ("RemoveServices.php");	
}	
if ($_REQUEST['DriverRoute']==1) {
	$result = $dbT->RunQuery("INSERT IGNORE INTO `v4_DriverRoutes`(`RouteID`,`OwnerID`,`Active`, `Approved`,`OneToTwo`,`TwoToOne`,`SurCategory`) VALUES (".$_REQUEST['RouteID'].",".$_SESSION['UseDriverID'].",1,1,1,1,1)");
	//require_once ("InsertServices.php");
}
echo $_REQUEST['DriverRoute'];

	