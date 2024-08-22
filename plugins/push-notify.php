<?php
// if there is anything to notify, then return the response with data for
// push notification else just exit the code
require_once '../config.php';
require_once ROOT . '/db/v4_Notifications.class.php';
$nt=new v4_Notifications();
$where=" WHERE UserID=".$_REQUEST['userid']." AND DateToSend='".date('Y-m-d',time())."' AND Status=0 AND NotificationType=5"; 
$ntk=$nt->getKeysBy('NotificationID','',$where);
if (count($ntk)>0) {
	$nt->getRow($ntk[0]);
	$webNotificationPayload['title'] = 'Push Notification from Jamtransfer for '.$users[$_REQUEST['userid']]->AuthUserRealName;
	$webNotificationPayload['body'] = $nt->getMessage();
	$webNotificationPayload['icon'] = ROOT_HOME."/i/logo.png";
	$webNotificationPayload['url'] = $nt->getUrl();
	echo json_encode($webNotificationPayload);
	$nt->setStatus(1);
	$nt->saveRow();
}	
exit();
?>