<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
	
$keyValue = $_REQUEST['id'];
$fldList = array();
$out = array();
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);
foreach ($db->fieldNames() as $name) {
	$content=$db->myreal_escape_string($_REQUEST[$name]);
	if(isset($_REQUEST[$name])) {
		eval("\$db->set".$name."(\$content);");	
	}	
}	
if(isset($_REQUEST['AuthUserPassNew']) and $_REQUEST['AuthUserPassNew'] != '') { 
	$db->setAuthUserPass( md5($_REQUEST['AuthUserPassNew']) ); 
} 
$db->setAuthLevelID(32);
$db->setDriverID($_SESSION['UseDriverID']);

$upd = '';
$newID = '';
if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	$msg1="updated";	
	if($res !== true) $upd = $res;
}
if ($keyName != '' and $keyValue == '') {
	$newID = $db->saveAsNew();
	$msg1="insert";
	$_REQUEST['id']=$newID;
}
$out = array(
	'update' => $upd,
	'insert' => $newID
);
if ($_SESSION['AuthLevelID']==31) {
	$mailto="jam.bgprogrameri@gmail.com";
	$from_mail="cms@jamtransfer.com";
	$from_name="System mail";
	$replyto="";
	$subject="Driver insert or update subdriver";
	$attachment = '';
	$whatsapp = 0;
	$message=$_SESSION['AuthUserID']."-".$_SESSION['UserRealName']." ".$msg1." subdriver ".$_REQUEST['id'];
	mail_html_send($mailto, $from_mail, $from_name, $replyto, $subject, $message, $attachment, $whatsapp);
}
# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	