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
	
	$timeBegin=time()-365*24*3600;
	$timeBeginM=date('m',$timeBegin);
	$timeBeginY=date('Y',$timeBegin);
	$timeBeginD=date('d',$timeBegin);
	$timeBeginF="'".$timeBeginY."-".$timeBeginM."-".$timeBeginD."'";
	$q = "SELECT v4_AuthLevels.AuthLevelName as level,count(*) as value FROM `v4_OrderDetails`,v4_AuthLevels 
		WHERE `TransferStatus` <9 and  v4_AuthLevels.AuthLevelID=`UserLevelID` AND OrderDate>=(".$timeBeginF.")
		 GROUP BY `UserLevelID`";
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
	$timeBegin=time()-365*24*3600;
	$timeBeginM=date('m',$timeBegin);
	$timeEndM=date('m',time());
	$timeBeginY=date('Y',$timeBegin);
	$timeEndY=date('Y',time());
	$timeBeginF="'".$timeBeginY."-".$timeBeginM."-01'";
	$timeEndF="'".$timeEndY."-".$timeEndM."-01'";
	$q2 = "SELECT MONTHNAME(`MOrderDate`) as month, YEAR(`MOrderDate`) as year, sum(`MOrderPriceEUR`) as value FROM `v4_OrdersMaster` 
		WHERE `MOrderStatus` not in (3,9) and MOrderDate>=(".$timeBeginF.") and  MOrderDate<(".$timeEndF.")
		GROUP BY MONTH(`MOrderDate`) ORDER BY MOrderDate";
	$r2 = $db->RunQuery($q2);
	$months2="[";
	$values2="[";
	while ($t2 = $r2->fetch_object()) {
		$months2.="'".$t2->month." ".$t2->year."'";
		$months2.=",";		
		$values2.="'".$t2->value."'";
		$values2.=",";		
	}
	$months2.="]";
	$values2.="]";

	$smarty->assign("months2",$months2);
	$smarty->assign("values2",$values2);
// filling data for charts

