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
date_default_timezone_set("Europe/Paris");
$db->setSentTime(date("Y-m-d H:i:s"));

$from_mail="office@jamtransfer.com";
$from_name=$db->getFromName();
$mailto=$db->getToName();
$replyto=$db->getReplyTo();
$subject=$db->getSubject();
$message=$db->getBody();
$attachment=$db->getAttachment();
$result=mail_html_send($mailto, $from_mail, $from_name, $replyto, $subject, $message, $attachment = '') ;
if ($result=='OK') {
	$db->setStatus(1);
	$db->setType(1);
}	
$upd = '';

if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}
if ($keyName != '' and $keyValue == '') {
	if ($db->getCreateTime()==0) $db->setCreateTime(date("Y-m-d H:i:s"));	
	$newID = $db->saveAsNew();
}

$out = array(
	'update' => $upd
);

	
	

# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	