<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

$levels = "";
$out = array();
# Details  red
$db->getRow($_REQUEST['ItemID']);
# get fields and values
$detailFlds = $db->fieldValues();
# remove slashes 
foreach ($detailFlds as $key=>$value) {
	$detailFlds[$key] = stripslashes($value);
}

$result = $dbT->RunQuery("SELECT * FROM v4_ModulesLevel WHERE ModulID=".$_REQUEST['ItemID']);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$levels.=$row['AuthLevelID'].",";
	}
	$levels = substr($levels,0,strlen($levels)-1);
	$detailFlds['Levels']=$levels;
$out[] = $detailFlds;
# send output back
$output = json_encode($out);
echo $output;