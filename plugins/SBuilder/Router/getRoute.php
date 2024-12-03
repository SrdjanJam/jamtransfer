<?
@session_start();
require_once '../../../config.php';
$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";

$url="https://api.openrouteservice.org/v2/directions/driving-car?api_key=".$api_key."&start=".$_REQUEST['lng1'].",".$_REQUEST['lat1']."&end=".$_REQUEST['lng2'].",".$_REQUEST['lat2']."&radiuses=-1";
$json = file_get_contents($url);   
$obj="";
$obj = json_decode($json,true);	
$line="[";
if ($json) {
	$midlat=($_REQUEST['lat1']+$_REQUEST['lat2'])/2;
	$midlong=($_REQUEST['lng1']+$_REQUEST['lng2'])/2;
	$distance=number_format($obj['features'][0]['properties']['segments'][0]['distance']/1000,2);
	$duration=number_format($obj['features'][0]['properties']['segments'][0]['duration']/60,0);
	$transfersR['distance']=$distance;
	$transfersR['duration']=$duration;
	$steps=$obj['features'][0]['properties']['segments'][0]['steps'];
	$min=1000000000000000;
	foreach($obj['features'][0]['geometry']['coordinates'] as $coor) {	
		$line.="[";
		$line.=$coor[1];
		$line.=",";
		$line.=$coor[0];
		$line.="]";
		$line.=",";	
		$d=pow(($midlat-$coor[1]),2)+pow(($midlong-$coor[0]),2);
		if ($d<$min) {
			$transfersR['mll']="[".$coor[1].",".$coor[0]."]";
			$min=$d;
			$lat=$coor[1];
			$long=$coor[0];
		}
	}
	$line=substr($line,0,-1);
	$line.="]";
	$transfersR['line']=$line;
}
$res = json_encode($transfersR);
echo $_GET['callback'] . '(' . $res. ')';