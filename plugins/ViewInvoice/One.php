<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

	# init libs
	require_once ROOT . '/db/v4_Invoices.class.php';
	

	# init vars
	$out = array();

	# init class
	$db = new v4_Invoices();

	# filters
	$db->getRow($_REQUEST['ItemID']);

	# get fields and values
	$detailFlds = $db->fieldValues();
 	
	
	$out[] = $detailFlds;

	# send output back
	$output = json_encode($out);
	echo $_GET['callback'] . '(' . $output . ')';
	