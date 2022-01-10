<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_Surcharges.class.php';


	# init class
	$db = new v4_Surcharges();

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

		 	
	if(isset($_REQUEST['VehicleID'])) { $db->setVehicleID($db->myreal_escape_string($_REQUEST['VehicleID']) ); } 

		 	
	if(isset($_REQUEST['NgtStartHour'])) { $db->setNgtStartHour($db->myreal_escape_string($_REQUEST['NgtStartHour']) ); } 

		 	
	if(isset($_REQUEST['NgtEndHour'])) { $db->setNgtEndHour($db->myreal_escape_string($_REQUEST['NgtEndHour']) ); } 

		 	
	if(isset($_REQUEST['NgtSurcharge'])) { $db->setNgtSurcharge($db->myreal_escape_string($_REQUEST['NgtSurcharge']) ); } 

		 	
	if(isset($_REQUEST['WkndSurcharge'])) { $db->setWkndSurcharge($db->myreal_escape_string($_REQUEST['WkndSurcharge']) ); } 

		 	
	if(isset($_REQUEST['NgtAddPrice'])) { $db->setNgtAddPrice($db->myreal_escape_string($_REQUEST['NgtAddPrice']) ); } 

		 	
	if(isset($_REQUEST['WkndAddPrice'])) { $db->setWkndAddPrice($db->myreal_escape_string($_REQUEST['WkndAddPrice']) ); } 

		 	

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
	