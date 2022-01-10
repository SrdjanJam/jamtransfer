<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once ROOT . '/db/db.class.php';
	require_once ROOT . '/db/v4_ExtrasMaster.class.php';
	require_once ROOT . '/db/v4_Extras.class.php';


	# init class
	$em = new v4_ExtrasMaster();
	$db = new DataBaseMysql();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();


# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $em->getRow($keyValue);


	if(isset($_REQUEST['ID'])) { $em->setID($em->myreal_escape_string($_REQUEST['ID']) ); } 

		 	
	if(isset($_REQUEST['DisplayOrder'])) { $em->setDisplayOrder($em->myreal_escape_string($_REQUEST['DisplayOrder']) ); } 

		 	
	if(isset($_REQUEST['ServiceEN'])) { $em->setServiceEN($em->myreal_escape_string($_REQUEST['ServiceEN']) ); } 

		 	
	if(isset($_REQUEST['ServiceDE'])) { $em->setServiceDE($em->myreal_escape_string($_REQUEST['ServiceDE']) ); } 

		 	
	if(isset($_REQUEST['ServiceRU'])) { $em->setServiceRU($em->myreal_escape_string($_REQUEST['ServiceRU']) ); } 

		 	
	if(isset($_REQUEST['ServiceFR'])) { $em->setServiceFR($em->myreal_escape_string($_REQUEST['ServiceFR']) ); } 

		 	
	if(isset($_REQUEST['ServiceIT'])) { $em->setServiceIT($em->myreal_escape_string($_REQUEST['ServiceIT']) ); } 

		 	
	if(isset($_REQUEST['ServiceSE'])) { $em->setServiceSE($em->myreal_escape_string($_REQUEST['ServiceSE']) ); } 

		 	
	if(isset($_REQUEST['ServiceNO'])) { $em->setServiceNO($em->myreal_escape_string($_REQUEST['ServiceNO']) ); }


	if(isset($_REQUEST['ServiceES'])) { $em->setServiceES($em->myreal_escape_string($_REQUEST['ServiceES']) ); } 

		 	
	if(isset($_REQUEST['ServiceNL'])) { $em->setServiceNL($em->myreal_escape_string($_REQUEST['ServiceNL']) ); }

	//Update Extras tablice

	$q  = "UPDATE v4_Extras ";
	$q .= "SET Service = '".addslashes($_REQUEST['Service'])."', 
			   ServiceEN = '".addslashes($_REQUEST['ServiceEN'])."', 
			   ServiceRU = '".addslashes($_REQUEST['ServiceRU'])."', 
			   ServiceFR = '".addslashes($_REQUEST['ServiceFR'])."', 
			   ServiceDE = '".addslashes($_REQUEST['ServiceDE'])."', 
			   ServiceIT = '".addslashes($_REQUEST['ServiceIT'])."', 
			   ServiceSE = '".addslashes($_REQUEST['ServiceSE'])."', 
			   ServiceNO = '".addslashes($_REQUEST['ServiceNO'])."', 
			   ServiceES = '".addslashes($_REQUEST['ServiceES'])."', 
			   ServiceNL = '".addslashes($_REQUEST['ServiceNL'])."' ";
	$q .= "WHERE ServiceID = '".$_REQUEST['keyValue']."'";

	$db->RunQuery($q);
	
$upd = '';
$newID = '';

// ako je update, azuriraj trazeni slog

if ($keyName != '' and $keyValue != '') {
	$res = $em->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}

// inace dodaj novi slog	
if ($keyName != '' and $keyValue == '') {
	$newID = $em->saveAsNew();
}


$out = array(
	'update' => $upd,
	'insert' => $newID
);

# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	
