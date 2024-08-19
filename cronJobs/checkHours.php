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
$where= " WHERE WorkDate='".date("Y-m-d",time())." '";	
$ohk=$oh->getKeysBy("ID","",$where);
if (count($ohk)>0) {
	foreach ($ohk as $key) {
		$message1="You have not logged into the system today. Log in. Thank you.";
		$message2="Employee not logged into the system today. Thank you.";		
		$oh->getRow($key);
		$userid=$oh->getUserID();
		$begin=$oh->getBegin();
		$end=$oh->getEnd();
		$where1= " WHERE DATE(`DateTime`)='".date("Y-m-d",time())."' and Type=1 and AuthUserID=".$userid;
		$luk=$lu->getKeysBy("ID","",$where1);
		if (count($luk)==0) {
			if ($begin<date('H:i:s',time())) {
				//echo $users[$userid]->AuthUserRealName;
				switch ($oh->getStatus()) {
					case 0:
						$phone1=$users[$userid]->AuthUserMob;
						send_whatsapp_message($phone1,$message1);
						$oh->setStatus(1);
						break;					
					case 1:
						$phone2="+381669236911";
						$message2.="<br>".$users[$userid]->AuthUserRealName;
						$message2.="<br>Confirm receipt at: https://wis.jamtransfer.com/plugins/LogEvidence/confirmReceipt.php?id=".$key;
						send_whatsapp_message($phone2,$message2);
						$oh->setStatus(2);
						break;					
					case 2:
						$phone3=$users[$userid]->AuthUserMob;
						$message3="Hello. This is a generated call from Jam Transfer. You have not logged into the system today. Log in. Thank you.";
						send_whatsapp_message($phone3,$message3);
						//phoneCall($phone3,$message3);
						$oh->setStatus(4);
						break;
				}
				$oh->saveRow();		
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

function phoneCall($phone,$message) {
	$key = "fa404096-f934-440f-b294-bced97af6768";
	$secret = "JFctbNvHUU+gdUzBtWgnbA==";
	$to = $phone;
	//$fromNumber = "+447520652398";
	$fromNumber = "+447441421833";
	$locale = "en-US";
	$payload = [
	  "method" => "ttsCallout",
	  "ttsCallout" => [
		"cli" => $fromNumber,
		"destination" => [
		  "type" => "number",
		  "endpoint" => $to
		],
		"locale" => $locale,
		"text" => $message
	  ]
	];
	$curl = curl_init();
	curl_setopt_array($curl, [
	  CURLOPT_HTTPHEADER => [
		"Content-Type: application/json",
		"Authorization: Basic " . base64_encode($key . ":" . $secret)
	  ],
	  CURLOPT_POSTFIELDS => json_encode($payload),
	  CURLOPT_URL => "https://calling.api.sinch.com/calling/v1/callouts",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_CUSTOMREQUEST => "POST",
	]);
	$response = curl_exec($curl);
	$error = curl_error($curl);
	curl_close($curl);
	if ($error) {
	  echo "cURL Error #:" . $error;
	} else {
	  echo $response;
	}
}
