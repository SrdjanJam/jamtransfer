<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

$out = array();

# delete row by key value
$db->deleteRow($_REQUEST['ID']);
$out[] = 'Deleted';

if ($_SESSION['AuthLevelID']==31) {
	$mailto="jam.bgprogrameri@gmail.com";
	$from_mail="cms@jamtransfer.com";
	$from_name="System mail";
	$replyto="";
	$subject="Driver delete subdriver";
	$attachment = '';
	$whatsapp = 0;
	$message=$_SESSION['AuthUserID']."-".$_SESSION['UserRealName']." delete subdriver ".$_REQUEST['ID'];
	mail_html_send($mailto, $from_mail, $from_name, $replyto, $subject, $message, $attachment, $whatsapp);
}

# send output back
$output = json_encode($out);
echo $_GET['callback'] . '(' . $output . ')';