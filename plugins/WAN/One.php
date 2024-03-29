<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

$out = array();
# Details  red
$db->getRow($_REQUEST['ItemID']);
# get fields and values
$detailFlds = $db->fieldValues();
# remove slashes 
foreach ($detailFlds as $key=>$value) {
	$detailFlds[$key] = stripslashes($value);
}
$datetime=explode(" ",$detailFlds["ScheduleTime"]);
$detailFlds["ScheduleTime1"]=$datetime[0];
$timeReducedArr=explode(":",$datetime[1]);
$timeReduced=$timeReducedArr[0].":".$timeReducedArr[1];
$detailFlds["ScheduleTime2"]=$timeReduced;
$out[] = $detailFlds;
# send output back
$output = json_encode($out);
echo  $output;