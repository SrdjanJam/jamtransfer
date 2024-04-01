<?

require "../../config.php";
require_once 'Initial.php';

@session_start();


$DB_Where = " WHERE Status=0";
$dbk = $db->getKeysBy($ItemName, '',$DB_Where);

if (count($dbk) != 0) {
    foreach ($dbk as $nn => $key)
    {
    	$db->getRow($key);
		$message=$db->getBody();
		$message.="\n";
		$message.="Confirm receipt of the note.\n";
		$message.="https://wis.jamtransfer.com/plugins/WAN/Confirm.php?id=".$key;
		$phone=$users[$db->getUserID()]->AuthUserMob;
		$rule=explode("/",$db->getSendRule());
		$ruleSendNumber=$rule[0];
		$ruleSendPeriod=$rule[1];
		if ($ruleSendNumber>$db->getSendNumber()) {
			$minutes=$db->getSendNumber()*$ruleSendPeriod." minutes" ;
			$timeplus=date('Y-m-d H:i:s',strtotime($minutes,strtotime($db->getScheduleTime())));
			if (date("Y-m-d H:i:s")>$timeplus) {
				if ($db->getSendNumber()==0) $db->setSendTimeFirst(date("Y-m-d H:i:s"));
				$db->setSendTimeLast(date("Y-m-d H:i:s"));
				$db->setSendNumber($db->getSendNumber()+1);
				$db->saveRow();
				//echo $message;
				send_whatsapp_message($phone,$message);
			}
		}	
    }
}
	