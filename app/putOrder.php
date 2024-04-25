<?
// deo za testiranje
/*require_once "../config.php";
$_REQUEST['code']="4190d4731aa725d606c511be010e2e6d";
*/
// kraj dela za testiranje

	require_once ROOT . '/db/v4_OrdersMaster.class.php';
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_Extras.class.php';
	require_once ROOT . '/db/v4_OrderExtras.class.php';
	require_once ROOT . '/db/v4_Services.class.php';
	require_once ROOT . '/db/v4_Routes.class.php';
	require_once ROOT . '/db/v4_Places.class.php';
	require_once ROOT . '/db/v4_AuthUsers.class.php';
	require_once ROOT . '/db/v4_VehicleTypes.class.php';
	require_once ROOT . '/db/v4_Vehicles.class.php';
	require_once ROOT . '/db/v4_DriverRoutes.class.php';
	
	$om = new v4_OrdersMaster();
	$od = new v4_OrderDetails();
	$ex = new v4_Extras();
	$ox = new v4_OrderExtras();
	$s = new v4_Services();
	$rt = new v4_Routes();
	$pl = new v4_Places();
	$au = new v4_AuthUsers();
	$vt	= new v4_VehicleTypes();
	$v	= new v4_Vehicles();
	$dr = new v4_DriverRoutes();
