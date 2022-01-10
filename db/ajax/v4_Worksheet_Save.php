<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_Worksheet.class.php';


	# init class
	$db = new v4_Worksheet();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();


# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);


	if(isset($_REQUEST['WSID'])) { $db->setWSID($db->myreal_escape_string($_REQUEST['WSID']) ); } 

		 	
	if(isset($_REQUEST['OwnerID'])) { $db->setOwnerID($db->myreal_escape_string($_REQUEST['OwnerID']) ); } 

		 	
	if(isset($_REQUEST['MyDriverID'])) { $db->setMyDriverID($db->myreal_escape_string($_REQUEST['MyDriverID']) ); } 

		 	
	if(isset($_REQUEST['DriverSignature'])) { $db->setDriverSignature($db->myreal_escape_string($_REQUEST['DriverSignature']) ); } 

		 	
	if(isset($_REQUEST['WSDate'])) { $db->setWSDate($db->myreal_escape_string($_REQUEST['WSDate']) ); } 

		 	
	if(isset($_REQUEST['WSTime'])) { $db->setWSTime($db->myreal_escape_string($_REQUEST['WSTime']) ); } 

		 	
	if(isset($_REQUEST['FromDate'])) { $db->setFromDate($db->myreal_escape_string($_REQUEST['FromDate']) ); } 

		 	
	if(isset($_REQUEST['ToDate'])) { $db->setToDate($db->myreal_escape_string($_REQUEST['ToDate']) ); } 

		 	
	if(isset($_REQUEST['CashWithdrawn'])) { $db->setCashWithdrawn($db->myreal_escape_string($_REQUEST['CashWithdrawn']) ); } 

		 	
	if(isset($_REQUEST['CashDeposit'])) { $db->setCashDeposit($db->myreal_escape_string($_REQUEST['CashDeposit']) ); } 

		 	
	if(isset($_REQUEST['KmOut'])) { $db->setKmOut($db->myreal_escape_string($_REQUEST['KmOut']) ); } 

		 	
	if(isset($_REQUEST['KmIn'])) { $db->setKmIn($db->myreal_escape_string($_REQUEST['KmIn']) ); } 

		 	
	if(isset($_REQUEST['Notes'])) { $db->setNotes($db->myreal_escape_string($_REQUEST['Notes']) ); } 

		 	
	if(isset($_REQUEST['Status'])) { $db->setStatus($db->myreal_escape_string($_REQUEST['Status']) ); } 

		 	
	if(isset($_REQUEST['LastChange'])) { $db->setLastChange($db->myreal_escape_string($_REQUEST['LastChange']) ); } 

		 	

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
	