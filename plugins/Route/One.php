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
$detailFlds["TopRoute"]=0;
$result = $dbT->RunQuery("SELECT * FROM v4_TopRoutes WHERE TopRouteID=".$_REQUEST['ItemID']);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$detailFlds["TopRoute"]=1;
	}	
$detailFlds["TerminalID"]=0;	
$result2 = $dbT->RunQuery("SELECT TerminalID from v4_RoutesTerminals WHERE RouteID=".$_REQUEST['ItemID']);
	while($row = $result2->fetch_array(MYSQLI_ASSOC)){
		$detailFlds["TerminalID"]=$row["TerminalID"];
	}	
$out[] = $detailFlds;
# send output back
$output = json_encode($out);
echo $output;