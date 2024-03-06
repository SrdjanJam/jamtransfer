<?php
/*$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.openrouteservice.org/v2/directions/driving-car/gpx");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, '{"coordinates":[[8.681495,49.41461],[8.686507,49.41943],[8.687872,49.420318]]}');

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8",
  "Authorization: 5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb",
  "Content-Type: application/json; charset=utf-8"
));

$response = curl_exec($ch);
curl_close($ch);

var_dump($response);
  


$callurl = curl_init();

curl_setopt($callurl , CURLOPT_URL, "https://wa.me/381646413504/?text=proba");
curl_setopt($callurl , CURLOPT_HEADER, 0);

curl_exec($callurl );

curl_close($callurl );*/


$phone_to='+381646413504';
$message='Ovo je testiranje automatskog slanja whatsapp poruke preko funkcije 2';

/*$params=array(
'token' => $token,
'to' => $phone_to,
'body' => $message
);
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.ultramsg.com/".$instance."/messages/chat",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => http_build_query($params),
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}*/


require_once "config.php";
send_whatsapp_message($phone_to,$message);