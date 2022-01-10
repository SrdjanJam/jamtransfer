<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_TodoList.class.php';


	# init class
	$db = new v4_TodoList();

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

		 	
	if(isset($_REQUEST['OwnerID'])) { $db->setOwnerID($db->myreal_escape_string($_REQUEST['OwnerID']) ); } 

		 	
	if(isset($_REQUEST['Task'])) { $db->setTask($db->myreal_escape_string($_REQUEST['Task']) ); } 

		 	
	if(isset($_REQUEST['DateAdded'])) { $db->setDateAdded($db->myreal_escape_string($_REQUEST['DateAdded']) ); } 

		 	
	if(isset($_REQUEST['TimeAdded'])) { $db->setTimeAdded($db->myreal_escape_string($_REQUEST['TimeAdded']) ); } 

		 	
	if(isset($_REQUEST['Completed'])) { $db->setCompleted($db->myreal_escape_string($_REQUEST['Completed']) ); } 

		 	
	if(isset($_REQUEST['DateCompleted'])) { $db->setDateCompleted($db->myreal_escape_string($_REQUEST['DateCompleted']) ); } 

		 	
	if(isset($_REQUEST['TimeCompleted'])) { $db->setTimeCompleted($db->myreal_escape_string($_REQUEST['TimeCompleted']) ); } 

		 	
	if(isset($_REQUEST['SortOrder'])) { $db->setSortOrder($db->myreal_escape_string($_REQUEST['SortOrder']) ); } 

		 	
	if(isset($_REQUEST['GroupID'])) { $db->setGroupID($db->myreal_escape_string($_REQUEST['GroupID']) ); } 

		 	
	if(isset($_REQUEST['ShareWithGroup'])) { $db->setShareWithGroup($db->myreal_escape_string($_REQUEST['ShareWithGroup']) ); } 

		 	

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
	