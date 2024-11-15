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
	
	if (isset($_SESSION['UseDriverID'])) $driverQ=" WHERE DriverID=".$_SESSION['UseDriverID']." AND ";
	else $driverQ=" WHERE ";

    $where = $driverQ.' PickupDate >= "'.date("Y-m-d").'" AND TransferStatus < "3"';
    $k = $od->getKeysBy('DetailsID', 'asc', $where);
    $smarty->assign('activeOrders', count($k));


    $where = $driverQ.' PickupDate >= "'.date("Y-m-d").'" AND TransferStatus < "3" AND (DriverConfStatus = "2" OR DriverConfStatus = "3")';
    $k = $od->getKeysBy('DetailsID', 'asc', $where);
    $smarty->assign('confirmedOrders', count($k));


    $where = $driverQ.' TransferStatus < "3" AND DriverConfStatus = "1"';
    $k = $od->getKeysBy('DetailsID', 'asc', $where);
    $smarty->assign('notConfirmedOrders', count($k));    
	
	/*$where = $driverQ.' PickupDate = "'.date("Y-m-d").'" AND TransferStatus < "3" AND (DriverConfStatus = "1" OR DriverConfStatus = "4")';
    $k = $od->getKeysBy('DetailsID', 'asc', $where);
    $smarty->assign('notConfirmedOrdersToday',count($k));	
	
	$where = $driverQ.' PickupDate = ("'.date("Y-m-d").'"+INTERVAL 1 DAY) AND TransferStatus < "3" AND (DriverConfStatus = "1" OR DriverConfStatus = "4")';
    $k = $od->getKeysBy('DetailsID', 'asc', $where);
    $smarty->assign('notConfirmedOrdersTomorrow',count($k));*/
	
	$where = $driverQ.' (PickupDate = "'.date("Y-m-d").'" OR  PickupDate = ("'.date("Y-m-d").'"+INTERVAL 1 DAY)) AND TransferStatus < "3" AND (DriverConfStatus = "1" OR DriverConfStatus = "4")';
    $k = $od->getKeysBy('DetailsID', 'asc', $where);
    $smarty->assign('notConfirmedOrdersTodayTomorrow',count($k));		
	
	$where = $driverQ.' PickupDate >"'.date("Y-m-d").'" AND  PickupDate < ("'.date("Y-m-d").'"+INTERVAL 4 DAY) AND TransferStatus < "3" AND DriverConfStatus = "2"';
    $k = $od->getKeysBy('DetailsID', 'asc', $where);
    $smarty->assign('notAssign',count($k));	

    $where = $driverQ.' PickupDate >= "'.date("Y-m-d").'" AND TransferStatus < "3" AND DriverConfStatus = "4"';
    $k = $od->getKeysBy('DetailsID', 'asc', $where);
    $smarty->assign('declined',count($k));

	$today              = strtotime("today 00:00");
	$yesterday          = strtotime("yesterday 00:00");
	$lastWeek = strtotime("yesterday -1 week 00:00");

	$fromDate= date("Y-m-d", time()-3600*24);
	$lastWeek= date("Y-m-d", $lastWeek);

    $where = $driverQ.' OrderDate >= "'. $fromDate.'" AND TransferStatus < "3"';
    $k = $od->getKeysBy('DetailsID', 'asc', $where);
    $smarty->assign('todayBooking',count($k));


    $where = $driverQ.' OrderDate >= "'.$lastWeek.'" AND TransferStatus < "3" AND (DriverConfStatus = "2" OR DriverConfStatus = "3")';
    $k = $od->getKeysBy('DetailsID', 'asc', $where);
    $smarty->assign('lastWeekBooking',count($k));	

    // Tomorrow

	$datetime = new DateTime('tomorrow');
	$tomorrow = $datetime->format('Y-m-d');
    $where = $driverQ.' PickupDate = "'.$tomorrow.'" AND TransferStatus < "3"';
    $k = $od->getKeysBy('DetailsID', 'asc', $where);
    $smarty->assign('tomorrowTransfers', count($k));

	
    $od->endv4_OrderDetails();

