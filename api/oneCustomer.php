<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../config.php';
require_once ROOT . '/db/v4_Customers.class.php';
# init vars
$cu = new v4_Customers();
$cu->getRow($_REQUEST['CustID']);
$detailFlds = array();
$detailFlds['CustName'] = $cu->getCustFirstName()." ".$cu->getCustLastName();
$detailFlds['Level'] = $cu->getLevelID();

$out[] = $detailFlds;
# send output back
$output = json_encode($out);
echo $_GET['callback'] . '(' . $output . ')';

