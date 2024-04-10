<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

$keyValue = $_REQUEST['id'];

$fldList = array();
$out = array();

if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);

foreach ($db->fieldNames() as $name) {
	$content=$db->myreal_escape_string($_REQUEST[$name]);
	if(isset($_REQUEST[$name])) {
		eval("\$db->set".$name."(\$content);");	
	}
}
$message.=$db->getBody();
$message="_jtmsg_ \n".$message;
date_default_timezone_set("Europe/Paris");
$db->setSendTimeFirst(date("Y-m-d H:i:s"));
$db->setSendTimeLast(date("Y-m-d H:i:s"));
$db->setSendNumber(1);
$db->setStatus(1);
	
send($db->getPhone(),$message);
   
$upd = '';

if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}
if ($keyName != '' and $keyValue == '') {
	date_default_timezone_set("Europe/Paris");	
	if ($db->getScheduleTime()==0) $db->setScheduleTime(date("Y-m-d H:i:s"));		
	if (isset($_SESSION["UseDriverID"])) $db->setOwnerID($_SESSION["UseDriverID"]);	
	else $db->setOwnerID($_REQUEST["UserID"]);
	$db->setType(1);	
	$newID = $db->saveAsNew();
}

$out = array(
	'update' => $upd
);
# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	
	
function send($phone_to,$message) {
	// slanje poruke	
	$message=str_replace("<BR>","\n",$message);
	$message=str_replace("<br>","\n",$message);
	$message=str_replace("&nbsp;"," ",$message);
	$message=strip_tags($message);
	$message = preg_replace('/^[ \t]*[\r\n]+/m', '', $message);	
	require_once ROOT . '/db/v4_CoInfo.class.php';
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