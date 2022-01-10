<?
header('Content-Type: text/javascript; charset=UTF-8');

# init libs
require_once '../../db/v4_Places.class.php';

# init vars
$out = array();

# init class
$db = new v4_Places();

$dbKeys = $db->getKeysBy('PlaceNameEN', 'asc');

foreach($dbKeys as $n => $ID) {
	$db->getRow($ID);
		$out[] = array(
					'PlaceID'		=> $db->getPlaceID(), 
					'PlaceName' 	=> $db->getPlaceNameEN()
		);
	
}

# send output back
$output = json_encode($out);

unset($out);
//print_r($output);
echo $_REQUEST['callback'] . '(' . $output . ')';


