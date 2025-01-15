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
date_default_timezone_set("Europe/Paris");

$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";
$driverID=$_SESSION['UseDriverID'];
$dateT=date('Y-m-d');
$dateH=date('H:i:s', time()+3600);


	
	// dobavi sve parove vozaca i vozila za driver-a
	$q = "SELECT * FROM v4_SubVehicles";
	$q .= "	WHERE OwnerID = " . $_SESSION['UseDriverID']; 
	$r = $db->RunQuery($q);
	while ($d = $r->fetch_object()) {
		$vehicles[$d->AssignSDID]=$d->VehicleDescription;
	}

	$sdArray = array();
	//$subdriversOnTransfers=implode(",",$subdriversOnTransfers);
	$where=" WHERE AuthLevelID=32 and Active=1 and DriverID=".$driverID;
	$auk=$au->getKeysBy('AuthUserID','',$where);

	if ($_SESSION['UseDriverID']!=876) {
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
				$sdArray[$au->AuthUserID] = $row;	
			}	
		}
	}	else {
		$ch = curl_init();
		//curl_setopt($ch, CURLOPT_URL, 'https://wis.taxifrom.com/raptor.php?object=location');
		curl_setopt($ch, CURLOPT_URL, 'https://integration.raptor-fleet.com:50111/get_current_location_records?user_id=jamtransferWS01user&user_psw=HGvmvX5kxghlFod9N9oxd3PWHj49');
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		$response = curl_exec($ch);
		curl_close($ch);
		$obj = json_decode($response,true);	
		$locations=array();	
		foreach ($obj['records'] as $rec) {
			$arr=array();
			$arr['long']=$rec['longitude'];
			$arr['lat']=$rec['latitude'];
			$arr['angle']=$rec['angle'];
			$arr['speed']=$rec['speed'];
			$locations[$rec['vehicle_id']]=$arr;
		}	
		
		$where=" WHERE `OwnerID`=876 and `Active`=1 and RaptorID>0";
		$svk=$sv->getKeysBy("VehicleID","",$where);
		foreach ($svk as $key) {
			$sv->getRow($key);
			$rid=$sv->getRaptorID();
			$locations[$rid]['VehicleID']=$sv->getVehicleID();
			$locations[$rid]['SDID']=$sv->getAssignSDID();
		}		
		$device='raptor';
		foreach ($locations as $loc) {
			if ($loc['long']+$loc['lat']>0 && in_array($loc['SDID'],$auk)) {
				$key='5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb';
				$url='https://api.openrouteservice.org/geocode/reverse?api_key='.$key.'&point.lon='.$loc['long'].'&point.lat='.$loc['lat'];   
				$json2 = file_get_contents($url);   
				$obj=array();
				$obj = json_decode($json2,true);
				if (!in_array(gettype($obj),array('array','object'))) $obj=array();
				if (count($obj)>0) {	
					$lngX=$obj['features'][0]['geometry']['coordinates'][0];
					$latX=$obj['features'][0]['geometry']['coordinates'][1];
					$label=$obj['features'][0]['properties']['label'];
					$label=str_replace('\'','',$label);
				} else {
					$lngX=0;
					$latX=0;
					$label='';
				}
				$au->getRow($loc['SDID']);
				$row['DriverID'] = $au->AuthUserID;
				$row['DriverName'] = $au->AuthUserRealName;
				$row['Active'] = $au->Active;
				$row['Mob'] = $au->AuthUserMob;		
				if (array_key_exists($au->AuthUserID,$vehicles)) $row['Vehicle'] = $vehicles[$au->AuthUserID];
				else $row['Vehicle'] = "";		
				$row['Lat']=$loc['lat'];
				$row['Lng']=$loc['long'];			
				$row['Location']=$label;
				$row['LL']="[".$loc['lat'].",".$loc['long']."]";
				$row['Device']=$device.' at '.date('H:i:s');
				$row['DeviceTime']=time();
				$row['foundlocation']=true;
				$angle=$loc['angle'];
				if ($loc['speed']>0) $row['Icon']='<i style="color:blue; transform: rotate('.$angle.'deg);" class="fa-solid fa-arrow-circle-up fa-xl"></i>';
				else  $row['Icon']='<i style="color:red;" class="fa-solid fa-stop fa-xl"></i>';
				$sdArray[$au->AuthUserID] = $row;				
			}
		}
	}	

	$where=" WHERE TransferStatus=1 AND DriverConfStatus>1 AND PickupDate='".$dateT."' AND PickupTime<'".$dateH."' AND DriverID=".$driverID;
	$odk=$od->getKeysBy('PickupTime','',$where);
	$transfers=array();
	if (count($odk)>0) {
		$subdriversOnTransfers=array();
		foreach ($odk as $key) {
			$od->getRow($key);
			$subdriversOnTransfers[]=$od->getSubDriver();
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
			$plat=$sdArray[$od->getSubDriver()]['Lat'];
			$plong=$sdArray[$od->getSubDriver()]['Lng'];
			$mlat[]=$plat;
			$mlong[]=$plong;
			if ($od->getPickupTime()<date("H:i:s")) {
				$pl->getRow($od->getDropID());
				$transfersR['Color']='green';	
				$sdArray[$od->getSubdriver()]['Icon']=str_replace("blue","green",$sdArray[$od->getSubdriver()]['Icon']);
			}	
			else {
				$pl->getRow($od->getPickupID());
				$transfersR['Color']='#FFAC1C';
				$sdArray[$od->getSubdriver()]['Icon']=str_replace("blue","#FFAC1C",$sdArray[$od->getSubdriver()]['Icon']);

			}	
			$transfersR['Drop']=$pl->PlaceNameEN;
			$dlat=$pl->Latitude;
			$dlong=$pl->Longitude;
			$mlat[]=$dlat;		
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
				$transfersR['json']='';
			} else $transfersR['json']='NO ROUTE DATA';
			$transfersR['subDriver']=$users[$od->getSubdriver()]->AuthUserRealName;
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

	function cmp($a, $b)
	{
		return strcmp($b['Device'], $a['Device']);
	}
	usort($sdArray, "cmp");	
	
	$smarty->assign('sdArray',$sdArray);
	
	$smarty->assign('transfers',$transfers);
	$smarty->assign('lat',$lat);
	$smarty->assign('long',$long);
	$smarty->assign('scale',$scale);
?>
