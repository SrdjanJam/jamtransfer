<?
@session_start();
require_once '../../../config.php';
require_once ROOT . '/db/sb_Routes.class.php';
$rt = new sb_Routes();
$rt->deleteRow($_REQUEST['id']);
$array=array();

$res = json_encode($array);
echo $_GET['callback'] . '(' . $res. ')';