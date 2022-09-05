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

if(isset($_REQUEST['PaymentStatus'])) { 
	$db->setStatus($db->myreal_escape_string($_REQUEST['PaymentStatus']) ); 			
	$query="UPDATE `v4_OrderDetails` SET `PaymentStatus`=".$_REQUEST['PaymentStatus']." WHERE `InvoiceNumber`='".$_REQUEST['InvoiceNumber']."'"; 
	$base = new  DataBaseMysql();
	$base->RunQuery($query);  
} 
if(isset($_REQUEST['DriverPayment'])) { 
	$db->setStatus($db->myreal_escape_string($_REQUEST['DriverPayment']) ); 		
	$query="UPDATE `v4_OrderDetails` SET `DriverPayment`=".$_REQUEST['DriverPayment']." WHERE `DriverInvoiceNumber`='".$_REQUEST['InvoiceNumber']."'";
	$base = new  DataBaseMysql();
	$base->RunQuery($query);  
} 


$upd = '';
if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}

$out = array(
	'update' => $upd
);
	
	

# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	