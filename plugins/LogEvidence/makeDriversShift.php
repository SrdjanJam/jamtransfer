<?php
/*
	AJAX Script !!!!
*/
if (isset($_REQUEST['Date']) && isset($_REQUEST['DriverID'])) {
	require_once "../../config.php";
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_OfficeHours.class.php';
	require_once ROOT . '/db/v4_AuthUsers.class.php';
	require_once ROOT . '/db/v4_Places.class.php';
	$od=new v4_OrderDetails();
	$oh=new v4_OfficeHours();
	$au=new v4_AuthUsers();
	$pl=new v4_Places();
	date_default_timezone_set('Europe/Paris');
	$where= " WHERE DriverID=".$_REQUEST['DriverID']." AND TransferStatus not in (3,6) AND PickupDate='".$_REQUEST['Date']."' and subdriver>0";
	$odk=$od->getKeysBy("DetailsID","",$where);
	if (count($odk)>0) {
		$begin=array();
		$end=array();
		foreach ($odk as $key) {
			$od->getRow($key);
			$sdid=$od->getSubdriver();
			$row=array();
			$row['PickupTime']=$od->getSubPickupTime();
			$row['PickupID']=$od->getPickupID();
			$row['DropID']=$od->getDropID();
			
			if (!isset($begin[$sdid])) {
				$begin[$sdid]=$row;
			}	else if ($begin[$sdid]['PickupTime']>$row['PickupTime']) {
				$begin[$sdid]=$row;
			}			
			if (!isset($end[$sdid])) {
				$end[$sdid]=$row;
			}	else if ($end[$sdid]['PickupTime']<$row['PickupTime']) {
				$end[$sdid]=$row;
			}	
		}	
		foreach ($begin as $key=>$b) {
			$au->getRow($key);	
			if ($au->getIBAN()>0) {
				$pl->getRow($au->getIBAN());
				$sdplace=$pl->getPlaceNameEN();
				$sdLat=$pl->getLatitude();
				$sdLng=$pl->getLongitude();
				$pl->getRow($b['PickupID']);
				$rplace=$pl->getPlaceNameEN();
				$rLat=$pl->getLatitude();
				$rLng=$pl->getLongitude();

				$sdplace."-".$au->getIBAN()."-";
				$distanceTime=DistanceTime($sdLat,$sdLng,$rLat,$rLng);
				
				if ($distanceTime) {
					$distanceTime=str_replace(",","",$distanceTime);
					$timeB=date('Y-m-d',time());
					$timeB=$timeB." ".$b['PickupTime'].".00";
					$timeB=strtotime($timeB);
					$timeB=$timeB-$distanceTime-30*60; //vreme pickup-a - vreme dolaska od smestaja do pickup mesta - 1/2 sata
					$timeB=date('H:i:s',$timeB);
				} else {
					$timeB="";	
					$message.="Check routable:".$sdplace."-".$rplace."<br>";
				}	
				$pl->getRow($end[$key]['PickupID']);
				$r1Lat=$pl->getLatitude();
				$r1Lng=$pl->getLongitude();
				$r1Place=$pl->getPlaceNameEN();
				$pl->getRow($end[$key]['DropID']);
				$r2Lat=$pl->getLatitude();
				$r2Lng=$pl->getLongitude();
				$r2Place=$pl->getPlaceNameEN();				
				$distanceTime1=DistanceTime($r1Lat,$r1Lng,$r2Lat,$r2Lng);
				$distanceTime2=DistanceTime($r2Lat,$r2Lng,$sdLat,$sdLng);
				if ($distanceTime1)  {
					$distanceTime1=str_replace(",","",$distanceTime1);
					if ($distanceTime2)  {
						$distanceTime2=str_replace(",","",$distanceTime2);
						$timeE=date('Y-m-d',time());
						$timeE=$timeE." ".$end[$key]['PickupTime'].".00";
						$timeE=strtotime($timeE);
						$timeE=$timeE+$distanceTime1+$distanceTime2;
						$timeE=date('H:i:s',$timeE);
					} else {
						$timeE="";
						$message.="Check routable:".$r2place."-".$sdplace."<br>";		
					}	
				} else {
					$timeE="";
					$message.="Check routable:".$r1place."-".$r2place."<br>";
				}	
				$where= " WHERE UserID=".$key." AND WorkDate='".$_REQUEST['Date']."'";
				$ohk=$oh->getKeysBy("ID","",$where);
				if (count($ohk)==1) $oh->getRow($ohk[0]);
				$oh->setUserID($key);
				$oh->setWorkDate($_REQUEST['Date']);
				$oh->setBegin($timeB);
				$oh->setEnd($timeE);
				if (count($ohk)==1) $oh->saveRow();
				else $oh->saveAsNew();
			}	
		}	
	}	
}
echo $message;
function DistanceTime($Lat1,$Lng1,$Lat2,$Lng2) {
			$api_key='5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb';
			$url='https://api.openrouteservice.org/v2/directions/driving-car?api_key='.$api_key.'&start='.$Lng1.','.$Lat1.'&end='.$Lng2.','.$Lat2;
			$json = file_get_contents($url);   
			$obj=array();
			$obj = json_decode($json,true);
			if ($json) {
				$duration=$obj['features'][0]['properties']['segments'][0]['duration'];
				if ($duration==0) $duration=300;
				return $duration;
			}
			else {
				return false;
			}	
}