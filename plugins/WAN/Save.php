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
	$db->setScheduleTime($_REQUEST["ScheduleTime1"]." ".$_REQUEST["ScheduleTime2"]);
}	
$upd = '';
$newID = '';
if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}
if ($keyName != '' and $keyValue == '') {
	date_default_timezone_set("Europe/Paris");	
	if ($db->getScheduleTime()==0) $db->setScheduleTime(date("Y-m-d H:i:s"));
	if (isset($_SESSION["UseDriverID"])) $db->setOwnerID($_SESSION["UseDriverID"]);	
	else $db->setOwnerID($_REQUEST["UserID"]);
	$db->setType(1);
	$newID = $db->saveAsNew();
}
$out = array(
	'update' => $upd,
	'insert' => $newID
);
# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	