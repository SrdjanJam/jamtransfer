<?
	$orkeys="0";
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_OrdersMaster.class.php';

	$od = new v4_OrderDetails();
	$om = new v4_OrdersMaster();
	$noOfTransfers2 = 0;	
	$timestart=date('Y-m-d',time()-183*3600*24);	
	$timeend=date('Y-m-d',time());	
	$where=" WHERE PickupDate>'".$timestart."' AND PickupDate<='".$timeend."' AND TransferStatus=1 AND DriverConfStatus in (2,3) AND DriverID=".$_SESSION['UseDriverID'];	
	$odk=$od->getKeysBy('PickupDate,PickupTime','ASC',$where);
	$details2=array();
	foreach ($odk as $key) {
		$od->getRow($key);
		date_default_timezone_set('Europe/Paris');
		$fulltime=$od->getPickupDate()." ".$od->getPickupTime();
		$transferEndTime=strtotime($fulltime)+1800;
		if ($transferEndTime<time()) {
			$detail_row=$od->fieldValues();
			$detail_row['VehicleTypeName']=getVehicleTypeName($od->getVehicleType());
			$om->getRow($od->getOrderID());
			$detail_row['MOrderKey']=$om->getMOrderKey();
			$details2[]=$detail_row;
			$noOfTransfers2 += 1;
		}
	}
	$smarty->assign('details2',$details2);
	$smarty->assign('noOfTransfers2',$noOfTransfers2);
