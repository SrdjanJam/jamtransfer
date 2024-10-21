<?
	$orkeys="0";
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_OrdersMaster.class.php';

	$od = new v4_OrderDetails();
	$om = new v4_OrdersMaster();
	$noOfTransfers3 = 0;	
	$timestart=date('Y-m-d',time()-3600*24);	
	$timeend=date('Y-m-d',time()+3600*48);	
	$where=" WHERE PickupDate>'".$timestart."' AND PickupDate<'".$timeend."' AND TransferStatus=1 AND DriverConfStatus in (2,3) AND DriverID=".$_SESSION['UseDriverID'];	
	$odk=$od->getKeysBy('PickupDate,PickupTime','ASC',$where);
	$details3=array();
	foreach ($odk as $key) {
		$od->getRow($key);
		$detail_row=$od->fieldValues();
		$detail_row['VehicleTypeName']=getVehicleTypeName($od->getVehicleType());
		$om->getRow($od->getOrderID());
		$detail_row['MOrderKey']=$om->getMOrderKey();
		$details3[]=$detail_row;
		$noOfTransfers3 += 1;
	}
	$smarty->assign('details3',$details3);
	$smarty->assign('noOfTransfers3',$noOfTransfers3);
