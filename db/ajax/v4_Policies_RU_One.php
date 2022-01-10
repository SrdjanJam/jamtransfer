<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_Policies_RU.class.php';


	# init vars
	$out = array();


	# init class
	$db = new v4_Policies_RU();


	# filters

	$OwnerID = $_REQUEST['OwnerID'];

	# Details  red
	$db->getRow($OwnerID);

	# Details  red
	$db->getRow($dbk[0]);

	# get fields and values
	$detailFlds = $db->fieldValues();

	$out[] = $detailFlds;

	# send output back
	$output = json_encode($out);
	echo $_GET['callback'] . '(' . $output . ')';
	