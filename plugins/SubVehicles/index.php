<?
	require_once 'ListTemplate.php';
	if ($isNew) require_once 'EditForm.php';
	
	$smarty->assign('ItemID','VehicleID');
	$smarty->assign('pagelength',20);
	
	