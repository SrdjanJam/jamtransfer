<?

/*
 * CRON JOB za dnevno slanje liste cash transfera vozacima
 * - salje se svaki dan u 8AM za sutrasnje transfere
 * - sadrzi listu svih dodijeljenih transfera u sljedeca 24h
 * - ne salje podsjetnik za transfere di je DriverID = 0
 * - ne salje podsjetnik vozacima koji nemaju email adresu
 */
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");

$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";

require_once $root . '/db/v4_OrderDetails.class.php';
require_once $root . '/db/v4_AuthUsers.class.php';
require_once $root . '/db/v4_CoInfo.class.php';


$db = new DataBaseMysql();
$od = new v4_OrderDetails();
$au = new v4_AuthUsers();

$transferKeys = array();
$driverKeys = array();
$dateToday = date('Y-m-d');
date_default_timezone_set('Europe/Zagreb');
$time = date('H:i');
$dateTomorrow = new DateTime('tomorrow');
$dateTomorrow = $dateTomorrow->format('Y-m-d');

// uzmi transfere u sljedeca 24h koja imaju drivera sa email adresom
$sql  = "SELECT * FROM v4_OrderDetails INNER JOIN v4_AuthUsers ON v4_OrderDetails.DriverID = v4_AuthUsers.AuthUserID ";
$sql .= "WHERE v4_OrderDetails.DriverID != 0 ";
$sql .= "AND PickupDate = '".$dateTomorrow."' ";
$sql .= "AND v4_AuthUsers.AuthUserMob != '' ";
$sql .= "AND TransferStatus != '3' "; // cancel
$sql .= "AND TransferStatus != '4' "; // temp
$sql .= "AND TransferStatus != '9' "; // deleted
$sql .= "AND PayLater>0 "; // cash, online+cash
$sql .= "AND v4_OrderDetails.DriverID not in (843,876,556) "; // cash, online+cash
$sql .= "ORDER BY v4_OrderDetails.DriverID ASC, PickupTime ASC";



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

// uzmi transfere za svakog drivera te slozi i posalji poruke
foreach ($driverKeys as $key) {
	$au->getRow($key);
	if ( $au->getAuthUserMail() != '') { // druga provjera, sql uvijet sam nije potpuno funkcionirao (primjer AuthUser 1664)
		$sql = "SELECT * FROM v4_OrderDetails WHERE (DriverID = " . $key . ") ";
		$sql .= "AND PickupDate = '".$dateTomorrow."' ";
		$sql .= "AND TransferStatus != '3' "; // cancel
		$sql .= "AND TransferStatus != '4' "; // temp
		$sql .= "AND TransferStatus != '9' "; // deleted
		$sql .= "AND PayLater>0 "; // cash, online+cash
		$sql .= "ORDER BY PickupTime ASC";
		$r = $db->RunQuery($sql);

		$transferKeys = array();
		while ($d = $r->fetch_object()) {
			$transferKeys[] = $d->DetailsID;
		}
		//$userPhone = "+381646413504";
		//$userPhone = "+381669236911";
		//$userPhone = "+381 60 310 8033";
		$userPhone = $au->getAuthUserMob();

		$messageW = 'ATTENTION! You need to charge for cash transfer for tomorrow ('.$dateTomorrow.'):<BR>';
		foreach ($transferKeys as $key) {
			$od->getRow($key);
			$messageW .= '*'.$od->getOrderID().'-'.$od->getTNo() . '* ' ;
			$messageW .=$od->getPickupTime().' '.$od->getPickupName().'-'.$od->getDropName().' CASH: '.$od->getPayLater().' EUR <br>';
		}

		$messageW .= 'Kind Regards,<br>JamTransfer';
		// END MAIL
		//send_whatsapp_message('+381646413504',$messageW);	
		//echo $userPhone."<br>".$messageW;
		if (!empty($userPhone)) send_whatsapp_message($userPhone,$messageW);				
	}
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

