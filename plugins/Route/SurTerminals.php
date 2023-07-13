<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
require_once ROOT . '/db/v4_Places.class.php';
$pl = new v4_Places();
	
// uzimanja geolokacija za sve terminale
$result=$dbT->RunQuery("SELECT TerminalID,Longitude,Latitude FROM `v4_Terminals`,v4_Places WHERE `TerminalID`=PlaceID");
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	if ($row['Longitude']>0 && $row['Latitude']>0)
	$arr_row=array();
	$arr_row['TerminalID']=$row['TerminalID'];
	$arr_row['Longitude']=$row['Longitude'];
	$arr_row['Latitude']=$row['Latitude'];
	$terminals[]=$arr_row;
}	
$fID=$_REQUEST['fID'];
$pl->getRow($fID);
$fLon=$pl->getLongitude();
$fLat=$pl->getLatitude();
$tID=$_REQUEST['tID'];
$pl->getRow($tID);
$tLon=$pl->getLongitude();
$tLat=$pl->getLatitude();

// selektovanje i belezenje najblizeg terminala lokacijama iz rute ako su do 500km
if ($fLon<>0 && $fLat<>0 && $tLon<>0 && $tLat<>0) {
	$distanceMin=200000;
	$terminalID=array();			
	foreach($terminals as $t) {
		$terLon=$t['Longitude'];
		$terLat=$t['Latitude'];
		$distanceF=vincentyGreatCircleDistance($fLat,$fLon,$terLat,$terLon,'6371000');
		$distanceT=vincentyGreatCircleDistance($tLat,$tLon,$terLat,$terLon,'6371000');
		if ($distanceF<$distanceMin) $terminalID[]=$t['TerminalID'];
		if ($distanceT<$distanceMin) $terminalID[]=$t['TerminalID'];
	}
}		
# send output back
$output = json_encode($terminalID);
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