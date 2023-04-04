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


$upd = '';

if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}
if ($keyName != '' and $keyValue == '') {
	$db->setFromName($_SESSION['UserRealName']);	
	$db->setUserID($_SESSION['AuthUserID']);	
	$db->setUserLevel($_SESSION['AuthLevelID']);	
	$db->setPageLink('general');	
	$newID = $db->saveAsNew();
}

$out = array(
	'update' => $upd
);

	
	

# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	