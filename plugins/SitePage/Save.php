<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
	
$keyValue = $_REQUEST['id'];
$fldList = array();
$out = array();
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);
foreach ($db->fieldNames() as $name) {
	if(isset($_REQUEST[$name])) {
		$content=$db->myreal_escape_string($_REQUEST[$name]);
		$content=str_replace("'","`",$content);
		eval("\$db->set".$name."(\$content);");	
	}	
}
$db->setContentEN($_REQUEST['Content']);
$db->setTitleEN($_REQUEST['Title']);
$db->setContent($_REQUEST['Content']);
$db->setTitle($_REQUEST['Title']);

$upd = '';
$newID = '';
if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}
if ($keyName != '' and $keyValue == '') {
	$newID = $db->saveAsNew();
}
$out = array(
	'update' => $upd,
	'insert' => $newID
);
# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	