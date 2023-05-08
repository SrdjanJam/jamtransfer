<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
require_once ROOT . '/db/v4_Places.class.php';
$pl = new v4_Places();
	
$keyValue = $_REQUEST['id'];
$topRouteID=$_REQUEST['id'];

$fldList = array();
$out = array();
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);
foreach ($db->fieldNames() as $name) {
	$content=$db->myreal_escape_string($_REQUEST[$name]);
	if(isset($_REQUEST[$name])) {
		eval("\$db->set".$name."(\$content);");	
	}	
}	
$upd = '';
$newID = '';
if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}
if ($keyName != '' and $keyValue == '') {
	$newID = $db->saveAsNew();
	$topRouteID=$newID;
}
$out = array(
	'update' => $upd,
	'insert' => $newID
);
	
if ($_REQUEST['TopRoute']==1) $result = $dbT->RunQuery("INSERT IGNORE INTO `v4_TopRoutes`(`TopRouteID`) VALUES (".$topRouteID.")");
else $result = $dbT->RunQuery("DELETE FROM `v4_TopRoutes` WHERE `TopRouteID`=".$topRouteID);

if ($keyName != '' and $keyValue != '') $result = $dbT->RunQuery("DELETE FROM `v4_RoutesTerminals` WHERE `RouteID`=".$keyValue);
// varijanta iz select box-a
$terminalID=$_REQUEST['TerminalID'];
/*$result2 = $dbT->RunQuery("SELECT count(*) as count from v4_Terminals WHERE TerminalID=".$_REQUEST['FromID']);
$row2 = $result2->fetch_array(MYSQLI_ASSOC);
if ($row2['count']>0) $terminalID=$_REQUEST['FromID'];
else {

	$result3 = $dbT->RunQuery("SELECT count(*) TerminalID from v4_Terminals WHERE ".$_REQUEST['ToID']."=TerminalID");
	$row3 = $result3->fetch_array(MYSQLI_ASSOC);
	if ($row3['count']>0) $terminalID=$_REQUEST['ToID'];
	else {
			// uzimanja geolokacija za sve terminale
		$result4=$dbT->RunQuery("SELECT TerminalID,Longitude,Latitude FROM `v4_Terminals`,v4_Places WHERE `TerminalID`=PlaceID");
		while($row = $result4->fetch_array(MYSQLI_ASSOC)){
			if ($row['Longitude']>0 && $row['Latitude']>0)
			$arr_row=array();
			$arr_row['TerminalID']=$row['TerminalID'];
			$arr_row['Longitude']=$row['Longitude'];
			$arr_row['Latitude']=$row['Latitude'];
			$terminals[]=$arr_row;
		}	
		$fID=$db->getFromID();
		$pl->getRow($fID);
		$fLon=$pl->getLongitude();
		$fLat=$pl->getLatitude();
		$tID=$db->getToID();
		$pl->getRow($tID);
		$tLon=$pl->getLongitude();
		$tLat=$pl->getLatitude();
		// selektovanje i belezenje najblizeg terminala lokacijama iz rute ako su do 500km
		if ($fLon>0 && $fLat>0 && $tLon>0 && $tLat>0) {
			$distanceMin=500000;
			$terminalID=0;			
			foreach($terminals as $t) {
				$terLon=$t['Longitude'];
				$terLat=$t['Latitude'];
				$distanceF=vincentyGreatCircleDistance($fLat,$fLon,$terLat,$terLon,'6371000');
				$distanceT=vincentyGreatCircleDistance($tLat,$tLon,$terLat,$terLon,'6371000');
				if ($distanceF<$distanceMin) {
					$distanceMin=$distanceF;
					$terminalID=$t['TerminalID'];
				}	
				if ($distanceT<$distanceMin) {
					$distanceMin=$distanceT;
					$terminalID=$t['TerminalID'];
				}
			}
		}		
	}
}*/
if ($terminalID>0) {
	$dbT->RunQuery("INSERT INTO `v4_RoutesTerminals`(`RouteID`, `TerminalID`) VALUES (".$topRouteID.",".$terminalID.")");					
}	
# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';

function vincentyGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  return $angle * $earthRadius;
}	