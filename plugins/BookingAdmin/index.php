<?
$smarty->assign('page', $md->getName());
@session_start();
if (!$_SESSION['UserAuthorized']) die('Bye, bye');


require_once ROOT . '/db/v4_Places.class.php';
$pl = new v4_Places;

if (isset($_SESSION['AgentID']) && $_SESSION['AgentID'] > 0) 
$AgentID = $_SESSION['AgentID'];
else $AgentID = 0;

if (isset($_SESSION['FromID']) && $_SESSION['FromID'] > 0) {
	$fromID = $_SESSION['FromID'];
	global $pl;
	$pl->getRow($fromID);
	$fromName=$pl->getPlaceNameEN();
}

if (isset($_SESSION['ToID']) && $_SESSION['ToID'] > 0) {
	$toID = $_SESSION['ToID'];
	global $pl;
	$pl->getRow($toID);
	$toName=$pl->getPlaceNameEN();
}

if (isset($_SESSION['PaxNo']) && $_SESSION['PaxNo'] > 0) $PaxNo = $_SESSION['PaxNo']; else $PaxNo = 0;

if (s('MPaxTel') == '') $PaxTel = " ";
else $PaxNo=0;
if (isset($_SESSION['transferDate'])) $transferDate=$_SESSION['transferDate'];

if ( (isset($lastElement) and count($lastElement) == 2) or !empty ($_REQUEST)) {
	foreach ($_REQUEST as $key => $value) {
		$_SESSION[$key] = $value;
	}
}

require_once "scriptsAdm.php";
require_once ROOT . '/db/v4_AuthUsers.class.php';
$au = new v4_AuthUsers();

if (s('MPaxFirstName')== '') $PaxFirstName = " ";
else $PaxFirstName=s('MPaxFirstName');
$weby_key = file_get_contents('weby_key', FILE_USE_INCLUDE_PATH);
#################################################################
?>
<?
$db = new DataBaseMysql();
$query = "SELECT AuthUserID, AuthUserCompany from v4_AuthUsers where AuthLevelID = 2;";
$result = $db->RunQuery($query);
$agents = array();
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	$agents[] = $row;
}
$smarty->assign('agents', $agents);
?>
