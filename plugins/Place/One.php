<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

	# init libs
	require_once ROOT . '/db/v4_AuthUsers.class.php';
	require_once ROOT . '/db/v4_DriverTerminals.class.php';
	
	$name2='';
	# init vars

	$drivers = "";

	$out = array();

	# init class
	$au = new v4_AuthUsers();

	# filters
	$db->getRow($_REQUEST['ItemID']);

	# get fields and values
	$detailFlds = $db->fieldValues();
	if (isset($_SESSION['UseDriverID']) && $_SESSION['UseDriverID']>0) $detailFlds['UseDriverID']=$_SESSION['UseDriverID'];
	else $detailFlds['UseDriverID']=0;
    
    # remove slashes 
    foreach ($detailFlds as $key=>$value) {
        $detailFlds[$key] = stripslashes($value);
    }
	// geo sirina i duzina
	$detailFlds["LongitudeOld"]=$detailFlds["Longitude"];
	$detailFlds["LatitudeOld"]=$detailFlds["Latitude"];	
	if ($db->getLongitude()==0 || $db->getLatitude()==0) {
		if ($db->getPlaceType()==1) $name .=" parking";
		$ll=getLL($db->getPlaceNameEN());
		$ll_arr=explode("/",$ll);
		$detailFlds["Longitude"]=$ll_arr[0];
		$detailFlds["Latitude"]=$ll_arr[1];
	}	

	$name=$db->getPlaceNameEN();
	$name = str_replace(" ","_",$name);
	$name2.=$name.",_".$db->getCountryNameEN();
		
	$url='https://en.wikipedia.org/w/api.php?action=query&prop=extracts&format=json&exintro=&titles='.$name2;
						
	$json = file_get_contents($url);  
	$obj="";
	if ($json) {
		$obj = json_decode($json,true);
		$arrey=$obj['query']['pages'];
		$desc='';
		foreach ($arrey as $arr) {
			if (!isset($arr['extract'])) $arr['extract']=""; 
			else $desc=($arr['extract']);   
		}
		if (empty($desc)) {
			$url='https://en.wikipedia.org/w/api.php?action=query&prop=extracts&format=json&exintro=&titles='.$name;
			$json = file_get_contents($url);  
			if ($json) {
				$obj = json_decode($json,true);
				$arrey=$obj['query']['pages'];
				$desc='';
				foreach ($arrey as $arr) {
					if (!isset($arr['extract'])) $arr['extract']=""; 
					else $desc=($arr['extract']);    
				}
			}
		}
	}
	else $desc="";
	
	$detailFlds['WikiDesc']=strip_tags($desc);
	
	class v4_TerminalsJoin extends v4_DriverTerminals {
		public function getKeysBy($column, $order, $where = NULL){
			$keys = array(); $i = 0; 
			$where=" WHERE v4_DriverTerminals.TerminalID=".$_REQUEST['ItemID'] ;
			 
			$result = $this->connection->RunQuery(
						"SELECT v4_DriverTerminals.ID,v4_DriverTerminals.DriverID FROM v4_DriverTerminals WHERE v4_DriverTerminals.TerminalID=".$_REQUEST['ItemID']);
				while($row = $result->fetch_array(MYSQLI_ASSOC)){
					$keys[$i] = $row["DriverID"];
					$i++;
				}

		return $keys;
		}
	}	
	
	$dt = new v4_TerminalsJoin();
	$dtk = $dt->getKeysBy('DriverID ASC ', '', '');
	
	if (count($dtk) != 0) {
		foreach ($dtk as $nn => $key)
		{
			$au->getRow($key);
			$drivers .= $au->getAuthUserCompany() ." / ";
		}
		$detailFlds["Drivers"] = $drivers;
	}
	//Da li je lokacija terminal?
	$detailFlds["Terminal"]=0;

	$result = $dbT->RunQuery("SELECT * FROM v4_Terminals WHERE TerminalID=".$_REQUEST['ItemID']);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$detailFlds["Terminal"]=1;
	}	

	
	$out[] = $detailFlds;

	# send output back
	$output = json_encode($out);
	echo $output;
	
function getLL($name) {
	$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";
	$layers="coarse";
	$source1="whosonfirst";
	$source2="geonames";
	$text=str_replace(" ","%20",$name);
	$url="https://api.openrouteservice.org/geocode/search?api_key=".$api_key."&start&layers=".$layers."&sources=".$source1.",".$source2."&text=".$text;
	$json = file_get_contents($url);   
	$obj="";
	$obj = json_decode($json,true);	
	if ($obj) {
		$long=$obj['features'][0]['geometry']['coordinates'][0];	
		$latt=$obj['features'][0]['geometry']['coordinates'][1]; 
		if ($long>0 && $latt>0) return $long."/".$latt;
	}	
}	