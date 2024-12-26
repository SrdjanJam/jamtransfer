<?
	//potrebna polja za query
	$DateFrom = $_REQUEST['DateFrom'];
	$DateTo = $_REQUEST['DateTo'];
	$SubDriverID = $_REQUEST['SubDriverID'];
	$NumberOfTransfers = 0;
	$TotalPayLater = 0;
	$TotalCashIn = 0;
	$NumberOfCashDiffTransfers = 0;
	
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_AuthUsers.class.php';
	$od = new v4_OrderDetails();
	$au = new v4_AuthUsers();


	//ako imamo oba datuma prikazi izvjestaj
	if( isset($_REQUEST['DateFrom']) and isset($_REQUEST['DateTo']) ){
		$where1 .= " WHERE DriverID = '".$_SESSION["UseDriverID"]."' ";
		$where1 .= "AND (PickupDate >= '".$DateFrom."' AND PickupDate <= '".$DateTo."') ";
		$where1 .= "AND TransferStatus != '3' ";
		$where1 .= "AND TransferStatus != '4' ";
		$where1 .= "AND TransferStatus != '9' ";
		if( isset($_REQUEST['SubDriverID']) and $_REQUEST['SubDriverID']>0) $where1 .= "AND SubDriver = '".$SubDriverID."' ";
		$odk=$od->getKeysBy("PickupDate","",$where1);
		$orders=array();
		//ako ima rezultata
		if( count($odk) > 0) {  
			foreach ($odk as $key) {
				$od->getRow($key);
				$orders[]=$od->fieldValues();
				$NumberOfTransfers += 1;
				$TotalCashIn = $TotalCashIn + $od->CashIn;
				$TotalPayLater = $TotalPayLater + $od->PayLater;
				if($od->CashIn != $od->PayLater) {
					$color = 'red';
					$NumberOfCashDiffTransfers += 1;
				}
				else $color = '';
			}
		}
		$smarty->assign("orders",$orders);
		$smarty->assign("NumberOfTransfers",$NumberOfTransfers);
		$smarty->assign("TotalCashIn",$TotalCashIn);
		$smarty->assign("TotalPayLater",$TotalPayLater);
		$smarty->assign("NumberOfCashDiffTransfers",$NumberOfCashDiffTransfers);
		$smarty->assign("User",$users[$_REQUEST['SubDriverID']]->AuthUserRealName);
	} else {

		$q  = "SELECT AuthUserID, AuthUserRealName FROM v4_AuthUsers ";
		$where2 .= " WHERE DriverID = '".$_SESSION['UseDriverID']."' ";
		$where2 .= "AND AuthLevelID = '32' ";
		$where2 .= "AND Active = '1' ";
		$auk=$au->getKeysBy("AuthUserRealName","",$where2);
		$sdarray=array();
		foreach ($auk as $key) {
			$au->getRow($key);
			$sd_row=array();
			$sd_row['id']=$au->getAuthUserID();
			$sd_row['name']=$au->getAuthUserRealName();
			$sdarray[]=$sd_row;
		}
		$smarty->assign('sdrivers',$sdarray);
	}	
		
	
?>








