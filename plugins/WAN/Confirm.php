<?
require_once 'Initial.php';
	
$keyValue = $_REQUEST['id'];
$fldList = array();
$out = array();
if ($keyValue != '') {
	$db->getRow($keyValue);
	if ($db->getStatus()==0) {
		$db->setStatus(1);	
		$db->setConfirmTime(date("Y-m-d H:i:s"));	
		$db->saveRow();	
		echo "<h3 style='font-size:6em;'>You have just confirmed receipt of this WhatsApp note:</h3><h1 style='font-size:6em;'>".$db->getBody()."</h1>";
	} else {
		echo "<h1 style='font-size:4em;'>This whatsapp note is already confirmed !</h1>";
	}	
}	
else echo "<h1>Something wrong</h1>";