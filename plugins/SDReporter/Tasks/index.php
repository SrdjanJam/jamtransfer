<?
	$pageList="Tasks";
	$pageName="";
	
	if (isset($CAU)) {
		$cash=number_format($CAU/100,0);
		$approved=number_format(($CAU-$cash*100)/10,0);
		$unapproved=number_format(($CAU-$cash*100-$approved*10),0);
	}
	//akcije-troskovi
	require_once ROOT.'/db/v4_Actions.class.php';
	$actions=array();
	$ac = new v4_Actions();
	$ack = $ac->getKeysBy('DisplayOrder ', '','WHERE Active=2');
	foreach ($ack as $key)
	{
		$ac->getRow($key);
		$owners=explode(",",$ac->getOwnersIDs());
		if (in_array($_SESSION['UseDriverID'],$owners))
			$actions[]=$ac->fieldValues();
	}
	$subdrivers=array();
	require_once ROOT.'/db/v4_AuthUsers.class.php';
	$au = new v4_AuthUsers();
	$where = " WHERE Active=1 AND DriverID=".$_SESSION['UseDriverID'];
	$authusers = $au->getKeysBy('AuthUserRealName', 'asc', $where);
	foreach($authusers as $nn => $id) {
		$au->getRow($id);
		$arr_row['id']=$au->getAuthUserID();
		$arr_row['name']=$au->getAuthUserRealName();
		$subdrivers[]=$arr_row;
	}
	
	//vehicles
	$vehicles=array();
	require_once ROOT . '/db/v4_SubVehicles.class.php';
	$sv = new v4_SubVehicles();
	$where = " WHERE Active=1 AND OwnerID = '".$_SESSION['UseDriverID']."'";
	$svk= $sv->getKeysBy('VehicleDescription', 'asc', $where);
	foreach($svk as $nn => $id) {
		$sv->getRow($id);
		$arr_row['id']=$sv->getVehicleID();
		$arr_row['name']=$sv->getVehicleDescription();
		$vehicles[]=$arr_row;
	}		
	
		
	
	require_once 'ListTemplate.php';
	require_once 'EditForm.php';
	$smarty->assign('ItemID','ID');
	$smarty->assign('pagelength',20);
	
