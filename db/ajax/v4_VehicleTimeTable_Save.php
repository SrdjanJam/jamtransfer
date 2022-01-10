<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_VehicleTimeTable.class.php';


	# init class
	$db = new v4_VehicleTimeTable();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();


# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);


	if(isset($_REQUEST['OwnerID'])) { $db->setOwnerID($db->myreal_escape_string($_REQUEST['OwnerID']) ); } 

		 	
	if(isset($_REQUEST['WSID'])) { $db->setWSID($db->myreal_escape_string($_REQUEST['WSID']) ); } 

		 	
	if(isset($_REQUEST['VehicleID'])) { $db->setVehicleID($db->myreal_escape_string($_REQUEST['VehicleID']) ); } 

		 	
	if(isset($_REQUEST['TaskID'])) { $db->setTaskID($db->myreal_escape_string($_REQUEST['TaskID']) ); } 

		 	
	if(isset($_REQUEST['TaskDesc'])) { $db->setTaskDesc($db->myreal_escape_string($_REQUEST['TaskDesc']) ); } 

		 	
	if(isset($_REQUEST['TaskDetails'])) { $db->setTaskDetails($db->myreal_escape_string($_REQUEST['TaskDetails']) ); } 

		 	
	if(isset($_REQUEST['Extras'])) { $db->setExtras($db->myreal_escape_string($_REQUEST['Extras']) ); } 

		 	
	if(isset($_REQUEST['MyDriver'])) { $db->setMyDriver($db->myreal_escape_string($_REQUEST['MyDriver']) ); } 

		 	
	if(isset($_REQUEST['StartDate'])) { $db->setStartDate($db->myreal_escape_string($_REQUEST['StartDate']) ); } 

		 	
	if(isset($_REQUEST['StartTime'])) { $db->setStartTime($db->myreal_escape_string($_REQUEST['StartTime']) ); } 

		 	
	if(isset($_REQUEST['FlightNo'])) { $db->setFlightNo($db->myreal_escape_string($_REQUEST['FlightNo']) ); } 

		 	
	if(isset($_REQUEST['FlightTime'])) { $db->setFlightTime($db->myreal_escape_string($_REQUEST['FlightTime']) ); } 

		 	
	if(isset($_REQUEST['PickupDate'])) { $db->setPickupDate($db->myreal_escape_string($_REQUEST['PickupDate']) ); } 

		 	
	if(isset($_REQUEST['PickupTime'])) { $db->setPickupTime($db->myreal_escape_string($_REQUEST['PickupTime']) ); } 

		 	
	if(isset($_REQUEST['PickupName'])) { $db->setPickupName($db->myreal_escape_string($_REQUEST['PickupName']) ); } 

		 	
	if(isset($_REQUEST['PickupPlace'])) { $db->setPickupPlace($db->myreal_escape_string($_REQUEST['PickupPlace']) ); } 

		 	
	if(isset($_REQUEST['PickupAddress'])) { $db->setPickupAddress($db->myreal_escape_string($_REQUEST['PickupAddress']) ); } 

		 	
	if(isset($_REQUEST['DropName'])) { $db->setDropName($db->myreal_escape_string($_REQUEST['DropName']) ); } 

		 	
	if(isset($_REQUEST['DropPlace'])) { $db->setDropPlace($db->myreal_escape_string($_REQUEST['DropPlace']) ); } 

		 	
	if(isset($_REQUEST['DropAddress'])) { $db->setDropAddress($db->myreal_escape_string($_REQUEST['DropAddress']) ); } 

		 	
	if(isset($_REQUEST['PaxName'])) { $db->setPaxName($db->myreal_escape_string($_REQUEST['PaxName']) ); } 

		 	
	if(isset($_REQUEST['PaxGSM'])) { $db->setPaxGSM($db->myreal_escape_string($_REQUEST['PaxGSM']) ); } 

		 	
	if(isset($_REQUEST['PaxNotes'])) { $db->setPaxNotes($db->myreal_escape_string($_REQUEST['PaxNotes']) ); } 

		 	
	if(isset($_REQUEST['AfterTask'])) { $db->setAfterTask($db->myreal_escape_string($_REQUEST['AfterTask']) ); } 

		 	
	if(isset($_REQUEST['OrderDetailsID'])) { $db->setOrderDetailsID($db->myreal_escape_string($_REQUEST['OrderDetailsID']) ); } 

		 	
	if(isset($_REQUEST['KmStart'])) { $db->setKmStart($db->myreal_escape_string($_REQUEST['KmStart']) ); } 

		 	
	if(isset($_REQUEST['KmEnd'])) { $db->setKmEnd($db->myreal_escape_string($_REQUEST['KmEnd']) ); } 

		 	
	if(isset($_REQUEST['Cash'])) { $db->setCash($db->myreal_escape_string($_REQUEST['Cash']) ); } 

		 	
	if(isset($_REQUEST['Status'])) { $db->setStatus($db->myreal_escape_string($_REQUEST['Status']) ); } 

		 	
	if(isset($_REQUEST['Completition'])) { $db->setCompletition($db->myreal_escape_string($_REQUEST['Completition']) ); } 

		 	
	if(isset($_REQUEST['DriverNotes'])) { $db->setDriverNotes($db->myreal_escape_string($_REQUEST['DriverNotes']) ); } 

		 	

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
	