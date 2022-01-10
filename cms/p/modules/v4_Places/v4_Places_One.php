<?
header('Content-Type: text/javascript; charset=UTF-8'); 
	# init libs
	require_once '../../../../config.php';
	require_once '../../../../db/v4_Places.class.php';
	require_once '../../../../db/v4_AuthUsers.class.php';
	require_once '../../../../db/v4_DriverTerminals.class.php';

	# init vars
	$out = array();


	# init class
	$db = new v4_Places();
	$au = new v4_AuthUsers();


	# filters

	$PlaceID = $_REQUEST['PlaceID'];

	# Details  red
	$db->getRow($PlaceID);


	# get fields and values
	$detailFlds = $db->fieldValues();

    
    # remove slashes 
    foreach ($detailFlds as $key=>$value) {
        $detailFlds[$key] = stripslashes($value);
    }

	$name=$db->getPlaceNameEN();
	$name2.=$name.",_".$db->getCountryNameEN();
	
	$url='https://en.wikipedia.org/w/api.php?action=query&prop=extracts&format=json&exintro=&titles='.$name2;
						
	$json = file_get_contents($url);  
	$obj="";
	if ($json) {
		$obj = json_decode($json,true);
		$arrey=$obj['query']['pages'];
		$desc='';
		foreach ($arrey as $arr) {
			$desc=($arr['extract']);  
		}
		if (empty($desc)) {
			$url='https://en.wikipedia.org/w/api.php?action=query&prop=extracts&format=json&exintro=&titles='.$name;
			$json = file_get_contents($url);  
			if ($json) {
				$obj = json_decode($json,true);
				$arrey=$obj['query']['pages'];
				$desc='';
				foreach ($arrey as $arr) {
					$desc=($arr['extract']);  
				}
			}
		}
	}
	else $desc="";
	
	$detailFlds['WikiDesc']=strip_tags($desc);

	
	class v4_TerminalsJoin extends v4_DriverTerminals {
		public function getKeysBy($column, $order, $where = NULL){
			$keys = array(); $i = 0; 

			$where=" WHERE v4_DriverTerminals.TerminalID=".$_REQUEST['PlaceID'] ;
			 
			$result = $this->connection->RunQuery(
						"SELECT v4_DriverTerminals.ID,v4_DriverTerminals.DriverID FROM v4_DriverTerminals WHERE v4_DriverTerminals.TerminalID=".$_REQUEST['PlaceID']);
				while($row = $result->fetch_array(MYSQLI_ASSOC)){
					$keys[$i] = $row["DriverID"];
					$i++;
				}

		return $keys;
		}
	}	
	$dt = new v4_TerminalsJoin();

	$dtk = $dt->getKeysBy('v4_AuthUsers.AuthUserCompany '.$sortOrder.'', '', $DB_Where);
	if (count($dtk) != 0) {
		foreach ($dtk as $nn => $key)
		{
			$au->getRow($key);
			$drivers .= $au->getAuthUserCompany() ." / ";
		}
		$detailFlds["Drivers"] = $drivers;
	}
	
	$out[] = $detailFlds;

	# send output back
	$output = json_encode($out);
	echo $_GET['callback'] . '(' . $output . ')';
	