<?
// aktivna stranica iz url-a	
$baseUrl = "/";
$pathVars = new PathVars($baseUrl);
if(DEVELOPMENT) $indexStart = 0;
else $indexStart = 1;
$size=$pathVars->size();
if ($size>0) $activePage=$pathVars->fetchByIndex($indexStart + 1);
else $activePage = 'dashboard';
$help="menu";
$isNew=false;

switch ($activePage) {
	case 'loginAsUser':
		$_REQUEST['sa_u']=$pathVars->fetchByIndex($indexStart + 2);
		$_REQUEST['sa_l']=$pathVars->fetchByIndex($indexStart + 3);
		$activePage = 'dashboard';		
	case 'satAsDriver':
		$_SESSION['UseDriverID']=$pathVars->fetchByIndex($indexStart + 2);
		require_once ROOT . '/db/v4_AuthUsers.class.php';
		$au = new v4_AuthUsers();
		$au->getRow($_SESSION['UseDriverID']);
		$_SESSION['UseDriverName']=$au->getAuthUserRealName();
		header('Location: '.ROOT_HOME);
	default:
		if ($pathVars->fetchByIndex($indexStart + 2)) { 
			if (is_numeric($pathVars->fetchByIndex($indexStart + 2))) {
				$item=$pathVars->fetchByIndex($indexStart + 2);
				$smarty->assign('item',$item);
			}
			else if (($pathVars->fetchByIndex($indexStart + 2))=='connect') {
				$item=$pathVars->fetchByIndex($indexStart + 3);
				// ovde ubaciti program koji vrsi konekciju master i driver tabela	
				require ROOT."/plugins/makeDriverConnection.php";
			}
		}	
}


$specialpage=$pathVars->fetchByIndex($indexStart + $size - 1);
switch ($specialpage) {
	case 'help':
		$help=$activePage;
		$activePage='tutorials';	
	case 'new':
		$isNew=true;
		$smarty->assign('isNew',$isNew);	
	default:
}	


