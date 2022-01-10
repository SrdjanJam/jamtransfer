<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_Countries.class.php';


	# init class
	$db = new v4_Countries();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();


# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);


	if(isset($_REQUEST['CountryID'])) { $db->setCountryID($db->myreal_escape_string($_REQUEST['CountryID']) ); } 

		 	
	if(isset($_REQUEST['CountryName'])) { $db->setCountryName($db->myreal_escape_string($_REQUEST['CountryName']) ); } 

		 	
	if(isset($_REQUEST['CountryNameEN'])) { $db->setCountryNameEN($db->myreal_escape_string($_REQUEST['CountryNameEN']) ); } 

		 	
	if(isset($_REQUEST['CountryNameRU'])) { $db->setCountryNameRU($db->myreal_escape_string($_REQUEST['CountryNameRU']) ); } 

		 	
	if(isset($_REQUEST['CountryNameFR'])) { $db->setCountryNameFR($db->myreal_escape_string($_REQUEST['CountryNameFR']) ); } 

		 	
	if(isset($_REQUEST['CountryNameDE'])) { $db->setCountryNameDE($db->myreal_escape_string($_REQUEST['CountryNameDE']) ); } 

		 	
	if(isset($_REQUEST['CountryNameIT'])) { $db->setCountryNameIT($db->myreal_escape_string($_REQUEST['CountryNameIT']) ); } 

		 	
	if(isset($_REQUEST['CountryDesc'])) { $db->setCountryDesc($db->myreal_escape_string($_REQUEST['CountryDesc']) ); } 

		 	
	if(isset($_REQUEST['CountryDescEN'])) { $db->setCountryDescEN($db->myreal_escape_string($_REQUEST['CountryDescEN']) ); } 

		 	
	if(isset($_REQUEST['CountryDescRU'])) { $db->setCountryDescRU($db->myreal_escape_string($_REQUEST['CountryDescRU']) ); } 

		 	
	if(isset($_REQUEST['CountryDescFR'])) { $db->setCountryDescFR($db->myreal_escape_string($_REQUEST['CountryDescFR']) ); } 

		 	
	if(isset($_REQUEST['CountryDescDE'])) { $db->setCountryDescDE($db->myreal_escape_string($_REQUEST['CountryDescDE']) ); } 

		 	
	if(isset($_REQUEST['CountryDescIT'])) { $db->setCountryDescIT($db->myreal_escape_string($_REQUEST['CountryDescIT']) ); } 

		 	
	if(isset($_REQUEST['CountryISO'])) { $db->setCountryISO($db->myreal_escape_string($_REQUEST['CountryISO']) ); } 

		 	
	if(isset($_REQUEST['CountryCode'])) { $db->setCountryCode($db->myreal_escape_string($_REQUEST['CountryCode']) ); } 

		 	
	if(isset($_REQUEST['CountryCode3'])) { $db->setCountryCode3($db->myreal_escape_string($_REQUEST['CountryCode3']) ); } 

		 	
	if(isset($_REQUEST['PhonePrefix'])) { $db->setPhonePrefix($db->myreal_escape_string($_REQUEST['PhonePrefix']) ); } 

		 	
	if(isset($_REQUEST['Currency'])) { $db->setCurrency($db->myreal_escape_string($_REQUEST['Currency']) ); } 

		 	

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
	