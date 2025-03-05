<?
@session_start();

require_once "../../config.php";
require_once ROOT.'/db/v4_AuthUsers.class.php';
require_once ROOT.'/db/v4_OrderDetails.class.php';
require_once ROOT.'/db/v4_OrdersMaster.class.php';
require_once ROOT.'/db/v4_OrderLog.class.php';

// ukljuci mail funkcije
//require_once 'informFuncs.php';

# init class
$au = new v4_AuthUsers();
$od = new v4_OrderDetails();
$om = new v4_OrdersMaster();
$ol = new v4_OrderLog();
$where=" WHERE DetailsID=".$_REQUEST["id"];
$olk=$ol->getKeysBy("ID ASC","",$where);
$logs=array();
foreach ($olk as $key) {
	$ol->getRow($key);
	$logs[]=$ol->fieldValues();
}
$smarty->assign("logs",$logs);
ob_start();
$smarty->display("orderLogs.tpl");
$out = ob_get_contents();
ob_end_clean();

echo $out;

