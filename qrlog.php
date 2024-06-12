<?php
require_once 'config.php';
if (isset($_REQUEST['sid'])) {
	require_once ROOT . '/db/v4_LogUser.class.php';
	$lu = new v4_LogUser();
	$luk = $lu->getKeysBy('ID', '' , " WHERE `SessionID`='".$_REQUEST['sid']." AND Type>2'");
	if (count($luk)>0) {
		$lu->getRow($luk[0]);
		$lu->setType($lu->getType()-2);
		$lu->saveRow();
		echo "<h1>LOGIN APPROVED</h1>";
	}	
}	else {
	include  ROOT . '/common/class/qrcode.php';
	$options=array();
	$options['h']="500px";
	$options['w']="500px";
	$options['s']="qrq";
	$generator = new QRCode("https://wis.jamtransfer.com/qrlog.php?sid=".session_id(), $options);
	$generator->output_image();
	$image = $generator->render_image();
	imagepng($image);
	imagedestroy($image);
}	
?>
