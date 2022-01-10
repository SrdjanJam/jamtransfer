<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_Policies_DE.class.php';


	# init class
	$db = new v4_Policies_DE();

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

		 	
	if(isset($_REQUEST['DateChanged'])) { $db->setDateChanged($db->myreal_escape_string($_REQUEST['DateChanged']) ); } 

		 	
	if(isset($_REQUEST['BookingAdvance'])) { $db->setBookingAdvance($db->myreal_escape_string($_REQUEST['BookingAdvance']) ); } 

		 	
	if(isset($_REQUEST['DeclineTime'])) { $db->setDeclineTime($db->myreal_escape_string($_REQUEST['DeclineTime']) ); } 

		 	
	if(isset($_REQUEST['CancelDays'])) { $db->setCancelDays($db->myreal_escape_string($_REQUEST['CancelDays']) ); } 

		 	
	if(isset($_REQUEST['CancelCharge'])) { $db->setCancelCharge($db->myreal_escape_string($_REQUEST['CancelCharge']) ); } 

		 	
	if(isset($_REQUEST['Deposit'])) { $db->setDeposit($db->myreal_escape_string($_REQUEST['Deposit']) ); } 

		 	
	if(isset($_REQUEST['AMEX'])) { $db->setAMEX($db->myreal_escape_string($_REQUEST['AMEX']) ); } 

		 	
	if(isset($_REQUEST['Visa'])) { $db->setVisa($db->myreal_escape_string($_REQUEST['Visa']) ); } 

		 	
	if(isset($_REQUEST['MasterCard'])) { $db->setMasterCard($db->myreal_escape_string($_REQUEST['MasterCard']) ); } 

		 	
	if(isset($_REQUEST['Diners'])) { $db->setDiners($db->myreal_escape_string($_REQUEST['Diners']) ); } 

		 	
	if(isset($_REQUEST['MeetingGeneral'])) { $db->setMeetingGeneral($db->myreal_escape_string($_REQUEST['MeetingGeneral']) ); } 

		 	
	if(isset($_REQUEST['MeetingAirport'])) { $db->setMeetingAirport($db->myreal_escape_string($_REQUEST['MeetingAirport']) ); } 

		 	
	if(isset($_REQUEST['MeetingFerry'])) { $db->setMeetingFerry($db->myreal_escape_string($_REQUEST['MeetingFerry']) ); } 

		 	
	if(isset($_REQUEST['MeetingBus'])) { $db->setMeetingBus($db->myreal_escape_string($_REQUEST['MeetingBus']) ); } 

		 	
	if(isset($_REQUEST['MeetingTrain'])) { $db->setMeetingTrain($db->myreal_escape_string($_REQUEST['MeetingTrain']) ); } 

		 	
	if(isset($_REQUEST['Locked'])) { $db->setLocked($db->myreal_escape_string($_REQUEST['Locked']) ); } 

		 	

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
	