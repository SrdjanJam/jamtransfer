<?
// aktivna stranica iz url-a	
$baseUrl = "/";
$pathVars = new PathVars($baseUrl);
if (LOCAL) $indexStart = 1;
else $indexStart = 0;
$size=$pathVars->size();
if ($size>$indexStart) {
	$activePage=$pathVars->fetchByIndex($indexStart);
}	
else $activePage = 'dashboard';
$help="menu";
$isNew=false;
$transfersFilter='';
$includefile='/index.php';
$includefiletpl='index.tpl';

switch ($activePage) {
	case 'loginAsUser':
		$_REQUEST['sa_u']=$pathVars->fetchByIndex($indexStart + 1);
		$_REQUEST['sa_l']=$pathVars->fetchByIndex($indexStart + 2);
		$activePage = 'dashboard';	
		break;		
		
	case 'satAsDriver':
		$_SESSION['UseDriverID']=$pathVars->fetchByIndex($indexStart + 1);
		require_once ROOT . '/db/v4_AuthUsers.class.php';
		$au = new v4_AuthUsers();
		$au->getRow($_SESSION['UseDriverID']);
		$_SESSION['UseDriverName']=$au->getAuthUserRealName();
		header('Location: '.ROOT_HOME);
		break;		
				
	case 'rules':
		$_REQUEST['rulesType']=$pathVars->fetchByIndex($indexStart + 1);
		if (is_numeric($pathVars->fetchByIndex($indexStart + 2))) {
			$_REQUEST['item']=$pathVars->fetchByIndex($indexStart + 2);
		}
		break;		
		
	case 'driverReOrder':
		if ($pathVars->fetchByIndex($indexStart + 1)) { 
			$_REQUEST['OrderID']=$pathVars->fetchByIndex($indexStart + 1);
			$_REQUEST['TNo']=$pathVars->fetchByIndex($indexStart + 2);
			if ($pathVars->fetchByIndex($indexStart + 3)) {
				$_REQUEST['returnTransfer']=$pathVars->fetchByIndex($indexStart + 3);
			}
		}
		break;
		
	case 'orders':
		if ($pathVars->fetchByIndex($indexStart + 1)) { 
			$isEdit=false;
			$transfersFilter=$pathVars->fetchByIndex($indexStart + 1);
			if ($transfersFilter=='order') $smarty->assign('orderid',$pathVars->fetchByIndex($indexStart + 2));
			if ($transfersFilter=='detail')  $smarty->assign('detailid',$pathVars->fetchByIndex($indexStart + 2));
		
			if (is_numeric($transfersFilter)) {
				$detailid=$pathVars->fetchByIndex($indexStart + 1);
				$isEdit=true;
			}	
		}
		break;
		
	case 'buking':
		if ($pathVars->fetchByIndex($indexStart + 1)) { 
		
			$includefile='/'.$pathVars->fetchByIndex($indexStart + 1).'.php';
			$includefiletpl=$pathVars->fetchByIndex($indexStart + 1).'.tpl';
		}	
		break;		
	default:
		if ($pathVars->fetchByIndex($indexStart + 1)) { 
			if (is_numeric($pathVars->fetchByIndex($indexStart + 1))) {
				$item=$pathVars->fetchByIndex($indexStart + 1);
				$smarty->assign('item',$item);
			}
			else if (($pathVars->fetchByIndex($indexStart + 1))=='connect') {
				$item=$pathVars->fetchByIndex($indexStart + 2);
				// ovde ubaciti program koji vrsi konekciju master i driver tabela	
				require ROOT."/plugins/makeDriverConnection.php";
			}			
		}	
}
$smarty->assign('transfersFilter',$transfersFilter);
$smarty->assign('includefiletpl',$includefiletpl);

$specialpage=$pathVars->fetchByIndex($indexStart + $size - 2);
switch ($specialpage) {
	case 'help':
		$help=$activePage;
		$activePage='tutorials';	
	case 'new':
		$isNew=true;
		$smarty->assign('isNew',$isNew);	
	default:
}	