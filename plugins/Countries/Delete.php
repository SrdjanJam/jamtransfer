<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../../config.php';

require_once ROOT . '/db/v4_Countries.class.php';
$db = new v4_Countries();

$out = array();

# delete row by key value
$db->deleteRow($_REQUEST['ID']);
$out[] = 'Deleted';

# send output back
$output = json_encode($out);
echo $_GET['callback'] . '(' . $output . ')';