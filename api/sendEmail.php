<?
header('Content-Type: text/javascript; charset=UTF-8');
session_start();
require_once '../config.php';
$from_name = 'JamTransfer.com';
$from = 'info@jamtransfer.com';	
$to = $_REQUEST['to'];
$subject 	= $_REQUEST['subject'];
$message 	= $subject . '<br><br>Message:<br><br>'.$_REQUEST['message'];
$OrderID 	= $_REQUEST['OrderID'];
$TNo		= $_REQUEST['TNo'];
if ($_REQUEST['message'] != '' and $to != '') mail_html($to, $from, $from_name, $from, $subject, $message);
$output = '<span class="badge bg-green"><i class="ic-happy"></i> Message sent. </span>';
echo $_GET['callback'] . '(' . json_encode($output) . ')';	

