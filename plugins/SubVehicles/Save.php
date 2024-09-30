<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
	
$keyValue = $_REQUEST['VehicleID'];
$fldList = array();
$out = array();
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);
foreach ($db->fieldNames() as $name) {
	$content=$db->myreal_escape_string($_REQUEST[$name]);
	if(isset($_REQUEST[$name])) {
		eval("\$db->set".$name."(\$content);");	
	}	
}	
if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$msg1="updated";
}
if ($keyName != '' and $keyValue == '') {
	$db->setOwnerID($_SESSION['UseDriverID']);
	$_REQUEST['VehicleID'] = $db->saveAsNew();
	$msg1="insert";
}
if ($_SESSION['AuthLevelID']==31) {
	$mailto1="jam.bgprogrameri@gmail.com";
	$mailto2="jam.ivan.markicevic@gmail.com";
	$from_mail="cms@jamtransfer.com";
	$from_name="System mail";
	$replyto="";
	$subject="Driver insert or update vehicle";
	$attachment = '';
	$whatsapp = 0;
	$message=$_SESSION['AuthUserID']."-".$_SESSION['UserRealName']." ".$msg1." vehicle ".$_REQUEST['VehicleID'];
	mail_html_send($mailto1, $from_mail, $from_name, $replyto, $subject, $message, $attachment, $whatsapp);
	mail_html_send($mailto2, $from_mail, $from_name, $replyto, $subject, $message, $attachment, $whatsapp);
}	
echo $_REQUEST['VehicleID'];


