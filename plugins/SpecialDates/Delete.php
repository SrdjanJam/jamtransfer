<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

$out = array();

echo "DELETE FROM `v4_SpecialDates` WHERE `ID`=".$_REQUEST['id']." AND `OwnerID`=".$_SESSION['UseDriverID'];

# delete row by key value
if (isset($_SESSION['UseDriverID']) && $_SESSION['UseDriverID']>0) 
	$result = $dbT->RunQuery("DELETE FROM `v4_SpecialDates` WHERE `ID`=".$_REQUEST['id']." AND `OwnerID`=".$_SESSION['UseDriverID']);	
else $db->deleteRow($_REQUEST['ID']);
$out[] = 'Deleted';

# send output back
$output = json_encode($out);
echo $_GET['callback'] . '(' . $output . ')';