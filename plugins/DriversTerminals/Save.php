<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
$terminalID=$_REQUEST['PlaceID'];
if ($_REQUEST['Terminal']==1) $result = $dbT->RunQuery("INSERT IGNORE INTO `v4_DriverTerminals`(`DriverID`,`TerminalID`) VALUES (".$_SESSION['UseDriverID'].",".$terminalID.")");
else $result = $dbT->RunQuery("DELETE FROM `v4_DriverTerminals` WHERE `TerminalID`=".$terminalID." AND `DriverID`=".$_SESSION['UseDriverID']);	