// deo za testiranje
/*$agentKeys = $au->getKeysBy('AuthUserID','asc',"WHERE AuthLevelID=2 and Active=1");
foreach($agentKeys as $ki => $id) {
	$au->getRow($id);
	if ($_REQUEST['code']==md5($au->getAuthUserPass())) {
		$pass=true;
		$userID=$au->getAuthUserID();
		break;
	}	
}*/
// kraj dela za testiranje	
	
	//commision
	$au->getRow($userID);
	$AgentCommision=$au->getProvision();
	$agentMail=$au->getAuthUserMail();	
	// extras
	$extras=array();
	foreach ($data->ExtrasIDS as $exid) {
		$extras[$exid]+=1;
		$ex->getRow($exid);
		$driversExtrasPrice+=$ex->getDriverPrice();
		$extrasPrice+=$ex->getPrice();
	}		
	// services
	$s->getRow($data->ServiceID);
	$routeID=$s->getRouteID();
	$vehicleTypeID=$s->getVehicleTypeID();
	$vehicleID=$s->getVehicleID();
	$driverID=$s->getOwnerID();	
    $drWhere = "WHERE RouteID = ".$routeID." AND Active = '1' AND OwnerID=".$driverID;
    $driverRouteKeys = $dr->getKeysBy('OwnerID', "ASC", $drWhere);
	$dr->getRow($driverRouteKeys[0]);
	$v->getRow($s->getVehicleID());
	$returnDiscount = $v->getReturnDiscount();
    $vt->getRow($vehicleTypeID);
    $vehicleClass   = $vt->getVehicleClass();	
	$SurCategory    = $s->getSurCategory();
    $DRSurCategory  = $dr->getSurCategory();
    $VSurCategory   = $v->getSurCategory();
	
	// izracunavanje transfer price
	$sur = Surcharges($driverID, $SurCategory, $s->getServicePrice1(),
					  $data->transferDate, $data->transferTime,
					  $data->returnDate, $data->returnTime,
					  $dr->getID(), $vehicleID, $data->ServiceID,
					  $VSurCategory, $DRSurCategory
					  );	
	$addToPrice =   $sur['MonPrice'] +
				$sur['TuePrice'] +
				$sur['WedPrice'] +
				$sur['ThuPrice'] +
				$sur['FriPrice'] +
				$sur['SatPrice'] +
				$sur['SunPrice'] +
				$sur['S1Price'] +
				$sur['S2Price'] +
				$sur['S3Price'] +
				$sur['S4Price'] +
				$sur['S5Price'] +
				$sur['S6Price'] +
				$sur['S7Price'] +
				$sur['S8Price'] +
				$sur['S9Price'] +
				$sur['S10Price'] +
				$sur['NightPrice'];				  
			
	if ($data->returnTransfer==1) {
		$driversPrice = $s->getServicePrice1();
		$DiscountPrice = $driversPrice - ($driversPrice * $returnDiscount / 100);
		$driversPrice = $driversPrice + $DiscountPrice + $addToPrice;
		$specialDatesPrice = calculateSpecialDates($driverID,$driversPrice/2,$data->transferDate, $data->transferTime,$data->returnDate, $data->returnTime);
		$driversPrice = $driversPrice + $specialDatesPrice;
		$FinalPrice = calculateBasePrice($driversPrice, $s->getOwnerID(), $vehicleClass);
		$driversPrice = ($driversPrice) / 2;
		$OneWayPrice = nf( round($FinalPrice/2,2) );
		$FinalPrice = nf( round($FinalPrice/2,2) )*2;
	}
	else {
		$driversPrice = $s->getServicePrice1();
		$driversPrice = $driversPrice + $addToPrice;	
		$specialDatesPrice = calculateSpecialDates($driverID,$driversPrice,$data->transferDate, $data->transferTime);
		$driversPrice = $driversPrice + $specialDatesPrice;
		$OneWayPrice = calculateBasePrice($driversPrice, $s->getOwnerID(), $vehicleClass);
		$FinalPrice = $OneWayPrice;
	}
	// zaokruzenje cijena
	$mTransferPrice =$FinalPrice;	
	$transferPrice = number_format(round($OneWayPrice,2),2);
	
	if ($data->returnTransfer==1) {
		$mDriversExtrasPrice=$driversExtrasPrice*2;
		$mExtrasPrice=$extrasPrice*2;
	} else {
		$mDriversExtrasPrice=$driversExtrasPrice;
		$mExtrasPrice=$extrasPrice;
	}	
	$provision=$transferPrice*$AgentCommision/100;
	$transferPrice2=$transferPrice+$extrasPrice-$provision;
	$mProvision=$mTransferPrice*$AgentCommision/100;
	//$mTransferPrice2=$mTransferPrice+$mExtrasPrice-$mProvision;	
	$mTransferPrice2=$mTransferPrice+$mExtrasPrice;	
	
	//routes
	$rt->getRow($routeID);
	$fromID=$rt->getFromID();
	$toID=$rt->getToID();
	$pl->getRow($fromID);
	$fromName=$pl->getPlaceNameEN();
	$pl->getRow($toID);
	$toName=$pl->getPlaceNameEN();
	//driver
	$driverName=$users[$driverID]->AuthUserRealName;
	$driverEmail=$users[$driverID]->AuthUserMail;
	$driverTel=$users[$driverID]->AuthUserMob;	
	
	$OrderKey = create_order_key(); // pravi OrderKey

	// OrdersMaster
		$om->setMOrderKey( $OrderKey );
		$om->setSiteID('2');
		$om->setMOrderStatus('1');
		$om->setMOrderDate(date("Y-m-d"));
		$om->setMOrderTime(date("H:i:s"));
		$om->setMUserID($userID);
		$om->setMUserLevelID( 6 ); 
		$om->setMTransferPrice($mTransferPrice2);
		$om->setMExtrasPrice($mExtrasPrice);
		//$om->setMDriverExtrasPrice($mDriversExtrasPrice);		
		//$om->setMProvision($mProvision);
		$om->setMOrderPriceEUR($mTransferPrice2);
		$om->setMOrderCurrency("EUR");
		$om->setMOrderCurrencyPrice($mTransferPrice2);
		$om->setMEurToCurrencyRate(1);
		$om->setMPaymentMethod(4);
		//$om->setMInvoiceAmount($mTransferPrice2);
		$om->setMAgentCommision($mProvision);
		$names=explode(" ",$data->paxName);
		$om->setMPaxFirstName($names[0]);
		$om->setMPaxLastName($names[1]);
		$om->setMPaxTel($data->paxMobile);
		$om->setMPaxEmail($data->paxEmail);
		$om->setMAcceptTerms(1);
		$om->setMOrderLang('en');		
		$omOrderID = $om->saveAsNew();
