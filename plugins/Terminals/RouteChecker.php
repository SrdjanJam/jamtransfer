<?

require_once '../../config.php';

require_once '../../db/db.class.php';
require_once '../../db/v4_Places.class.php';
require_once '../../db/v4_Routes.class.php';
$dbT = new DataBaseMysql();
$pl  = new v4_Places();
$r  = new v4_Routes();

	
$routes=array();
$PlaceID=ltrim($_REQUEST["PlaceID"]);
$pl->getRow($PlaceID);
$terminalname=$pl->getPlaceNameEN();
$rWhere = "WHERE (Approved = '1' 
	AND RouteID in (SELECT `RouteID` FROM `v4_RoutesTerminals` WHERE `TerminalID`={$PlaceID}) 
	AND (Km=0 OR Km>300 OR Duration=0)
	)";
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
		$row['link']="<a target='_blank' href='https://wis.jamtransfer.com/routes/".$rt."'>".$rt."</a>";
		$routes_arr[]=$row;
	}
}	
$smarty->assign('terminalname',$terminalname);
$smarty->assign('routes',$routes_arr);
$smarty->display('templatesN/RouteChecker.tpl');
