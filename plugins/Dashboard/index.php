<?
	$smarty->assign('smallBoxes',false);	
	$smarty->assign('emptyRow',false);	
	$smarty->assign('getOrder',false);				
	$smarty->assign('getUnfinishedPayment',false);							
	$smarty->assign('actualTransfers',false);										
	$smarty->assign('todo',false);
	$smarty->assign('quickEmail',false);	
	$smarty->assign('translatorPanel',false);	

	if (in_array($_SESSION['AuthLevelID'],array(2,31,41,43,44,45,91,99))) {
		require_once 'smallBoxes.php'; 
		$smarty->assign('smallBoxes',true);	
	}	
	if (in_array($_SESSION['AuthLevelID'],array(2,31,41,43,44,45,91,99))) {
		require_once 'emptyRow.php';
		$smarty->assign('emptyRow',true);	
	}	
	if (in_array($_SESSION['AuthLevelID'],array(2,31,41,43,44,45,91,99))) {
		require_once 'getOrder.php';
		$smarty->assign('getOrder',true);				
	}	
	if (in_array($_SESSION['AuthLevelID'],array(41,44,91,99))) {
		require_once 'getUnfinishedPayment.php';
		$smarty->assign('getUnfinishedPayment',true);							
	}		
	if (in_array($_SESSION['AuthLevelID'],array(31,41,43,45,91,99))) {
		require_once 'actualTransfers.php';
		$smarty->assign('actualTransfers',true);										
	}	
	if (in_array($_SESSION['AuthLevelID'],array(2,31,41,42,43,44,45,91,99))) {
		require_once 'todo.php';
		$smarty->assign('todo',true);
	}	
	if (in_array($_SESSION['AuthLevelID'],array(2,31,41,42,43,44,45,91,99))) {
		$smarty->assign('quickEmail',true);	
	}	
	if (in_array($_SESSION['AuthLevelID'],array(42))) {
		$smarty->assign('translatorPanel',true);	
	}											


