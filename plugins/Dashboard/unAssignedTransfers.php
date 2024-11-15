<?
	$orkeys="0";
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_OrdersMaster.class.php';
	require_once ROOT . '/db/v4_OrderRequest.class.php';
	require_once ROOT . '/db/v4_OrderExtras.class.php';

	$or = new v4_OrderRequest();
	$od = new v4_OrderDetails();
	$om = new v4_OrdersMaster();
	$oe = new v4_OrderExtras();
	$noOfTransfers = 0;	
	$timestart=date('Y-m-d',time()-3600*24);
	$timeend=date('Y-m-d',time()+3600*24*4);
	$details=array();

	$where=" WHERE PickupDate>'".$timestart."' AND PickupDate<'".$timeend."' AND TransferStatus=1 AND DriverConfStatus=2 AND DriverID=".$_SESSION['UseDriverID'];	
	$odk=$od->getKeysBy('PickupDate,PickupTime','ASC',$where);
	foreach ($odk as $key) {
		$od->getRow($key);
		$detail_row=$od->fieldValues();
		$detail_row['VehicleTypeName']=getVehicleTypeName($od->getVehicleType());
		$om->getRow($od->getOrderID());
		$detail_row['MOrderKey']=$om->getMOrderKey();
		$oek = $oe->getKeysBy('ID', 'ASC', ' WHERE OrderDetailsID = ' . $key);
		$oeServices=array();
		if(count($oek) > 0) {
			foreach ($oek as $key => $value) {
				$oe->getRow($value);
				$oeServices[] = $oe->fieldValues();
			}			
			date_default_timezone_set('Europe/Paris');
		}	
		$detail_row['oeServices']=$oeServices;
		$detail_row['PaymentMethod']=$PaymentMethod[$od->getPaymentMethod()];
		if (in_array($od->getPaymentMethod(),array(1,4,5,6))) {
			$detail_row['Payment']=1;
			$detail_row['PaymentValue']=$od->getDriversPrice();
		} else if($od->getPaymentMethod()==2){
			$detail_row['Payment']=2;
			$detail_row['PaymentValue']=$od->getPayLater()-$od->getDriversPrice();
		} else if($od->getPaymentMethod()==3){
			$detail_row['Payment']=3;
			$detail_row['PaymentValue']=$od->getPayLater();
		}	
		
		$details[]=$detail_row;
		$noOfTransfers += 1;
	}
	
	
	$smarty->assign('details4',$details);
	$smarty->assign('noOfTransfers4',$noOfTransfers);
