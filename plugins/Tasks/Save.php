<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
require_once 'Initial.php';
session_start();
$keyValue = $_REQUEST['id'];

$fldList = array();
$out = array();

foreach($fakeDrivers as $key => $fakeDriverID) {
    if($_REQUEST['OwnerID'] == $fakeDriverID) $_REQUEST['OwnerID'] = $realDrivers[$key];    
}

if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);
foreach ($db->fieldNames() as $name) {
	$content=$db->myreal_escape_string($_REQUEST[$name]);
	if(isset($_REQUEST[$name])) {
		eval("\$db->set".$name."(\$content);");	
	}
}
if(isset($_REQUEST['Datum1']) && isset($_REQUEST['Vreme1'])) { 
	$vreme=$_REQUEST['Datum1'].' '.$_REQUEST['Vreme1']; 
	$db->setDatum($db->myreal_escape_string($vreme) ); 
} 

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
	$db->setOwnerID($_SESSION['UseDriverID']);
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