<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../config.php';

# init vars
$out = array();

foreach($extras as $ex) {
	if ($ex->OwnerID==$_REQUEST['driverid']) {
		$out[] = array(
					'ID'			=> $ex->ID, 
					'ServiceEN' 	=> $ex->ServiceEN,
					'DriverPrice' 	=> $ex->DriverPrice,
					'Price' 	=> $ex->Price
		);	
	}	
}

# send output back
$output = json_encode($out);

unset($out);
//print_r($output);
echo $_REQUEST['callback'] . '(' . $output . ')';


