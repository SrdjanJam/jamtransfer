<?
# init libs
require_once '../../config.php';
require_once ROOT .'/db/v4_OrderDetails.class.php';
require_once ROOT .'/db/v4_OrderLog.class.php';
require_once ROOT .'/db/v4_SubVehicles.class.php';
$od = new v4_OrderDetails();
$ol = new v4_OrderLog();
$sv = new v4_SubVehicles();

$DetailsID = $_REQUEST['DetailsID'];

$od->getRow($DetailsID);
$od->setCar($_REQUEST['SubDriverID']);
$sv->getRow($_REQUEST['SubDriverID']);
$od->setSubDriver($sv->getAssignSDID());
if ($_REQUEST['SubDriverID']>0) $od->setDriverConfStatus(3);
else $od->setDriverConfStatus(2);

// za log
$OrderID = $od->getOrderID();
$TNo = $od->getTNo();
// spremanje u Log
$icon = 'fa fa-cloud-upload bg-blue';
$logDescription = '';
$logAction = 'Update';
$logTitle = 'Order Updated by ' . $_SESSION['UserName'];
$showToCustomer = 0;

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

$sd_array['username']=$users[$sv->getAssignSDID()]->AuthUserRealName;
$sd_array['phone']=$users[$sv->getAssignSDID()]->AuthUserMob;
echo json_encode($sd_array);	