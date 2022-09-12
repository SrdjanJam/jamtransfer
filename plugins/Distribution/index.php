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

	$sdArray = array();

	while ($d = $r->fetch_object()) {
		$row = array();
		$row['DriverID'] = $d->AuthUserID;
		$row['DriverName'] = $d->AuthUserRealName;
		$row['Active'] = $d->Active;
		$sdArray[] = $row;
	}
	
	$smarty->assign('drivers',$sdArray);
	

	$column = 'PickupDate';
	$order = 'ASC';
	$where = " WHERE DriverID = " . $_SESSION['UseDriverID'];

	$order = " ASC, SubPickupTime ASC";
	//$where .= " AND SubDriver = 0 ";
	if (($_REQUEST['Date'] != null)) $where .= " AND PickupDate = '".$_REQUEST['Date']."' "; 
	else $where .= " AND SubDriver = 0 AND PickupDate > CURDATE()";
	$where .= " AND TransferStatus < '6' AND TransferStatus != '3' AND TransferStatus != '4'
				AND DriverConfStatus != '3' ";

	$odArray = $od->getKeysBy($column, $order, $where);
	
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

	