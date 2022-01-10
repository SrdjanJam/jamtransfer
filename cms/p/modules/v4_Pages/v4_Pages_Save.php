<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once ROOT . '/db/db.class.php';
	require_once ROOT . '/db/v4_Pages.class.php';


	# init class
	$db = new v4_Pages();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();


# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);


	if(isset($_REQUEST['ID'])) { $db->setID($db->myreal_escape_string($_REQUEST['ID']) ); } 

		 	
	if(isset($_REQUEST['Title'])) { $db->setTitle($db->myreal_escape_string($_REQUEST['Title']) ); } 

		 	
	if(isset($_REQUEST['TitleEN'])) { $db->setTitleEN($db->myreal_escape_string($_REQUEST['TitleEN']) ); } 

		 	
	if(isset($_REQUEST['TitleRU'])) { $db->setTitleRU($db->myreal_escape_string($_REQUEST['TitleRU']) ); } 

		 	
	if(isset($_REQUEST['TitleFR'])) { $db->setTitleFR($db->myreal_escape_string($_REQUEST['TitleFR']) ); } 

		 	
	if(isset($_REQUEST['TitleDE'])) { $db->setTitleDE($db->myreal_escape_string($_REQUEST['TitleDE']) ); } 

		 	
	if(isset($_REQUEST['TitleIT'])) { $db->setTitleIT($db->myreal_escape_string($_REQUEST['TitleIT']) ); } 

		 	
	if(isset($_REQUEST['TitleSE'])) { $db->setTitleSE($db->myreal_escape_string($_REQUEST['TitleSE']) ); } 

		 	
	if(isset($_REQUEST['TitleNO'])) { $db->setTitleNO($db->myreal_escape_string($_REQUEST['TitleNO']) ); } 

		 	
	if(isset($_REQUEST['TitleES'])) { $db->setTitleES($db->myreal_escape_string($_REQUEST['TitleES']) ); } 

		 	
	if(isset($_REQUEST['TitleNL'])) { $db->setTitleNL($db->myreal_escape_string($_REQUEST['TitleNL']) ); } 

		 	
	if(isset($_REQUEST['Content'])) { $db->setContent($db->myreal_escape_string($_REQUEST['Content']) ); } 

		 	
	if(isset($_REQUEST['ContentEN'])) { $db->setContentEN($db->myreal_escape_string($_REQUEST['ContentEN']) ); } 

		 	
	if(isset($_REQUEST['ContentRU'])) { $db->setContentRU($db->myreal_escape_string($_REQUEST['ContentRU']) ); } 

		 	
	if(isset($_REQUEST['ContentFR'])) { $db->setContentFR($db->myreal_escape_string($_REQUEST['ContentFR']) ); } 

		 	
	if(isset($_REQUEST['ContentDE'])) { $db->setContentDE($db->myreal_escape_string($_REQUEST['ContentDE']) ); } 

		 	
	if(isset($_REQUEST['ContentIT'])) { $db->setContentIT($db->myreal_escape_string($_REQUEST['ContentIT']) ); } 

		 	
	if(isset($_REQUEST['ContentSE'])) { $db->setContentSE($db->myreal_escape_string($_REQUEST['ContentSE']) ); } 

		 	
	if(isset($_REQUEST['ContentNO'])) { $db->setContentNO($db->myreal_escape_string($_REQUEST['ContentNO']) ); } 

		 	
	if(isset($_REQUEST['ContentES'])) { $db->setContentES($db->myreal_escape_string($_REQUEST['ContentES']) ); } 

		 	
	if(isset($_REQUEST['ContentNL'])) { $db->setContentNL($db->myreal_escape_string($_REQUEST['ContentNL']) ); } 

		 	
	if(isset($_REQUEST['MenuTitle'])) { $db->setMenuTitle($db->myreal_escape_string($_REQUEST['MenuTitle']) ); } 

		 	
	if(isset($_REQUEST['MenuTitleEN'])) { $db->setMenuTitleEN($db->myreal_escape_string($_REQUEST['MenuTitleEN']) ); } 

		 	
	if(isset($_REQUEST['MenuTitleRU'])) { $db->setMenuTitleRU($db->myreal_escape_string($_REQUEST['MenuTitleRU']) ); } 

		 	
	if(isset($_REQUEST['MenuTitleFR'])) { $db->setMenuTitleFR($db->myreal_escape_string($_REQUEST['MenuTitleFR']) ); } 

		 	
	if(isset($_REQUEST['MenuTitleDE'])) { $db->setMenuTitleDE($db->myreal_escape_string($_REQUEST['MenuTitleDE']) ); } 

		 	
	if(isset($_REQUEST['MenuTitleIT'])) { $db->setMenuTitleIT($db->myreal_escape_string($_REQUEST['MenuTitleIT']) ); } 

		 	
	if(isset($_REQUEST['MenuTitleSE'])) { $db->setMenuTitleSE($db->myreal_escape_string($_REQUEST['MenuTitleSE']) ); } 

		 	
	if(isset($_REQUEST['MenuTitleNO'])) { $db->setMenuTitleNO($db->myreal_escape_string($_REQUEST['MenuTitleNO']) ); } 

		 	
	if(isset($_REQUEST['MenuTitleES'])) { $db->setMenuTitleES($db->myreal_escape_string($_REQUEST['MenuTitleES']) ); } 

		 	
	if(isset($_REQUEST['MenuTitleNL'])) { $db->setMenuTitleNL($db->myreal_escape_string($_REQUEST['MenuTitleNL']) ); } 

		 	
	if(isset($_REQUEST['LastChange'])) { $db->setLastChange($db->myreal_escape_string($_REQUEST['LastChange']) ); } 

		 	

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

# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	