<?

/*
 * CRON JOB za slanje liste transfera subdrajverima
 * - salje se svaki sat za transfere u naredna dva sata
 * - ne salje podsjetnik za transfere gde je SubdriverID = 0
 * - ne salje podsetnik vozacima koji nemaju telefon
 */
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");

$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";

require_once $root . '/db/v4_OrderDetails.class.php';
require_once $root . '/db/v4_AuthUsers.class.php';
require_once $root . '/db/v4_Places.class.php';
require_once $root . '/db/v4_CoInfo.class.php';
$db = new DataBaseMysql();
$od = new v4_OrderDetails();
$au = new v4_AuthUsers();
$pl = new v4_Places();

$where=" WHERE DriverID in (843,876,556)";
$auk=$au->getKeysBy("AuthUserID","",$where);
$jamdrivers=implode($auk,",");

$where= " WHERE `TransferStatus`=1 ";
$where.= "AND `DriverConfStatus`=3 ";
$where.= "AND `PickupDate`=curdate() ";
$where.= "AND `Subdriver`>0 ";
$where.= "AND `Subdriver` not in (".$jamdrivers.")";

$odk=$od->getKeysBy("DetailsID","",$where);
foreach ($odk as $key) {
	$od->getRow($key);
	$pl->getRow($od->getPickupID());
	if ($pl->getLongitude()<>0 and $pl->getLatitude()<>0) {
		date_default_timezone_set(get_nearest_timezone($pl->getLatitude(),$pl->getLongitude()));
		$time1 = date('H:i',time());
		$time2 =date('H:i',time()+3600*2);
		if ($od->getPickupTime()>$time1 and $od->getPickupTime()<$time2) {
			$au->getRow($od->getSubdriver());
			if ($au->getAuthUserMob()!="") {
				$userPhone = $au->getAuthUserMob();
				//$userPhone = "+381646413504";
				$userCode=md5($au->getAuthUserPass());
				$page="https://wis.jamtransfer.com/codeLogin.php?userCode=".$userCode."&userID=".$au->getAuthUserID();
				$messageW = 'You have scheduled transfer '.$od->getOrderID().'-'.$od->getTNo(). ' for '.$od->getPickupTime()."<br>";
				$messageW .= 'Login: '.$page.'<br>';	
				$messageW .= 'Kind Regards,<br>JamTransfer';
				//echo $userPhone."<br>".$messageW;
				send_whatsapp_message($userPhone,$messageW);				
			}
		}
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

function get_nearest_timezone($cur_lat, $cur_long, $country_code = '') {
    $timezone_ids = ($country_code) ? DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $country_code)
                                    : DateTimeZone::listIdentifiers();

    if($timezone_ids && is_array($timezone_ids) && isset($timezone_ids[0])) {

        $time_zone = '';
        $tz_distance = 0;

        //only one identifier?
        if (count($timezone_ids) == 1) {
            $time_zone = $timezone_ids[0];
        } else {

            foreach($timezone_ids as $timezone_id) {
                $timezone = new DateTimeZone($timezone_id);
                $location = $timezone->getLocation();
                $tz_lat   = $location['latitude'];
                $tz_long  = $location['longitude'];

                $theta    = $cur_long - $tz_long;
                $distance = (sin(deg2rad($cur_lat)) * sin(deg2rad($tz_lat))) 
                + (cos(deg2rad($cur_lat)) * cos(deg2rad($tz_lat)) * cos(deg2rad($theta)));
                $distance = acos($distance);
                $distance = abs(rad2deg($distance));
                // echo '<br />'.$timezone_id.' '.$distance; 

                if (!$time_zone || $tz_distance > $distance) {
                    $time_zone   = $timezone_id;
                    $tz_distance = $distance;
                } 

            }
        }
        return  $time_zone;
    }
    return 'unknown';
}