<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../config.php';

# init libs
require_once ROOT . '/db/v4_ExtrasMaster.class.php';
require_once ROOT . '/db/v4_Extras.class.php';

# init vars
$out = array();

# init class
$db = new v4_ExtrasMaster();
$ex = new v4_Extras();

//$dbKeys = $db->getKeysBy('ServiceEN', 'asc');
$dbKeys = $db->getKeysBy('DisplayOrder', 'asc', ' WHERE DisplayOrder>0 ' );

foreach($dbKeys as $n => $ID) {
	$db->getRow($ID);
		$where=" WHERE OwnerID=".$_REQUEST['driverid']." AND ServiceID=".$db->getID();
		$exKeys = $ex->getKeysBy('ID', 'asc', $where);
		if (count($exKeys)>0) {
			$ex->getRow($exKeys[0]);
			$out[] = array(
						'ID'			=> $ex->getID(), 
						'ServiceEN' 	=> $db->getServiceEN(),
						'DriverPrice' 	=> $ex->getDriverPrice(),
						'Price' 	=> $ex->getPrice()
			);	
		}	
}

# send output back
$output = json_encode($out);

unset($out);
//print_r($output);
echo $_REQUEST['callback'] . '(' . $output . ')';


