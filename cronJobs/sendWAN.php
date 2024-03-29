<?
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");

$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";
//require_once $root . '/db/db.class.php';
require_once $root . '/db/v4_WAN.class.php';
require_once $root . '/db/v4_AuthUsers.class.php';
require_once $root . '/db/v4_CoInfo.class.php';

$db = new DataBaseMysql();
$wn = new v4_WAN();
$au = new v4_AuthUsers();

$DB_Where = " WHERE Status=0";
$wnk = $wn->getKeysBy("ID", '',$DB_Where);
if (count($wnk) != 0) {
    foreach ($wnk as $nn => $key)
    {
    	$wn->getRow($key);
		$message=$wn->getBody();
		$message.="\n";
		$message.="Confirm receipt of the note.\n";
		$message.="https://wis.jamtransfer.com/plugins/WAN/Confirm.php?id=".$key;
		$rule=explode("/",$wn->getSendRule());
		$ruleSendNumber=$rule[0];
		$ruleSendPeriod=$rule[1];
		if ($ruleSendNumber>$wn->getSendNumber()) {
			$minutes=$wn->getSendNumber()*$ruleSendPeriod." minutes" ;
			date_default_timezone_set("Europe/Paris");
			$timeplus=date('Y-m-d H:i:s',strtotime($minutes,strtotime($wn->getScheduleTime())));
			if (date("Y-m-d H:i:s")>$timeplus) {
				if ($wn->getSendNumber()==0) $wn->setSendTimeFirst(date("Y-m-d H:i:s"));
				$wn->setSendTimeLast(date("Y-m-d H:i:s"));
				$wn->setSendNumber($wn->getSendNumber()+1);
				$wn->saveRow();
				//echo $message;
				$au->getRow($wn->getUserID());
				$phone=$au->getAuthUserMob();
				send_whatsapp_message($phone,$message);
			}
		}	
    }
}
	
function send_whatsapp_message($phone_to,$message) {
	$message=str_replace("<BR>","\n",$message);
	$message=str_replace("<br>","\n",$message);	
	$message=strip_tags($message);
	$message = preg_replace('/^[ \t]*[\r\n]+/m', '', $message);
	$ci = new v4_CoInfo;
	$ci->getRow(3);
	$token=$ci->getco_facebook();
	$instance=$ci->getco_twitter();
	$params=array(
	'token' => $token,
	'to' => $phone_to,
	'body' => $message
	);
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.ultramsg.com/".$instance."/messages/chat",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_SSL_VERIFYHOST => 0,
	  CURLOPT_SSL_VERIFYPEER => 0,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => http_build_query($params),
	  CURLOPT_HTTPHEADER => array(
		"content-type: application/x-www-form-urlencoded"
	  ),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
}
	