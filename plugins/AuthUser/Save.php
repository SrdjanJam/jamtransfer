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
	$message="You/your company have been entered into the WIS.JAMTRANSFER system. Your username and password will come soon. Login on https://wis.jamtransfer.com/.";
	send_whatsapp_message($_REQUEST['AuthUserMob'],$message);		
}
$out = array(
	'update' => $upd,
	'insert' => $newID
);
# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	