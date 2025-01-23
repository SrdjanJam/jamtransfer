<?
	require_once 'ListTemplate.php';
	//subdrivers
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
	$smarty->assign('selectsubdriver',true);
	$smarty->assign('subdrivers',$subdrivers);	
	$smarty->assign('ItemID','ID');
	$smarty->assign('pagelength',20);
	
