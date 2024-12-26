<?
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://integration.raptor-fleet.com:50111/get_vehicles?user_id=jamtransferWS01user&user_psw=HGvmvX5kxghlFod9N9oxd3PWHj49');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$response = curl_exec($ch);
curl_close($ch);
print_r($response);