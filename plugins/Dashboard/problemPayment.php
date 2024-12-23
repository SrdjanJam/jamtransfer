<?
	$db = new DataBaseMysql();
	$time = date("Y-m-d", strtotime(date("Y-m-d")." -30 days"));	
	$query="SELECT * FROM `v4_OrdersMaster` WHERE 
		`MPaymentStatus`=0 and 
		`MOrderDate`>'".$time."' and 
		`MPaymentMethod` in (1,3) and 		
		`MOrderStatus` not in (3,9) and 
		`MUserLevelID` in (3,12) and
		`MCardNumber` not in (
			SELECT `MOrderKey` FROM `v4_OrdersMasterTemp` WHERE 
				`MOrderDate`>'".$time."'  and 
				`MPaymentMethod` in (1,3) and 
				`MPaymentStatus` = 1 
			) and
		`MPayNow`>5
	";
	$result = $db->RunQuery($query); 
	
	$porders=array();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){ 
		$porders[]=$row;

	}
	$smarty->assign("porders",$porders);