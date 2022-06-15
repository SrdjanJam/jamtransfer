<?
$smarty->assign('page', $md->getName());
@session_start();
if (!$_SESSION['UserAuthorized']) die('Bye, bye');
$test = "test";
$smarty->assign('test', $test);

require_once ROOT . '/db/v4_Places.class.php';
$pl = new v4_Places();
if (isset($_SESSION['AgentID']) && $_SESSION['AgentID'] > 0) $AgentID = $_SESSION['AgentID'];
else $AgentID = 0;

if (isset($_SESSION['FromID']) && $_SESSION['FromID'] > 0) {
    $fromID = $_SESSION['FromID'];
    global $pl;
    $pl->getRow($fromID);
    $fromName = $pl->getPlaceNameEN();
}

if (isset($_SESSION['ToID']) && $_SESSION['ToID'] > 0) {
    $toID = $_SESSION['ToID'];
    global $pl;
    $pl->getRow($toID);
    $toName = $pl->getPlaceNameEN();
}

if (isset($_SESSION['PaxNo']) && $_SESSION['PaxNo'] > 0)
    $PaxNo = $_SESSION['PaxNo'];
else $PaxNo = 0;

if (s('MpaxTel') == '') $PaxTel = '';
else $PaxTel = s('MPaxTel');
if (isset($_SESSION['transferDate'])) $transferDate = $_SESSION['transferDate'];
$_SESSION['REFRESHED'] = false;

require_once "scriptsAdm.php";
require_once ROOT . '/db/v4_AuthUsers.class.php';
$au = new v4_AuthUsers();


if (s('MPaxFirstName')=='') $PaxFirstName = " ";
else $PaxFirstname=s('MpaxFirstName');
$weby_key=file_get_contents(ROOT . '/plugins/Buking/weby_key.inc', FILE_USE_INCLUDE_PATH);

// logika prikaza forme


