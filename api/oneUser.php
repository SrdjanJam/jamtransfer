<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../config.php';
	# init libs
	require_once ROOT . '/db/db.class.php';
	require_once ROOT . '/db/v4_AuthLevels.class.php';
	require_once ROOT . '/lng/en_text.php';
	

	# init vars
	$out = array();

	# init class
	$al = new v4_AuthLevels();


	# filters

	$AuthUserID = $_REQUEST['AuthUserID'];


	# get fields and values
	$detailFlds = $users[$AuthUserID];
	//$pm=$detailFlds["AcceptedPayment"];
	//$detailFlds["AcceptedPaymentName"]=$AcceptedPayment[$pm];
	
	$AuthLevelID = $users[$AuthUserID]->AuthLevelID;
	$al->getRow($AuthLevelID);


	$detailFlds->AuthLevelName = $al->getAuthLevelName();

	$detailFlds->DBImage = '';

	$out[] = $detailFlds;
	# send output back
	$output = json_encode($out);
	echo $_GET['callback'] . '(' . $output . ')';
	//echo '<pre>'; print_r($out); echo '</pre>';
	
