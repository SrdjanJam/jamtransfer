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
	$where=" WHERE CustomerID=".$db->getCustID()." ";
	$odk=$od->getKeysBy('OrderID', 'ASC', $where);
	$transfers=array();
	if ($odk>0) {
		foreach($odk as $key) {
			$od->getRow($key);
			$transfersrow = array(
					"TransferID" => $od->getDetailsID(),
					"TransferText" => $od->getOrderID().'-'.$od->getTNo()
			);
			$transfers[]=$transfersrow;
		}	
	}
	$detailFlds['transfers']=$transfers;
	$detailFlds['PersonalCode']="PC".substr(md5($detailFlds['CustEmail']),0,10);
	$detailFlds['Language']=$detailFlds['CustLanguage'];
	$out[] = $detailFlds;

	# send output back
	$output = json_encode($out);
	echo $output;
	