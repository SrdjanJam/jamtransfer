<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
	require_once ROOT . '/db/v4_Extras.class.php';
	$ex = new v4_Extras();

	$out = array();
	# Details  red
	$db->getRow($_REQUEST['ItemID']);
	# get fields and values
	$detailFlds = $db->fieldValues();
	# remove slashes 
	foreach ($detailFlds as $key=>$value) {
		$detailFlds[$key] = stripslashes($value);
	}
	$detailFlds['setting']=false;		
	if (isset($_SESSION['UseDriverID']) && $_SESSION['UseDriverID']>0) {
		$id=$db->getID();
		$keys=$ex->getKeysBy('ID', '', ' WHERE ServiceID='.$id.' AND OwnerID='.$_SESSION['UseDriverID']);		
		if (count($keys)>0) $detailFlds['setting']=true;	
	}	
	$out[] = $detailFlds;
	# send output back
	$output = json_encode($out);
	echo $_GET['callback'] . '(' . $output . ')';