<?
	session_start();
	//$_SESSION['UseDriverID'] = false;
	unset ($_SESSION['UseDriverID']);
	if (isset($_COOKIE['page'])) $page=$_COOKIE['page'];
	else $page='dashboard';
	header("Location: " .$page);
	exit();

