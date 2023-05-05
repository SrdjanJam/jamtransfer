<?
	session_start();
	//$_SESSION['UseDriverID'] = false;
	unset ($_SESSION['UseDriverID']);
	unset ($_SESSION['UseDriverName']);
	if (isset($_COOKIE['pageEx'])) $page=$_COOKIE['pageEx'];
	else $page='dashboard';
	header("Location: " .$page);
	exit();

