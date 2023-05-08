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
			WHERE FromID = ".$fID."
			OR    ToID   = ".$fID."
			";
$r1 = $db->RunQuery($q1);

while($r = $r1->fetch_object())
{
	if ($r->FromID==$fID) $toID=$r->ToID;
	else $toID=$r->FromID;
	$pl->getRow($toID);
	$routes[$r->RouteID] = array(
									'ID' => $r->RouteID,
									'ToPlace' => $pl->getPlaceNameEN(),
									'RouteName' => $r->RouteName
								);		
}
$res = json_encode($routes);
echo $_GET['callback'] . '(' . $res. ')';




