<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../config.php';

# init libs
require_once ROOT . '/db/v4_VehicleTypes.class.php';

# init vars
$out = array();

# init class
$db = new v4_VehicleTypes();

$dbKeys = $db->getKeysBy('VehicleTypeID', 'asc');

foreach($dbKeys as $n => $ID) {
	$db->getRow($ID);
		$out[] = array(
					'VehicleTypeID'		=> $db->getVehicleTypeID(), 
					'VehicleTypeNameEN' => $db->getVehicleTypeNameEN()
		);
	
}

# send output back
$output = json_encode($out);

unset($out);
//print_r($output);
echo $_REQUEST['callback'] . '(' . $output . ')';
