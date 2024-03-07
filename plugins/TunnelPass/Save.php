<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
	
$keyValue = $_REQUEST['TunnelPassID'];
$fldList = array();
$out = array();
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);
foreach ($db->fieldNames() as $name) {
	$content=$db->myreal_escape_string($_REQUEST[$name]);
	if(isset($_REQUEST[$name])) {
		eval("\$db->set".$name."(\$content);");	
	}	
}	
$upd = '';
$newID = '';
if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}
if ($keyName != '' and $keyValue == '') {
	$db->setTunnelPassID($_SESSION['TunnelPassID']);
	$_REQUEST['TunnelPassID'] = $db->saveAsNew();
}
$out = array(
	'update' => $upd,
	'insert' => $newID
);

	

# send output back
$output = json_encode($out);
if ($keyName != '' and $keyValue != '') echo $_REQUEST['TunnelPassID'];
if ($keyName != '' and $keyValue == '') echo $_REQUEST['callback'] . '(' . $output . ')';

