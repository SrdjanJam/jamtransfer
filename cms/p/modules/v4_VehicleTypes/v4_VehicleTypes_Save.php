<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once ROOT . '/db/db.class.php';
	require_once ROOT . '/db/v4_VehicleTypes.class.php';


	# init class
	$db = new v4_VehicleTypes();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();


# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);


	if(isset($_REQUEST['VehicleTypeID'])) { $db->setVehicleTypeID($db->myreal_escape_string($_REQUEST['VehicleTypeID']) ); } 

		 	
	if(isset($_REQUEST['VehicleTypeName'])) { $db->setVehicleTypeName($db->myreal_escape_string($_REQUEST['VehicleTypeName']) ); } 

		 	
	if(isset($_REQUEST['VehicleTypeNameEN'])) { $db->setVehicleTypeNameEN($db->myreal_escape_string($_REQUEST['VehicleTypeNameEN']) ); } 

		 	
	if(isset($_REQUEST['VehicleTypeNameRU'])) { $db->setVehicleTypeNameRU($db->myreal_escape_string($_REQUEST['VehicleTypeNameRU']) ); } 

		 	
	if(isset($_REQUEST['VehicleTypeNameFR'])) { $db->setVehicleTypeNameFR($db->myreal_escape_string($_REQUEST['VehicleTypeNameFR']) ); } 

		 	
	if(isset($_REQUEST['VehicleTypeNameDE'])) { $db->setVehicleTypeNameDE($db->myreal_escape_string($_REQUEST['VehicleTypeNameDE']) ); } 

		 	
	if(isset($_REQUEST['VehicleTypeNameIT'])) { $db->setVehicleTypeNameIT($db->myreal_escape_string($_REQUEST['VehicleTypeNameIT']) ); } 

		 	
	if(isset($_REQUEST['VehicleTypeNameSE'])) { $db->setVehicleTypeNameSE($db->myreal_escape_string($_REQUEST['VehicleTypeNameSE']) ); } 

		 	
	if(isset($_REQUEST['VehicleTypeNameNO'])) { $db->setVehicleTypeNameNO($db->myreal_escape_string($_REQUEST['VehicleTypeNameNO']) ); } 

		 	
	if(isset($_REQUEST['VehicleTypeNameES'])) { $db->setVehicleTypeNameES($db->myreal_escape_string($_REQUEST['VehicleTypeNameES']) ); } 

		 	
	if(isset($_REQUEST['VehicleTypeNameNL'])) { $db->setVehicleTypeNameNL($db->myreal_escape_string($_REQUEST['VehicleTypeNameNL']) ); } 

		 	
	if(isset($_REQUEST['Min'])) { $db->setMin($db->myreal_escape_string($_REQUEST['Min']) ); } 

		 	
	if(isset($_REQUEST['Max'])) { $db->setMax($db->myreal_escape_string($_REQUEST['Max']) ); } 

		 	
	if(isset($_REQUEST['VehicleClass'])) { $db->setVehicleClass($db->myreal_escape_string($_REQUEST['VehicleClass']) ); } 

		 	
	if(isset($_REQUEST['Description'])) { $db->setDescription($db->myreal_escape_string($_REQUEST['Description']) ); } 

		 	
	if(isset($_REQUEST['DescriptionEN'])) { $db->setDescriptionEN($db->myreal_escape_string($_REQUEST['DescriptionEN']) ); } 

		 	
	if(isset($_REQUEST['DescriptionRU'])) { $db->setDescriptionRU($db->myreal_escape_string($_REQUEST['DescriptionRU']) ); } 

		 	
	if(isset($_REQUEST['DescriptionFR'])) { $db->setDescriptionFR($db->myreal_escape_string($_REQUEST['DescriptionFR']) ); } 

		 	
	if(isset($_REQUEST['DescriptionDE'])) { $db->setDescriptionDE($db->myreal_escape_string($_REQUEST['DescriptionDE']) ); } 

		 	
	if(isset($_REQUEST['DescriptionIT'])) { $db->setDescriptionIT($db->myreal_escape_string($_REQUEST['DescriptionIT']) ); } 

		 	
	if(isset($_REQUEST['DescriptionSE'])) { $db->setDescriptionSE($db->myreal_escape_string($_REQUEST['DescriptionSE']) ); } 

		 	
	if(isset($_REQUEST['DescriptionNO'])) { $db->setDescriptionNO($db->myreal_escape_string($_REQUEST['DescriptionNO']) ); } 

		 	
	if(isset($_REQUEST['DescriptionES'])) { $db->setDescriptionES($db->myreal_escape_string($_REQUEST['DescriptionES']) ); } 

		 	
	if(isset($_REQUEST['DescriptionNL'])) { $db->setDescriptionNL($db->myreal_escape_string($_REQUEST['DescriptionNL']) ); } 

		 	

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
	