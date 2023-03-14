<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

	# init vars
	$out = array();

	# filters

	$db->getRow($_REQUEST['ItemID']);

	# get fields and values
	$detailFlds = $db->fieldValues();

	# remove slashes 
	foreach ($detailFlds as $key=>$value) {
		$detailFlds[$key] = stripslashes($value);
	}
	$where=" WHERE MUserID=53 AND MOrderStatus not in (3,9) AND MPaxEmail = '".$detailFlds['CustEmail']."' ";
	$omk=$om->getKeysBy('MOrderID', 'ASC', $where);
	$countom=count($omk);
	$sumom=0;
	if ($omk>0) {
		foreach($omk as $key) {
			$om->getRow($key);
			$sumom+=$om->getMOrderPriceEUR();
		}	
	}
	$detailFlds['PersonalCode']="PC".substr(md5($detailFlds['CustEmail']),0,10);
	$detailFlds['ReservationNumber']=$countom;
	$detailFlds['ReservationValue']=number_format($sumom,2,'.',',');
	$detailFlds['Language']=$detailFlds['CustLanguage'];
	$out[] = $detailFlds;

	# send output back
	$output = json_encode($out);
	echo $output;
	