<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';


	# init vars
	$out = array();


	# filters

	// Old:
	// $ID = $_REQUEST['ID'];

	// # Details  red
	// $db->getRow($ID);

	// # Details  red
	// $db->getRow($dbk[0]);

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
	echo $output;
	