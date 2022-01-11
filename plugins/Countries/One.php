<?
header('Content-Type: text/javascript; charset=UTF-8');

 
	# init libs
	require_once '../../config.php';
	require_once ROOT . '/db/v4_Countries.class.php';


	# init vars
	$out = array();


	# init class
	$db = new v4_Countries();


	# filters

	$CountryID = $_REQUEST['CountryID'];

	# Details  red
	$db->getRow($CountryID);

	# get fields and values
	$detailFlds = $db->fieldValues();

    
    # remove slashes 
    foreach ($detailFlds as $key=>$value) {
        $detailFlds[$key] = stripslashes($value);
    }


	$out[] = $detailFlds;

	# send output back
	$output = json_encode($out);
	echo $_GET['callback'] . '(' . $output . ')';
	