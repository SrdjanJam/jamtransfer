<?
	require_once '../../config.php';
	$url="https://api.openrouteservice.org/v2/directions/driving-car?api_key=5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb&start=".$_REQUEST['Lng'].",".$_REQUEST['Lat']."&end=".$_REQUEST['Lng'].",".$_REQUEST['Lat']."&radiuses=-1";
	$ch=curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    $json=curl_exec($ch); 
	//echo curl_error($ch);
    curl_close ($ch); 	
	$obj="";
	$obj = json_decode($json,true);	
	$error="";
	if ($obj) {
		$error=$obj['error']['message'];
		$error_arr=explode(";",$error);
		$error=$error_arr[0];
		if (empty($error)) $error="Location is routable!";
	}	else $error="Something wrong!";
	echo $error;
?>





