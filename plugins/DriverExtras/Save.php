<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
if ($_REQUEST['DriverExtras']==0) $result = $dbT->RunQuery("DELETE FROM `v4_Extras` WHERE `ServiceID`=".$_REQUEST['ExtrasID']." AND `OwnerID`=".$_SESSION['UseDriverID']);
if ($_REQUEST['DriverExtras']==1 && $_REQUEST['DriverPrice']==0 && $_REQUEST['Provision']==0) 
	$result = $dbT->RunQuery("INSERT IGNORE INTO `v4_Extras`(`ServiceID`,`Service`,`ServiceEN`,`OwnerID`) VALUES (".$_REQUEST['ExtrasID'].",'".$_REQUEST['ExtrasName']."','".$_REQUEST['ExtrasName']."',".$_SESSION['UseDriverID'].")");
//if ($_REQUEST['DriverPrice']>0) {
	$result = $dbT->RunQuery("UPDATE `v4_Extras` SET `DriverPrice`= ".$_REQUEST['DriverPrice']."  WHERE `ServiceID`=".$_REQUEST['ExtrasID']." AND `OwnerID`=".$_SESSION['UseDriverID']);
//}
//if ($_REQUEST['Provision']>0) {
	$result = $dbT->RunQuery("UPDATE `v4_Extras` SET `Provision`= ".$_REQUEST['Provision']."  WHERE `ServiceID`=".$_REQUEST['ExtrasID']." AND `OwnerID`=".$_SESSION['UseDriverID']);
//}	
//if ($_REQUEST['DriverPrice']>0 || $_REQUEST['Provision']>0) {
	$result = $dbT->RunQuery("UPDATE `v4_Extras` SET `Price`= `DriverPrice`*(1+`Provision`/100) WHERE `ServiceID`=".$_REQUEST['ExtrasID']." AND `OwnerID`=".$_SESSION['UseDriverID']);	
//}	
$q="SELECT `DriverPrice`*(1+`Provision`/100) as price FROM `v4_Extras` WHERE `ServiceID`=".$_REQUEST['ExtrasID']." AND `OwnerID`=".$_SESSION['UseDriverID'];	
$result = $dbT->RunQuery($q);
$price=number_format($result->fetch_object()->price,2);
$out = array(
	'driverextras' => $_REQUEST['DriverExtras'],
	'price' => $price
);
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';

	