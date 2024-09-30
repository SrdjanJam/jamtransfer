<?php
require_once '../config.php';
require_once ROOT . '/db/v4_OrdersMaster.class.php';
require_once ROOT . '/db/v4_OrderDetails.class.php';
require_once ROOT . '/db/v4_AuthUsers.class.php';
$om=new v4_OrdersMaster;
$od=new v4_OrderDetails;
$au=new v4_AuthUsers;
if (isset($_REQUEST['order_key'])) {
	$where=" WHERE MOrderKey='".$_REQUEST['order_key']."'";
	$omk=$om->getKeysBy('MOrderID','',$where);
	if (count($omk)==1) {
		$om->getRow($omk[0]);
		$OrderID=$om->getMOrderID();
		$where2=" WHERE OrderID=".$OrderID;
		$odk=$od->getKeysBy('DetailsID','',$where2);
		if (count($odk)>0) {
			foreach($odk as $key) {
				$od->getRow($key);
				$DetailsIDs[]=$od->getDetailsID();
				$au->getRow($od->getDriverID());
				$phone=$au->getAuthUserMob();
			}	
			$message="Hello! We have new transfers for you. Please Confirm or Decline these transfers immediately using the link(s) below:<br>";
			foreach($DetailsIDs as $detailid) { 
				$message.="https://wis.jamtransfer.com/dc.php?code=".$detailid."&control=".$_REQUEST['order_key']."&id=".$od->getDriverID()."<br>";
			}
			$message.="Thank you!";
			send_whatsapp_message($phone,$message);
		}
	}
}	
