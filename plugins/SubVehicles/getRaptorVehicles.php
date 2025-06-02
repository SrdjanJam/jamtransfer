<?
	//require_once('getSubDriverRaptor.php');
	$link='https://integration.raptor-fleet.com:50111/get_vehicles?user_id=jamtransferWS01user&user_psw=HGvmvX5kxghlFod9N9oxd3PWHj49';
	//echo $link='https://api.giscloud.com/rest/1/drivers.json?api_key=4a27e4227a88de0508aa9fa2e4c57144&app_instance_id=107495';
	//$json = file_get_contents($link); 
	//$obj = json_decode($json,true);	
	
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://integration.raptor-fleet.com:50111/get_vehicles?user_id=jamtransferWS01user&user_psw=HGvmvX5kxghlFod9N9oxd3PWHj49');
//curl_setopt($ch, CURLOPT_URL, 'https://wis.taxifrom.com/raptor.php?object=vehicle');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$response = curl_exec($ch);
curl_close($ch);

$obj = json_decode($response,true);





	$excl_arr=array('id','devtype','client_id','company_id','note','fuel_tank_litres','expenses_per_h','expenses_per_km',
					'device_id','custom_options','gps_device_id','last_change_time',
					'satellites','app_instance_owner_id','last_active_time');
	
	echo "<table>";		
	foreach ($obj['vehicles'][0] as $key=>$o) {
		if (!in_array($key, $excl_arr)) {
			echo "<th>";
			echo $key;	
			echo "</th>";	
		}	
	}	
	foreach ($obj['vehicles'] as $o1) {
		echo "<tr>";
		foreach ($o1 as $key=>$o2) {
			if (!in_array($key, $excl_arr)) {
				echo "<td>";
				if ($key=='timestamp') echo date('Y-m-d h:i:s',$o2);
				else echo $o2;
				echo "</td>";
			}
		}
		echo "</tr>";
	}	
	echo "</table>";
	