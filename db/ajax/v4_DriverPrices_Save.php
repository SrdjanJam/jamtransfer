<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_DriverPrices.class.php';


	# init class
	$db = new v4_DriverPrices();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();


# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);


	if(isset($_REQUEST['DriverID'])) { $db->setDriverID($db->myreal_escape_string($_REQUEST['DriverID']) ); } 

		 	
	if(isset($_REQUEST['FromName'])) { $db->setFromName($db->myreal_escape_string($_REQUEST['FromName']) ); } 

		 	
	if(isset($_REQUEST['FromNameEN'])) { $db->setFromNameEN($db->myreal_escape_string($_REQUEST['FromNameEN']) ); } 

		 	
	if(isset($_REQUEST['FromNameRU'])) { $db->setFromNameRU($db->myreal_escape_string($_REQUEST['FromNameRU']) ); } 

		 	
	if(isset($_REQUEST['FromNameFR'])) { $db->setFromNameFR($db->myreal_escape_string($_REQUEST['FromNameFR']) ); } 

		 	
	if(isset($_REQUEST['FromNameDE'])) { $db->setFromNameDE($db->myreal_escape_string($_REQUEST['FromNameDE']) ); } 

		 	
	if(isset($_REQUEST['FromNameIT'])) { $db->setFromNameIT($db->myreal_escape_string($_REQUEST['FromNameIT']) ); } 

		 	
	if(isset($_REQUEST['TerminalID'])) { $db->setTerminalID($db->myreal_escape_string($_REQUEST['TerminalID']) ); } 

		 	
	if(isset($_REQUEST['ToName'])) { $db->setToName($db->myreal_escape_string($_REQUEST['ToName']) ); } 

		 	
	if(isset($_REQUEST['ToNameEN'])) { $db->setToNameEN($db->myreal_escape_string($_REQUEST['ToNameEN']) ); } 

		 	
	if(isset($_REQUEST['ToNameRU'])) { $db->setToNameRU($db->myreal_escape_string($_REQUEST['ToNameRU']) ); } 

		 	
	if(isset($_REQUEST['ToNameFR'])) { $db->setToNameFR($db->myreal_escape_string($_REQUEST['ToNameFR']) ); } 

		 	
	if(isset($_REQUEST['ToNameDE'])) { $db->setToNameDE($db->myreal_escape_string($_REQUEST['ToNameDE']) ); } 

		 	
	if(isset($_REQUEST['ToNameIT'])) { $db->setToNameIT($db->myreal_escape_string($_REQUEST['ToNameIT']) ); } 

		 	
	if(isset($_REQUEST['DestinationID'])) { $db->setDestinationID($db->myreal_escape_string($_REQUEST['DestinationID']) ); } 

		 	
	if(isset($_REQUEST['RouteID'])) { $db->setRouteID($db->myreal_escape_string($_REQUEST['RouteID']) ); } 

		 	
	if(isset($_REQUEST['VehicleTypeID'])) { $db->setVehicleTypeID($db->myreal_escape_string($_REQUEST['VehicleTypeID']) ); } 

		 	
	if(isset($_REQUEST['SinglePrice'])) { $db->setSinglePrice($db->myreal_escape_string($_REQUEST['SinglePrice']) ); } 

		 	
	if(isset($_REQUEST['ReturnPrice'])) { $db->setReturnPrice($db->myreal_escape_string($_REQUEST['ReturnPrice']) ); } 

		 	
	if(isset($_REQUEST['ID'])) { $db->setID($db->myreal_escape_string($_REQUEST['ID']) ); } 

		 	

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
	