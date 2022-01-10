<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_CustomQuery.class.php';


	# init class
	$db = new v4_CustomQuery();

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

		 	
	if(isset($_REQUEST['customName'])) { $db->setcustomName($db->myreal_escape_string($_REQUEST['customName']) ); } 

		 	
	if(isset($_REQUEST['customMail'])) { $db->setcustomMail($db->myreal_escape_string($_REQUEST['customMail']) ); } 

		 	
	if(isset($_REQUEST['customFrom'])) { $db->setcustomFrom($db->myreal_escape_string($_REQUEST['customFrom']) ); } 

		 	
	if(isset($_REQUEST['customTo'])) { $db->setcustomTo($db->myreal_escape_string($_REQUEST['customTo']) ); } 

		 	
	if(isset($_REQUEST['customPDate'])) { $db->setcustomPDate($db->myreal_escape_string($_REQUEST['customPDate']) ); } 

		 	
	if(isset($_REQUEST['customPTime'])) { $db->setcustomPTime($db->myreal_escape_string($_REQUEST['customPTime']) ); } 

		 	
	if(isset($_REQUEST['customPAddress'])) { $db->setcustomPAddress($db->myreal_escape_string($_REQUEST['customPAddress']) ); } 

		 	
	if(isset($_REQUEST['customDropoff'])) { $db->setcustomDropoff($db->myreal_escape_string($_REQUEST['customDropoff']) ); } 

		 	
	if(isset($_REQUEST['customPax'])) { $db->setcustomPax($db->myreal_escape_string($_REQUEST['customPax']) ); } 

		 	
	if(isset($_REQUEST['customVehicle'])) { $db->setcustomVehicle($db->myreal_escape_string($_REQUEST['customVehicle']) ); } 

		 	
	if(isset($_REQUEST['customBabySeats'])) { $db->setcustomBabySeats($db->myreal_escape_string($_REQUEST['customBabySeats']) ); } 

		 	
	if(isset($_REQUEST['customChildSeats'])) { $db->setcustomChildSeats($db->myreal_escape_string($_REQUEST['customChildSeats']) ); } 

		 	
	if(isset($_REQUEST['customExtras'])) { $db->setcustomExtras($db->myreal_escape_string($_REQUEST['customExtras']) ); } 

		 	
	if(isset($_REQUEST['customNotes'])) { $db->setcustomNotes($db->myreal_escape_string($_REQUEST['customNotes']) ); } 

		 	
	if(isset($_REQUEST['DateSent'])) { $db->setDateSent($db->myreal_escape_string($_REQUEST['DateSent']) ); } 

		 	
	if(isset($_REQUEST['TimeSent'])) { $db->setTimeSent($db->myreal_escape_string($_REQUEST['TimeSent']) ); } 

		 	
	if(isset($_REQUEST['Status'])) { $db->setStatus($db->myreal_escape_string($_REQUEST['Status']) ); } 

		 	
	if(isset($_REQUEST['Reply'])) { $db->setReply($db->myreal_escape_string($_REQUEST['Reply']) ); } 

		 	
	if(isset($_REQUEST['ReplyUserID'])) { $db->setReplyUserID($db->myreal_escape_string($_REQUEST['ReplyUserID']) ); } 

		 	
	if(isset($_REQUEST['ReplyDate'])) { $db->setReplyDate($db->myreal_escape_string($_REQUEST['ReplyDate']) ); } 

		 	
	if(isset($_REQUEST['ReplyTime'])) { $db->setReplyTime($db->myreal_escape_string($_REQUEST['ReplyTime']) ); } 

		 	
	if(isset($_REQUEST['AssignedDriverID'])) { $db->setAssignedDriverID($db->myreal_escape_string($_REQUEST['AssignedDriverID']) ); } 

		 	
	if(isset($_REQUEST['ConvertToBooking'])) { $db->setConvertToBooking($db->myreal_escape_string($_REQUEST['ConvertToBooking']) ); } 

		 	

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
	