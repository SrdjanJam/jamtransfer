<?
	require_once ROOT . '/db/v4_OrdersMaster.class.php';
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_OrderExtras.class.php';
	require_once ROOT . '/db/v4_Places.class.php';
	require_once ROOT . '/db/v4_Routes.class.php';
	require_once ROOT . '/db/v4_OrderLog.class.php';
	require_once ROOT . '/db/v4_AuthUsers.class.php';

	$om = new v4_OrdersMaster();
	$au = new v4_AuthUsers();
	$od = new v4_OrderDetails();
	$d2 = new v4_OrderDetails();
	$oe = new v4_OrderExtras();
	$op = new v4_Places();
	$or = new v4_Routes();
	$ol = new v4_OrderLog();
	
	$q = "SELECT * FROM v4_AuthUsers";
	$q .= " WHERE DriverID = ".$_SESSION['UseDriverID']." AND Active=1 ORDER BY AuthUserRealName ASC";
	$r = $db->RunQuery($q);	
	
	$q2 = "SELECT * FROM v4_SubVehiclesSubDrivers,v4_SubVehicles";
	$q2 .= " WHERE v4_SubVehiclesSubDrivers.OwnerID = ".$_SESSION['UseDriverID']." AND VehicleID=SubVehicleID";
	$r2 = $db->RunQuery($q2);
	$subvehicles=array();
	while ($d = $r2->fetch_object()) {
		$row = array();
		$row['SubDriverID'] = $d->SubDriverID;
		$row['SubVehicleID'] = $d->SubVehicleID;
		$row['SubVehicleDescription'] = $d->VehicleDescription;
		$row['SubVehicleCapacity'] = $d->VehicleCapacity;		
		$subvehicles[] = $row;
	}	


	$sdArray = array();

	while ($d = $r->fetch_object()) {
		$row = array();
		$row['DriverID'] = $d->AuthUserID;
		$key = array_search($d->AuthUserID, array_column($subvehicles, 'SubDriverID'));
		if ($key) {
			$row['SubVehicleID']=$subvehicles[$key]['SubVehicleID'];
			$row['SubVehicleDescription']=$subvehicles[$key]['SubVehicleDescription'];
			$row['SubVehicleID']=$subvehicles[$key]['SubVehicleID'];
			$row['SubVehicleDescription']=$subvehicles[$key]['SubVehicleDescription'];
			$row['SubVehicleCapacity']=$subvehicles[$key]['SubVehicleCapacity'];			
		}	else $row['SubVehicleID']=0;
			
		$row['DriverName'] = $d->AuthUserRealName;
		$row['Active'] = $d->Active;
		$sdArray[] = $row;

	}
	
	$smarty->assign('drivers',$sdArray);
	

	$column = 'SubPickupTime';
	$order = 'ASC';
	$where = " WHERE DriverID = " . $_SESSION['UseDriverID'];

	$order = " ASC";
	//$where .= " AND SubDriver = 0 ";
	if (!isset($_REQUEST['Date'])) $_REQUEST['Date']=date('Y-m-d');
	
	$where .= " AND PickupDate = '".$_REQUEST['Date']."' "; 
	$where .= " AND TransferStatus < '6' AND TransferStatus != '3' AND TransferStatus != '4'
				AND DriverConfStatus > '1' ";

	$odArray = $od->getKeysBy($column, $order, $where);

	$transfers = array();
	
	// red u tablici
	foreach($odArray as $val => $ID) {
		$od->getRow($ID);		
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
		$transfers[]=$transfersR;
		
	}
	
	$smarty->assign('transfers',$transfers);
	$startday=strtotime($_REQUEST['Date'])-3*24*3600;
	$days=array();
	for ($i=0; $i<7; $i++) 
	{	
		$days[]=gmdate('Y-m-d',$startday+$i*24*3600);
	}	
	$smarty->assign('days',$days);	

	