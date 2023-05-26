<?
session_start();
	if(!empty($_COOKIE['CMSLang'])) $_SESSION['CMSLang'] = $_COOKIE['CMSLang'];
	require_once 'config.php';		
	require_once 'engine.php';	
?>