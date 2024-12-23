<?
require_once 'config.php';
require_once 'headerScripts.php';
echo "<img width='300px' src='".ROOT_HOME."/i/logo.png' />";
$ip = $_SERVER['REMOTE_ADDR'];
if ($ip<>"91.150.99.84") {
	echo "<h1>NOT CONNECTED ON WI-FI</h1>";
	exit();
}
?>
<!DOCTYPE html>
<div class="log">
	<span></span><br>
	<button id='login' style="font-size:250%" class="btn-primary" type="button">LOGIN</button>&nbsp;&nbsp;
	<button id='logout' style="font-size:250%" class="btn-link" type="button">LOGOUT</button>
</div>
<h4 id="error"></h4>
	<script>
	$('.log').hide();
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
	//setCookie('code','<?=create_order_key() ?>','1000');
	$('span').text(getCookie('code'));	
	var error=0;
	if (getCookie('code')!=null) {
		$('span').text(getCookie('code'));
		$('.log').show();
		

		$('button').click(function(){
			var log=$(this).attr('id');
			var url = './api/checkTempPass.php';
			console.log(url); 
			var param="key="+getCookie('code')+"&log="+log;
			$.ajax({
				type: 'GET',
				url: url+"?"+param,
				success: function(data) {
					if (data==0) $('#error').text(getCookie('code'));
					else if (log=='login') {
						$('#error').text("LOGIN APPROVED "+data);
						$('#login').hide(200);
						$('#logout').show(200);
					}	
					else {
						$('#error').text("LOGOUT APPROVED "+data);
						$('#logout').hide(200);
						$('#login').show(200);
					}	
				}
			})
		})	
	} else {
		$('#error').text("SOMETHING WRONG / The phone is not set up (no cookie).");
		setCookie('code','<?=create_order_key() ?>','1000');
		$('span').text(getCookie('code'));			
	}	
	
	</script>	




