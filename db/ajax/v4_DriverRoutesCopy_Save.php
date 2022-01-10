<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_DriverRoutesCopy.class.php';


	# init class
	$db = new v4_DriverRoutesCopy();

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

		 	
	if(isset($_REQUEST['SiteID'])) { $db->setSiteID($db->myreal_escape_string($_REQUEST['SiteID']) ); } 

		 	
	if(isset($_REQUEST['OwnerID'])) { $db->setOwnerID($db->myreal_escape_string($_REQUEST['OwnerID']) ); } 

		 	
	if(isset($_REQUEST['RouteID'])) { $db->setRouteID($db->myreal_escape_string($_REQUEST['RouteID']) ); } 

		 	
	if(isset($_REQUEST['Active'])) { $db->setActive($db->myreal_escape_string($_REQUEST['Active']) ); } 

		 	
	if(isset($_REQUEST['Approved'])) { $db->setApproved($db->myreal_escape_string($_REQUEST['Approved']) ); } 

		 	
	if(isset($_REQUEST['RouteName'])) { $db->setRouteName($db->myreal_escape_string($_REQUEST['RouteName']) ); } 

		 	
	if(isset($_REQUEST['OneToTwo'])) { $db->setOneToTwo($db->myreal_escape_string($_REQUEST['OneToTwo']) ); } 

		 	
	if(isset($_REQUEST['TwoToOne'])) { $db->setTwoToOne($db->myreal_escape_string($_REQUEST['TwoToOne']) ); } 

		 	
	if(isset($_REQUEST['SurCategory'])) { $db->setSurCategory($db->myreal_escape_string($_REQUEST['SurCategory']) ); } 

		 	
	if(isset($_REQUEST['SurID'])) { $db->setSurID($db->myreal_escape_string($_REQUEST['SurID']) ); } 

		 	

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
	