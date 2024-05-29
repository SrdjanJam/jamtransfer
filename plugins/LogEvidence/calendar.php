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

$active = "SELECT * FROM ".DB_PREFIX."LogUser
			WHERE DATE(DateTime) IN (".$dayin.") ";
$active .=	"ORDER BY DateTime DESC";
$rec = $db->RunQuery($active) ;
$lg_arr=array();
while ($row = $rec->fetch_assoc() ) {
	if ($users[$row['AuthUserID']]->AuthLevelID==$_REQUEST["level_id"]) $lg_arr[]=$row;
}
$rec=$lg_arr;
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
for ($i=0; $i<($maxday+$startday); $i++) {
		$fullDate = date("Y-m-d",mktime(0,0,0,$cMonth,($i - $startday + 1),$cYear));
		$month_logs[]=monthLogs($fullDate,$rec,$i,$startday,$users);
}	
$smarty->assign('month_logs',$month_logs);
$smarty->assign('startday',$startday);
$smarty->display('monthlogs.tpl');		

function monthLogs($date,$rec,$count,$startday,$users)
{
	global $StatusDescription;
	global $DriverConfStatus;
	global $db;

	$data = '';
	$noOfLogs = 0;
	$arr = array();

	foreach ($rec as $row) { 
		if (DateofDT($row['DateTime'])==$date && $row['Type']==1) {
			if ((isset($_SESSION['UseDriverID']) && $users[$row['AuthUserID']]->DriverID==$_SESSION['UseDriverID']) ||
			(!isset($_SESSION['UseDriverID']) && $users[$row['AuthUserID']]->DriverID==0)) {	
				$noOfLogs += 1;
				$row['Time']=TimeofDT($row['DateTime']);
				$row['User']=$users[$row['AuthUserID']]->AuthUserRealName;
				$row['TimeOff']="";
				foreach ($rec as $row2) { 
					if (DateofDT($row2['DateTime'])==$date && in_array($row2['Type'],array(2,4)) && $row2['AuthUserID']==$row['AuthUserID']) {
						$row['TimeOff']="-".TimeofDT($row2['DateTime']);
					}
				}
				$arr[]= $row;
			}
		}
	}
	
	$dayofweek=($count % 7);
	if($count < $startday) $dayofweek=-1;
	$dayLogs['nom']=$count - $startday + 1;
	$dayLogs['dayofweek']=$dayofweek;
	$dayLogs['date']=$date;
	$dayLogs['logs']=$arr;
	$dayLogs['noOfLogs']=$noOfLogs;
    return $dayLogs;
}

function DateofDT($datetime) {
	$cdate=explode(" ",$datetime);
	$cdate=$cdate[0];
	return $cdate;
}
function TimeofDT($datetime) {
	$cdate=explode(" ",$datetime);
	$cdate=$cdate[1];
	return $cdate;
}	