<?
/*
 * CRON JOB za slanje obavjesti vozacima da potvrde zavrsen transfer ako jos nisu 
 * - sadrzi listu nekompletiranih transfera do prekjuce 
 *   zajedno sa linkom na cms za not completed transfere
 * - ne salje podsjetnik za transfere di je driver = 0
 * - ne salje podsjetnik vozacima koji nemaju email adresu
*/
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");

$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";

//require_once $root . '/db/db.class.php';
require_once $root . '/db/v4_OrderDetails.class.php';
require_once $root . '/db/v4_AuthUsers.class.php';
require_once $root . '/PHPMailer-master/PHPMailerAutoload.php';
require_once $root . '/db/v4_CoInfo.class.php';


$db = new DataBaseMysql();
$od = new v4_OrderDetails();
$au = new v4_AuthUsers();

//echo 'START sending markCompleted';

$transferKeys = array();
$driverKeys = array();
$dateToday = date('Y-m-d');
date_default_timezone_set('Europe/Zagreb');
$time = date('H:i');
$dateTomorrow = new DateTime('tomorrow');
$dateTomorrow = $dateTomorrow->format('Y-m-d');

// uzmi nepotvrdjene transfere u sljedeca 24h koja imaju drivera sa email adresom
$sql = "SELECT * FROM v4_OrderDetails INNER JOIN v4_AuthUsers ON v4_OrderDetails.DriverID = v4_AuthUsers.AuthUserID ";
$sql .= "WHERE v4_OrderDetails.DriverID != 0 AND PickupDate <  (CURRENT_DATE)-INTERVAL 1 DAY  AND PickupDate >  (CURRENT_DATE)-INTERVAL 7 DAY  AND "; 
$sql .= "TransferStatus < '3' AND DriverConfStatus < '4' AND v4_AuthUsers.AuthUserMail != '' ";
$sql .= "ORDER BY v4_OrderDetails.DriverID ASC, PickupDate ASC, PickupTime ASC";
$r = $db->RunQuery($sql);

while ($d = $r->fetch_object()) {
	$transferKeys[] = $d->DetailsID;
}

// slozi drivere sa transferima u array
foreach ($transferKeys as $key) {
	$od->getRow($key);
	$au->getRow($od->getDriverID());
	if (end($driverKeys) != $od->getDriverID()) $driverKeys[] = $od->getDriverID();
}

// uzmi nepotvrdjene transfere za svakog drivere te slozi i posalji mailove
foreach ($driverKeys as $key) {
	$au->getRow($key);
	if ( $au->getAuthUserMail() != '') { // druga provjera, sql uvijet sam nije potpuno funkcionirao (primjer AuthUser 1664)
		$sql = "SELECT * FROM v4_OrderDetails WHERE DriverID = " . $key . " ";
		$sql .= " AND PickupDate <  (CURRENT_DATE)-INTERVAL 1 DAY AND PickupDate >  (CURRENT_DATE)-INTERVAL 7 DAY";
		$sql .= " AND TransferStatus < '3' AND DriverConfStatus < '4' ";
		$sql .= "ORDER BY PickupDate ASC, PickupTime ASC";
		$r = $db->RunQuery($sql);

        $transferKeys = array();
		while ($d = $r->fetch_object()) {
			$transferKeys[] = $d->DetailsID;
		}

        $userEmail = $au->getAuthUserMail();
		$userPhone = $au->getAuthUserMob();	
		$userCode=md5($au->getAuthUserPass());
		$page="https://wis.jamtransfer.com/codeLogin.php?userCode=".$userCode."&userID=".$au->getAuthUserID();
		 
		// START MAIL
		$message = '<div style="width:1000px;margin:0 auto;border:solid 6px black;border-left:0;border-right:0;font-family:sans-serif"><div style="padding:12px;text-align:center"><img src="https://wis.jamtransfer.com/i/logo.png"></div><div style="padding:24px 36px;background:#eee"><p>Dear partner '.$au->getAuthUserRealName().',</p>';
		$message.= '<p>Please <a href="'.$page.'">Login</a> and <b>MARK AS A COMPLETED</b> this transfers immediately:</p><table style="width:100%;margin:24px auto;border:solid 1px black;text-align:center"><tr><th>Order</th><th>Pickup</th></tr>';
		$messageW = 'Dear partner '.$au->getAuthUserRealName().', Please Login and *MARK AS A COMPLETED* this transfers immediately:<br>';
		$messageW.= $page."<br>";
		foreach ($transferKeys as $key) {
			$od->getRow($key);
			$message .= '<tr><td>'.$od->getOrderID().'-'.$od->getTNo().'</td>';
			$message .= '<td>'.$od->getPickupDate().' '.$od->getPickupTime().' - '.$od->getPickupName().' - '.$od->getDropName().'</td></tr>';
			$messageW .= '*'.$od->getOrderID().'-'.$od->getTNo() . '* ' ;
			$messageW .= $od->getPickupDate().' '.$od->getPickupTime().' - '.$od->getPickupName().'-'.$od->getDropName().'<br>';		
		}

		$message .= '</table><p>Kind Regards,<br>JamTransfer</p><p style="margin:24px 0 0;text-align:center;font-size:small">This is an automatically generated email, please do not reply to this message.</p></div></div>';
		$messageW .= 'Kind Regards,<br>JamTransfer';		
		// END MAIL

		//echo $userEmail. ' - '. $message;	
		
		mail_html($userEmail, $message); 
		if (!empty($userPhone)) send_whatsapp_message($userPhone,$messageW);						
    }
}

function mail_html($mailto, $message) {
	$mail = new PHPMailer;
	$mail->isHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->setFrom('cms@jamtransfer.com', 'Jam Transfer');
	$mail->addReplyTo('info@jamtransfer.com', 'Jam Transfer');
	$mail->Subject = 'JamTransfer - Not Completed Transfers';

	$mail->addAddress($mailto);
	$mail->Body    = $message;

	if(!$mail->send()) {
		return 'Mailer Error: ' . $mail->ErrorInfo;
	} 
	//else {return 'OK';}
}
// whatsapp
function getPhoneFromMail($mail) {
	$db = new DataBaseMysql();	
	$q = "SELECT * FROM v4_AuthUsers WHERE Active=1 AND AuthUserMob<>'' AND AuthUserMail = '".$mail."'  ORDER BY AuthUserID DESC";
	$w = $db->RunQuery($q);
	$d = $w->fetch_object();
	if (!is_null(gettype($d))) {
		if (count($d)==1) {
			$phone=str_replace(" ","",$d->AuthUserMob);
			$phone=str_replace("-","",$phone);
			$phone=str_replace("/","",$phone);
			return $phone;
		}	
	}
	else return false;
}	
function send_whatsapp_message($phone_to,$message) {
	$message=str_replace("<BR>","\n",$message);
	$message=str_replace("<br>","\n",$message);	
	$message=strip_tags($message);
	$message = preg_replace('/^[ \t]*[\r\n]+/m', '', $message);
	$message="_jtcjmsg_ \n".$message;	
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