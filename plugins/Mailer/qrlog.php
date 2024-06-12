<?php

require_once 'config.php';
	include  ROOT . '/common/class/qrcode.php';

$options=array();
$options['h']="500px";
$options['w']="500px";
$options['s']="qrq";
	$generator = new QRCode("https://wis.jamtransfer.com/", $options);

	/* Output directly to standard output. */
	$generator->output_image();

	/* Create bitmap image. */
	$image = $generator->render_image();
	imagepng($image);
	imagedestroy($image);
	
?>
<?php
exit();

// Requires libcurl

const key = "fa404096-f934-440f-b294-bced97af6768";
const secret = "JFctbNvHUU+gdUzBtWgnbA==";
const to = "+381646413504";
const fromNumber = "+447520652398";
const locale = "en-US";

$payload = [
  "method" => "ttsCallout",
  "ttsCallout" => [
    "cli" => fromNumber,
    "destination" => [
      "type" => "number",
      "endpoint" => to
    ],
    "locale" => locale,
    "text" => "Hello, this is a test call from Jam Transfer Belgrade office!"
  ]
];

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "Authorization: Basic " . base64_encode(key . ":" . secret)
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


exit();

require_once 'config.php';
require_once ROOT . '/db/v4_Mailer.class.php';
$ml=new v4_Mailer;
	
	//$email="office@jamtransfer.com"; 
	$email="srdjan.petrovic@jamtransfer.com";
	//$pass="IRM86bk^GDu6";
	$pass="nKtGsd0J;UXK";
	$range="SINCE ".date('Y-m-d',strtotime("-1 days"));;
	$imap = imap_open('{mail.jamtransfer.com:993/imap/ssl}INBOX', $email, $pass);
	// Retrieve the incoming mail	// Retrieve the incoming mail
	$messages = imap_search($imap,$range);
	foreach ($messages as $message) {
		// Get the message header
		$structure = imap_fetchstructure($imap, $message);
		$mail_row = imap_headerinfo($imap, $message);
		$part = $structure->parts[1];
		$body=imap_fetchbody($imap, $message, 1);
		if($part->encoding == 3) {
			$mail_row->body = imap_base64($body);
			$mail_row->subject = imap_base64($mail_row->subject);
		} else if($part->encoding == 1) {
			$mail_row->body = imap_8bit($body);
			$mail_row->subject = imap_8bit($mail_row->subject);
		} else {
			$mail_row->body = imap_qprint($body);
			$mail_row->subject = imap_qprint($mail_row->subject);			
		}
		
		$where=" WHERE CreateTime='".getMailDate($mail_row->udate)."' AND FromName='".getEmailAddress($mail_row->from)."' ";
		$mlkeys=$ml->getKeysBy("MailID", "ASC", $where);
		if (count($mlkeys)==0) {
			$ml->setCreateTime(getMailDate($mail_row->MailDate));
			$ml->setSentTime(getMailDate($mail_row->Date));
			$ml->setSubject($mail_row->subject);
			$ml->setBody($mail_row->body);
			$ml->setDirection(2);
			$ml->setStatus(1);
			$ml->setFromName(getEmailAddress($mail_row->from));
			$ml->setToName(getEmailAddress($mail_row->to));
			$ml->setReplyTo(getEmailAddress($mail_row->to));
			$ml->setCreateTime(getMailDate($mail_row->udate));
			$ml->setSentTime(getMailDate($mail_row->udate));
			$ml->setCreatorID(getUserIDFromMail(getEmailAddress($mail_row->from)));			
			$ml->saveAsNew();
		}
	}	
	imap_close($imap);	

	function getEmailAddress($mail) {
		$mail=$mail[0];
		$mail=$mail->mailbox."@".$mail->host;
		return $mail;		
	}	
	
	function getMailDate($date) {
		date_default_timezone_set("Europe/Paris");
		$date=date("Y-m-d H:i:s",$date);
		return $date;		
	}	
