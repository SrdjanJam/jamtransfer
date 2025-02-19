<?
$arr=array (
			"ServiceID" => 861905,
			"ExtrasIDS" => array (3076,4117),
			"PaxNo" => 3,
			"transferDate" => "2025-05-01",
			"transferTime" => "15:30",
			"returnTransfer" => 1,
			"returnDate" => "2025-05-02",
			"returnTime" => "16:00",
			"VehiclesNo" => 1,
			"pickupAddress" => "Terminal airport",
			"dropoffAddress" => "Test street",
			"flightNumber" => "TT111",
			"flightTime" => "15:20",			
			"returnFlightNumber" => "TT112",
			"returnFlightTime" => "19:00",
			"paxName" => "Test Tester",
			"paxMobile" => "+44 11111111",
			"paxEmail" => "jsmith@test.com",
			"notes" => "for test porpuse"
		);	

$url = "https://wis.jamtransfer.com/app/setOrder.php?code=14e1b600b1fd579f47433b88e8d85291";    
$content = json_encode($arr);
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
$json_response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ( $status != 200 ) {
    die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
} 
curl_close($curl);
print_r($json_response);
