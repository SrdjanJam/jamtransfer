<?
@session_start();

require_once "../../config.php";

# init class
$dT = "SELECT `DriverID` FROM `v4_DriverTerminals`WHERE TerminalID=".$_REQUEST['tid'] ;
$T = $db->RunQuery($dT);
$terminals=array();
while ($t = $T->fetch_object()) {
	$terminals[]=$t;
}
echo json_encode($terminals);