//print_r($om);		
		// Update OrderKey za printReservation.php
		$OrderKey .= '-'.$omOrderID;
		$od->setSiteID('2');
		$od->setOrderID($omOrderID);
		$od->setTNo('1');
		$od->setUserID($userID);
		$od->setUserLevelID(6);
		$od->setAgentID($userID);
		$od->setTransferStatus( '1');
		$od->setOrderDate(date("Y-m-d"));
		$od->setServiceID( $data->ServiceID);
		$od->setRouteID($routeID);
		$od->setFlightNo($data->flightNumber);
		$od->setFlightTime($data->flightTime);
		$od->setPaxName($data->paxName);
		$od->setPickupID($fromID);
		$od->setPickupName($fromName);
		$od->setPickupAddress($data->pickupAddress);
		$od->setPickupDate($data->transferDate);
		$od->setPickupTime($data->transferTime);
		$od->setPickupNotes($data->notes);
		$od->setDropID($toID);
		$od->setDropName($toName);
		$od->setDropAddress($data->dropoffAddress);
		$od->setDetailPrice($transferPrice);
		$od->setDriversPrice($driversPrice);
		$od->setExtraCharge($extrasPrice);
		$od->setDriverExtraCharge($driversExtrasPrice);
		$od->setPaymentMethod(4);
		$od->setInvoiceAmount($transferPrice2);
		$od->setProvisionAmount($provision);
		$od->setPaxNo($data->PaxNo);
		$od->setVehiclesNo($data->VehiclesNo);
		$od->setVehicleType($vehicleTypeID);
		$od->setVehicleID($vehicleID);
		$od->setDriverID($driverID);
		$od->setDriverName($driverName);
		$od->setDriverEmail($driverEmail);
		$od->setDriverTel($driverTel);
		$od->setDriverConfStatus(1);
		//$od->setDriverPaymentAmt($driversPrice);

		// long term reservations
        $start_date = strtotime(date("Y-m-d"));
		$end_date = strtotime($data->transferDate);
		$interval = ($end_date - $start_date)/60/60/24;
		$exclude_array=array(843,876,556);
		if ($interval > 10 && !in_array($driverID, $exclude_array)) {
			$od->setDriverEmail("jamtransferlongterm@gmail.com");
			$od->setDriverID(635);
			$od->setDriverName("NO NAME DRIVER CMS");
		}			
		$oneWayID = $od->saveAsNew();
