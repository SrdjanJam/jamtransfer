<?
	$smarty->assign('smallBoxes',false);	
	$smarty->assign('charts',false);	
	$smarty->assign('emptyRow',false);	
	$smarty->assign('getOrder',false);	
	$smarty->assign('getRoutePrices',false);	
	$smarty->assign('getUnfinishedPayment',false);							
	$smarty->assign('problemPayment',false);							
	$smarty->assign('actualTransfers',false);										
	$smarty->assign('unConfirmedTransfers',false);										
	$smarty->assign('unCompletedTransfers',false);										
	$smarty->assign('presentTransfers',false);										
	$smarty->assign('unAssignedTransfers',false);	
	$smarty->assign('driverSettingsExist',false);	
	$smarty->assign('todo',false);
	$smarty->assign('quickEmail',false);	
	$smarty->assign('translatorPanel',false);
	$smarty->assign('bookingConversionRate',false);
	$smarty->assign('calculateProvision',false);	
	$smarty->assign('calendar',false);	
	$smarty->assign('subDriverPanel',false);	
	$smarty->assign('notReady',false);	
	// Check:
	// $smarty->assign('bookingConversionRate',false);	

	if (in_array($_SESSION['AuthLevelID'],array(2,31,41,43,44,45,91,92,99))) {
		require_once 'smallBoxes.php'; 
		$smarty->assign('smallBoxes',true);	
	}	
	if (in_array($_SESSION['AuthLevelID'],array(2,41,43,44,45,91,92,99))) {
		require_once 'charts.php'; 
		$smarty->assign('charts',true);	
	}	
	if (in_array($_SESSION['AuthLevelID'],array(2,31,41,43,44,45,91,92,99))) {
		require_once 'emptyRow.php';
		$smarty->assign('emptyRow',true);	
	}	
	if (in_array($_SESSION['AuthLevelID'],array(2,41,43,44,45,91,92,99))) {
		require_once 'getOrder.php';
		$smarty->assign('getOrder',true);				
	}	
	if (in_array($_SESSION['AuthLevelID'],array(2,41,43,44,45,91,92,99))) {
		require_once 'getRoutePrices.php';
		$smarty->assign('getRoutePrices',true);				
	}	
	if (in_array($_SESSION['AuthLevelID'],array(41,44,91,92,99))) {
		if (!isset($_SESSION['UseDriverID'])) require_once 'getUnfinishedPayment.php';
		if (!isset($_SESSION['UseDriverID'])) $smarty->assign('getUnfinishedPayment',true);							
	}		
	
	if (in_array($_SESSION['AuthLevelID'],array(41,44,91,92,99))) {
		if (!isset($_SESSION['UseDriverID'])) require_once 'problemPayment.php';
		if (!isset($_SESSION['UseDriverID'])) $smarty->assign('problemPayment',true);							
	}	
		
	if (in_array($_SESSION['AuthLevelID'],array(41,43,45,46,91,92,99))) {
		require_once 'actualTransfers.php';
		$smarty->assign('actualTransfers',true);										
	}	
	if (in_array($_SESSION['AuthLevelID'],array(2,41,42,43,44,45,46,91,92,99))) {
		if (!isset($_SESSION['UseDriverID'])) require_once 'todo.php';
		if (!isset($_SESSION['UseDriverID'])) $smarty->assign('todo',true);
	}
	/*if (in_array($_SESSION['AuthLevelID'],array(2,41,42,43,44,45,91,92,99))) {
		$smarty->assign('quickEmail',true);	
	}*/	
	if (in_array($_SESSION['AuthLevelID'],array(42))) {
		$smarty->assign('translatorPanel',true);	
	}											

	if (in_array($_SESSION['AuthLevelID'],array(2,41,43,44,45,91,92,99))) {
		if (!isset($_SESSION['UseDriverID'])) {
			require_once 'bookingConversionRate.php';
			$smarty->assign('bookingConversionRate',true);
		}	
	}	
	
	if (in_array($_SESSION['AuthLevelID'],array(2,31,41,43,44,45,91,92,99))) {
		if (!isset($_SESSION['UseDriverID'])) $smarty->assign('calculateProvision',true);
	}	
	
	if (in_array($_SESSION['AuthLevelID'],array(31,32))) {
		require_once ROOT.'/plugins/Calendar/index.php';
		$smarty->assign('calendar',true);
	}		
	
	if (in_array($_SESSION['AuthLevelID'],array(32))) {
		require_once ROOT.'/plugins/SubDriverPanel/index.php';
		$smarty->assign('subDriverPanel',true);
	}	
	
	if (in_array($_SESSION['AuthLevelID'],array(2,31,41,42,43,44,45,91,92,99))) {
			if (isset($_SESSION['UseDriverID'])) {
				require_once 'unConfirmedTransfers.php';
				$smarty->assign('unConfirmedTransfers',true);
			}	
	}	
	if (in_array($_SESSION['AuthLevelID'],array(2,31,41,42,43,44,45,91,92,99))) {
			if (isset($_SESSION['UseDriverID'])) {
				require_once 'unCompletedTransfers.php';
				$smarty->assign('unCompletedTransfers',true);
			}	
	}	
	if (in_array($_SESSION['AuthLevelID'],array(2,31,41,42,43,44,45,46,91,92,99))) {
			if (isset($_SESSION['UseDriverID'])) {
				require_once 'presentTransfers.php';
				$smarty->assign('presentTransfers',true);
			}	
	}	
	if (in_array($_SESSION['AuthLevelID'],array(2,31,41,42,43,44,45,91,92,99))) {
			if (isset($_SESSION['UseDriverID'])) {
				require_once 'unAssignedTransfers.php';
				$smarty->assign('unAssignedTransfers',true);
			}	
	}	
	if (in_array($_SESSION['AuthLevelID'],array(31))) {
			if (isset($_SESSION['UseDriverID'])) $smarty->assign('driverSettingsExist',driverSettingsExist());
	}

	if (in_array($_SESSION['AuthLevelID'],array(41,43,44,45,91,92,99))) {
			require_once 'notReady.php';
			$smarty->assign('notReady',true);
	}