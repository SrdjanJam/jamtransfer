<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_InvoicesMaster.class.php';


	# init class
	$db = new v4_InvoicesMaster();

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

		 	
	if(isset($_REQUEST['InvoiceNumber'])) { $db->setInvoiceNumber($db->myreal_escape_string($_REQUEST['InvoiceNumber']) ); } 

		 	
	if(isset($_REQUEST['DateCreated'])) { $db->setDateCreated($db->myreal_escape_string($_REQUEST['DateCreated']) ); } 

		 	
	if(isset($_REQUEST['DueDate'])) { $db->setDueDate($db->myreal_escape_string($_REQUEST['DueDate']) ); } 

		 	
	if(isset($_REQUEST['PartnerID'])) { $db->setPartnerID($db->myreal_escape_string($_REQUEST['PartnerID']) ); } 

		 	
	if(isset($_REQUEST['Instructions'])) { $db->setInstructions($db->myreal_escape_string($_REQUEST['Instructions']) ); } 

		 	
	if(isset($_REQUEST['Subtotal'])) { $db->setSubtotal($db->myreal_escape_string($_REQUEST['Subtotal']) ); } 

		 	
	if(isset($_REQUEST['TaxPercent'])) { $db->setTaxPercent($db->myreal_escape_string($_REQUEST['TaxPercent']) ); } 

		 	
	if(isset($_REQUEST['TaxAmount'])) { $db->setTaxAmount($db->myreal_escape_string($_REQUEST['TaxAmount']) ); } 

		 	
	if(isset($_REQUEST['Total'])) { $db->setTotal($db->myreal_escape_string($_REQUEST['Total']) ); } 

		 	
	if(isset($_REQUEST['Currency'])) { $db->setCurrency($db->myreal_escape_string($_REQUEST['Currency']) ); } 

		 	
	if(isset($_REQUEST['EURToCurrency'])) { $db->setEURToCurrency($db->myreal_escape_string($_REQUEST['EURToCurrency']) ); } 

		 	
	if(isset($_REQUEST['SubtotalEUR'])) { $db->setSubtotalEUR($db->myreal_escape_string($_REQUEST['SubtotalEUR']) ); } 

		 	
	if(isset($_REQUEST['TaxAmountEUR'])) { $db->setTaxAmountEUR($db->myreal_escape_string($_REQUEST['TaxAmountEUR']) ); } 

		 	
	if(isset($_REQUEST['TotalEUR'])) { $db->setTotalEUR($db->myreal_escape_string($_REQUEST['TotalEUR']) ); } 

		 	
	if(isset($_REQUEST['Status'])) { $db->setStatus($db->myreal_escape_string($_REQUEST['Status']) ); } 

		 	
	if(isset($_REQUEST['CreatorID'])) { $db->setCreatorID($db->myreal_escape_string($_REQUEST['CreatorID']) ); } 

		 	

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
	