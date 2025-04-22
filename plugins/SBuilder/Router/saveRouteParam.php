<?
@session_start();
require_once '../../../config.php';
require_once ROOT . '/db/sb_Routes.class.php';
$rt = new sb_Routes();

$rt->setOwnerID($_SESSION['UseDriverID']);
$rt->setRouteName($_REQUEST['from']."-".$_REQUEST['to']);
$fromtoLL=array($_REQUEST['fromLat'],$_REQUEST['fromLng'],$_REQUEST['toLat'],$_REQUEST['toLng']);
$fromtoLL=json_encode($fromtoLL);
$rt->setFromToLL($fromtoLL);
$line=json_encode($_REQUEST['line']);
$rt->setLine($line);
$rt->setDistance($_REQUEST['distance']);
$rt->setDuration($_REQUEST['duration']);
$rt->setPrice($_REQUEST['price']);
$vPrices=json_encode($_REQUEST['vPrices']);
$rt->setVPrices($vPrices);

$rt->saveAsNew();
$array=array();

$res = json_encode($array);
echo $_GET['callback'] . '(' . $res. ')';