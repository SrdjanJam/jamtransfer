<?
/*
 * CRON JOB za dnevno slanje podsjetnika kupcima
 * - salje se jednom dnevno
 * - za transfere kojima je PickupDate preksutra
 * - samo za JAM vozace
 */
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");

$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";

//require_once $root . '/db/db.class.php';
require_once $root . '/db/v4_OrderDetails.class.php';
require_once $root . '/db/v4_OrdersMaster.class.php';
require_once $root . '/db/v4_AuthUsers.class.php';
require_once $root . '/db/v4_CoInfo.class.php';
require_once $root . '/PHPMailer-master/PHPMailerAutoload.php';

$db = new DataBaseMysql();
$od = new v4_OrderDetails();
$om = new v4_OrdersMaster();
$au = new v4_AuthUsers();


date_default_timezone_set('Europe/Zagreb');

// preksutra
$dateTomorrow = new DateTime('tomorrow + 1 day');
$dateTomorrow = $dateTomorrow->format('Y-m-d');

$where = " WHERE NOT(`Image` is NULL or `Image`=' ') ";
$auk=$au->getKeysBy('AuthUserID','',$where);
$booking_system=implode(",", $auk);
// uzmi transfere koji se voze preksutra
$sql = "SELECT * FROM v4_OrderDetails ";

$sql .= "WHERE PickupDate = '".$dateTomorrow."' ";

$sql .= "AND TransferStatus != '3' ";
$sql .= "AND TransferStatus != '4' ";
$sql .= "AND TransferStatus != '5' ";
$sql .= "AND TransferStatus != '6' ";
$sql .= "AND TransferStatus != '9' ";

$sql .= "AND AgentID NOT IN (".$booking_system.")";
/*$sql .= "AND (";
$sql .= "DriverID = '556' OR ";
$sql .= "DriverID = '843' OR ";
$sql .= "DriverID = '876' OR ";
$sql .= "DriverID = '884' OR ";
$sql .= "DriverID = '885' OR ";
$sql .= "DriverID = '886' OR ";
$sql .= "DriverID = '887' OR ";
$sql .= "DriverID = '901' OR ";
$sql .= "DriverID = '902' OR ";
$sql .= "DriverID = '903' OR ";
$sql .= "DriverID = '907' OR ";
$sql .= "DriverID = '908' OR ";
$sql .= "DriverID = '1542' OR ";
$sql .= "DriverID = '1543' OR ";
$sql .= "DriverID = '1566' OR ";
$sql .= "DriverID = '1582'";
$sql .= ") ";*/
$sql .= "ORDER BY OrderID ASC, PickupDate ASC, PickupTime ASC";
$r = $db->RunQuery($sql);

$i = 0;

while ($d = $r->fetch_object()) {
    $om->getRow($d->OrderID);
    if($om->getMOrderID() == $d->OrderID) {

		$userEmail = trim( $om->getMPaxEmail() );
		$userPhone = $om->getMPaxTel();		
		
		//$userEmail = "jam.bgprogrameri@gmail.com";
		//$userPhone = "+381646413504";
		
		if($userEmail != '') { // ako je email prazan, ne salji nista
            // START MAIL
			$message = '<div style="width:1000px;margin:0 auto;border:solid 6px black;border-left:0;border-right:0;font-family:sans-serif"><div style="padding:12px;text-align:center"><img src="https://wis.jamtransfer.com/i/logo.png"></div>';
			
            $message .= '
                        <div style="font-family: sans-serif; font-size:14px;">
                        Dear '.$d->PaxName.',<br>
                        we just wish to remind You of Your transfer <strong>'.$d->OrderID. '-' . $d->TNo . '</strong>:<br>
                        <br>
                        From: <strong>'.$d->PickupName.'</strong>, '.$d->PickupAddress .'<br>
                        To &nbsp;&nbsp;&nbsp;: <strong>'.$d->DropName.'</strong>, '.$d->DropAddress.'<br>
                        <br>
                        Pickup Date: <strong>'.$d->PickupDate.'</strong><small> (Y-M-D)</small><br>
                        Pickup Time: <strong>'.$d->PickupTime.'</strong><small> (hours:minutes, 24h time format)</small><br>
                        <br>';
			if ($d->SubDriver>0 && !in_array($d->DriverID,array(843,876,556))) {
				$au->getRow($d->SubDriver);
				$message .= '	
                        Driver\'s Name: <strong>'.$au->getAuthUserRealName().'</strong><br>
                        Driver\'s Telephone: <strong>'.$au->getAuthUserMob().'</strong><br>
                        <br>';
			}	
            $message .= '<br>
                        <strong>If there are any last minute changes to your itinerary, please send an e-mail to 
                        <a href="mailto:info@jamtransfer.com">info@jamtransfer.com</a></strong><br>
                        <br>
                        Looking forward to meeting You!<br>
                        <br>
                        Kindest regards<br>
                        <br>
                        </div>
            ';            
			$messageW = 'Dear '.$d->PaxName.', we just wish to remind You of Your transfer ';
			$messageW .= $d->OrderID. '-' . $d->TNo .'<br>';
			$messageW .= 'From '.$d->PickupName.', '.$d->PickupAddress .'<br>';
			$messageW .= 'To '.$d->DropName.', '.$d->DropAddress.'<br>';
			$messageW .= 'Pickup Time is '.$d->PickupDate.' '.$d->PickupTime.'<br>';
			if ($d->SubDriver>0 && !in_array($d->DriverID,array(843,876,556))) {
				$au->getRow($d->SubDriver);
				$messageW .= '	
                        Driver\'s Name is '.$au->getAuthUserRealName().'<br>
                        Driver\'s Telephone is '.$au->getAuthUserMob().'<br>';
			}				
            $messageW .= 'Kindest regards<br>https://jamtransfer.com/';
						


            // END MAIL
			echo $userEmail."<br>".$message;
			//echo $userPhone."<br>".$messageW;
            //mail_html($userEmail, $message);			
			//if (!empty($userPhone) && in_array($d->PaymentMethod,array(2,3))) send_whatsapp_message($userPhone,$messageW);	
            //break; // samo za test, da ne idu svi mailovi
            $i++;
        } 
	} //endif

} // end while

//mail_html('info@jamtransfer.com', $i. ' Customer Reminder e-mails sent - ' . date("Y-m-d H:i:s") );

function mail_html($mailto, $message) {
	$mail = new PHPMailer;
	$mail->isHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->setFrom('cms@jamtransfer.com', 'JamTransfer.com');
	$mail->addReplyTo('info@jamtransfer.com', 'JamTransfer.com');
	$mail->Subject = 'JamTransfer - Transfer Reminder';

    //$mailto = 'bogo.split@gmail.com'; // just for testing
	
    $mail->addAddress($mailto);
	$mail->Body    = $message;

	if(!$mail->send()) {
		return 'Mailer Error: ' . $mail->ErrorInfo;
	} 
	//else {return 'OK';}
}

// whatsapp
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