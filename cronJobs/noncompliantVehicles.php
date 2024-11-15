<?
//cron_test();
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");

$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";

require_once $root.'/PHPMailer-master/PHPMailerAutoload.php';
require_once $root . '/db/v4_Vehicles.class.php';
require_once $root . '/db/v4_SubVehicles.class.php';
require_once $root . '/db/v4_AuthUsers.class.php';
$vh=new v4_Vehicles();
$sv=new v4_SubVehicles();
$au=new v4_AuthUsers();

$where1= " WHERE Active =1 and `OwnerID` not in (0,520,556,843,876) group by `OwnerID`";	
$svk=$sv->getKeysBy("OwnerID","",$where1);
//drajveri koji su unosili vozila
foreach($svk as $key) {
	$sv->getRow($key);	
	$owners[]=$sv->getOwnerID();
}	
$message="";	
$message.="<h3>IZBRISANI TIPOVI VOZILA</h3>";
foreach ($owners as $owner) {
	$where3= " WHERE Active =1 and VehicleTypeID>0 and `OwnerID`=".$owner;			
	$svk3=$sv->getKeysBy("OwnerID","",$where3);
	$drivertypes=array();
	foreach($svk3 as $key) {
		$sv->getRow($key);
		$drivertypes[]=$sv->getVehicleTypeID();
	}	
	if (count($drivertypes)>0) {
		$drivertypes=implode($drivertypes,",");
		$where4= " WHERE VehicleTypeID>0 and `OwnerID`=".$owner." AND VehicleTypeID not in (".$drivertypes.")";			
		$vhk=$vh->getKeysBy("OwnerID","",$where4);
		if (count($vhk)>0) {
			$au->getRow($owner);
			$message.=$owner."-".$au->getAuthUserRealName().": ";
			foreach($vhk as $key) {
				$vh->getRow($key);
				$message.=$vh->getVehicleTypeID()." ,";
			}
			$message.="<br>";
		}
	}
}
$message.="<h3>VOZILA NEPOVEZANA SA TIPOM</h3>";
foreach ($owners as $owner) {
	$where2= " WHERE Active =1 and `VehicleTypeID`=0 and `OwnerID`=".$owner;	
	$svk2=$sv->getKeysBy("OwnerID","",$where2);
	if (count($svk2)>0) {
		$au->getRow($owner);
		$message.=$owner."-".$au->getAuthUserRealName().": ";
		foreach($svk2 as $key) {
			$sv->getRow($key);
			$message.=$sv->getVehicleDescription()." ,";
		}
		$message.="<br>";
	}	
}
$from_mail="webmailtest@jamtransfer.com";
$from_name="JT REPORT";
$to_mail1="office@jamtransfer.com";
$subject = 'Neuskladjena vozila';
$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';	
$mail->setFrom($from_mail, $from_name);	
$mail->isHTML(true);								
$mail->Subject = $subject ;
$mail->Body    = $message ;
$mail->addAddress($to_mail1);		
if(!$mail->send()) { echo 'Mailer Error: ' . $mail->ErrorInfo;}
	

