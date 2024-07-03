<?
# init libs
require_once '../../config.php';
require_once ROOT .'/db/v4_OrderDetails.class.php';
require_once ROOT .'/db/v4_OrderLog.class.php';


$DetailsID = $_REQUEST['DetailsID'];
$NewStatus = $_REQUEST['NewStatus'];
$FinalNote = $_REQUEST['FinalNote'];

$od = new v4_OrderDetails();

$od->getRow($DetailsID);
// za log
$OrderID = $od->getOrderID();
$TNo = $od->getTNo();
// transfer status 9 = izbrisan - deleted
$od->setTransferStatus('5');
// spremanje u Log
$ol = new v4_OrderLog();

#	var driverConfStatus = {};
#	driverConfStatus[0] = 'No driver';
#	driverConfStatus[1] = 'Not Confirmed';
#	driverConfStatus[2] = 'Confirmed';
#	driverConfStatus[3] = 'Ready';
#	driverConfStatus[4] = 'Declined';
#	driverConfStatus[5] = 'No-show';
#	driverConfStatus[6] = 'Driver error';
#	driverConfStatus[7] = 'Completed';
#	driverConfStatus[8] = 'Operator error';
#	driverConfStatus[9] = 'Dispatcher error';

if($NewStatus == 7) {
	# init vars
	$icon = 'fa fa-minus-square bg-blue';
	$logDescription = 'Order status is now COMPLETED<br>'.$FinalNote;
	$logAction = 'Completed';
	$logTitle = 'Completed reported by ' . $_SESSION['UserName'];
	$showToCustomer = 0;
	
}if($NewStatus == 5) {
	# init vars
	$icon = 'fa fa-minus-square bg-red';
	$logDescription = 'Order status is now NO SHOW<br>'.$FinalNote;
	$logAction = 'NoShow';
	$logTitle = 'No-Show reported by ' . $_SESSION['UserName'];
	$showToCustomer = 0;
}

if($NewStatus == 6) {
	# init vars
	$icon = 'fa fa-taxi bg-red';
	$logDescription = 'Order status is now Driver Error<br>'.$FinalNote;
	$logAction = 'DriverError';
	$logTitle = 'Driver Error reported by ' . $_SESSION['UserName'];
	$showToCustomer = 0;
}

if($NewStatus == 8) {
	# init vars 
	$icon = 'fa fa-tasks bg-red';
	$logDescription = 'Order status is now Operator Error<br>'.$FinalNote;
	$logAction = 'OperatorError';
	$logTitle = 'Operator Error reported by ' . $_SESSION['UserName'];
	$showToCustomer = 0;
}

if($NewStatus == 9) {
	# init vars
	$icon = 'fa fa-road bg-red';
	$logDescription = 'Order status is now Dispatcher Error<br>'.$FinalNote;
	$logAction = 'DispatcherError';
	$logTitle = 'Dispatcher Error reported by ' . $_SESSION['UserName'];
	$showToCustomer = 0;
}

if($NewStatus == 10) {
	# init vars
	$icon = 'fa fa-road bg-red';
	$logDescription = 'Order status is now Agent Error<br>'.$FinalNote;
	$logAction = 'AgentError';
	$logTitle = 'Agent Error reported by ' . $_SESSION['UserName'];
	$showToCustomer = 0;
}

if($NewStatus == 11) {
	# init vars
	$icon = 'fa fa-road bg-red';
	$logDescription = 'Order status is now Force majeure<br>'.$FinalNote;
	$logAction = 'Force majeure';
	$logTitle = 'Force majeure reported by ' . $_SESSION['UserName'];
	$showToCustomer = 0;
}

if($NewStatus == 12) {
	# init vars
	$icon = 'fa fa-road bg-red';
	$logDescription = 'Order status is now Pending<br>'.$FinalNote;
	$logAction = 'Pending';
	$logTitle = 'Pending reported by ' . $_SESSION['UserName'];
	$showToCustomer = 0;
}
$od->setDriverConfStatus($NewStatus);
$od->setFinalNote($FinalNote);
$od->saveRow();

$ol->setOrderID($OrderID);
$ol->setDetailsID($DetailsID);
$ol->setAction($logAction);
$ol->setTitle($logTitle);
$ol->setDescription($logDescription);
$ol->setDateAdded(date("Y-m-d"));
$ol->setTimeAdded(date("H:i:s"));
$ol->setUserID($_SESSION['AuthUserID']);
$ol->setIcon($icon);
$ol->setShowToCustomer($showToCustomer);
$ol->saveAsNew();


