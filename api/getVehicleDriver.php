<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../config.php';

# init libs
require_once ROOT . '/db/v4_SubVehicles.class.php';
require_once ROOT . '/db/v4_SubDrivers.class.php';
# init vars
$out = array();

# init class
$db = new v4_SubVehicles();
$sd = new v4_SubDrivers();
$where= " WHERE 1=1 ";
if (isset($_SESSION["UseDriverID"]) || isset($_SESSION["DriverID"])) {
	if (isset($_SESSION["UseDriverID"])) $where=" WHERE OwnerID=".$_SESSION["UseDriverID"];
	if (isset($_SESSION["DriverID"])) $where=" WHERE OwnerID=".$_SESSION["DriverID"];
	$dbKeys = $db->getKeysBy('VehicleID', 'asc', $where);
	foreach($dbKeys as $n => $ID) {
		$db->getRow($ID);
			$vd=$db->getVehicleDescription()."/".$users[$db->getAssignSDID()]->AuthUserRealName;
			$out[] = array(
						'VehicleID'		=> $db->getVehicleID(), 
						'VehicleDescription' => $vd
			);
		
	}
}
# send output back
$output = json_encode($out);

unset($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
