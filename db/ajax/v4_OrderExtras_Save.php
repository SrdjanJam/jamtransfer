<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_OrderExtras.class.php';


	# init class
	$db = new v4_OrderExtras();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();


# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);


	if(isset($_REQUEST['ID'])) { $db->setID($db->myreal_escape_string($_REQUEST['ID']) ); } 

		 	
	if(isset($_REQUEST['OwnerID'])) { $db->setOwnerID($db->myreal_escape_string($_REQUEST['OwnerID']) ); } 

		 	
	if(isset($_REQUEST['OrderDetailsID'])) { $db->setOrderDetailsID($db->myreal_escape_string($_REQUEST['OrderDetailsID']) ); } 

		 	
	if(isset($_REQUEST['ServiceID'])) { $db->setServiceID($db->myreal_escape_string($_REQUEST['ServiceID']) ); } 

		 	
	if(isset($_REQUEST['ServiceName'])) { $db->setServiceName($db->myreal_escape_string($_REQUEST['ServiceName']) ); } 

		 	
	if(isset($_REQUEST['Provision'])) { $db->setProvision($db->myreal_escape_string($_REQUEST['Provision']) ); } 

		 	
	if(isset($_REQUEST['DriverPrice'])) { $db->setDriverPrice($db->myreal_escape_string($_REQUEST['DriverPrice']) ); } 

		 	
	if(isset($_REQUEST['Price'])) { $db->setPrice($db->myreal_escape_string($_REQUEST['Price']) ); } 

		 	
	if(isset($_REQUEST['Qty'])) { $db->setQty($db->myreal_escape_string($_REQUEST['Qty']) ); } 

		 	
	if(isset($_REQUEST['DriverPriceSum'])) { $db->setDriverPriceSum($db->myreal_escape_string($_REQUEST['DriverPriceSum']) ); } 

		 	
	if(isset($_REQUEST['Sum'])) { $db->setSum($db->myreal_escape_string($_REQUEST['Sum']) ); } 

		 	

$upd = '';
$newID = '';

// ako je update, azuriraj trazeni slog

if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}

// inace dodaj novi slog	
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
	