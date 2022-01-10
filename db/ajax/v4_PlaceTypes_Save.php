<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_PlaceTypes.class.php';


	# init class
	$db = new v4_PlaceTypes();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();


# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);


	if(isset($_REQUEST['PlaceTypeID'])) { $db->setPlaceTypeID($db->myreal_escape_string($_REQUEST['PlaceTypeID']) ); } 

		 	
	if(isset($_REQUEST['PlaceType'])) { $db->setPlaceType($db->myreal_escape_string($_REQUEST['PlaceType']) ); } 

		 	
	if(isset($_REQUEST['PlaceTypeEN'])) { $db->setPlaceTypeEN($db->myreal_escape_string($_REQUEST['PlaceTypeEN']) ); } 

		 	
	if(isset($_REQUEST['PlaceTypeRU'])) { $db->setPlaceTypeRU($db->myreal_escape_string($_REQUEST['PlaceTypeRU']) ); } 

		 	
	if(isset($_REQUEST['PlaceTypeFR'])) { $db->setPlaceTypeFR($db->myreal_escape_string($_REQUEST['PlaceTypeFR']) ); } 

		 	
	if(isset($_REQUEST['PlaceTypeDE'])) { $db->setPlaceTypeDE($db->myreal_escape_string($_REQUEST['PlaceTypeDE']) ); } 

		 	
	if(isset($_REQUEST['PlaceTypeIT'])) { $db->setPlaceTypeIT($db->myreal_escape_string($_REQUEST['PlaceTypeIT']) ); } 

		 	

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
	