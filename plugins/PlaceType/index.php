<?
	if (!$isNew) require_once 'ListTemplate.php';
	require_once 'EditForm.php';
	$smarty->assign('ItemID',$md->getBase().'ID');
	$smarty->assign('pagelength',50);