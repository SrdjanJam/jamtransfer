<?
	if (!$isNew) require_once 'ListTemplate.php';
	require_once 'EditForm.php';
	$smarty->assign('ItemID','AuthUserID');
	$smarty->assign('pagelength',10);
