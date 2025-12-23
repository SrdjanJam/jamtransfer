<?

$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");
$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";
require_once $root . '/db/db.class.php';
require_once $root . '/PHPMailer-master/PHPMailerAutoload.php';

// promeniti naziv html file-a, subject-a i tabele
$html="egzotika-newsletter-2025";
$subject="Ponuda egzotičnih destinacija za Turističke Agencije - Sezona 2025/26";

$table="agentsSerbia";
$qa  = "SELECT * FROM ".$table." WHERE send=0 LIMIT 5";
$db = new DataBaseMysql();

$wa = $db->RunQuery($qa);
while($ag = $wa->fetch_object()) {

	$ag->AuthUserMail;
	$adress[]=$ag->AuthUserMail;
}


// za test
/*$adress=array(
	"jam.bgprogrameri@gmail.com",
	"jam.vesna.paunovic@gmail.com",
	"jam.luka.tosic@gmail.com"
	//"it@jamtransfer.com",
	//"srdjan.petrovic@jamtransfer.com"
);*/




ob_start();
	require_once $root . '/cronJobs/newsletters/'.$html.'.html';
	$output = ob_get_contents();
ob_end_clean();	
foreach ($adress as $adr) {
	$mail = new PHPMailer;
	$mail->isHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->setFrom("cms@jamtransfer.com","jamtransfer.com");
	$mail->addReplyTo("office@jamtransfer.com");
	$mail->Subject = $subject;

	$mail->addAddress($adr);
	
	$mail->Body    = $output;
	if(!$mail->send()) { echo 'Mailer Error: ' . $mail->ErrorInfo;}
	else {
		echo $q="UPDATE ".$table." SET `send`=1 WHERE `AuthUserMail`='".$adr."'";
		$db->RunQuery($q);
	}	
}
		