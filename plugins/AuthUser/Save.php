<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
	
$keyValue = $_REQUEST['id'];
$fldList = array();
$out = array();
if ($_SESSION['UserRealName']=="New driver") $_REQUEST['AuthLevelID']=31;
if ($_SESSION['UserRealName']=="New agent") $_REQUEST['AuthLevelID']=2;
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);
foreach ($db->fieldNames() as $name) {
	$content=$db->myreal_escape_string($_REQUEST[$name]);
	if(isset($_REQUEST[$name])) {
		eval("\$db->set".$name."(\$content);");	
	}	
}	
if ($_REQUEST['AuthLevelID']==2) $db->setAuthUserRealName($_REQUEST['AuthUserCompany']);	
if (!empty($_REQUEST['AuthUserPassNew'])) $db->setAuthUserPass( md5($_REQUEST['AuthUserPassNew']) ); 
$upd = '';
$newID = '';
if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;	
}
if ($keyName != '' and $keyValue == '') {
	$newID = $db->saveAsNew();
	$mailto="office@jamtransfer.com";
	$from_mail="cms@jamtransfer.com";
	$from_name="System mail";
	$replyto="";
	$attachment = '';
	$whatsapp = 0;
	
	if ($_SESSION['UserRealName']=="New driver") {
		$messageWA="Your company have been entered into the WIS.JAMTRANSFER system and will be activated soon. Login on https://wis.jamtransfer.com/.";
		$messageM="New driver have been entered into the system. ID:".$newID;
		$subject="Insert new driver";
		mail_html_send($mailto, $from_mail, $from_name, $replyto, $subject, $messageM, $attachment, $whatsapp);		
	}	
	else if ($_SESSION['UserRealName']=="New agent") {
		$messageWA="Your company have been entered into the WIS.JAMTRANSFER system and will be activated soon. Login on https://wis.jamtransfer.com/.";
		$messageM="New agent have been entered into the system. ID:".$newID;
		$subject="Insert new agent";
		mail_html_send($mailto, $from_mail, $from_name, $replyto, $subject, $messageM, $attachment, $whatsapp);
	}
	else {
		$messageWA="You/your company have been entered into the WIS.JAMTRANSFER system. Your username and password will come soon. Login on https://wis.jamtransfer.com/.";
	}	
	$subject="Input confirmation";
	$mailto=$_REQUEST['AuthUserMail'];
	mail_html_send($mailto, $from_mail, $from_name, $replyto, $subject, $messageWA, $attachment, $whatsapp);
	send_whatsapp_message($_REQUEST['AuthUserMob'],$messageWA);		
	if ($_SESSION['AuthLevelID']==0) {
		unset ($_SESSION['UserAuthorized']);
		unset ($_SESSION['UserRealName']);
		unset ($_SESSION['AuthLevelID']);
	}
}
$out = array(
	'update' => $upd,
	'insert' => $newID
);
# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	