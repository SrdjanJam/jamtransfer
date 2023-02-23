<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);

require_once 'Initial.php';

session_start();

// OLDER:	
# init vars
// $keyName = '';
// $keyValue = '';

// if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
// if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];


$keyValue = $_REQUEST['id'];

$fldList = array();
$out = array();


foreach($fakeDrivers as $key => $fakeDriverID) {
    if($_REQUEST['OwnerID'] == $fakeDriverID) $_REQUEST['OwnerID'] = $realDrivers[$key];    
}

# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);
	$vreme=$_REQUEST['Datum1'].' '.$_REQUEST['Vreme1']; 
	if(isset($_REQUEST['ID'])) { $db->setID($db->myreal_escape_string($_REQUEST['ID']) ); } 
	if(isset($_REQUEST['OwnerID'])) { $db->setOwnerID($db->myreal_escape_string($_REQUEST['OwnerID']) ); } 
	if(isset($_REQUEST['DriverID'])) { $db->setDriverID($db->myreal_escape_string($_REQUEST['DriverID']) ); } 
	if(isset($_REQUEST['VehicleID'])) { $db->setVehicleID($db->myreal_escape_string($_REQUEST['VehicleID']) ); } 
	if(isset($_REQUEST['Datum1']) && isset($_REQUEST['Vreme1'])) { $db->setDatum($db->myreal_escape_string($vreme) ); } 
	if(isset($_REQUEST['Expense'])) { $db->setExpense($db->myreal_escape_string($_REQUEST['Expense']) ); } 
	if(isset($_REQUEST['Description'])) { $db->setDescription($db->myreal_escape_string($_REQUEST['Description']) ); } 
	if(isset($_REQUEST['DocumentImage'])) { $db->setDocumentImage($db->myreal_escape_string($_REQUEST['DocumentImage']) ); } 
	if(isset($_REQUEST['ActionImage'])) { $db->setActionImage($db->myreal_escape_string($_REQUEST['ActionImage']) ); } 	
	if(isset($_REQUEST['Approved'])) { $db->setApproved($db->myreal_escape_string($_REQUEST['Approved']) ); } 
	if(isset($_REQUEST['Note'])) { $db->setNote($db->myreal_escape_string($_REQUEST['Note']) ); } 


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
	$db->setOwnerID($_SESSION['OwnerID']);
	$newID = $db->saveAsNew();
}
// zaprimanje - razduzivanje vozila
$ex_arr=array(109,127);
if( in_array($_REQUEST['Expense'],$ex_arr)) {
	// brisanje
$sqlD="DELETE FROM `v4_SubVehiclesSubDrivers` WHERE `OwnerID`='".$_REQUEST['OwnerID']."' && (SubVehicleID=".$_REQUEST['VehicleID']." || SubDriverID=".$_REQUEST['DriverID'].")";
	$dbf->RunQuery($sqlD);
	if(isset($_REQUEST['Approved']) && $_REQUEST['Approved']==1 && $_REQUEST['Expense']==109) {
		//unos
		$sql="INSERT INTO `v4_SubVehiclesSubDrivers`(`OwnerID`,`SubVehicleID`, `SubDriverID`) VALUES ('".$_REQUEST['OwnerID']."','".$_REQUEST['VehicleID']."','".$_REQUEST['DriverID']."')";
		$dbf->RunQuery($sql);	
	}	
}	

$out = array(
	'update' => $upd,
	'insert' => $newID
);

# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';