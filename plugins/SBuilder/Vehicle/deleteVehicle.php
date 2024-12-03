<?
@session_start();
require_once '../../../config.php';
require_once ROOT . '/db/sb_Vehicles.class.php';
$vh = new sb_Vehicles();
$vh->deleteRow($_REQUEST['id']);
$array=array();
$res = json_encode($array);
echo $_GET['callback'] . '(' . $res. ')';