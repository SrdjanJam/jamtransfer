<?

require_once ROOT . '/a/getBookingData.php';

$T = getBookingData();
if (count($T) > 2) $RT = 1; // return transfer exists

require_once ROOT.'/db/v4_Extras.class.php';
require_once ROOT.'/db/v4_ExtrasMaster.class.php';

$e = new v4_Extras();
$em = new v4_ExtrasMaster();
$k = $e->getKeysBy('Service', 'ASC', ' WHERE OwnerID = ' . $T[0]['DriverID']);

$extras = array();

if( count($k) > 0) {

    foreach($k as $nn => $id) {
	    $e->getRow($id);
		$sid = $e->getServiceID();
		$em->getRow($sid);
		$extras_arr=  $e->fieldValues();
		$extras_arr = array_merge($extras_arr, array("order" => $em->getDisplayOrder()));				
	    $extras[] = $extras_arr;
    }
	usort($extras,function($first,$second){
		return $first['order'] > $second['order'];
	});	
} //else echo 'Extras not found for Driver: '. $T[0]['DriverID'];

#if(isset($_GET['callback'])) {
#	$extras = json_encode($extras);
#	echo $_GET['callback'] . '(' . $extras. ')';
#}	

