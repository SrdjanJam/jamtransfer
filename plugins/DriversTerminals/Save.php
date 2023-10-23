<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
$terminalID=$_REQUEST['PlaceID'];
if ($_REQUEST['Terminal']==1) {
	$result = $dbT->RunQuery("INSERT IGNORE INTO `v4_DriverTerminals`(`DriverID`,`TerminalID`) VALUES (".$_SESSION['UseDriverID'].",".$terminalID.")");
	// unos top ruta
	$result2 = $dbT->RunQuery("SELECT `RouteID` FROM `v4_RoutesTerminals` WHERE `TerminalID`=".$terminalID." and `RouteID` in (SELECT TopRouteID from v4_TopRoutes)");
	while($row2 = $result2->fetch_array(MYSQLI_ASSOC)){
		$result3 = $dbT->RunQuery("SELECT count(*) as count from `v4_DriverRoutes` WHERE `RouteID`=".$row2['RouteID']." AND `OwnerID`=".$_SESSION['UseDriverID']."");
		$row3 = $result3->fetch_array(MYSQLI_ASSOC);
		if ($row3['count']==0) {
			$result4 = $dbT->RunQuery("INSERT INTO `v4_DriverRoutes`(`OwnerID`, `RouteID`, `Active`, `Approved`, `OneToTwo`, `TwoToOne`, `SurCategory`) VALUES (".$_SESSION['UseDriverID'].",".$row2['RouteID'].",'1','1','1','1','1')");
			$_REQUEST['RouteID']=$row2['RouteID'];
			require ("../DriverRoutes/InsertServices.php");
		}
	}	
}	
else $result = $dbT->RunQuery("DELETE FROM `v4_DriverTerminals` WHERE `TerminalID`=".$terminalID." AND `DriverID`=".$_SESSION['UseDriverID']);	
