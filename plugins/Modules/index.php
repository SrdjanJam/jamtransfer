<?
	if (!$isNew) require_once 'ListTemplate.php';
	require_once 'EditForm.php';
	$smarty->assign('ItemID','ModulID');
	$smarty->assign('pagelength',20);	