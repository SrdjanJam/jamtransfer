<?
	//session_start();
	$sdid=$_REQUEST['sdid'];
	//require_once ROOT . '/db/db.class.php';
	/*require_once ROOT . '/db/v4_SubActivity.class.php';	
	require_once ROOT . '/db/v4_SubVehicles.class.php';
	require_once ROOT . '/db/v4_Equipment.class.php';
	require_once ROOT . '/db/v4_VehicleEquipmentList.class.php';


	$db = new DataBaseMySql();
	$ac = new v4_SubActivity();
	$sv = new v4_SubVehicles();
	$eq = new v4_Equipment();
	$veql = new v4_VehicleEquipmentList();
	
	$sv->getRow($_REQUEST['VehicleID']);
	$vehicle=$sv->getVehicleDescription();
	
	$where="Where VehicleID=".$_REQUEST['VehicleID'];
	$eqk = $eq->getKeysBy('DisplayOrder ','', 'Where Active=1');
	$veqlk = $veql->getKeysBy('Datum Desc','', $where);
	$veql->getRow($veqlk[0]);
	$ListID=$veql->ListID;
	$query="SELECT EquipmentID FROM `v4_VehicleEquipmentItem` WHERE `ListID`='".$ListID."' AND VehicleID=".$_REQUEST['VehicleID'];
	$eqids = mysqli_query($con, $query) or die('Error in VehicleEquipmentItem query' . mysqli_connect_error());
	while($eqid = mysqli_fetch_object($eqids) ) {
		$eq_arr[] = $eqid->EquipmentID;
	}
	$delete=true;
	
	if (!isset($_REQUEST['SubmitFlag'])) {
		//select iz redova tabele
		$sqls="SELECT EquipmentID FROM `v4_VehicleCheckList` WHERE `ActivityID`=".$_REQUEST['ActivityID'];
		$query=mysqli_query($con, $sqls) or die('Error in VehicleCheckList query' . mysqli_connect_error());
		while($eqp = mysqli_fetch_object($query) ) {
			$eq_arr2[]=$eqp->EquipmentID;
		}
	}	*/
	$back=array();
	$back['alarmid']=1;
	$back['userid']=$_REQUEST['sdid'];
	$back['message']='Ovo je test';
	echo json_encode($back);
	
	//if ($sdid==948) echo TRUE;
	//else FALSE;
	
?>


