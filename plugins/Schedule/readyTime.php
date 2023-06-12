<?
@session_start();
require_once "../../config.php";

require_once ROOT . '/db/v4_OrderDetails.class.php';
require_once ROOT . '/db/v4_Notifications.class.php';
$od = new v4_OrderDetails();
$nt = new v4_Notifications();

if ($_REQUEST['NotificationID']>0) $nt->getRow($_REQUEST['NotificationID']);
foreach ($nt->fieldNames() as $name) {
	$content=$nt->myreal_escape_string($_REQUEST[$name]);
	if(isset($_REQUEST[$name])) {
		eval("\$nt->set".$name."(\$content);");	
	}
}

$nt->setSenderID($_SESSION['UseDriverID']);
$nt->setMessage("Are you ready?");
$nt->setNotificationType(1);

if ($_REQUEST['NotificationID']>0) $res = $nt->saveRow();
else $newID = $nt->saveAsNew();	


