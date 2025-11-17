<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
	
$keyValue = $_REQUEST['ServiceID'];

$fldList = array();
$out = array();
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);
$old_price=$db->getServicePrice1();
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
$rt->getRow($db->getRouteID());
$vt->getRow($db->getVehicleTypeID());

$message="Owner:".$users[$db->getOwnerID()]->AuthUserRealName.", Route Name:".$rt->getRouteNameEN().", Vehicle Type: ".$vt->getVehicleTypeName();
$message.=", Price change: ".$old_price." -> ".$db->getServicePrice1();
mail_html('office@jamtransfer.com', 'cms@jamtransfer.com', 'JamTransfer', 'office@jamtransfer.com',  
          "Service change", $message);

$out = array(
	'update' => $upd,
);
	
# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	