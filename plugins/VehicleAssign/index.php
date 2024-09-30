<?
	require_once ROOT . '/db/v4_AuthUsers.class.php';
	require_once ROOT . '/db/v4_SubDrivers.class.php';
	$au = new v4_AuthUsers();
	
	$q = "SELECT * FROM v4_AuthUsers";
	$q .= " WHERE DriverID = ".$_SESSION['UseDriverID']." AND Active=1 ORDER BY AuthUserRealName ASC";
	$r = $db->RunQuery($q);

	$q2 = "SELECT * FROM v4_SubVehicles";
	$q2 .= " WHERE v4_SubVehicles.OwnerID = ".$_SESSION['UseDriverID'];
	$r2 = $db->RunQuery($q2);
	$subvehicles=array();
	while ($d = $r2->fetch_object()) {
		$row = array();
		$row['SubDriverID'] = $d->AssignSDID;
		$row['SubVehicleID'] = $d->VehicleID;
		$row['SubVehicleDescription'] = $d->VehicleDescription;
		$row['SubVehicleCapacity'] = $d->VehicleCapacity;
		$row['Active'] = $d->Active;

		$subvehicles[] = $row;
	}	

	$sdArray = array();
	while ($d = $r->fetch_object()) {
		$row = array();
		$row['DriverID'] = $d->AuthUserID;
		$key = array_search($d->AuthUserID, array_column($subvehicles, 'SubDriverID'));
		if (is_numeric($key)) {
			$row['SubVehicleID']=$subvehicles[$key]['SubVehicleID'];
			$row['SubVehicleDescription']=$subvehicles[$key]['SubVehicleDescription'];
			$row['SubVehicleCapacity']=$subvehicles[$key]['SubVehicleCapacity'];
		}	else $row['SubVehicleID']=0;
		
		$row['DriverName'] = $d->AuthUserRealName;
		$row['Active'] = $d->Active;
		$sdArray[] = $row;
	}
	
	$smarty->assign('drivers',$sdArray);	
	
	$q = "SELECT * FROM v4_SubVehicles";
	$q .= " WHERE OwnerID = ".$_SESSION['UseDriverID']." AND Active=1 AND AssignSDID=0 ORDER BY VehicleCapacity ASC";
	$r = $db->RunQuery($q);

	$svArray = array();

	while ($d = $r->fetch_object()) {
		$row = array();
		$row['VehicleID'] = $d->VehicleID;
		$row['VehicleTypeID'] = $d->VehicleTypeID;
		$row['VehicleDescription'] = $d->VehicleDescription;
		$row['Year'] = $d->Year;
		$row['VehicleCapacity'] = $d->VehicleCapacity;
		$row['Active'] = $d->Active;
		$svArray[] = $row;
	}
	
	$smarty->assign('vehicles',$svArray);
	



	