<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

	# init vars
	$out = array();

	$db->getRow($_REQUEST['ItemID']);

	# get fields and values
	$detailFlds = $db->fieldValues();
	$dbP->getRow($_REQUEST['ItemID']);

	# remove slashes 
	foreach ($detailFlds as $key=>$value) {
		$detailFlds[$key] = stripslashes($value);
	}
	$detailFlds['PlaceNameSEO']=$dbP->getPlaceNameSEO();
	$filename = "../../site_terminals/".$dbP->getPlaceNameSEO().".html";
	if (file_exists($filename)) $detailFlds['HtmlExist']=1;
	else $detailFlds['HtmlExist']=0;

	$arr=json_decode($detailFlds['Description']);
	if (gettype($arr)!="object") {
		$arr=array();
		$arr['en']="";
		$arr['de']="";
		$arr['fr']="";
		$arr['ru']="";
	}	
	$detailFlds['des_arr']= (array) $arr;	
	if (in_array($_SESSION['BrandName'],array('EN','FR','RU','DE'))) {
		$detailFlds['language']=strtolower($_SESSION['BrandName']);
		$detailFlds['disabled']='disabled';
	}	
	else {
		$detailFlds['language']=" ";
		$detailFlds['disabled']='';
	}
	$result = $dbT->RunQuery("SELECT * FROM v4_DriverTerminals WHERE TerminalID=".$_REQUEST['ItemID']); 
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$driverID=$row['DriverID'];
		if (array_key_exists($driverID, $users)) $detailFlds["Drivers"][]=$users[$driverID];
	}
	//print_r($detailFlds["Drivers"]);
	$out[] = $detailFlds;

	# send output back
	$output = json_encode($out);
	echo $output;
	