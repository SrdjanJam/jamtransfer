<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_CoInfo.class.php';


	# init class
	$db = new v4_CoInfo();

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

		 	
	if(isset($_REQUEST['co_name'])) { $db->setco_name($db->myreal_escape_string($_REQUEST['co_name']) ); } 

		 	
	if(isset($_REQUEST['co_address'])) { $db->setco_address($db->myreal_escape_string($_REQUEST['co_address']) ); } 

		 	
	if(isset($_REQUEST['co_tel'])) { $db->setco_tel($db->myreal_escape_string($_REQUEST['co_tel']) ); } 

		 	
	if(isset($_REQUEST['co_fax'])) { $db->setco_fax($db->myreal_escape_string($_REQUEST['co_fax']) ); } 

		 	
	if(isset($_REQUEST['co_city'])) { $db->setco_city($db->myreal_escape_string($_REQUEST['co_city']) ); } 

		 	
	if(isset($_REQUEST['co_country'])) { $db->setco_country($db->myreal_escape_string($_REQUEST['co_country']) ); } 

		 	
	if(isset($_REQUEST['co_zip'])) { $db->setco_zip($db->myreal_escape_string($_REQUEST['co_zip']) ); } 

		 	
	if(isset($_REQUEST['co_email'])) { $db->setco_email($db->myreal_escape_string($_REQUEST['co_email']) ); } 

		 	
	if(isset($_REQUEST['co_taxno'])) { $db->setco_taxno($db->myreal_escape_string($_REQUEST['co_taxno']) ); } 

		 	
	if(isset($_REQUEST['co_bank'])) { $db->setco_bank($db->myreal_escape_string($_REQUEST['co_bank']) ); } 

		 	
	if(isset($_REQUEST['co_accountno'])) { $db->setco_accountno($db->myreal_escape_string($_REQUEST['co_accountno']) ); } 

		 	
	if(isset($_REQUEST['co_iban'])) { $db->setco_iban($db->myreal_escape_string($_REQUEST['co_iban']) ); } 

		 	
	if(isset($_REQUEST['co_swift'])) { $db->setco_swift($db->myreal_escape_string($_REQUEST['co_swift']) ); } 

		 	
	if(isset($_REQUEST['co_domestictax'])) { $db->setco_domestictax($db->myreal_escape_string($_REQUEST['co_domestictax']) ); } 

		 	
	if(isset($_REQUEST['co_foreigntax'])) { $db->setco_foreigntax($db->myreal_escape_string($_REQUEST['co_foreigntax']) ); } 

		 	
	if(isset($_REQUEST['co_eurinfo'])) { $db->setco_eurinfo($db->myreal_escape_string($_REQUEST['co_eurinfo']) ); } 

		 	
	if(isset($_REQUEST['co_paymentinfo'])) { $db->setco_paymentinfo($db->myreal_escape_string($_REQUEST['co_paymentinfo']) ); } 

		 	
	if(isset($_REQUEST['co_facebook'])) { $db->setco_facebook($db->myreal_escape_string($_REQUEST['co_facebook']) ); } 

		 	
	if(isset($_REQUEST['co_twitter'])) { $db->setco_twitter($db->myreal_escape_string($_REQUEST['co_twitter']) ); } 

		 	
	if(isset($_REQUEST['co_linkedin'])) { $db->setco_linkedin($db->myreal_escape_string($_REQUEST['co_linkedin']) ); } 

		 	
	if(isset($_REQUEST['co_youtube'])) { $db->setco_youtube($db->myreal_escape_string($_REQUEST['co_youtube']) ); } 

		 	
	if(isset($_REQUEST['co_googleplus'])) { $db->setco_googleplus($db->myreal_escape_string($_REQUEST['co_googleplus']) ); } 

		 	
	if(isset($_REQUEST['co_todo'])) { $db->setco_todo($db->myreal_escape_string($_REQUEST['co_todo']) ); } 

		 	

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
	