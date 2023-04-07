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
	require_once ROOT . '/db/db.class.php';
	
	$db = new DataBaseMysql();
	$q = "SELECT v4_AuthLevels.AuthLevelName as level,count(*) as value FROM `v4_OrderDetails`,v4_AuthLevels where `TransferStatus` <9 and  v4_AuthLevels.AuthLevelID=`UserLevelID` group by `UserLevelID`";
	$r = $db->RunQuery($q);
	$levels="[";
	$values="[";
	while ($t = $r->fetch_object()) {
		$levels.="'".$t->level."'";
		$levels.=",";		
		$values.="'".$t->value."'";
		$values.=",";		
	}
	$levels.="]";
	$values.="]";

	$smarty->assign("levels",$levels);
	$smarty->assign("values",$values);
// filling data for charts

