<?
	if (!$isNew) require_once 'ListTemplate.php';
	require_once 'EditForm.php';
	$smarty->assign('ItemID','id');
	$smarty->assign('pagelength',50);
	