<? 

$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");

$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";

require_once $root . '/PHPMailer-master/PHPMailerAutoload.php';

function checkOnline($domain) {
   $curlInit = curl_init($domain);
   curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
   curl_setopt($curlInit,CURLOPT_HEADER,true);
   curl_setopt($curlInit,CURLOPT_NOBODY,true);
   curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

   //get answer
   $response = curl_exec($curlInit);

   curl_close($curlInit);
   if ($response) return true;
   return false;
}
$sites=array(
	'http://jamtransfer.com',
	'http://cms.jamtransfer.com',
	'http://wis.jamtransfer.com',
	'http://jamgroup.net',
	'http://taxicms.com',
	'http://taxido.net',
	'http://taxifrom.com',
	'http://villa-cezar.com',
	'http://jamyachtsupply.com',
	'http://taxigenevaairport.com',
	'http://taxiviennaairport.com',
	'http://taximilanairport.com',
	'http://taxiniceairport.com',
	'http://taxiturinairport.com',
	'http://taxibergamoairport.com',
	'http://transfersplitairport.com',
	'http://taxisplitairport.com'
);
$body = "Testiranje funkcionisanja sajtova Jam grupe za ". date("m.d.y h:i:sa").".\r\n";
$body .= "Proveriti sledeće sajtove:". ".\r\n";
$wrong=false;
foreach ($sites as $s) {
	if(!checkOnline($s)) { 
		$body .= $s. ".\r\n";
		$wrong=true;
	}
}	
if ($wrong) {
	$from_mail="webmailtest@jamtransfer.com";
	$from_name="JT TEST";
	$to_mail1="test@jamtransfer.com";
	$to_mail2="jam.bgprogrameri3@gmail.com";
	 
	$subject = 'Test sajtova: '.$from_mail. ' at '. date("m.d.y h:i:sa");
	$mail = new PHPMailer;
	$mail->CharSet = 'UTF-8';	
	$mail->setFrom($from_mail, $from_name);	
	$mail->isHTML(true);										// Set email format to HTML

	$mail->Subject = 'Test mail: '.$from_mail ;
	$mail->Body    = $body."<br>".$from_mail ;
	$mail->addAddress($to_mail1);		
	$mail->addAddress($to_mail2);		
	if(!$mail->send()) { echo 'Mailer Error: ' . $mail->ErrorInfo;}
}
?>
