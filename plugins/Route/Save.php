<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
require_once ROOT . '/db/v4_Places.class.php';
$pl = new v4_Places();
	
$keyValue = $_REQUEST['id'];
$topRouteID=$_REQUEST['id'];

$fldList = array();
$out = array();
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);
foreach ($db->fieldNames() as $name) {
	$content=$db->myreal_escape_string($_REQUEST[$name]);
	if(isset($_REQUEST[$name])) {
		eval("\$db->set".$name."(\$content);");	
	}	
}	
$db->setRouteNameEN($_REQUEST['RouteName']);

$upd = '';
$newID = '';
if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}
if ($keyName != '' and $keyValue == '') {
	$newID = $db->saveAsNew();
	$topRouteID=$newID;
}
$out = array(
	'update' => $upd,
	'insert' => $newID
);
	
if ($_REQUEST['TopRoute']==1) $result = $dbT->RunQuery("INSERT IGNORE INTO `v4_TopRoutes`(`TopRouteID`) VALUES (".$topRouteID.")");
else $result = $dbT->RunQuery("DELETE FROM `v4_TopRoutes` WHERE `TopRouteID`=".$topRouteID);

if ($keyName != '' and $keyValue != '') $result = $dbT->RunQuery("DELETE FROM `v4_RoutesTerminals` WHERE `RouteID`=".$keyValue);
// varijanta iz select box-a
$terminalID=$_REQUEST['TerminalID'];
if ($terminalID>0) {
	$dbT->RunQuery("INSERT INTO `v4_RoutesTerminals`(`RouteID`, `TerminalID`) VALUES (".$topRouteID.",".$terminalID.")");					
}	
# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
