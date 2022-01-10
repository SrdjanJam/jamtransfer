<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
	# init libs
	require_once ROOT . '/db/db.class.php';
	require_once ROOT . '/db/v4_DriverTerminals.class.php';

	# init class
	$db = new v4_DriverTerminals();

# init vars
$PlaceID = '';
$DriverID = '';

if (isset($_REQUEST['PlaceID']) and $_REQUEST['PlaceID'] != '') 	$PlaceID = $_REQUEST['PlaceID'];
if (isset($_REQUEST['DriverID']) and $_REQUEST['DriverID'] != '') 	$DriverID = $_REQUEST['DriverID'];



$fldList = array();
$out = array();

$sameplace=array(); 
$where="where `TerminalID` = ".$PlaceID." AND `DriverID` = '".$DriverID."'";
$sameplace=$db->getKeysBy('TerminalID', 'ASC', $where);

	if (count($sameplace)>0 ) {
		
		$out = array(
			'update' => 'Exist',
			'insert' => ''
		);
	}
	
	else {
		$db->setTerminalID($db->myreal_escape_string($PlaceID) );
		$db->setDriverID($db->myreal_escape_string($DriverID) );
		$newID = $db->saveAsNew();
		$out = array(
			'update' => '',
			'insert' => $newID
		);
	}
	

# send output back
$output = json_encode($out); 
echo $_REQUEST['callback'] . '(' . $output . ')';
	