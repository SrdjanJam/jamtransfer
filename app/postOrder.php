<?
$arr=array (
			"ServiceID" => 535063,
			"ExtrasIDS" => array (103,105),
			"PaxNo" => 3,
			"transferDate" => "2024-04-01",
			"transferTime" => "15:30",
			"returnTransfer" => 1,
			"returnDate" => "2024-04-02",
			"returnTime" => "16:00",
			"VehiclesNo" => 1,
			"pickupAddress" => "Terminal airport",
			"dropoffAddress" => "Test street",
			"flightNumber" => "TT111",
			"flightTime" => "15:20",			
			"returnFlightNumber" => "TT112",
			"returnFlightTime" => "19:00",
			"paxName" => "John Smith",
			"paxMobile" => "+44 11111111",
			"paxEmail" => "jsmith@test.com",
			"notes" => "for test porpuse"
		);	

$url = "https://wis.jamtransfer.com/app/setOrder.php?code=4190d4731aa725d606c511be010e2e6d";    
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
//print_r($json_response);
