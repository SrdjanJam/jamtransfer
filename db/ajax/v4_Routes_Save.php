<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_Routes.class.php';


	# init class
	$db = new v4_Routes();

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

		 	
	if(isset($_REQUEST['RouteID'])) { $db->setRouteID($db->myreal_escape_string($_REQUEST['RouteID']) ); } 

		 	
	if(isset($_REQUEST['FromID'])) { $db->setFromID($db->myreal_escape_string($_REQUEST['FromID']) ); } 

		 	
	if(isset($_REQUEST['ToID'])) { $db->setToID($db->myreal_escape_string($_REQUEST['ToID']) ); } 

		 	
	if(isset($_REQUEST['Approved'])) { $db->setApproved($db->myreal_escape_string($_REQUEST['Approved']) ); } 

		 	
	if(isset($_REQUEST['RouteName'])) { $db->setRouteName($db->myreal_escape_string($_REQUEST['RouteName']) ); } 

		 	
	if(isset($_REQUEST['RouteNameEN'])) { $db->setRouteNameEN($db->myreal_escape_string($_REQUEST['RouteNameEN']) ); } 

		 	
	if(isset($_REQUEST['RouteNameRU'])) { $db->setRouteNameRU($db->myreal_escape_string($_REQUEST['RouteNameRU']) ); } 

		 	
	if(isset($_REQUEST['RouteNameFR'])) { $db->setRouteNameFR($db->myreal_escape_string($_REQUEST['RouteNameFR']) ); } 

		 	
	if(isset($_REQUEST['RouteNameDE'])) { $db->setRouteNameDE($db->myreal_escape_string($_REQUEST['RouteNameDE']) ); } 

		 	
	if(isset($_REQUEST['RouteNameIT'])) { $db->setRouteNameIT($db->myreal_escape_string($_REQUEST['RouteNameIT']) ); } 

		 	
	if(isset($_REQUEST['Km'])) { $db->setKm($db->myreal_escape_string($_REQUEST['Km']) ); } 

		 	
	if(isset($_REQUEST['Duration'])) { $db->setDuration($db->myreal_escape_string($_REQUEST['Duration']) ); } 

		 	

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
	