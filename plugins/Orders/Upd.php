<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

@session_start();

# sastavi filter - posalji ga $_REQUEST-om
$dbk = $od->getFullOrderByDetailsID("OrderID", "", ""  , " WHERE OrderDate=''");
if (count($dbk) != 0) {
    foreach ($dbk as $nn => $key)
    {
    	$od->getRow($key);    	
    	
		# OrderID za OrdersMaster
		$OrderID = $od->getOrderID();

		# master key
		$omk = $om->getKeysBy('MOrderID', 'asc' , ' WHERE MOrderID = ' . $OrderID);

		# master row
		$om->getRow($omk[0]);
		$od->setOrderDate($om->getMOrderDate());
		$od->saveRow();

		
    }
}
