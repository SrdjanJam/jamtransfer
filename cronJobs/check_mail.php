<?
//cron_test();
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");

$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";

	require_once $root.'/PHPMailer-master/PHPMailerAutoload.php';
	//require_once $root.'f/f.php';

//cron_test();

	$from_mail="webmailtest@jamtransfer.com";
	$from_name="JT TEST";
	$to_mail1="test@jamtransfer.com";
	$to_mail2="jam.bgprogrameri@gmail.com";
	$to_mail3="jam.bgprogrameri@yahoo.com";
	$to_mail4="jam.bgprogrameri@outlook.com";
	$to_mail5="jam.bgprogrameri3@gmail.com";

	 
	$subject = 'Test mail: '.$from_mail. ' at '. date("m.d.y h:i:sa");
	$body = "Testiranje funkcionisanja mail saobracaja za ". date("m.d.y h:i:sa").".\r\n";
	$body .= "U slučaju blokade kontakt je https://unlimited.rs/kontakt/". ".\r\n";
	$body .= "PIN za podršku je 93649";
	
	
	$mail = new PHPMailer;
	$mail->CharSet = 'UTF-8';	
	$mail->setFrom($from_mail, $from_name);	
	$mail->isHTML(true);										// Set email format to HTML

	$mail->Subject = 'Test mail: '.$from_mail ;
	$mail->Body    = $body."<br>".$from_mail ;
	$mail->addAddress($to_mail1);		
	$mail->addAddress($to_mail2);		
	$mail->addAddress($to_mail3);		
	$mail->addAddress($to_mail4);		
	if(!$mail->send()) { echo 'Mailer Error: ' . $mail->ErrorInfo;}
	//else { echo 'OK'; }
	
	//mail_html($to_mail1, $from_mail, $from_name, 'info@jamtransfer.com', $subject , $body);

function cron_test() {	
	$crontext = "Cron Run at ".date("r")." by ".$_SERVER['USER']."\n" ;
	$folder = substr($_SERVER['SCRIPT_FILENAME'],0,strrpos($_SERVER['SCRIPT_FILENAME'],"/")+1);
	$filename = $folder."cron_test.txt" ;
	$fp = fopen($filename,"a") or die("Open error!");
	fwrite($fp, $crontext) or die("Write error!");
	fclose($fp);
	echo "Wrote to ".$filename."\n\n" ;	
}