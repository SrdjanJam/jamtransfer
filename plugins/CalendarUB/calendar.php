<?php
/*
	AJAX Script !!!!
*/
require_once "../../config.php";

if (!isset($_REQUEST["cal_month"])) {
    if (!isset($_SESSION["cal_month"])) $cMonth = date("m");
    else $cMonth = $_SESSION["cal_month"]; 
}
else {
    $_SESSION['cal_month'] = $_REQUEST["cal_month"];
    $cMonth = $_REQUEST["cal_month"];
}
if (!isset($_REQUEST["cal_year"])) {
    if (!isset($_SESSION["cal_year"])) $cYear = date("Y");
    else $cYear = $_SESSION["cal_year"];
}
else {
    $_SESSION['cal_year'] = $_REQUEST["cal_year"];
    $cYear = $_REQUEST["cal_year"];
}
$prev_year = $cYear;
$next_year = $cYear;
$prev_month = $cMonth-1;
$next_month = $cMonth+1;
if ($prev_month == 0 ) {
	$prev_month = 12;
	$prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
	$next_month = 1;
	$next_year = $cYear + 1;
}
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
$dayin="";
for ($i=0; $i<($maxday+$startday); $i++) {
	$fullDate = date("Y-m-d",mktime(0,0,0,$cMonth,($i - $startday + 1),$cYear));
	$dayin .= "'".$fullDate. "'," ;
}	
$dayin = substr($dayin,0,strlen($dayin)-1);
if ($_REQUEST["all"]==1) $filter_users="";
else $filter_users="((AgentID=53 and CustomerID>0) or (AgentID<>53)) and ";
//$active = "SELECT MOrderDate,MOrderTime,PickupDate,PickupTime,PickupName,DropName,PaxNo FROM `v4_OrderDetailsTemp`,`v4_OrdersMasterTemp` WHERE `TransferStatus`=6 and TNo=1 and `OrderDate` in (".$dayin.") and OrderID=MOrderID	";		
$active = "SELECT `OrderDate`,`AgentID`,`CustomerID`,`PickupName`,`DropName`,`PickupDate`,`PickupTime` FROM `v4_OrderDetailsTemp` WHERE ".$filter_users." `UserID`>0 and `OrderID` in (SELECT MOrderID FROM `v4_OrdersMasterTemp` WHERE  `MUserLevelID` in (2,3) and `MUserID`>0 and `MOrderKey` not in (SELECT `MCardNumber` FROM `v4_OrdersMaster` WHERE `MCardNumber`>0))";
$rec = $db->RunQuery($active) ;
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
require_once ROOT . '/db/v4_Customers.class.php';
$cu = new v4_Customers();
for ($i=0; $i<($maxday+$startday); $i++) {
		$fullDate = date("Y-m-d",mktime(0,0,0,$cMonth,($i - $startday + 1),$cYear));
		$month_transfers[]=monthTransfers($fullDate,$rec,$i,$startday,$users,$cu);
}	
$smarty->assign('month_transfers',$month_transfers);
$smarty->assign('startday',$startday);
$smarty->display('monthtransfers.tpl');		

function monthTransfers($date,$rec,$count,$startday,$users,$cu)
{
	global $StatusDescription;
	global $DriverConfStatus;

	$data = '';
	$noOfTransfers = 0;
	$arr = array();
	foreach ($rec as $row) { 
		if ($row['OrderDate']==$date) {
			if ($row['AgentID']<>53) {
				$row['AgentName']=$users[$row['AgentID']]->AuthUserRealName;
				$row['AgentID']=$row['AgentID'];
			}	
			if ($row['CustomerID']>0) {
				$cu->getRow($row['CustomerID']);
				$row['CustomerName']=$cu->getCustFirstName()." ".$cu->getCustLastName();
				$row['CustomerID']=$cu->getCustID();
			}	
			$noOfTransfers += 1;
			$arr[]= $row;
		}
	}
	$dayofweek=($count % 7);
	if($count < $startday) $dayofweek=-1;
	$dayTransfers['nom']=$count - $startday + 1;
	$dayTransfers['dayofweek']=$dayofweek;
	$dayTransfers['date']=$date;
	$dayTransfers['transfers']=$arr;
	$dayTransfers['noOfTransfers']=$noOfTransfers;
    return $dayTransfers;
}
