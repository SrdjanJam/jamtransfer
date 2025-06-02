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

if ($_REQUEST['NotificationID']>0) {
	$ntk=$nt->getKeysBy("NotificationID", "ASC", $where = " WHERE CNotificationID=".$_REQUEST['NotificationID']);
	foreach ($ntk as $key) {
		$nt->deleteRow($key);
	}	
	$nt->deleteRow($_REQUEST['NotificationID']);
}	
echo $newID = $nt->saveAsNew();	
$_REQUEST['NotificationID']=$newID;
$nt->setMessage("Are you ready, again?");
$nt->setCNotificationID($_REQUEST['NotificationID']);
$nt->setTimeToSend(addMin($_REQUEST['TimeToSend'],10));
$nt->saveAsNew();	
$nt->setMessage($users[$_REQUEST["SubDriverID"]]->AuthUserRealName." unresponsive");
$nt->setSubDriverID(9999);
$nt->setTimeToSend(addMin($_REQUEST['TimeToSend'],20));	
$nt->saveAsNew();


function addMin($datetime, $minutes_to_add) {
	$time = new DateTime($datetime);
	$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
	return $time->format('Y-m-d H:i');
}	
