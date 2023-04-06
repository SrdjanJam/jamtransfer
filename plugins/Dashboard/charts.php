<?
error_reporting(E_ALL);
/*
# TransferStatus
$StatusDescription = array(
    '1' =>    'New',
    '2' =>    'Confirmed',
    '3' =>    'Canceled',
    '4' =>    'Refunded',
    '5' =>    'No-Show',
    '6' =>    'DriverError',
    '7' =>    'Completed',
    '8' =>    'Comm.Paid'
);
*/
	require_once 'config.php';
	require_once ROOT . '/db/v4_OrderDetails.class.php';

    $od = new v4_OrderDetails();

    $where = ' WHERE PickupDate >= "'.date("Y-m-d").'" AND TransferStatus < "3"';
    $k = $od->getKeysBy('DetailsID', 'asc', $where);
// filling data for charts

$data1 = "data1";
$data2 = "50";

$smarty->assign("data1",$data1);
$smarty->assign("data2",$data2);

