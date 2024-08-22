<?php
/*
	AJAX Script !!!!
*/
require_once "../../config.php";
if ($_REQUEST["level_id"]==1 || isset($_SESSION['UseDriverID'])) {
	if ($_REQUEST["level_id"]==1) $levels=array(41,43,44,91,92,99);
	if (isset($_SESSION['UseDriverID'])) $levels=array(32);
	$levelsT=implode(",", $levels);
	$where=" WHERE `AuthLevelID` in (".$levelsT.") AND Active=1";
	if (isset($_SESSION['UseDriverID'])) $where.=" AND DriverID=".$_SESSION['UseDriverID'];
	require_once ROOT . '/db/v4_AuthUsers.class.php';
	require_once ROOT . '/db/v4_AuthLevels.class.php';
	$au = new v4_AuthUsers();
	$al = new v4_AuthLevels();
	$alk=$al->getKeysBy('AuthLevelID','','');
	foreach ($alk as $nn => $key) {
		$al->getRow($key);
		$levelName[$key]=$al->getAuthLevelName();
	}
	$auk=$au->getKeysBy('AuthUserRealName ASC','',$where);
	$office_users=array();
	if (count($auk) != 0) {
		foreach ($auk as $nn => $key)
		{
			$row=array();
			$row['id']=$key;
			$row['name']=$users[$key]->AuthUserRealName;
			$row['level']=$levelName[$users[$key]->AuthLevelID];
			$office_users[]=$row;
		}
	}
	require_once ROOT . '/db/v4_OfficeShift.class.php';
	$os = new v4_OfficeShift();
	require_once ROOT . '/db/v4_OfficeHours.class.php';
	$oh=new v4_OfficeHours();	
	$osk=$os->getKeysBy('ShiftName','','');
	$office_shifts=array();
	if (count($osk) != 0) {
		foreach ($osk as $nn => $key)
		{	
			$os->getRow($key);
			$row=array();
			$row['id']=$key;
			$row['name']=$os->getShiftName();
			$row['begin']=substr($os->getBegin(),0,5);
			$row['end']=substr($os->getEnd(),0,5);
			$office_shifts[]=$row;
		}
	}	
}	
if ($_REQUEST["level_id"]==2) $levels=array(31);
if ($_REQUEST["level_id"]==3) $levels=array(2);
if (isset($_SESSION['UseDriverID'])) $levels=array(32);

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
	if (in_array($users[$row['AuthUserID']]->AuthLevelID, $levels)) $lg_arr[]=$row;
}
$rec=$lg_arr;
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
for ($i=0; $i<($maxday+$startday); $i++) {
		$fullDate = date("Y-m-d",mktime(0,0,0,$cMonth,($i - $startday + 1),$cYear));
		$month_logs[]=monthLogs($fullDate,$rec,$i,$startday,$users,$office_users,$oh);
}	
$smarty->assign('office_users',$office_users);
$smarty->assign('office_shifts',$office_shifts);
$smarty->assign('date',$fullDate);
$smarty->assign('month_logs',$month_logs);
$smarty->assign('startday',$startday);
$smarty->display('monthlogs.tpl');		

function monthLogs($date,$rec,$count,$startday,$users,$office_users,$oh)
{
	global $StatusDescription;
	global $DriverConfStatus;
	global $db;

	$data = '';
	$noOfLogs = 0;
	$arr = array();

	// uzimanje smena
	if ($_REQUEST["level_id"]==1 || isset($_SESSION['UseDriverID'])) {
		$where = " WHERE WorkDate='".$date."' ";
		$ohk=$oh->getKeysBy('ID','',$where);
		if (count($ohk)>0) {
			foreach ($ohk as $key) {
				$oh->getRow($key);
				$begin_arr[$oh->getUserID()]=substr($oh->getBegin(),0,5);
				$end_arr[$oh->getUserID()]=substr($oh->getEnd(),0,5);
			}		
		}	
	}	

	foreach ($rec as $row) {		
		if (DateofDT($row['DateTime'])==$date && $row['Type']==1) {
			if ((isset($_SESSION['UseDriverID']) && $users[$row['AuthUserID']]->DriverID==$_SESSION['UseDriverID']) ||
			(!isset($_SESSION['UseDriverID']) && $users[$row['AuthUserID']]->DriverID==0)) {	
				$noOfLogs += 1;
				$row['Time']=TimeofDT($row['DateTime']);
				if (isLate($row['AuthUserID'],$row['Time'],$begin_arr)) $row['TimeColor']="text-danger";
				else $row['TimeColor']="";
				$row['User']=$users[$row['AuthUserID']]->AuthUserRealName;
				$row['TimeOff']="";
				foreach ($rec as $row2) { 
					if (DateofDT($row2['DateTime'])==$date && in_array($row2['Type'],array(2)) && $row2['AuthUserID']==$row['AuthUserID']) {
						$row['TimeOff']=TimeofDT($row2['DateTime']);
						if (isOnTime($row['AuthUserID'],$row['TimeOff'],$end_arr)) $row['TimeOffColor']="text-danger";
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
	$cdate=substr($cdate[1],0,5);
	return $cdate;
}	

function IsLate($id,$time,$begin_arr) {
	if ($time>$begin_arr[$id]) return true;
	else return false;
}
function IsOnTime($id,$time,$end_arr) {
	if ($time<$end_arr[$id]) return true;
	else return false;
}