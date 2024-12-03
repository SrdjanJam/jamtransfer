<?
@session_start();
require_once "../../../config.php";

if (isset($_REQUEST['lng']) && isset($_REQUEST['lat'])) {
	$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";
	$url="https://api.openrouteservice.org/geocode/reverse?api_key=".$api_key."&point.lon=".$_REQUEST['lng'].",".$plat."&point.lat=".$_REQUEST['lat'];	
	$json = file_get_contents($url);   
	$obj="";
	$obj = json_decode($json,true);	
	if ($json) echo ($obj['features'][0]['properties']['locality']);
}	
else echo "";