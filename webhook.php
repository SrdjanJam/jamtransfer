<?
require_once 'config.php';
require_once ROOT . '/db/v4_WAN.class.php';
$wn=new v4_WAN;
$data = file_get_contents("php://input");
$event = json_decode($data, true);
if(isset($event)){
	$event=json_decode($data)->data;
	$phone=str_replace("@c.us","",$event->from);
	if (getUserIDFromPhone($phone)) {
		$arr=explode("/",getUserIDFromPhone($phone));
		$wn->setOwnerID($arr[0]);
		$wn->setUserID($arr[1]);
		$wn->setBody($event->body);
		date_default_timezone_set("Europe/Paris");
		$wn->setScheduleTime(date("Y-m-d H:i:s"));
		$wn->setStatus("1");
		$wn->setDirection("2");
		$wn->saveAsNew();
	}
}