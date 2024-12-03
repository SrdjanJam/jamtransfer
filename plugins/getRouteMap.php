<?
require_once '../config.php';
require_once '../headerScripts.php';
require_once ROOT . '/db/v4_Places.class.php';
$pl=new v4_Places;
$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";
$found=false;
if (isset($_REQUEST['DetailsID'])) {
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	$od=new v4_OrderDetails;	
	$where=" WHERE DetailsID=".$_REQUEST['DetailsID'];
	$odk=$od->getKeysBy('DetailsID','',$where);
	if (count($odk)==1) {
		$found=true;
		$od->getRow($odk[0]);
		//$FromName=$od->getPickupName();
		//$ToName=$od->getDropName();	
		$FromID=$od->getPickupID();
		$ToID=$od->getDropID();	
	}
}	
if (isset($_REQUEST['RouteID'])) {
	require_once ROOT . '/db/v4_Routes.class.php';
	$rt=new v4_Routes;	
	$rt->getRow($_REQUEST['RouteID']);
	$found=true;
	$FromID=$rt->getFromID();
	$ToID=$rt->getToID();	
}
if ($found) {
	$pl->getRow($FromID);
	$FromName=$pl->getPlaceNameEN();
	$plat=$pl->Latitude;
	$plong=$pl->Longitude;	
	$pl->getRow($ToID);
	$ToName=$pl->getPlaceNameEN();
	$dlat=$pl->Latitude;
	$dlong=$pl->Longitude;	
	$transfersR['PickupName']="From<br><h5>".$FromName."</h5>";
	$transfersR['DropName']="To<br><h5>".$ToName."</h5>";
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


