<?
/*
 * CRON JOB za pravljenje notifikacije o nezavrsenim bukinzima
 * - datum bookinga danas, do pre pola sata
 */

define("NL", "<br>");
define("B", " ");
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");

$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";

//require_once $root . '/db/db.class.php';
require_once $root . '/db/v4_Notifications.class.php';
require_once $root . '/db/v4_AuthUsers.class.php';
require_once $root . '/lng/en.php';

$db = new DataBaseMysql();
$nt = new v4_Notifications();
$au = new v4_AuthUsers();

$timeFrom=date("H:i:s",time()-45*60);
$timeTo=date("H:i:s",time()-15*60);
$query="SELECT `OrderDate`,`UserID`,`PickupName`,`DropName`,`PickupDate`,`PickupTime` 
	FROM `v4_OrderDetailsTemp` WHERE `UserID`>0 and `OrderID` in 
		(SELECT MOrderID FROM `v4_OrdersMasterTemp` 
			WHERE  `MOrderDate`=CURDATE()
			and `MOrderTime`>'".$timeFrom."' and `MOrderTime`< '".$timeTo."'
			and `MUserLevelID` in (2,3) and `MUserID` not in (0,53) and `MOrderKey` not in 
				(SELECT `MCardNumber` FROM `v4_OrdersMaster` WHERE `MCardNumber`>0))";
$od = $db->RunQuery($query);
$recivers=array(3091,3269,2899,3409,3421,2864,2322);
while($odk = $od->fetch_object()) {
		$au->getRow($odk->UserID);
		$message="Unfinished booking: User ". $au->getAuthUserRealName() ."; ".$odk->PickupName." - ".$odk->DropName.
			" for ".$odk->PickupDate." ".$odk->PickupTime;
		// slanje notifikacije
		$nt->setMessage($message);
		//$nt->setCNotificationID();
		//$nt->setSenderID();
		$nt->setNotificationType(5);
		$nt->setDateToSend(date("Y-m-d"));
		$nt->setTimeToSend(date("H:s:i"));
		foreach ($recivers as $r) {
			$nt->setUserID($r);
			$nt->saveAsNew();	
		}	


}

