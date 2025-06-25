<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

$out = array();
# Details  red
$db->getRow($_REQUEST['ItemID']);
# get fields and values
$detailFlds = $db->fieldValues();

# remove slashes 
foreach ($detailFlds as $key=>$value) {
	$detailFlds[$key] = stripslashes($value);
}
$detailFlds["TopRoute"]=0;
$result = $dbT->RunQuery("SELECT * FROM v4_TopRoutes WHERE TopRouteID=".$_REQUEST['ItemID']);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$detailFlds["TopRoute"]=1;
	}	
$detailFlds["TerminalID"]=0;	
$result2 = $dbT->RunQuery("SELECT TerminalID from v4_RoutesTerminals WHERE RouteID=".$_REQUEST['ItemID']);
	while($row = $result2->fetch_array(MYSQLI_ASSOC)){
		$detailFlds["TerminalID"]=$row["TerminalID"];
	}
$detailFlds["Duration2"]=$detailFlds["Duration"];
$detailFlds["Km2"]=$detailFlds["Km"];
//if ($detailFlds["LastChange"]<date('Y-m-d', time()-183*24*3600) )	{
	$pl->getRow($db->getFromID());
	$lng1=$pl->getLongitude();
	$lat1=$pl->getLatitude();
	$pl->getRow($db->getToID());
	$lng2=$pl->getLongitude();
	$lat2=$pl->getLatitude();
	$transfersR=getRouteParam($lng1,$lat1,$lng2,$lat2);
	$detailFlds["Lng1"]=$lng1;
	$detailFlds["Lat1"]=$lat1;
	$detailFlds["Lng2"]=$lng2;
	$detailFlds["Lat2"]=$lat2;
	$detailFlds["Duration"]=$transfersR['duration'];
	$detailFlds["Km"]=$transfersR['distance'];
	//$detailFlds["Steps"]=$transfersR['steps'];
	//$detailFlds["StepsEncode"]=json_encode($transfersR['steps']);
	$detailFlds["Line"]=$transfersR['line'];
	$detailFlds["TopRouteID"]=getTopRouteID($transfersR['line']);
	$detailFlds["ConFaktor"]=getConFaktor($detailFlds["TopRouteID"]);
	$detailFlds["LastChange"]=date("Y-m-d");
	$detailFlds["Lng"]=($lng1+$lng2)/2;
	$detailFlds["Lat"]=($lat1+$lat2)/2;
	$detailFlds["Error"]=$transfersR['error'];
//}
$out[] = $detailFlds;
# send output back
$output = json_encode($out);
echo $output;

function getTopRouteID($line) {
	// ovde algoritam za trazenje najbliskije top rute
	return 100;
}	

function getConFaktor($id) {
	// ovde algoritam za izracunavanje konverzionog faktora
	return 1;
}	

function getRouteParam($lng1,$lat1,$lng2,$lat2) {
	$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";
	$url="https://api.openrouteservice.org/v2/directions/driving-car?api_key=".$api_key."&start=".$lng1.",".$lat1."&end=".$lng2.",".$lat2."&radiuses=-1";
	
	
	$ch=curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    $json=curl_exec($ch); 
	//echo curl_error($ch);
    curl_close ($ch); 	
	
	//$json = file_get_contents($url);  
	$obj="";
	$obj = json_decode($json,true);	
	$line="[";
	if ($json) {
		$distance=number_format($obj['features'][0]['properties']['segments'][0]['distance']/1000,2);
		$duration=number_format($obj['features'][0]['properties']['segments'][0]['duration']/60,0);
		$transfersR['distance']=$distance;
		$transfersR['duration']=$duration;
		//$transfersR['steps']=$obj['features'][0]['properties']['segments'][0]['steps'];
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
		$transfersR['line']=$line;
		$transfersR['error']=$obj['error']['message'];
	}
		

	return $transfersR;
}	