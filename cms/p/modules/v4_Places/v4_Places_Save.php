<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once ROOT . '/db/db.class.php';
	require_once ROOT . '/db/v4_Places.class.php';


	# init class
	$db = new v4_Places();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();

$sameplace=array(); 
$where="where `PlaceCountry` = ".$_REQUEST['PlaceCountry']." AND `PlaceNameEN` = '".$_REQUEST['PlaceNameEN']."'";
//exit ($where);
$sameplace=$db->getKeysBy('PlaceID', 'ASC', $where);

	if (count($sameplace)>0 && $keyValue == '') {
		
		$out = array(
			'update' => 'Exist',
			'insert' => ''
		);
	}
	
	else {

		# if Update - get the row by keyValue
		if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);


			if(isset($_REQUEST['PlaceID'])) { $db->setPlaceID($db->myreal_escape_string($_REQUEST['PlaceID']) ); } 

					
			if(isset($_REQUEST['PlaceCountry'])) { $db->setPlaceCountry($db->myreal_escape_string($_REQUEST['PlaceCountry']) ); } 

					
			if(isset($_REQUEST['CountryNameEN'])) { $db->setCountryNameEN($db->myreal_escape_string($_REQUEST['CountryNameEN']) ); } 

					
			if(isset($_REQUEST['PlaceNameEN'])) { $db->setPlaceNameEN($db->myreal_escape_string($_REQUEST['PlaceNameEN']) ); } 

					
			if(isset($_REQUEST['PlaceNameSEO'])) { $db->setPlaceNameSEO($db->myreal_escape_string($_REQUEST['PlaceNameSEO']) ); } 

					
			if(isset($_REQUEST['PlaceNameRU'])) { $db->setPlaceNameRU($db->myreal_escape_string($_REQUEST['PlaceNameRU']) ); } 

					
			if(isset($_REQUEST['PlaceNameFR'])) { $db->setPlaceNameFR($db->myreal_escape_string($_REQUEST['PlaceNameFR']) ); } 

					
			if(isset($_REQUEST['PlaceNameDE'])) { $db->setPlaceNameDE($db->myreal_escape_string($_REQUEST['PlaceNameDE']) ); } 

					
			if(isset($_REQUEST['PlaceNameIT'])) { $db->setPlaceNameIT($db->myreal_escape_string($_REQUEST['PlaceNameIT']) ); } 

					
			if(isset($_REQUEST['PlaceNameSE'])) { $db->setPlaceNameSE($db->myreal_escape_string($_REQUEST['PlaceNameSE']) ); } 

					
			if(isset($_REQUEST['PlaceNameNO'])) { $db->setPlaceNameNO($db->myreal_escape_string($_REQUEST['PlaceNameNO']) ); } 

					
			if(isset($_REQUEST['PlaceNameES'])) { $db->setPlaceNameES($db->myreal_escape_string($_REQUEST['PlaceNameES']) ); } 

					
			if(isset($_REQUEST['PlaceNameNL'])) { $db->setPlaceNameNL($db->myreal_escape_string($_REQUEST['PlaceNameNL']) ); } 

					
			if(isset($_REQUEST['PlaceType'])) { $db->setPlaceType($db->myreal_escape_string($_REQUEST['PlaceType']) ); } 

					
			if(isset($_REQUEST['PlaceCity'])) { $db->setPlaceCity($db->myreal_escape_string($_REQUEST['PlaceCity']) ); } 

					
			if(isset($_REQUEST['PlaceAddress'])) { $db->setPlaceAddress($db->myreal_escape_string($_REQUEST['PlaceAddress']) ); } 

					
			if(isset($_REQUEST['PlaceDesc'])) { $db->setPlaceDesc($db->myreal_escape_string($_REQUEST['PlaceDesc']) ); } 

					
			if(isset($_REQUEST['PlaceDescEN'])) { $db->setPlaceDescEN($db->myreal_escape_string($_REQUEST['PlaceDescEN']) ); } 

					
			if(isset($_REQUEST['PlaceDescRU'])) { $db->setPlaceDescRU($db->myreal_escape_string($_REQUEST['PlaceDescRU']) ); } 

					
			if(isset($_REQUEST['PlaceDescFR'])) { $db->setPlaceDescFR($db->myreal_escape_string($_REQUEST['PlaceDescFR']) ); } 

					
			if(isset($_REQUEST['PlaceDescDE'])) { $db->setPlaceDescDE($db->myreal_escape_string($_REQUEST['PlaceDescDE']) ); } 

					
			if(isset($_REQUEST['PlaceDescIT'])) { $db->setPlaceDescIT($db->myreal_escape_string($_REQUEST['PlaceDescIT']) ); } 

					
			if(isset($_REQUEST['PlaceDescSE'])) { $db->setPlaceDescSE($db->myreal_escape_string($_REQUEST['PlaceDescSE']) ); } 

					
			if(isset($_REQUEST['PlaceDescNO'])) { $db->setPlaceDescNO($db->myreal_escape_string($_REQUEST['PlaceDescNO']) ); } 

					
			if(isset($_REQUEST['PlaceDescES'])) { $db->setPlaceDescES($db->myreal_escape_string($_REQUEST['PlaceDescES']) ); } 

					
			if(isset($_REQUEST['PlaceDescNL'])) { $db->setPlaceDescNL($db->myreal_escape_string($_REQUEST['PlaceDescNL']) ); } 

					
			if(isset($_REQUEST['Image'])) { $db->setImage($db->myreal_escape_string($_REQUEST['Image']) ); } 

					
			if(isset($_REQUEST['Island'])) { $db->setIsland($db->myreal_escape_string($_REQUEST['Island']) ); } 


			if(isset($_REQUEST['PlaceActive'])) { $db->setPlaceActive($db->myreal_escape_string($_REQUEST['PlaceActive']) ); } 


			if(isset($_REQUEST['Longitude'])) { $db->setLongitude($db->myreal_escape_string($_REQUEST['Longitude']) ); } 

					
			if(isset($_REQUEST['Latitude'])) { $db->setLatitude($db->myreal_escape_string($_REQUEST['Latitude']) ); } 
			
			if(isset($_REQUEST['Elevation'])) { $db->setElevation($db->myreal_escape_string($_REQUEST['Elevation']) ); } 

					

		$upd = '';
		$newID = '';

		// ako je update, azuriraj trazeni slog

		if ($keyName != '' and $keyValue != '') {
			$res = $db->saveRow();
			$upd = 'Updated';
			if($res !== true) $upd = $res;
		}

		// inace dodaj novi slog	
		if ($keyName != '' and $keyValue == '') {
			$newID = $db->saveAsNew();
		}


		$out = array(
			'update' => $upd,
			'insert' => $newID
		);
	}
# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	