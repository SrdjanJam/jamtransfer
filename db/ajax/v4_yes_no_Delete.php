
<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_yes_no.class.php';


	# init vars
	$out = array();


	# init class
	$db = new v4_yes_no();

	# delete row by key value
	$db->deleteRow($_REQUEST['dn_broj']);
	$out[] = 'Deleted';

	# send output back
	$output = json_encode($out);
	echo $_GET['callback'] . '(' . $output . ')';
	