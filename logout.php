<?
require_once 'config.php';
	session_start();
	$_SESSION['UserAuthorized'] = false;
	$_SESSION['AdminAccessToDriverProfile'] = false;
	
	if (session_status() != PHP_SESSION_ACTIVE) {
		echo "<h1>YOU HAVE TO LOGIN FOR FINAL LOGOUT</h1>";
		echo "<a href='https://wis.jamtransfer.com/login.php'>LOGIN</a>";
	} else {
		$_REQUEST['username']=$_SESSION['UserName'];
		$_REQUEST['latitude']=$_SESSION["UserLatitude"];
		$_REQUEST['longitude']=$_SESSION["UserLongitude"];	
		saveLog($_SESSION['AuthUserID'],2);
		session_destroy();
		echo "<h1>YOU ARE LOGOUT</h1>";
		echo "<a href='https://wis.jamtransfer.com/login.php'>LOGIN</a>";
	}	
