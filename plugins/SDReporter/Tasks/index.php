<?
	$pageList="Tasks";
	$pageName="";
	
	if (!$isNew) {
		$smarty->assign('date1',true);
		$smarty->assign('date2',true);		
		$smarty->assign('selectaction',true);		
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
			$actions[]=$ac->fieldValues();
		}
		$smarty->assign('actions',$actions);
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
		require_once 'ListTemplate.php';
	}
	require_once 'EditForm.php';
	$smarty->assign('ItemID','ID');
	$smarty->assign('pagelength',20);
	
