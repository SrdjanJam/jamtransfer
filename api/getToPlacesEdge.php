<?	
require_once '../config.php';
error_reporting(E_ALL);

require_once ROOT . '/db/db.class.php';
require_once ROOT . '/db/v4_Places.class.php';
$db = new DataBaseMysql();
$pl = new v4_Places();
if(isset($_REQUEST['language'])) $_SESSION['language'] = $_REQUEST['language'];
$lang = "EN";
if( $lang == 'NB') $lang='NO';
$fID = $_REQUEST['fid'];
if(empty($fID) and isset($_SESSION['FromID']))
$fID = $_SESSION['FromID'];
$routes = array();
# Routes for selected place
$q1 = "SELECT DISTINCT RouteID, FromID, ToID, RouteName FROM v4_Routes
			WHERE (FromID = ".$fID."
			OR    ToID   = ".$fID.")
			";
if (isset($_SESSION['UseDriverID']) && $_SESSION['UseDriverID']>0) {
	$q1.=" AND RouteID in (SELECT `RouteID` FROM `v4_DriverRoutes` WHERE `OwnerID`=".$_SESSION['UseDriverID'].") ";
}	
$r1 = $db->RunQuery($q1);

while($r = $r1->fetch_object())
{
	if ($r->FromID==$fID) $toID=$r->ToID;
	else $toID=$r->FromID;
	$pl->getRow($toID);
	$routes[$r->RouteID] = array(
									'ID' => $r->RouteID,
									'ToID' => $toID,
									'ToPlace' => $pl->getPlaceNameEN(),
									'RouteName' => $r->RouteName
								);		
}
usort($routes, function($a, $b) {
    if ($a['ToPlace'] > $b['ToPlace']) {
        return 1;
    } elseif ($a['ToPlace'] < $b['ToPlace']) {
        return -1;
    }
    return 0;
});

$res = json_encode($routes);
echo $_GET['callback'] . '(' . $res. ')';




