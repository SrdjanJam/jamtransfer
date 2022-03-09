<?
	session_start();
	$_SESSION['UseDriverID'] = false;
	if (isset($_COOKIE['page'])) $page=$_COOKIE['page'];
	else $page='dashboard';
	header("Location: " .$page);
	exit();

