<?
//error_reporting(E_ALL); 
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
define("DB_HOST", "127.0.0.1");

$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";


$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";


require_once $root . '/db/v4_AuthUsers.class.php';
require_once $root . '/db/v4_Routes.class.php';
require_once $root . '/db/v4_Places.class.php';

$db = new DataBaseMysql();
$au = new v4_AuthUsers();
$rt = new v4_Routes();
$rt1 = new v4_Routes();
$pl = new v4_Places();

//$where=" WHERE Approved=1 AND JSON_EXTRACT(`Line`, '$[0]') IS NULL";	
$where=" WHERE Approved=1 AND (Line='[' OR Line=']' OR Line is NULL) AND RouteNameSE=''";	
$rtk=$rt->getKeysBy('RouteID','LIMIT 20',$where);
foreach ($rtk as $key) {
	$rt->getRow($key);
	$pl->getRow($rt->getFromID());
	$lng1=$pl->getLongitude();
	$lat1=$pl->getLatitude();
	$pl->getRow($rt->getToID());
	$lng2=$pl->getLongitude();
	$lat2=$pl->getLatitude();

	$url="https://api.openrouteservice.org/v2/directions/driving-car?api_key=".$api_key."&start=".$lng1.",".$lat1."&end=".$lng2.",".$lat2."&radiuses=-1";

	$ch=curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    $json=curl_exec($ch); 
	//echo curl_error($ch);
    curl_close ($ch); 	
	
	$obj="";
	$obj = json_decode($json,true);	
	$line="[";
	if ($json) {
		$distance=number_format($obj['features'][0]['properties']['segments'][0]['distance']/1000,2);
		$duration=number_format($obj['features'][0]['properties']['segments'][0]['duration']/60,0);
		$error=$obj['error']['message'];
		foreach($obj['features'][0]['geometry']['coordinates'] as $coor) {	
			$line.="[";
			$line.=$coor[1];
			$line.=",";
			$line.=$coor[0];
			$line.="]";
			$line.=",";	
		}
		$line=substr($line,0,-1);
		$line.="]";
		$line=json_encode($line);
		$rt->setKm($distance);
		$rt->setDuration($duration);		
		$rt->setLine($line);
		$rt->setRouteNameSE($error);
		if (!empty($error)) $rt->setLine(json_encode('['));
		$rt->saveRow();
	}
}

/*$where=" WHERE Approved=1 AND TopRouteID=0 AND Line is NOT NULL AND Line<>']' AND LastChange<CURDATE() - INTERVAL 1 YEAR";	
$rtk=$rt->getKeysBy('RouteID','LIMIT 20',$where);
foreach ($rtk as $key) {
	$rt->getRow($key);
	$line=json_decode($rt->getLine());
	$max_line=0;
	$max_route_id=-1;
	$sql="SELECT `RouteID` FROM `v4_RoutesTerminals` WHERE `TerminalID` in (SELECT `TerminalID` FROM `v4_RoutesTerminals` WHERE `RouteID`=".$key.") and `RouteID` in (SELECT TopRouteID from v4_TopRoutes)";	
	$result = $db->RunQuery($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$rt1->getRow($row['RouteID']);
		$route_line=json_decode($rt1->getLine());
		$counter=0;
		foreach ($route_line as $rl) {
			if (in_array($rl,$line)) $counter++;
			if ($counter>$max_line) {
				$max_line=$counter;
				$max_route_id=$rt1->getRouteID();
				$km=$rt1->getKm();
				$duration=$rt1->getDuration();
			}	
		}	
	}
	$rt->setTopRouteID($max_route_id);
	
	$distance_coef=$km/$rt->getKm();
	$duration_coef=$duration/$rt->getDuration();
	$coef=($distance_coef+$duration_coef)/2;	
	$rt->setConFaktor($coef);
	$rt->setLastChange(date("Y-m-d"));
	$rt->saveRow();
	
}*/

