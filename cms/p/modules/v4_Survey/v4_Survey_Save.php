<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_Survey.class.php';


	# init class
	$db = new v4_Survey();

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

		 	
	if(isset($_REQUEST['Date'])) { $db->setDate($db->myreal_escape_string($_REQUEST['Date']) ); } 

		 	
	if(isset($_REQUEST['OrderID'])) { $db->setOrderID($db->myreal_escape_string($_REQUEST['OrderID']) ); } 

		 	
	if(isset($_REQUEST['RouteID'])) { $db->setRouteID($db->myreal_escape_string($_REQUEST['RouteID']) ); } 

		 	
	if(isset($_REQUEST['UserEmail'])) { $db->setUserEmail($db->myreal_escape_string($_REQUEST['UserEmail']) ); } 

		 	
	if(isset($_REQUEST['UserName'])) { $db->setUserName($db->myreal_escape_string($_REQUEST['UserName']) ); } 

		 	
	if(isset($_REQUEST['Comment'])) { $db->setComment($db->myreal_escape_string($_REQUEST['Comment']) ); } 

		 	
	if(isset($_REQUEST['ScoreService'])) { $db->setScoreService($db->myreal_escape_string($_REQUEST['ScoreService']) ); } 

		 	
	if(isset($_REQUEST['ScoreDriver'])) { $db->setScoreDriver($db->myreal_escape_string($_REQUEST['ScoreDriver']) ); } 

		 	
	if(isset($_REQUEST['ScoreClean'])) { $db->setScoreClean($db->myreal_escape_string($_REQUEST['ScoreClean']) ); } 

		 	
	if(isset($_REQUEST['ScoreValue'])) { $db->setScoreValue($db->myreal_escape_string($_REQUEST['ScoreValue']) ); } 

		 	
	if(isset($_REQUEST['ScoreWebsite'])) { $db->setScoreWebsite($db->myreal_escape_string($_REQUEST['ScoreWebsite']) ); } 

		 	
	if(isset($_REQUEST['ScoreTotal'])) { $db->setScoreTotal($db->myreal_escape_string($_REQUEST['ScoreTotal']) ); } 

		 	
	if(isset($_REQUEST['DriverOnTime'])) { $db->setDriverOnTime($db->myreal_escape_string($_REQUEST['DriverOnTime']) ); } 

		 	
	if(isset($_REQUEST['Recommend'])) { $db->setRecommend($db->myreal_escape_string($_REQUEST['Recommend']) ); } 

		 	
	if(isset($_REQUEST['BookAgain'])) { $db->setBookAgain($db->myreal_escape_string($_REQUEST['BookAgain']) ); } 

		 	
	if(isset($_REQUEST['Approved'])) { $db->setApproved($db->myreal_escape_string($_REQUEST['Approved']) ); } 

		 	

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
	