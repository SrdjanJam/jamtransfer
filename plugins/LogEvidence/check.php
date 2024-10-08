<?php
require_once "../../config.php";
require_once ROOT . '/db/v4_OfficeHours.class.php';
require_once ROOT . '/db/v4_LogUser.class.php';
require_once ROOT . '/db/v4_AuthUsers.class.php';

$oh=new v4_OfficeHours();
$lu=new v4_LogUser();
$au=new v4_AuthUsers();

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
						$phone1=$au->getAuthUserMob();
						send_whatsapp_message($phone1,$message1);
						$oh->setStatus(1);
						break;					
					case 1:
						if ($au->getAuthLevelID()!=32) $phone2="+381669236911";
						else $phone2="+381646597200";
						$message2.="<br>".$au->getAuthUserRealName();
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
					case 4:
						if ($au->getAuthLevelID()==32) {
							$phone4="+385915375842";
							$message2.="<br>".$au->getAuthUserRealName();
							send_whatsapp_message($phone4,$message2);
							$oh->setStatus(5);
							break;
						}
				}		
				$oh->saveRow();		
			}	
		}
	}
}



