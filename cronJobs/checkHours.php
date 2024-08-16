<?php
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");

$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";
require_once $root . '/db/v4_OfficeHours.class.php';
require_once $root . '/db/v4_LogUser.class.php';
$oh=new v4_OfficeHours();
$lu=new v4_LogUser();
date_default_timezone_set('Europe/Paris');
$message1="You have not logged into the system today. Log in. Thank you.";
$where= " WHERE WorkDate='".date("Y-m-d",time())." '";	
$ohk=$oh->getKeysBy("ID","",$where);
if (count($ohk)>0) {
	foreach ($ohk as $key) {
		$oh->getRow($key);
		$userid=$oh->getUserID();
		$begin=$oh->getBegin();
		$end=$oh->getEnd();
		$where1= " WHERE DATE(`DateTime`)='".date("Y-m-d",time())."' and Type=1 and AuthUserID=".$userid;
		$luk=$lu->getKeysBy("ID","",$where1);
		if (count($luk)==0) {
			if ($begin<date('H:i:s',time())) {
				//echo $users[$userid]->AuthUserRealName;
				
				$phone=$users[$userid]->AuthUserMob;
				send_whatsapp_message($phone,$message1);
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

