<?
@session_start();
error_reporting(E_PARSE);
require_once '../config.php';

require_once ROOT . '/db/db.class.php';
require_once ROOT . '/db/v4_Places.class.php';
$db = new DataBaseMysql();


$lang = "EN";
$fromPlaces = array();
$srch = explode(',' , trim($_REQUEST['query']) );
$LongC=$_REQUEST['long'];
$LattC=$_REQUEST['latt'];
$Country=$_REQUEST['country'];
$layers="locality";
$radius=3;

# Places in the Country
$q  = " SELECT * FROM v4_Places ";
$q .= " WHERE PlaceActive = '1'";
	$q .= " AND (PlaceName".$lang." LIKE'" .  $srch[0]. "%' ";
	$q .= " OR PlaceNameSEO LIKE'" .  $srch[0]. "%') ";
$q .= " ORDER BY PlaceName".$lang." ASC";
$w = $db->RunQuery($q);

while($p = mysqli_fetch_object($w))
{
	if($p->PlaceActive == '1') {
		if (isAround($p->Longitude,$p->Latitude,$LongC,$LattC,$radius,$db)) {
		
			# Add Place to array
			$pnLang = 'PlaceName'. $lang;
			if(strlen($pnLang) == 9) $pnLang = 'PlaceNameEN';
		
			$placeName = strtolower($p->$pnLang);
			
			// fix ako nema jezika
			if(empty($placeName)) $pnLang = 'PlaceNameEN';
			$placeName = mb_strtolower($p->$pnLang, 'UTF-8');			
			
			$placeName .= ', ' . getPlaceCountryCode($p->PlaceCountry);
			# Add Place to array
			if (!in_array($placeName . '|'.$p->PlaceNameSEO,$fromPlaces)) {
				//$fromPlaces[$p->PlaceID] = trim($placeName) . '|' . trim($p->PlaceNameSEO);
				$fromPlaces["1".trim($placeName)] = array(
													'ID' => $p->PlaceID,
													'Place'=> trim($placeName),
													'SEO' => trim($p->PlaceNameSEO),
													'Long' => $p->Longitude,
													'Latt' => $p->Latitude,
													'Country' => $p->CountryNameEN,
													'Type' => 1
												);
			}
		}
	}
}
// from api
	$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";	
	$text=str_replace(" ","%20",$srch[0]);

	$url="https://api.openrouteservice.org/geocode/autocomplete?api_key=".$api_key."&layers=".$layers."&focus.point.lon=".$LongC."&focus.point.lat=".$LattC."&country=".$Country."&text=".$text;

	$json = file_get_contents($url);   
	$obj="";
	$obj = json_decode($json,true);					
	if ($json) {	
		foreach ($obj['features'] as $places) {
			$placeNameL=strtoupper(trim($places['properties']['label']));
			$placeName=trim($places['properties']['name']);
			if (strtoupper(substr($placeName, 0, strlen($text)))==strtoupper($text)) { 
				if (isAround($places['geometry']['coordinates'][0],$places['geometry']['coordinates'][1],$LongC,$LattC,$radius,$db)) {
					$fromPlaces["2".$placeNameL] = array(
														'ID' => 0,
														'Place'=> $placeNameL." (api)",
														'SEO' => '',
														'Long' => $places['geometry']['coordinates'][0],
														'Latt' => $places['geometry']['coordinates'][1],
														'Country' => $places['properties']['country'],
														'Type' => 2
													);
				}								
			}
		}
	}


# Sort by name
ksort($fromPlaces);
$res = array();

foreach ($fromPlaces as $key => $value) {
	$res[] = array(
		'Place'=>mb_strtoupper($value['Place'], 'UTF-8'),
		'ID'=>$value['ID'],
		'SEO' => $value['PlaceNameSEO'],
		'Long' => $value['Long'],
		'Latt' => $value['Latt'],
		'Country' => $value['Country'],		
		'Type' => $value['Type']
    );
}

$res = json_encode($res);
ob_start();
echo $_GET['callback'] . '(' . $res. ')';
ob_end_flush();


function isAround($Long,$Latt,$LongC,$LattC,$radius,$db) {
		$distance=vincentyGreatCircleDistance($LattC, $LongC, $Latt, $Long, $earthRadius = 6371000);
		if ($distance<200) return true;
		else return false;
}

function vincentyGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  return $angle * $earthRadius / 1000;
}	