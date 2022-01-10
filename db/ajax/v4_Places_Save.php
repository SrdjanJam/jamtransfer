<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_Places.class.php';


	# init class
	$db = new v4_Places();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();


# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);


	if(isset($_REQUEST['PlaceID'])) { $db->setPlaceID($db->myreal_escape_string($_REQUEST['PlaceID']) ); } 

		 	
	if(isset($_REQUEST['PlaceCountry'])) { $db->setPlaceCountry($db->myreal_escape_string($_REQUEST['PlaceCountry']) ); } 

		 	
	if(isset($_REQUEST['CountryNameEN'])) { $db->setCountryNameEN($db->myreal_escape_string($_REQUEST['CountryNameEN']) ); } 

		 	
	if(isset($_REQUEST['PlaceNameEN'])) { $db->setPlaceNameEN($db->myreal_escape_string($_REQUEST['PlaceNameEN']) ); } 

		 	
	if(isset($_REQUEST['PlaceNameSEO'])) { $db->setPlaceNameSEO($db->myreal_escape_string($_REQUEST['PlaceNameSEO']) ); } 

		 	
	if(isset($_REQUEST['PlaceNameRU'])) { $db->setPlaceNameRU($db->myreal_escape_string($_REQUEST['PlaceNameRU']) ); } 

		 	
	if(isset($_REQUEST['PlaceNameFR'])) { $db->setPlaceNameFR($db->myreal_escape_string($_REQUEST['PlaceNameFR']) ); } 

		 	
	if(isset($_REQUEST['PlaceNameDE'])) { $db->setPlaceNameDE($db->myreal_escape_string($_REQUEST['PlaceNameDE']) ); } 

		 	
	if(isset($_REQUEST['PlaceNameIT'])) { $db->setPlaceNameIT($db->myreal_escape_string($_REQUEST['PlaceNameIT']) ); } 

		 	
	if(isset($_REQUEST['PlaceType'])) { $db->setPlaceType($db->myreal_escape_string($_REQUEST['PlaceType']) ); } 

		 	
	if(isset($_REQUEST['PlaceCity'])) { $db->setPlaceCity($db->myreal_escape_string($_REQUEST['PlaceCity']) ); } 

		 	
	if(isset($_REQUEST['PlaceAddress'])) { $db->setPlaceAddress($db->myreal_escape_string($_REQUEST['PlaceAddress']) ); } 

		 	
	if(isset($_REQUEST['PlaceDesc'])) { $db->setPlaceDesc($db->myreal_escape_string($_REQUEST['PlaceDesc']) ); } 

		 	
	if(isset($_REQUEST['PlaceDescEN'])) { $db->setPlaceDescEN($db->myreal_escape_string($_REQUEST['PlaceDescEN']) ); } 

		 	
	if(isset($_REQUEST['PlaceDescRU'])) { $db->setPlaceDescRU($db->myreal_escape_string($_REQUEST['PlaceDescRU']) ); } 

		 	
	if(isset($_REQUEST['PlaceDescFR'])) { $db->setPlaceDescFR($db->myreal_escape_string($_REQUEST['PlaceDescFR']) ); } 

		 	
	if(isset($_REQUEST['PlaceDescDE'])) { $db->setPlaceDescDE($db->myreal_escape_string($_REQUEST['PlaceDescDE']) ); } 

		 	
	if(isset($_REQUEST['PlaceDescIT'])) { $db->setPlaceDescIT($db->myreal_escape_string($_REQUEST['PlaceDescIT']) ); } 

		 	
	if(isset($_REQUEST['Image'])) { $db->setImage($db->myreal_escape_string($_REQUEST['Image']) ); } 

		 	
	if(isset($_REQUEST['Island'])) { $db->setIsland($db->myreal_escape_string($_REQUEST['Island']) ); } 

		 	
	if(isset($_REQUEST['PlaceActive'])) { $db->setPlaceActive($db->myreal_escape_string($_REQUEST['PlaceActive']) ); } 

		 	

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
	