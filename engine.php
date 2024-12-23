<?
// Sprema adresu na koju korisnik zeli doci
// ali ako nije logiran, ne moze
// nakon Logina vraca korisnika na spremljenu stranicu
$_SESSION['InitialRequest'] = $_SERVER['REQUEST_URI'];
$help="menu";
$isNew=false;
$isNewNL=false;
$NewDriver=false;
$NewAgent=false;
$transfersFilter='';
$includeFile='/index.php';
$includeFileTpl='index.tpl';
$orderid=0;
$detailid=0;
$RouteID=0;
$VehicleTypeID=0;
$VehicleID=0;
$item=0;
$active_pages=array();
$menu1=array();
$pageName='';
$pageList='';
$existNew=false;
$SubDriverID=0;
$ActionID=0;
$terminalID=0;

require_once 'pathToVars.php';
// LOGIN
if ($activePage=="users" && !isset($_SESSION['UserRealName']) && $isNew) {
	$_SESSION['UserAuthorized']=true;
	$_SESSION['AuthLevelID']=0;
}	
if ($_SESSION['AuthLevelID']==0) {
	$active_pages[]="users";
	if ($newAgent) $_SESSION['UserRealName']="New agent";
	if ($newDriver) $_SESSION['UserRealName']="New driver";
}	
if(!isset($_SESSION['UserAuthorized']) or $_SESSION['UserAuthorized'] == false) {
	if ($activePage<>"") setcookie("pageEx", $activePage, time() + (7*24*60*60),"/");
	require_once 'login.php';
	exit();	
}
else if (!isset($_SESSION['UseDriverID'])) setcookie("pageEx", $activePage, time() + (7*24*60*60),"/");
if (isset ($_SESSION['UseDriverID'])){
	setcookie("UseDriverID", $_SESSION['UseDriverID'],time()+24*3600);
	setcookie("UseDriverName", $_SESSION['UseDriverName'],time()+(24*3600));
}
// kontrola pristupa
$modules_arr='';
if(isset($_SESSION['UseDriverID']) && $_SESSION['AuthLevelID']<>31) $AuthLevelID=81;
else $AuthLevelID=$_SESSION['AuthLevelID'];	
if ($_SESSION['AuthLevelID']==31) $_SESSION['UseDriverID']=$_SESSION['AuthUserID'];

