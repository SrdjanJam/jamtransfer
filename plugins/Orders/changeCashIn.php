<?
	require_once '../../config.php';
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	$od = new v4_OrderDetails();
	
	$od->getRow($_REQUEST['DetailsID']);
	$od->setCashIn($_REQUEST['CashIn']);
	$od->saveRow();
