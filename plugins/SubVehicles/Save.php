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
}
if ($keyName != '' and $keyValue == '') {
	$db->setOwnerID($_SESSION['UseDriverID']);
	$_REQUEST['VehicleID'] = $db->saveAsNew();
}
echo $_REQUEST['VehicleID'];

