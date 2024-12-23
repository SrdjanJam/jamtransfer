<?
require_once 'config.php';
	session_start();
	$_SESSION['UserAuthorized'] = false;
	$_SESSION['AdminAccessToDriverProfile'] = false;
	
	if (PARTNERLOG) {
		session_destroy();
		//header('location: '.ROOT_HOME);	
	}	

	$_REQUEST['username']=$_SESSION['UserName'];
	$_REQUEST['latitude']=$_SESSION["UserLatitude"];
	$_REQUEST['longitude']=$_SESSION["UserLongitude"];	
	if ($_SESSION['AuthLevelID']<40) saveLog($_SESSION['AuthUserID'],2);
	session_destroy();
	/*echo "<h1>YOU ARE LOGOUT</h1>";
	echo "<a href='https://wis.jamtransfer.com/login.php'>LOGIN</a><br>";
	
	echo "<a target='_blank' href='qrlog.php'><i class='fa fa-qrcode'></i>QR LOGOUT</a>";*/
		
		
	header('location: '.ROOT_HOME);		