<?
require_once '../config.php';
require_once '../headerScripts.php';
require_once ROOT . '/db/v4_Places.class.php';
require_once ROOT . '/db/v4_OrderDetails.class.php';
require_once ROOT . '/db/v4_DriverTerminals.class.php';
$pl=new v4_Places;
$od=new v4_OrderDetails;
$dt = new v4_DriverTerminals();
$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";
$where=" WHERE DetailsID=".$_REQUEST['DetailsID'];
$odk=$od->getKeysBy('DetailsID','',$where);
if (count($odk)==1) {
	$od->getRow($odk[0]);
	$pl->getRow($od->getPickupID());
	$transfersR['PickupName']="From<br><h5>".$od->getPickupName()."</h5>";
	$transfersR['DropName']="To<br><h5>".$od->getDropName()."</h5>";
	$plat=$pl->Latitude;
	$plong=$pl->Longitude;	
	$pl->getRow($od->getDropID());
	$dlat=$pl->Latitude;
	$dlong=$pl->Longitude;
	if (($plat==0 && $plong==0) || ($dlat==0 && $dlong==0)) $transfersR['wrongll']="text-warning";
	else $transfersR['wrongll']="";
	$transfersR['pll']="[".$plat.",".$plong."]";
	$transfersR['dll']="[".$dlat.",".$dlong."]";
	$url="https://api.openrouteservice.org/v2/directions/driving-car?api_key=".$api_key."&start=".$plong.",".$plat."&end=".$dlong.",".$dlat."&radiuses=-1";
	$json = file_get_contents($url);   
	$obj="";
	$obj = json_decode($json,true);	
	$line="[";
	if ($json) {
		$midlat=($plat+$dlat)/2;
		$midlong=($plong+$dlong)/2;
		$distance=number_format($obj['features'][0]['properties']['segments'][0]['distance']/1000,2)."km";
		$duration=number_format($obj['features'][0]['properties']['segments'][0]['duration']/60,0)."min";
		$transfersR['dd']=$distance." / ".$duration;
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
	
		
		$dd=vincentyGreatCircleDistance($plat, $plong, $dlat, $dlong);	
		$dd=$dd/1000;
		$scale=11;
		if 	($dd>50) $scale=9;
		if 	($dd>100) $scale=8;
		if 	($dd>300) $scale=7;			
		if 	($dd>500) $scale=6;			
		if 	($dd>800) $scale=5;			
		if 	($dd>1500) $scale=4;
	}	
}
$smarty->assign('transfer',$transfersR);
$smarty->assign('lat',$lat);
$smarty->assign('long',$long);
$smarty->assign('scale',$scale);
$smarty->display('getRouteMap.tpl');	


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


