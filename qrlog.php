<?php
require_once 'config.php';
require_once ROOT . '/db/v4_AuthUsers.class.php';
$au = new v4_AuthUsers();

if (isset($_REQUEST['pid'])) {
	
	$au->getRow($_REQUEST['pid']);
			?>
				<script>
					function setCookie(key, value, expiry) {
						var expires = new Date();
						expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
						document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
					}
					function getCookie(key) {
						var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
						return keyValue ? keyValue[2] : null;
					}
					function eraseCookie(key) {
						var keyValue = getCookie(key);
						setCookie(key, keyValue, '-1');
					}
					if (getCookie('code')==null) {
						setCookie('code','<?=md5($au->getAuthUserPass()) ?>','100');
					}	
					if (getCookie('code')=='<?=md5($au->getAuthUserPass()) ?>') {
						alert ("Cookie setted on");
						<?
							$au->setTemp_pass(md5($au->getAuthUserPass()));
							$au->saveRow();
						?>
					}					
				</script>	
			<?		
	
	
	
	
	
	
	echo "<img width='500px' src='".ROOT_HOME."/i/logo.png' />";
	/*$ip = $_SERVER['REMOTE_ADDR'];
	if ($ip<>"91.150.99.84") echo "<h1>SOMETHING WRONG / NOT CONNECTED ON WI-FI</h1>";
	else {
		require_once ROOT . '/db/v4_LogUser.class.php';
		$lu = new v4_LogUser();
		$luk = $lu->getKeysBy('ID', '' , " WHERE `SessionID`='".$_REQUEST['sid']."' AND Type>2");
		if (count($luk)>0) {
			$lu->getRow($luk[0]);
			require_once ROOT . '/db/v4_AuthUsers.class.php';
			$au = new v4_AuthUsers();
			$au->getRow($lu->getAuthUserID());
			//$lu->setType($lu->getType()-2);
			//$lu->saveRow();	
			echo "<h1>LOGIN / LOGOUT APPROVED</h1>";
		} else echo "<h1>SOMETHING WRONG / YOU ARE ALREADY LOGGED</h1>";
	}*/
}	
else {
	include  ROOT . '/common/class/qrcode.php';
	$au->getRow($_SESSION['AuthUserID']);
	$options=array();
	$options['h']="500px";
	$options['w']="500px";
	$options['s']="qrq";
	$generator = new QRCode("https://wis.jamtransfer.com/qrlog.php?pid=".$_SESSION['AuthUserID'], $options);
	$generator->output_image();
	$image = $generator->render_image();
	imagepng($image);
	imagedestroy($image);
}	
?>