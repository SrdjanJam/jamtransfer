<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../../config.php';

require_once ROOT . '/db/v4_Countries.class.php';
$db = new v4_Countries();

$out = array();
# Details  red
$db->getRow($_REQUEST['ItemID']);
# get fields and values
$detailFlds = $db->fieldValues();
# remove slashes 
foreach ($detailFlds as $key=>$value) {
	$detailFlds[$key] = stripslashes($value);
}
$out[] = $detailFlds;
# send output back
$output = json_encode($out);
echo $_GET['callback'] . '(' . $output . ')';