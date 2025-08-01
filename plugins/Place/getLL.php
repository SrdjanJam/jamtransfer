<?
	require_once '../../config.php';
	$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";
	$source1="whosonfirst";
	$source2="geonames";
	$text=str_replace(" ","%20",$_REQUEST['Place']);
	$url="https://api.openrouteservice.org/geocode/search?api_key=".$api_key."&start&layers=".$_REQUEST['Layers']."&boundary.country=".$_REQUEST['CC']."&sources=".$source1.",".$source2."&text=".$text;
	$ch=curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    $json=curl_exec($ch); 
	//echo curl_error($ch);
    curl_close ($ch); 	
	$obj="";
	$obj = json_decode($json,true);	
	$geolocation=array();
	if ($obj) {
		$long=$obj['features'][0]['geometry']['coordinates'][0];	
		$latt=$obj['features'][0]['geometry']['coordinates'][1]; 
		$geolocation['Lng']=$long;
		$geolocation['Lat']=$latt;
		
		
		$url2="https://api.openrouteservice.org/elevation/point?api_key=".$api_key."&geometry=".$long.",".$latt;
		$ch2=curl_init(); 
		curl_setopt($ch2, CURLOPT_URL,$url2); 
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); 
		$json2=curl_exec($ch2); 
		//echo curl_error($ch);
		curl_close ($ch2); 	
		$obj2="";
		$obj2 = json_decode($json2,true);	
		if ($obj2) {
			$elev=$obj2['geometry']['coordinates'][2]; 
			$geolocation['Elv']=$elev;
		}
	}
	echo json_encode($geolocation);

?>





