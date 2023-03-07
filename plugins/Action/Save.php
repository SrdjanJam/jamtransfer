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
$newID = '';
if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}
if ($keyName != '' and $keyValue == '') {
	$newID = $db->saveAsNew();
	$keyValue=$newID;
}

$rqk = $rq->getKeysBy('ID ' , '' , 'Where Active>0');
$sql="DELETE FROM `v4_ActionRequestItem` WHERE `ActionID`=".$keyValue;
$dbc->RunQuery($sql);
if (count($rqk) != 0) {
	foreach ($rqk as $nn => $key)  
	{	
		$rq->getRow($key);
		$index='check'.$key;
		if (isset($_REQUEST[$index])) {
			$sql="INSERT INTO `v4_ActionRequestItem`(`ActionID`,`RequestID`) VALUES (".$keyValue.",".$key.")";
			$dbc->RunQuery($sql);	
		}	
	}
}


$out = array(
	'update' => $upd,
	'insert' => $newID
);
# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	