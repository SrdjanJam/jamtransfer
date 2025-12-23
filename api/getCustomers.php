<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../config.php';
require_once '../db/v4_Customers.class.php';
$cu = new v4_Customers();
$where = " WHERE CustActive=1";
$cuk=$cu->getKeysBy("CustFirstName","",$where);
$out = array();
foreach($cuk as $key) {
	$cu->getRow($key);
	$out[] = array(
				'CustID'			=> $cu->getCustID(), 
				'CustFirstName'		=> $cu->getCustFirstName(), 
				'CustLastName'		=> $cu->getCustLastName(), 
				'CustMobile' 		=> $cu->getCustMobile(),
				'CustEmail' 		=> $cu->getCustEmail()
	);
}


# send output back
$output = json_encode($out);

unset($out);
echo $_REQUEST['callback'] . '(' . $output . ')';


