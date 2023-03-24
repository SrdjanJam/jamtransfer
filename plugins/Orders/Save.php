<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

//cuvanje extrasa
$sumDriverPrice=0;
$sumPrice=0;
foreach ($_REQUEST['ServiceID'] as $key=>$serviceid) {
	if ($serviceid>0) {
		if ($key>0) $oe->getRow($key);
		// za naziv servisa
		$ex->getRow($serviceid);
		$oe->setServiceName($ex->getServiceEN());
		$oe->setServiceID($_REQUEST['ServiceID'][$key]);
		$sumDriverPrice+=$_REQUEST['DriverPrice'][$key]*$_REQUEST['Qty'][$key];
		$sumPrice+=$_REQUEST['Price'][$key]*$_REQUEST['Qty'][$key];
		$oe->setDriverPrice($_REQUEST['DriverPrice'][$key]);
		$oe->setPrice($_REQUEST['Price'][$key]);
		$oe->setQty($_REQUEST['Qty'][$key]);
		$oe->setOrderDetailsID($_REQUEST['DetailsID']);
		if ($key>0) $oe->saveRow();	
		else $oe->saveAsNew();
	}
	elseif ($key>0) $oe->deleteRow($key);
}


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
$db->setDriverExtraCharge(number_format($sumDriverPrice));
$db->setExtraCharge(number_format($sumPrice));
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
	