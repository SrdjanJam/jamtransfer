<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
$DB_Where=" WHERE Temp_pass='".$_REQUEST['key']."' AND Active=9";
$dbk = $db->getKeysBy('AuthUserRealName ', '' , $DB_Where);
if (count($dbk)==1) {
	$db->getRow($dbk[0]);
	$db->setActive(0);
	$db->setTemp_pass("");
	$db->saveRow();
	
	$mailto="office@jamtransfer.com";
	$from_mail="cms@jamtransfer.com";
	$from_name="System mail";
	$replyto="";
	$attachment = '';
	$whatsapp = 0;
	
	if ($db->getAuthLevelID()==31) {
		$messageM="New driver have been entered into the system. ID:".$db->getAuthUserID();
		$subject="Insert new driver";
	}
	if ($db->getAuthLevelID()==2) {
		$messageM="New agent have been entered into the system. ID:".$db->getAuthUserID();
		$subject="Insert new agent";
	}
	mail_html_send($mailto, $from_mail, $from_name, $replyto, $subject, $messageM, $attachment, $whatsapp);
		
		
	$messageWA="Your company have been entered into the WIS.JAMTRANSFER system and will be activated soon. Login on https://wis.jamtransfer.com/.";
	$mailto=$db->getAuthUserMail();
	$phone=$db->getAuthUserMob();
		
	mail_html_send($mailto, $from_mail, $from_name, $replyto, $subject, $messageWA, $attachment, $whatsapp);
	send_whatsapp_message($phone,$messageWA);		
	
	
	
	echo "Your company have been entered into the WIS.JAMTRANSFER system and will be activated soon. Login on https://wis.jamtransfer.com/.";
} else echo "Something wrong";