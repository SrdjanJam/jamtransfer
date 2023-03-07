<?
	if (!$isNew) require_once 'ListTemplate.php';
	else {
		//punjnje select box-ova
		//akcije-troskovi
		require_once ROOT.'/db/v4_Actions.class.php';
		$ac = new v4_Actions();
		$ack = $ac->getKeysBy('DisplayOrder ', '','WHERE Active=2');

		foreach ($ack as $nn => $key)
		{
			$ac->getRow($key);
			$opis[$key]=$ac->getTitle();		
		}
		$dbT = new DataBaseMysql();
		$q = "SELECT AuthUserID, AuthUserRealName FROM v4_AuthUsers WHERE Active=1 AND AuthLevelID = '32' AND DriverID = '".$_SESSION["UseDriverID"]."' ORDER BY AuthUserRealName ASC";
		$r = $dbT->RunQuery($q);
		$driverArr = array();
		while($e = $r->fetch_object()) {
			$driverArr[] = $e;
		}

		$q = "SELECT VehicleID, VehicleDescription FROM v4_SubVehicles WHERE Active=1 AND OwnerID = '".$_SESSION["UseDriverID"]."' ORDER BY VehicleDescription ASC";
		$r = $dbT->RunQuery($q);
		$vehicleArr = array();
		while($e = $r->fetch_object()) {
			$vehicleArr[] = $e;
		}

		$q = 'SELECT DISTINCT Expense FROM v4_SubActivity WHERE Approved<9 AND OwnerID = '.$_SESSION["UseDriverID"].' ORDER BY Expense ASC';
		$r = $dbT->RunQuery($q);
		$expenseArr = array();
		while($s = $r->fetch_object()) {
			$expenseArr[] = $s;
		}	
	}
	
	require_once 'EditForm.php';
	$smarty->assign('ItemID','ID');
	$smarty->assign('pagelength',20);