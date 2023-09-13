<?
/*
 * CRON JOB za slanje mail-ova
 * - salje se na svakih 5 minuta
 * - sadrzi listu neposlatih mail-ova
 */
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");
$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";
require_once $root . '/db/db.class.php';
require_once $root . '/db/v4_Mailer.class.php';
require_once $root . '/PHPMailer-master/PHPMailerAutoload.php';
$db = new DataBaseMysql();
$ml = new v4_Mailer();

$DB_Where = " WHERE Status=0 ";
$mlk = $ml->getKeysBy("MailID", "ASC" , $DB_Where);
if (count($mlk) != 0) {
    foreach ($mlk as $nn => $key)
    {
		$ml->getRow($key);
		$mail = new PHPMailer;
		$mail->isHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->setFrom($ml->getFromName());
		$mail->addReplyTo($ml->getReplyTo());
		$mail->Subject = $ml->getSubject();
		$mail->addAddress($ml->getToName());
		$mail->Body    = $ml->getBody();
		if(!$mail->send()) {
			return 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		$ml->setSentTime(date("Y-m-d h:i:s"));
		$ml->setStatus(1);
		$ml->saveRow();
	}
}	