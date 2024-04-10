<?
require_once 'config.php';
require_once ROOT . '/db/v4_WAN.class.php';
$wn=new v4_WAN;
$data = file_get_contents("php://input");
$event = json_decode($data, true);
if(isset($event)){
	$event=json_decode($data)->data;
	if (json_decode($data)->event_type=="message_received") $phone=str_replace("@c.us","",$event->from);
	else $phone=str_replace("@c.us","",$event->to);
	if (getUserIDFromPhone($phone)) {
		$arr=explode("/",getUserIDFromPhone($phone));
		$wn->setOwnerID($arr[0]);
		$wn->setUserID($arr[1]);
		$wn->setPhone($phone);
		$wn->setBody($event->body);
		date_default_timezone_set("Europe/Paris");
		$wn->setScheduleTime(date("Y-m-d H:i:s"));
		if (json_decode($data)->event_type=="message_received") {
			$wn->setStatus("1");
			$wn->setDirection("2");
			$wn->setType(3);	
		} else {
			$wn->setDirection("1");
			$wn->setStatus("1");
			$wn->setType(1);
		}
		$code_array=array("jtwismsg","jtcmsmsg","jtcjmsg","jtmsg");
		foreach ($code_array as $code) {
			$pos = strpos($event->body, $code);
			if ($pos) break;	
		}
		if (!$pos) $wn->saveAsNew();
	}
}