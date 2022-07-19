<?
	if (!$isNew && !$isEdit) require_once 'ListTemplate.php';
	if ($isEdit) {
		require_once 'One.php';
	}	
	if (isset($_REQUEST['orderid'])) $orderid=$_REQUEST['orderid']; 
	else if (!isset($orderid) ) $orderid=0; 
	$smarty->assign('ItemID','DetailsID');
	$smarty->assign('orderid',$orderid);
	
		