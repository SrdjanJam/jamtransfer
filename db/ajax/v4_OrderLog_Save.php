<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_OrderLog.class.php';


	# init class
	$db = new v4_OrderLog();

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

		 	
	if(isset($_REQUEST['ShowToCustomer'])) { $db->setShowToCustomer($db->myreal_escape_string($_REQUEST['ShowToCustomer']) ); } 

		 	
	if(isset($_REQUEST['OrderID'])) { $db->setOrderID($db->myreal_escape_string($_REQUEST['OrderID']) ); } 

		 	
	if(isset($_REQUEST['DetailsID'])) { $db->setDetailsID($db->myreal_escape_string($_REQUEST['DetailsID']) ); } 

		 	
	if(isset($_REQUEST['UserID'])) { $db->setUserID($db->myreal_escape_string($_REQUEST['UserID']) ); } 

		 	
	if(isset($_REQUEST['Icon'])) { $db->setIcon($db->myreal_escape_string($_REQUEST['Icon']) ); } 

		 	
	if(isset($_REQUEST['Action'])) { $db->setAction($db->myreal_escape_string($_REQUEST['Action']) ); } 

		 	
	if(isset($_REQUEST['Title'])) { $db->setTitle($db->myreal_escape_string($_REQUEST['Title']) ); } 

		 	
	if(isset($_REQUEST['Description'])) { $db->setDescription($db->myreal_escape_string($_REQUEST['Description']) ); } 

		 	
	if(isset($_REQUEST['DateAdded'])) { $db->setDateAdded($db->myreal_escape_string($_REQUEST['DateAdded']) ); } 

		 	
	if(isset($_REQUEST['TimeAdded'])) { $db->setTimeAdded($db->myreal_escape_string($_REQUEST['TimeAdded']) ); } 

		 	

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
	