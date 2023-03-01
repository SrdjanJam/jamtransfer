<?
// Sprema adresu na koju korisnik zeli doci
// ali ako nije logiran, ne moze
// nakon Logina vraca korisnika na spremljenu stranicu
$_SESSION['InitialRequest'] = $_SERVER['REQUEST_URI'];

$help="menu";
$isNew=false;
$transfersFilter='';
$includeFile='/index.php';
$includeFileTpl='index.tpl';
$orderid=0;
$detailid=0;
$RouteID=0;
$VehicleTypeID=0;
$VehicleID=0;
$item=0;
$isNew=false;
$active_pages=array();
$menu1=array();
$pageName='';
$pageList='';
$existNew=true;

require_once 'pathToVars.php';
// LOGIN
if(!isset($_SESSION['UserAuthorized']) or $_SESSION['UserAuthorized'] == false) {
	require_once 'login.php';
	exit();	
}
else setcookie("page", $activePage, time() + (7*24*60*60),"/");

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
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$modules_arr.=$row['ModulID'].",";
}
$modules_arr = substr($modules_arr,0,strlen($modules_arr)-1);
// meni
require_once 'db/v4_Modules.class.php';
$md = new v4_Modules();
$mdk = $md->getKeysBy('MenuOrder ' ,'asc', "where ParentID=0 AND ModulID in (".$modules_arr.")");
$setasdriver=false;
foreach($mdk as $key) {
	$md->getRow($key);
	$row1=array();
	$row1['title']=$md->getName();
	$row1['link']=$md->getCode();
	$active_pages[]=$md->getCode();			
	$row1['icon']=$md->getIcon();
	$row1['description']=$md->getDescription();
	$row1['activestatus']=activeStatus($md->getActive());
	
	$mdk2 = $md->getKeysBy('MenuOrder ' ,'asc', "where ParentID=".$md->getModulID()." AND ModulID in (".$modules_arr.")");
	$menu2=array();
	if ($md->getCode()==$activePage) $active_parent=true;		
	else $active_parent=false;
	if (count($mdk2)>0) {
		$row1['arrow']='fa arrow';
		foreach($mdk2 as $key2) {
			$md->getRow($key2);
			if ($md->getCode()=='setDriver') $setasdriver=true;
			$row2=array();
			$row2['title']=$md->getName();
			$row2['link']=$md->getCode();	
			$row2['description']=$md->getDescription();	
			$row2['activestatus']=activeStatus($md->getActive());
			$active_pages[]=$md->getCode();			
			//$row2['icon']=$md->getIcon();
			if ($md->getCode()==$activePage) {
				$row2['active']='active';
				$active_parent=true;
			}	
			else $row2['active']='';
			$menu2[]=$row2;	
		}
	}
	else $row1['arrow']='';	
	if ($active_parent) $row1['active']='active';
	else $row1['active']='';		
	$row1['menu']=$menu2;	
	$menu1[]=$row1;
}	
$mdk = $md->getKeysBy('ModulID ' ,'asc', "where code='$activePage'");
if (count($mdk)==1 && in_array($activePage,$active_pages)) {
	$key=$mdk[0];
	$md->getRow($key);
	if (is_dir($modulesPath . '/'.$md->getBase())) {
		require_once $modulesPath . '/'.$md->getBase().$includeFile;
	
		if (is_dir($modulesPath . '/'.$md->getBase().'/templates')) 
			$pageName=$md->getName();		
		else $pageList=$md->getName();
	}	
	/*$md->getRow($md->getParentID());
	$parentFolder=$md->getBase();
	$md->getRow($key);
	if (is_dir($modulesPath . '/'.$parentFolder.'/'.$md->getBase())) {
		require_once $modulesPath . '/'.$parentFolder.'/'.$md->getBase().$includefile;
	
		if (is_dir($modulesPath . '/'.$parentFolder.'/'.$md->getBase().'/templates')) 
			$smarty->assign('page',$md->getName());		
		else $smarty->assign('pageList',$md->getName());
	}	
	$smarty->assign('parentFolder',$parentFolder);
	*/
	
}
else {
	if (count($mdk)==1) header("Location: ". ROOT_HOME . '/dashboard');
	else exit('Page not found');
}

if (isset($_SESSION['UseDriverID'])) $existNew=false;
if ($md->getName()=="SubDrivers") $existNew=true;
if ($md->getName()=="Orders") $existNew=false;
if ($md->getName()=="Invoices") $existNew=false;
if ($md->getName()=="Set Driver") $existNew=false;
if ($_SESSION['AuthLevelID']==42) $existNew=false;
if ($_SESSION['AuthUserID']==874) $existNew=true;
if ($md->getName()=="Articles") $existNew=true;


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
$smarty->assign('item',$item);
$smarty->assign('isNew',$isNew);
$smarty->assign('existNew',$existNew);
$smarty->assign('menu1',$menu1);
$smarty->assign('pageName',$pageName);
$smarty->assign('pageList',$pageList);
$smarty->assign('currenturl',ROOT_HOME.$activePage);
$smarty->assign('title',$md->getName());
$smarty->assign('base',$md->getBase());
$smarty->assign('parentID',$md->getParentID());
$smarty->assign('ModulID',$key);
$smarty->assign('setasdriver',$setasdriver);
$smarty->assign('database',$database);


	
// display
?><script type="text/x-handlebars-template"></script><?

$smarty->display("index.tpl");	

function activeStatus($status) {
	switch ($status) {
		case 0:
			return "";
			break;			
		case 1:
			return "A";
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