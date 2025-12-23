<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

$out = array();
# Details  red
$db->getRow($_REQUEST['ItemID']);
# get fields and values
$detailFlds = $db->fieldValues();
$detailFlds["DBImage"]='';


# remove slashes 
foreach ($detailFlds as $key=>$value) {
	$detailFlds[$key] = stripslashes($value);
}
$detailFlds['Deleted']=0;
$detailFlds['userCode']= md5($db->getAuthUserPass());

if ($db->getAuthLevelID()==2) {
	$where=" WHERE AgentID=".$db->getAuthUserID()." ";
	$odk=$od->getKeysBy('OrderID', 'ASC', $where);
	$transfers=array();
	if ($odk>0) {
		foreach($odk as $key) {
			$od->getRow($key);
			$transfersrow = array(
					"TransferID" => $od->getDetailsID(),
					"TransferText" => $od->getOrderID().'-'.$od->getTNo(),
					"OrderDate" => $od->getOrderDate(),
					"PickupDate" => $od->getPickupDate(),
					"PickupName" => $od->getPickupName(),
					"DropName" => $od->getDropName(),
					"DetailPrice" => $od->getDetailPrice(),
					"StatusDescription" => $StatusDescription[$od->getTransferStatus()] 
			);
			$transfers[]=$transfersrow;
		}	
	}
}
$detailFlds["transfers"]=$transfers;

$out[] = $detailFlds;
# send output back
$output = json_encode($out);
echo  $output;