$sql="SELECT ModulID FROM `v4_ModulesLevel` WHERE AuthLevelID=".$AuthLevelID;
$result = $db->RunQuery($sql);
if ($result->num_rows>0) {
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$modules_arr.=$row['ModulID'].",";
	}
	$modules_arr = substr($modules_arr,0,strlen($modules_arr)-1);
	// meni
	require_once 'db/v4_Modules.class.php';
	$md = new v4_Modules();
	$mdk = $md->getKeysBy('MenuOrder ' ,'asc', "where Active=1 AND ParentID=0 AND ModulID in (".$modules_arr.")");
	$setasdriver=false;
	$active_pages[]="profile";
	foreach($mdk as $key) {
		$md->getRow($key);
		$row1=array();
		if (!empty($md->getOnlyUsers())) $onlyusers=explode(",",$md->getOnlyUsers());
		else $onlyusers=array();
		if ((in_array($_SESSION['AuthUserID'],$onlyusers)) || count($onlyusers)==0) $display1=true;
		else $display1=false;		
		if (isset($_SESSION['UseDriverID']) && $_SESSION['AuthLevelID']!=31) $display1=true;
		$row1['title']=$md->getName();
		$row1['link']=$md->getCode();
		$active_pages[]=$md->getCode();			
		$row1['icon']=$md->getIcon();
		$row1['description']=$md->getDescription();
		$row1['phasestatus']=phaseStatus($md->getPhase());
		
		$mdk2 = $md->getKeysBy('MenuOrder ' ,'asc', "where Active=1 AND ParentID=".$md->getModulID()." AND ModulID in (".$modules_arr.")");
		$menu2=array();
		if ($md->getCode()==$activePage) $active_parent=true;		
		else $active_parent=false;
		if (count($mdk2)>0) {
			$row1['arrow']='fa arrow';
			foreach($mdk2 as $key2) {
				$md->getRow($key2);
				if ($md->getCode()=='setDriver') $setasdriver=true;
				$row2=array();
				if (!empty($md->getOnlyUsers())) $onlyusers=explode(",",$md->getOnlyUsers());
				else $onlyusers=array();
				if ((in_array($_SESSION['AuthUserID'],$onlyusers)) || count($onlyusers)==0) $display2=true;
				else $display2=false;
				if (isset($_SESSION['UseDriverID']) && $_SESSION['AuthLevelID']!=31) $display2=true;
				$row2['title']=$md->getName();
				$row2['link']=$md->getCode();	
				$row2['description']=$md->getDescription();	
				$row2['phasestatus']=phaseStatus($md->getPhase());
				$active_pages[]=$md->getCode();			
				//$row2['icon']=$md->getIcon();
				if ($md->getCode()==$activePage) {
					$row2['active']='active';
					$active_parent=true;
				}	
				else $row2['active']='';
				if ($md->getMenuOrder()<100 && $display2) $menu2[]=$row2;	
			}
		}
		else $row1['arrow']='';	
		if ($active_parent) $row1['active']='active';
		else $row1['active']='';		
		$row1['menu']=$menu2;	
		if ($display1) $menu1[]=$row1;
	}
	$mdk = $md->getKeysBy('ModulID ' ,'asc', "where code='$activePage'");
	if (count($mdk)==1 && in_array($activePage,$active_pages)) {
	//if (count($mdk)==1) {
		$keyP=$mdk[0];
		$md->getRow($keyP);
		if (is_dir($modulesPath . '/'.$md->getBase())) {	
			if (is_dir($modulesPath . '/'.$md->getBase().'/templates')) 
				$pageName=$md->getName();
			else $pageList=$md->getName();
			require_once $modulesPath . '/'.$md->getBase().$includeFile;		
		}	else {
			echo $md->getBase();
			//echo "NO PAGE";
		}	

		if ($md->getIsNew()==1) $existNew=true;
		if ($md->getIsDesc()==1) $isDesc=true;
		else $isDesc=false;
	}
	else header("Location: ". ROOT_HOME . 'dashboard');
	

	if ($specialpage2=='fieldsSettings') {
		$smarty->assign('fieldsSettings',1);
		$smarty->assign('levelID',$specialpage);
	}	
	else {
		$smarty->assign('fieldsSettings',0);
		$smarty->assign('levelID',0);		
	}	
	if ($specialpage2=='fieldsDescription') $smarty->assign('fieldsDescription',1);
	else $smarty->assign('fieldsDescription',0);
	
	$smarty->assign('transfersFilter',$transfersFilter);
	$smarty->assign('includeFile',$includeFile);
	$smarty->assign('includeFileTpl',$includeFileTpl);
	$smarty->assign('orderid',$orderid);
	$smarty->assign('detailid',$detailid);
	$smarty->assign('RouteID',$RouteID);
	$smarty->assign('VehicleTypeID',$VehicleTypeID);
	$smarty->assign('VehicleID',$VehicleID);
	$smarty->assign('SubDriverID',$SubDriverID);
	$smarty->assign('ActionID',$ActionID);
	$smarty->assign('TerminalID',$terminalID);
	$smarty->assign('item',$item);
	$smarty->assign('isNew',$isNew);
	$smarty->assign('isDesc',$isDesc);
	$smarty->assign('existNew',$existNew);
	$smarty->assign('menu1',$menu1);
	$smarty->assign('pageName',$pageName);
	$smarty->assign('pageList',$pageList);
	$smarty->assign('currenturl',ROOT_HOME.$activePage);
	$smarty->assign('title',$md->getName());
	$smarty->assign('base',$md->getBase());
	$smarty->assign('parentID',$md->getParentID());
	$smarty->assign('ModulID',$keyP);
	$smarty->assign('setasdriver',$setasdriver);


		
	// display
	?><script type="text/x-handlebars-template"></script><?
	require_once 'css.php';
	$smarty->display("index.tpl");	
}
//else echo "<h1>No menu options for this profile</h1>";




function phaseStatus($status) {
	switch ($status) {
		case 0:
			return "";
			break;			
		case 1:
			return "";
			break;			
		case 2:
			return "T";
			break;		
		case 3:
			return "D";
			break;		
		case 4:
			return "P";
			break;	
		default:
			break;	
	}	
}		
?>