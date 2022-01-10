<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
@session_start();
//echo '<pre>'; print_r($_REQUEST); echo '</pre>';
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_Articles.class.php';


	# init class
	$db = new v4_Articles();

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

		 	
	if(isset($_REQUEST['Language'])) { $db->setLanguage($db->myreal_escape_string($_REQUEST['Language']) ); } 

		 	
	if(isset($_REQUEST['Page'])) { $db->setPage($db->myreal_escape_string($_REQUEST['Page']) ); } 

		 	
	if(isset($_REQUEST['Position'])) { $db->setPosition($db->myreal_escape_string($_REQUEST['Position']) ); } 

		 	
	if(isset($_REQUEST['HTMLBefore'])) { $db->setHTMLBefore($db->myreal_escape_string($_REQUEST['HTMLBefore']) ); } 

		 	
	if(isset($_REQUEST['HTMLAfter'])) { $db->setHTMLAfter($db->myreal_escape_string($_REQUEST['HTMLAfter']) ); } 

		 	
	if(isset($_REQUEST['Classes'])) { $db->setClasses($db->myreal_escape_string($_REQUEST['Classes']) ); } 

		 	
	if(isset($_REQUEST['Title'])) { $db->setTitle($db->myreal_escape_string($_REQUEST['Title']) ); } 

		 	
	if(isset($_REQUEST['Article'])) { $db->setArticle(htmlentities(str_replace (array("\r\n", "\n", "\r"), ' ',stripslashes($_REQUEST['Article']))) ); } 

		 	
	if(isset($_REQUEST['Published'])) { $db->setPublished($db->myreal_escape_string($_REQUEST['Published']) ); } 

		 	
	$db->setLastChange($db->myreal_escape_string(date("Y-m-d H:i:s")) ); 

		 	
	$db->setUserID($db->myreal_escape_string($_SESSION['AuthUserID']) );  

		 	

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
	
