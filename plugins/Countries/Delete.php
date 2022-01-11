<?
header('Content-Type: text/javascript; charset=UTF-8');
	require_once '../../config.php';

	# init libs
	require_once ROOT . '/db/v4_Countries.class.php';


	# init vars
	$out = array();


	# init class
	$db = new v4_Countries();

	# delete row by key value
	$db->deleteRow($_REQUEST['CountryID']);
	$out[] = 'Deleted';

	# send output back
	$output = json_encode($out);
	echo $_GET['callback'] . '(' . $output . ')';
	
