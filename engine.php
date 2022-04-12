<?


// Sprema adresu na koju korisnik zeli doci
// ali ako nije logiran, ne moze
// nakon Logina vraca korisnika na spremljenu stranicu
$_SESSION['InitialRequest'] = $_SERVER['REQUEST_URI'];

require_once 'pathToVars.php';



// LOGIN
if(!isset($_SESSION['UserAuthorized']) or $_SESSION['UserAuthorized'] == false) {
	require_once 'login.php';
	exit();	
}
else setcookie("page", $activePage, time() + (7*24*60*60));

// LOGIN AS USER
if(isset($_REQUEST['sa_u']) and $_REQUEST['sa_u'] !='' and is_numeric($_REQUEST['sa_u'])
and isset($_REQUEST['sa_l']) and $_REQUEST['sa_l'] !='' and is_numeric($_REQUEST['sa_l'])) {
	require_once 'loginasuser.php'; 
}
// SELECT FOLDER/PAGE TO LOAD, ovisno o profilu korisnika
if (isset($_REQUEST['af']) && $_REQUEST['af']) $_SESSION['af']=$_REQUEST['af'];
if (isset ($_SESSION['af']) && $_SESSION['af']) $activeFolder=$_SESSION['af'];
else $activeFolder = 'cms/'.trim( strtolower($_SESSION['GroupProfile']) );
		
// meni

require_once $activeFolder . '/' . 'menu.php';
//stranica
require_once 'db/v4_Modules.php';
$md = new v4_Modules();
$mdk = $md->getKeysBy('ModulID ' ,'asc', "where code='$activePage'");
if (count($mdk)==1) {
	$key=$mdk[0];
	$md->getRow($key);
	require_once $modulesPath . '/'.$md->getBase().'/index.php';
	$smarty->assign('currenturl',ROOT_HOME.$activePage);
	$smarty->assign('pageList',$md->getName());	
	$smarty->assign('title',$md->getName());
	$smarty->assign('base',$md->getBase());
	$smarty->assign('parentID',$md->getParentID());
	
}
//staro resenje 
else {
	require_once $activeFolder . '/' . 'controler.php';	
	$smarty->assign('title',$activePage);
}	
 
// display
$smarty->display("index.tpl");	

?>