//print_r($od);
		if ($data->returnTransfer==1) {
			$od->setSiteID('2');
			$od->setOrderID($omOrderID);
			$od->setTNo('2');
			$od->setUserID($userID);
			$od->setUserLevelID(6);
			$od->setAgentID($userID);
			$od->setTransferStatus( '1');
			$od->setOrderDate(date("Y-m-d"));
			$od->setServiceID($data->ServiceID);
			$od->setRouteID($routeID);
			$od->setFlightNo($data->returnFlightNumber);
			$od->setFlightTime($data->returnFlightTime);
			$od->setPaxName($data->paxName);
			$od->setPickupID($toID);
			$od->setPickupName($toName);
			$od->setPickupAddress($data->dropoffAddress);
			$od->setPickupDate($data->returnDate);
			$od->setPickupTime($data->returnTime);
			$od->setDropID($fromID);
			$od->setDropName($fromName);
			$od->setDropAddress($data->pickupAddress);
			$od->setDetailPrice($transferPrice);
			$od->setDriversPrice($driversPrice);
			$od->setExtraCharge($extrasPrice);
			$od->setDriverExtraCharge($driversExtrasPrice);
			$od->setPaymentMethod(4);
			$od->setInvoiceAmount($transferPrice2);
			$od->setProvisionAmount($provision);
			$od->setPaxNo($data->PaxNo);
			$od->setVehiclesNo($data->VehiclesNo);
			$od->setVehicleType($vehicleTypeID);
			$od->setVehicleID($vehicleID);
			$od->setDriverID($driverID);
			$od->setDriverName($driverName);
			$od->setDriverEmail($driverEmail);
			$od->setDriverTel($driverTel);
			$od->setDriverConfStatus(1);
			//$od->setDriverPaymentAmt($driversPrice);

			if ($interval > 10 && !in_array($driverID, $exclude_array)) {
				$od->setDriverEmail("jamtransferlongterm@gmail.com");
				$od->setDriverID(635);
				$od->setDriverName("NO NAME DRIVER CMS");
			}
			$returnID = $od->saveAsNew();		
//print_r($od);			
		}

		foreach($extras as $key => $value) {
			$ex->getRow($key);
			$ox->setOrderDetailsID($oneWayID);
			$ox->setServiceID($key);
			$ox->setServiceName($ex->getServiceEN());
			$ox->setProvision($ex->getProvision());
			$ox->setDriverPrice($ex->getDriverPrice());
			$ox->setPrice($ex->getPrice());
			$ox->setQty($value);
			$ox->setDriverPriceSum(number_format($ex->getDriverPrice()*$value,2));
			$ox->setSum(number_format($ex->getPrice()*$value,2));	
			$ox->saveAsNew();		
//print_r($ox);			
		}
		
		if ($data->returnTransfer==1) {
			foreach($extras as $key => $value) {
				$ex->getRow($key);
				$ox->setOrderDetailsID($returnID);
				$ox->setServiceID($key);
				$ox->setServiceName($ex->getServiceEN());
				$ox->setProvision($ex->getProvision());
				$ox->setDriverPrice($ex->getDriverPrice());
				$ox->setPrice($ex->getPrice());
				$ox->setQty($value);
				$ox->setDriverPriceSum(number_format($ex->getDriverPrice()*$value,2));
				$ox->setSum(number_format($ex->getPrice()*$value,2));		
				$ox->saveAsNew();
//print_r($ox);
			}	
		}

// Dodavanje dogovorene provizije na osnovnu cijenu
function calculateBasePrice($price, $ownerid) {
	global $db;
		# Driver
		$q = "SELECT * FROM v4_AuthUsers
					WHERE AuthUserID = '" .$ownerid."' 
					";
		$w = $db->RunQuery($q);
		$d = mysqli_fetch_object($w);
		if($d->AuthUserID == $ownerid) {
		if ($price >= $d->R1Low and $price <= $d->R1Hi) return $price + ($price*$d->R1Percent / 100);
		else if ($price >= $d->R2Low and $price <= $d->R2Hi) return $price + ($price*$d->R2Percent / 100);
		else if ($price >= $d->R3Low and $price <= $d->R3Hi) return $price + ($price*$d->R3Percent / 100);
		else return $price;
		}
		return '0';	
}
function calculateSpecialDates($OwnerID, $amount, $transferDate, $transferTime, $returnDate='', $returnTime='') {
    if( empty($OwnerID) or empty($amount) or empty($transferDate)  or empty($transferTime) ) return 0;
    require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_SpecialDates.class.php';
    $sd = new v4_SpecialDates();
    $add1 = 0;
    $add2 = 0;
    $keys = $sd->getKeysBy("ID", "ASC", " WHERE OwnerID = '" . $OwnerID ."'");
    if( count($keys) > 0) {
        foreach($keys as $nn => $ID) {
            $sd->getRow($ID);

            if( inDateTimeRange($sd->getSpecialDate(), $sd->getStartTime(), $sd->getSpecialDate(), $sd->getEndTime(), $transferDate, $transferTime) ) {
                $add1 = nf($amount * $sd->getCorrectionPercent() / 100);
            }
            if($returnDate != '' and $returnTime != '') {
                if( inDateTimeRange($sd->getSpecialDate(), $sd->getStartTime(), $sd->getSpecialDate(), $sd->getEndTime(), $returnDate, $returnTime) ) {
                 $add2 = nf($amount * $sd->getCorrectionPercent() / 100);
                }
            }
        }
    }
    return $add1 + $add2;
}
