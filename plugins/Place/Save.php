<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
	
$keyValue = $_REQUEST['id'];
$terminalID=$_REQUEST['id'];
$fldList = array();
$out = array();
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);
foreach ($db->fieldNames() as $name) {
	$content=$db->myreal_escape_string($_REQUEST[$name]);
	if(isset($_REQUEST[$name])) {
		eval("\$db->set".$name."(\$content);");	
	}
	$db->setPlaceDescEN($db->getPlaceDesc());	
}	
$upd = '';
$newID = '';
if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}
if ($keyName != '' and $keyValue == '') {
	$newID = $db->saveAsNew();
	$terminalID=$newID;
}
$out = array(
	'update' => $upd,
	'insert' => $newID
);

if ($_REQUEST['Terminal']==1) $result = $dbT->RunQuery("INSERT IGNORE INTO `v4_Terminals`(`TerminalID`) VALUES (".$terminalID.")");
else $result = $dbT->RunQuery("DELETE FROM `v4_Terminals` WHERE `TerminalID`=".$terminalID);
	
	

# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	