<?
	require_once ROOT  . '/db/v4_AuthUsers.class.php';
	$au = new v4_AuthUsers();	
	require_once ROOT  . '/db/v4_OrderDetails.class.php';
	$od = new v4_OrderDetails();	
	require_once ROOT  . '/db/v4_Places.class.php';
	$pl = new v4_Places();		
	require_once ROOT  . '/db/v4_Terminals.class.php';
	$tr = new v4_Terminals();	
	require_once ROOT  . '/db/v4_DriverTerminals.class.php';
	$dt = new v4_DriverTerminals();	
	require_once ROOT  . '/db/v4_VehicleTypes.class.php';
	$vt = new v4_VehicleTypes();		
	require_once ROOT  . '/db/v4_Vehicles.class.php';
	$vh = new v4_Vehicles();	
	if (isset($_REQUEST['returnTransfer']) && $_REQUEST['returnTransfer']==1) {
		$returnTransfer=1;
		$oKey = $od->getKeysBy('OrderID', 'ASC', ' WHERE OrderID = ' .$_REQUEST['OrderID']);
	}	
	else {
		$returnTransfer=0;
		$oKey = $od->getKeysBy('OrderID', 'ASC', ' WHERE OrderID = ' .$_REQUEST['OrderID']. ' and TNo = ' . $_REQUEST['TNo']);
	}	
	$od->getRow($oKey[0]);
	$driverPrice=$od->getDriversPrice();
	$detailPrice=$od->getDetailPrice();
	if ($returnTransfer==1) {
		$od->getRow($oKey[1]);
		$driverPrice+=$od->getDriversPrice();
		$detailPrice+=$od->getDetailPrice();
		$od->getRow($oKey[0]);
	}		
	$au->getRow($od->getDriverID());
	$vt->getRow($od->getVehicleType());
	$smarty->assign("driverName",$au->getAuthUserRealName());
	$smarty->assign("DetailPrice",number_format($detailPrice,2));
	$smarty->assign("DriversPrice",number_format($driverPrice,2));
	$smarty->assign("VehicleTypeName",$vt->getVehicleTypeName());
	$smarty->assign("vehicleImage",getCarImage($vt->getVehicleClass()));
	$smarty->assign("VehiclesNo",$od->getVehiclesNo());
	$smarty->assign("returnTransfer",$returnTransfer);
	
	$fromID=$od->getPickupID();
	$toID=$od->getDropID();
	if ($fromID>0) {
		$pl->getRow($fromID);
		$fLon=$pl->getLongitude();
		$fLat=$pl->getLatitude();
		$route=$pl->getPlaceNameEN()."-";
	} else
	$route=$od->getPickupName();	
	if ($toID>0) {
		$pl->getRow($toID);
		$tLon=$pl->getLongitude();
		$tLat=$pl->getLatitude();
		$route.=$pl->getPlaceNameEN();
	} else
	$route.=$od->getDropName();	
	$smarty->assign("route",$route);

	$terminalsKeys = $tr->getKeysBy("TerminalID", "ASC", "WHERE 1=1");
	$distanceMin=150000;
	foreach($terminalsKeys as $ter) {
		$pl->getRow($ter);
		$terLon=$pl->getLongitude();
		$terLat=$pl->getLatitude();
		$distanceF=vincentyGreatCircleDistance($fLat,$fLon,$terLat,$terLon,'6371000');
		$distanceT=vincentyGreatCircleDistance($tLat,$tLon,$terLat,$terLon,'6371000');
		if ($distanceF<$distanceMin) {
			$terminals_ids.=$ter. ",";
		}	
		else if ($distanceT<$distanceMin) $terminals_ids.=$ter. ",";
	}
	$terminals_ids = substr($terminals_ids,0,strlen($terminals_ids)-1);
	$query1="SELECT * FROM `v4_DriverTerminals` WHERE `TerminalID` in (". $terminals_ids.") Order by DriverID";
	$r = $db->RunQuery($query1);
	$sdid=0;
	$terminals="";
	$drivername=array();
	while($did = $r->fetch_object() ){
		$au->getRow($did->DriverID);
		if ($au->getActive()==1) {
			$pl->getRow($did->TerminalID);
			if ($did->DriverID==$sdid) {
				if (($od->getPickupID()==$did->TerminalID) || ($od->getDropID()==$did->TerminalID)) 
					$terminals.="<b>".$pl->getPlaceNameEN()."</b>, ";
				else
					$terminals.=$pl->getPlaceNameEN().", ";
			} else {
				if ($sdid>0) {
					$driver['id']=$sdid;					
					$terminals = substr($terminals,0,strlen($terminals)-2);							
					$driver['terminals']=$terminals;
					$driver['name']=$drivername;
					$drivername=array();
					$drivers[]=$driver;
				}
				$sdid=$did->DriverID;
				$terminals=$pl->getPlaceNameEN().", ";
				$drivername['name']= $au->getAuthUserRealName();
				$drivername['mail']= $au->getAuthUserMail();
				$drivername['tel']= $au->getAuthUserTel();
				$drivername['mob']= $au->getAuthUserMob();
			}
		}	
	}
	$driver['id']=$sdid;
	$terminals = substr($terminals,0,strlen($terminals)-2);		
	$driver['terminals']=$terminals;
	$driver['name']=$drivername;
	$drivers[]=$driver;
	
	foreach ($drivers as $key=>$dr) {
		
		$vhKeys = $vh->getKeysBy('VehicleID', 'ASC', ' WHERE OwnerID = ' .$dr['id']);
		$vehicles="";
		foreach ($vhKeys as $vhid) {
			$vh->getRow($vhid);
			$vt->getRow($vh->getVehicleTypeID());
			if ($od->getVehicleType()==$vh->getVehicleTypeID())
				$vehicles.="<b>".$vt->getVehicleTypeName()."</b>/ ";		
			else 		
				$vehicles.=$vt->getVehicleTypeName()."/ ";				
		}	
		$vehicles = substr($vehicles,0,strlen($vehicles)-2);
		$vehicles = str_replace(",","",$vehicles);		
		$vehicles = str_replace("passengers","",$vehicles);		
		$dr['vehicles']=$vehicles;
		
		// statusi slanja oba upita
		$query1="SELECT * FROM `v4_OrderRequests` WHERE `OrderID`=".$_REQUEST['OrderID']." AND `TNo`=".$_REQUEST['TNo']." AND DriverID = ".$dr['id']." AND requestType = 1" ;
		$result1 = $db->RunQuery($query1);	
		$row1 = $result1->fetch_array(MYSQLI_ASSOC);
		if (isset($row1['ID'])) {
			$dr['request1']=1;
			$dr['request1date']=$row1['RequestDate'];
			$dr['request1time']=$row1['RequestTime'];
			if ($row1['ConfirmDecline']>0) {
				$dr['confirm_decline1']=$row1['ConfirmDecline'];
				$dr['response1date']=$row1['ResponseDate'];
				$dr['response1time']=$row1['ResponseTime'];
			}	
		}	
		else $dr['request1']=0;		
		$query2="SELECT * FROM `v4_OrderRequests` WHERE `OrderID`=".$_REQUEST['OrderID']." AND `TNo`=".$_REQUEST['TNo']." AND DriverID = ".$dr['id']." AND requestType = 2" ;
		$result2 = $db->RunQuery($query2);	
		$row2 = $result2->fetch_array(MYSQLI_ASSOC);
		if (isset($row2['ID'])) {
			$dr['request2']=1;
			$dr['request2date']=$row2['RequestDate'];
			$dr['request2time']=$row2['RequestTime'];
			if ($row2['ConfirmDecline']>0) {
				$dr['confirm_decline2']=$row2['ConfirmDecline'];
				$dr['response2date']=$row2['ResponseDate'];
				$dr['response2time']=$row2['ResponseTime'];
			}	
			if ($row2['ConfirmDecline']==1) $dr['price']=$row2['Price'];
		}	
		else $dr['request2']=0;
		$drivers[$key]=$dr;
	}
	//print_r($drivers);	
	$smarty->assign("drivers",$drivers);
	
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