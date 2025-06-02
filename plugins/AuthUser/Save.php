<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
	
$keyValue = $_REQUEST['id'];
$fldList = array();
$out = array();
if ($_SESSION['UserRealName']=="New driver") {
	$_REQUEST['AuthLevelID']=31;
	$_REQUEST['Active']=9;
	$_REQUEST['Temp_pass']=create_order_key();
}	
if ($_SESSION['UserRealName']=="New agent") {
	$_REQUEST['AuthLevelID']=2;
	$_REQUEST['Active']=9;
	$_REQUEST['Temp_pass']=create_order_key();	
}	
if (isset($_REQUEST['Delete']) && $_REQUEST['Delete']==1) {
	$_REQUEST['AuthUserRealName']=str_replace("ZZZDEL ","",$_REQUEST['AuthUserRealName']);
	$_REQUEST['AuthUserRealName']="ZZZDEL ".$_REQUEST['AuthUserRealName'];
	$_REQUEST['AuthUserCompany']=str_replace("ZZZDEL ","",$_REQUEST['AuthUserCompany']);
	$_REQUEST['AuthUserCompany']="ZZZDEL ".$_REQUEST['AuthUserCompany'];
}
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
	$from_mail="cms@jamtransfer.com";
	$from_name="System mail";
	$replyto="";
	$attachment = '';
	$whatsapp = 0;
	$subject="Input confirmation";
	
	if ($_SESSION['UserRealName']=="New driver" || $_SESSION['UserRealName']=="New agent") 
		$message="Your company have been applied to the WIS.JAMTRANSFER system. Confirmation link: https://wis.jamtransfer.com/plugins/AuthUser/Activate.php?key=".$_REQUEST['Temp_pass'];
	else {
		$message="You (your company) have been entered into the WIS.JAMTRANSFER system. Username and password will come soon. Login on https://wis.jamtransfer.com/.";
		send_whatsapp_message($_REQUEST['AuthUserMob'],$message);		
	}
	$mailto=$_REQUEST['AuthUserMail'];
	mail_html_send($mailto, $from_mail, $from_name, $replyto, $subject, $message, $attachment, $whatsapp);
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
	