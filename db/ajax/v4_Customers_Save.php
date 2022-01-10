<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_Customers.class.php';


	# init class
	$db = new v4_Customers();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();


# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);


	if(isset($_REQUEST['Site'])) { $db->setSite($db->myreal_escape_string($_REQUEST['Site']) ); } 

		 	
	if(isset($_REQUEST['CustID'])) { $db->setCustID($db->myreal_escape_string($_REQUEST['CustID']) ); } 

		 	
	if(isset($_REQUEST['CustType'])) { $db->setCustType($db->myreal_escape_string($_REQUEST['CustType']) ); } 

		 	
	if(isset($_REQUEST['CustFirstName'])) { $db->setCustFirstName($db->myreal_escape_string($_REQUEST['CustFirstName']) ); } 

		 	
	if(isset($_REQUEST['CustLastName'])) { $db->setCustLastName($db->myreal_escape_string($_REQUEST['CustLastName']) ); } 

		 	
	if(isset($_REQUEST['CustCountry'])) { $db->setCustCountry($db->myreal_escape_string($_REQUEST['CustCountry']) ); } 

		 	
	if(isset($_REQUEST['CustLanguage'])) { $db->setCustLanguage($db->myreal_escape_string($_REQUEST['CustLanguage']) ); } 

		 	
	if(isset($_REQUEST['CustEmail'])) { $db->setCustEmail($db->myreal_escape_string($_REQUEST['CustEmail']) ); } 

		 	
	if(isset($_REQUEST['CustAddress'])) { $db->setCustAddress($db->myreal_escape_string($_REQUEST['CustAddress']) ); } 

		 	
	if(isset($_REQUEST['CustCity'])) { $db->setCustCity($db->myreal_escape_string($_REQUEST['CustCity']) ); } 

		 	
	if(isset($_REQUEST['CustZip'])) { $db->setCustZip($db->myreal_escape_string($_REQUEST['CustZip']) ); } 

		 	
	if(isset($_REQUEST['CustMobile'])) { $db->setCustMobile($db->myreal_escape_string($_REQUEST['CustMobile']) ); } 

		 	
	if(isset($_REQUEST['CustPass'])) { $db->setCustPass($db->myreal_escape_string($_REQUEST['CustPass']) ); } 

		 	
	if(isset($_REQUEST['CustSubscribed'])) { $db->setCustSubscribed($db->myreal_escape_string($_REQUEST['CustSubscribed']) ); } 

		 	
	if(isset($_REQUEST['CustActive'])) { $db->setCustActive($db->myreal_escape_string($_REQUEST['CustActive']) ); } 

		 	
	if(isset($_REQUEST['CustImage'])) { $db->setCustImage($db->myreal_escape_string($_REQUEST['CustImage']) ); } 

		 	
	if(isset($_REQUEST['CustImageType'])) { $db->setCustImageType($db->myreal_escape_string($_REQUEST['CustImageType']) ); } 

		 	

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
	