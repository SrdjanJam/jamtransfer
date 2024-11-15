<?
require_once ROOT . '/db/v4_AuthUsers.class.php';
require_once ROOT . '/db/v4_Places.class.php';
require_once ROOT . '/db/v4_OrderDetails.class.php';
require_once ROOT . '/db/v4_SubVehicles.class.php';
require_once ROOT . '/db/v4_DriverTerminals.class.php';
$au = new v4_AuthUsers();
$pl=new v4_Places;
$od=new v4_OrderDetails;
$sv = new v4_SubVehicles();
$dt = new v4_DriverTerminals();
$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";
$driverID=$_SESSION['UseDriverID'];
if (!isset($_REQUEST['Date'])) $_REQUEST['Date']=$dateT=date('Y-m-d');
$dateT=$_REQUEST['Date'];
$sdArray = array();
$where=" WHERE AuthLevelID=32 and Active=1 and DriverID=".$driverID." ";;
$auk=$au->getKeysBy('AuthUserID','',$where);
	// dobavi sve parove vozaca i vozila za driver-a
	$q = "SELECT * FROM v4_SubVehicles";
	$q .= "	WHERE OwnerID = " . $_SESSION['UseDriverID']; 
	$r = $db->RunQuery($q);
	while ($d = $r->fetch_object()) {
		$vehicles[$d->AssignSDID]=$d->VehicleDescription;
	}

	foreach	($auk as $d) {
		$au->getRow($d);
		$row = array();
		$row['DriverID'] = $au->AuthUserID;
		$row['DriverName'] = $au->AuthUserRealName;
		$row['Active'] = $au->Active;
		$row['Mob'] = $au->AuthUserMob;
		if (array_key_exists($au->AuthUserID,$vehicles)) $row['Vehicle'] = $vehicles[$au->AuthUserID];
		else $row['Vehicle'] = "";
		
		// hvatanje trenutne lokacije za danasnji datum
		if ($dateT==date('Y-m-d')) {
			$lng=0;
			$lat=0;				
			$time1=time()-1200;
			$time2=time()-60;	
			// lokacija i vreme iz UserLocation
			$timestart=time()-12*3600;
			$q = "SELECT * FROM `v4_UserLocations` WHERE 
				`UserID`=".$au->AuthUserID." and
				`Time` > ".$timestart."
				order by time desc"; 
			$rL = $db->RunQuery($q);
			$loc=array(); 
			$foundlocation=false;
			while ($tL = $rL->fetch_object()) {
				$loc[] = $tL;
				$foundlocation=true;
			}
			if ($foundlocation) {
				$lc=$loc[0];
				$row['Lat']=$lc->Lat;
				$row['Lng']=$lc->Lng;			
				$row['Location']=$lc->Label;
				$row['LL']="[".$lc->Lat.",".$lc->Lng."]";
				$row['Device']=$lc->Device.' at '.date('H:i:s',$lc->Time);
				$row['DeviceTime']=$lc->Time;
				$row['foundlocation']=true;
			}
			else $row['foundlocation']=false;
			$sdArray[] = $row;	
		}	
	}	
	function cmp($a, $b)
	{
		return strcmp($b['Device'], $a['Device']);
	}
	usort($sdArray, "cmp");		
	$smarty->assign('sdArray',$sdArray);
	$where=" WHERE TransferStatus not in (3,6) AND DriverConfStatus>1 AND PickupDate='".$dateT."' AND DriverID=".$driverID;
	$odk=$od->getKeysBy('PickupTime','',$where);
	if (count($odk)>0) {
		foreach ($odk as $key) {
			$od->getRow($key);
			
			$transfersR=array();
			$transfersR = $od->fieldValues();
			if($transfersR['VehicleType'] < 100) {
				$transfersR['VehicleType'] = 'S'.($od->getVehicleType());
			}		
			if($transfersR['VehicleType'] >= 100 and $transfersR['VehicleType'] < 200) {
				$transfersR['VehicleType'] = 'P'.($od->getVehicleType() - 100);
			}
			if($transfersR['VehicleType'] >= 200) {
				$transfersR['VehicleType'] = 'FC'.($od->getVehicleType() - 200);
			}	
			
			$pl->getRow($od->getPickupID());
			$transfersR['Pickup']=$pl->PlaceNameEN;		
			$plat=$pl->Latitude;
			$mlat[]=$plat;
			$plong=$pl->Longitude;	
			$mlong[]=$plong;
			$pl->getRow($od->getDropID());
			$transfersR['Drop']=$pl->PlaceNameEN;
			$dlat=$pl->Latitude;
			$mlat[]=$dlat;		
			$dlong=$pl->Longitude;
			$mlong[]=$dlong;
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
					}
				}
				$line=substr($line,0,-1);
				$line.="]";
				$transfersR['line']=$line;
			}
			$transfers[]=$transfersR;
		}

		if (count($mlong)==2) {
			$lat=$coor[1];
			$long=$coor[0];
			$dd=vincentyGreatCircleDistance($plat, $plong, $dlat, $dlong);	
		}	else {
			$minlong=min($mlong);
			$minlat=min($mlat);
			$maxlong=max($mlong);
			$maxlat=max($mlat);
			$lat=($minlat+$maxlat)/2;
			$long=($minlong+$maxlong)/2;
			$dd1=vincentyGreatCircleDistance($minlat, $minlong, $maxlat, $maxlong);	
			$dd2=vincentyGreatCircleDistance($maxlat, $minlong, $minlat, $maxlong);	
			$dd=max(array($dd1,$dd2));
		}
		$dd=$dd/1000;
		$scale=11;
		if 	($dd>50) $scale=10;
		if 	($dd>100) $scale=9;
		if 	($dd>300) $scale=8;			
		if 	($dd>500) $scale=7;			
		if 	($dd>800) $scale=6;			
		if 	($dd>1500) $scale=5;
	} else {
		$where=" WHERE DriverID=".$driverID;
		$dtk=$dt->getKeysBy('TerminalID','',$where);
		if (count($dtk)>0) {
			$slat=0;
			$slong=0;
			foreach ($dtk as $key) {
				$dt->getRow($key);
				$pl->getRow($dt->getTerminalID());
				if ($pl->getLongitude()<>0 && $pl->getLatitude()<>0) {
					$mlat[]=$pl->getLatitude();
					$mlong[]=$pl->getLongitude();
				}	
			}
			$minlong=min($mlong);
			$minlat=min($mlat);
			$maxlong=max($mlong);
			$maxlat=max($mlat);
			$lat=($minlat+$maxlat)/2;
			$long=($minlong+$maxlong)/2;
			$dd1=vincentyGreatCircleDistance($minlat, $minlong, $maxlat, $maxlong);	
			$dd2=vincentyGreatCircleDistance($maxlat, $minlong, $minlat, $maxlong);	
			$dd=max(array($dd1,$dd2));
			$dd=$dd/1000;
			$scale=11;
			if 	($dd>50) $scale=10;
			if 	($dd>100) $scale=9;
			if 	($dd>300) $scale=8;			
			if 	($dd>500) $scale=7;			
			if 	($dd>800) $scale=6;			
			if 	($dd>1500) $scale=5;			

		} else {
			$long=0;
			$lat=0;
			$scale=1;	
		}	
	}
	$smarty->assign('transfers',$transfers);
	$smarty->assign('lat',$lat);
	$smarty->assign('long',$long);
	$smarty->assign('scale',$scale);


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
?>
