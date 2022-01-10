<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_Ratings.class.php';


	# init class
	$db = new v4_Ratings();

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

		 	
	if(isset($_REQUEST['Average'])) { $db->setAverage($db->myreal_escape_string($_REQUEST['Average']) ); } 

		 	
	if(isset($_REQUEST['Votes'])) { $db->setVotes($db->myreal_escape_string($_REQUEST['Votes']) ); } 

		 	
	if(isset($_REQUEST['Overall'])) { $db->setOverall($db->myreal_escape_string($_REQUEST['Overall']) ); } 

		 	
	if(isset($_REQUEST['Punct'])) { $db->setPunct($db->myreal_escape_string($_REQUEST['Punct']) ); } 

		 	
	if(isset($_REQUEST['Respons'])) { $db->setRespons($db->myreal_escape_string($_REQUEST['Respons']) ); } 

		 	
	if(isset($_REQUEST['Kind'])) { $db->setKind($db->myreal_escape_string($_REQUEST['Kind']) ); } 

		 	
	if(isset($_REQUEST['Vehicle'])) { $db->setVehicle($db->myreal_escape_string($_REQUEST['Vehicle']) ); } 

		 	
	if(isset($_REQUEST['Driver'])) { $db->setDriver($db->myreal_escape_string($_REQUEST['Driver']) ); } 

		 	
	if(isset($_REQUEST['LastVote'])) { $db->setLastVote($db->myreal_escape_string($_REQUEST['LastVote']) ); } 

		 	

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
	