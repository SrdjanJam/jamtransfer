<?
@session_start();
error_reporting(E_PARSE);
require_once '../../../config.php';

require_once ROOT . '/db/db.class.php';
require_once ROOT . '/db/v4_Places.class.php';


$pl = new v4_Places();
$qDT = "SELECT TerminalID FROM v4_DriverTerminals WHERE DriverID=".$_SESSION['UseDriverID'];
$wDT = $db->RunQuery($qDT);
$terminals=array();
$fromPlaces = array();
$lang = "EN";
$srch = explode(',' , trim($_REQUEST['qry']) );
$text=str_replace("\"","",$srch[0]);
while($pDT = mysqli_fetch_object($wDT)) {
	$pl->getRow($pDT->TerminalID);
	$terminals_row=array();
	$terminals_row['ID']=$pl->getPlaceID();
	$terminals_row['Lat']=$pl->getLatitude();
	$terminals_row['Lng']=$pl->getLongitude();
	$terminals[]=$terminals_row;
	if (strpos(strtoupper($pl->getPlaceNameEN()), strtoupper($text)) !== false) {
		$fromPlaces["2".$pl->getPlaceNameEN()] = array(
										'ID' => 0,
										'Place'=> $pl->getPlaceNameEN(),
										'Long' => $pl->getLongitude(),
										'Latt' => $pl->getLatitude(),
										'Country' => $pl->getPlaceCountry(),
									);	
	}							
}



	$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";
	$layers="locality";
	$radius=3;
	
	

	$url="https://api.openrouteservice.org/geocode/autocomplete?api_key=".$api_key."&layers=".$layers."&text=".$text;

	$json = file_get_contents($url);   
	$obj="";
	$obj = json_decode($json,true);					
	if ($json) {	
		foreach ($obj['features'] as $places) {
			$placeNameL=strtoupper(trim($places['properties']['label']));
			$placeName=trim($places['properties']['name']);
			
			if (strtoupper(substr($placeName, 0, strlen($text)))==strtoupper($text)) { 
				if (isTerminal($places['geometry']['coordinates'][0],$places['geometry']['coordinates'][1],$radius,$terminals)) { 
					$fromPlaces["2".$placeNameL] = array(
													'ID' => 0,
													'Place'=> $placeNameL,
													'Long' => $places['geometry']['coordinates'][0],
													'Latt' => $places['geometry']['coordinates'][1],
													'Country' => $places['properties']['country'],
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
		'Long' => $value['Long'],
		'Latt' => $value['Latt'],
		'Country' => $value['Country']	
    );
}

$res = json_encode($res);
echo $_GET['callback'] . '(' . $res. ')';



function isTerminal($Long,$Latt,$radius,$terminals) {
	foreach ($terminals as $terminal) {
		$distance=vincentyGreatCircleDistance($terminal['Lat'], $terminal['Lng'], $Latt, $Long, $earthRadius = 6371000);
		if ($distance<$radius*111000) return true;
	}
	return false;
}

	