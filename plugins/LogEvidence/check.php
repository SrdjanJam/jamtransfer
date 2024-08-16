<?php
/*
	AJAX Script !!!!
*/
require_once "../../config.php";
require_once ROOT . '/db/v4_OfficeHours.class.php';
require_once ROOT . '/db/v4_LogUser.class.php';
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



