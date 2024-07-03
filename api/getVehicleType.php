<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../config.php';

# init libs
require_once ROOT . '/db/v4_VehicleTypes.class.php';
require_once ROOT . '/db/v4_Vehicles.class.php';
# init vars
$out = array();

# init class
$db = new v4_VehicleTypes();
$vh = new v4_Vehicles();
$where= " WHERE 1=1 ";
if (isset($_SESSION["UseDriverID"])) {
	$where2=" WHERE OwnerID=".$_SESSION["UseDriverID"];
	$vhKeys = $vh->getKeysBy('VehicleID', 'asc', $where2);
	$vht=array();
	foreach ($vhKeys as $vhk) {
		$vh->getRow($vhk);
		$vht[]=$vh->getVehicleTypeID();
	}	
	$where.= " AND VehicleTypeID in (".implode(',', $vht).")";
}	
$dbKeys = $db->getKeysBy('VehicleTypeID', 'asc', $where);
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
