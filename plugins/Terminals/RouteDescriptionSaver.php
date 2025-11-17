<?

require_once '../../config.php';

require_once '../../db/db.class.php';
require_once '../../db/v4_Places.class.php';
require_once '../../db/v4_Routes.class.php';
$dbT = new DataBaseMysql();
$pl  = new v4_Places();
$r  = new v4_Routes();

if (isset($_REQUEST['submit'])) {
	if (isset($_REQUEST['RouteID']) && isset($_REQUEST['HTML'])) {
		unlink(ROOT."/site_terminals/routes/".$_REQUEST['RouteID'].'.html');
		$fp = fopen(ROOT."/site_terminals/routes/".$_REQUEST['RouteID'].'.html', 'w');
		fwrite($fp, $_REQUEST['HTML']);	
	}	
}	
$routes=array();
$PlaceID=ltrim($_REQUEST["PlaceID"]);
$pl->getRow($PlaceID);
$terminalname=$pl->getPlaceNameEN();
$rWhere = "WHERE (Approved = '1' AND RouteID in (SELECT `RouteID` FROM `v4_RoutesTerminals` WHERE `TerminalID`={$PlaceID}) AND RouteID in (SELECT `TopRouteID` FROM `v4_TopRoutes` WHERE Main=".$_REQUEST['main']."))";
$routes = $r->getKeysBy('RouteID', "ASC", $rWhere);

$routes_arr=array();
if (count($routes)>0) {
	foreach ($routes as $rt) {
		$row=array();
		$r->getRow($rt);
		$row['id']=$rt;
		$row['km']=$r->getKm();
		$row['duration']=$r->getDuration();
		$row['name']=$r->getRouteNameEN();
		$link=ROOT."/site_terminals/routes/".$rt.".html";
		if (file_exists($link)) $row['link']="<a target='_blank' href='https://wis.jamtransfer.com/site_terminals/routes/".$rt.".html'>".$rt.".html</a>";
		else $row['link']="No file";
		$routes_arr[]=$row;
	}
}	
$smarty->assign('terminalname',$terminalname);
$smarty->assign('routes',$routes_arr);
$smarty->display('templatesN/RouteDescriptionSaver.tpl');
