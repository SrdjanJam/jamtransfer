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
		header('Location: '.ROOT_HOME);
	default:
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


