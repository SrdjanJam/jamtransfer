<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
	
$keyValue = $_REQUEST['id'];
$fldList = array();
$out = array();
$text_array=array();
if ($keyName != '' and $keyValue != '' and in_array($_SESSION['BrandName'],array('EN','FR','RU','DE'))) {
	$db->getRow($keyValue);
	$text_array['en']=str_replace("'","`",$_REQUEST['text_en']);
	$text_array['de']=str_replace("'","`",$_REQUEST['text_de']);
	$text_array['fr']=str_replace("'","`",$_REQUEST['text_fr']);
	$text_array['ru']=str_replace("'","`",$_REQUEST['text_ru']);
} else {
	$text_array['en']=str_replace("'","`",$_REQUEST['text']);
	$text_array['de']=str_replace("'","`",$_REQUEST['text']);
	$text_array['fr']=str_replace("'","`",$_REQUEST['text']);
	$text_array['ru']=str_replace("'","`",$_REQUEST['text']);
}	

$_REQUEST['text']=json_encode($text_array);

foreach ($db->fieldNames() as $name) {
	$content=$db->myreal_escape_string($_REQUEST[$name]);
	if(isset($_REQUEST[$name])) {
		eval("\$db->set".$name."(\$content);");	
	}	
}	
$db->setupdated_at(date('Y-m-d h:i:s'));
$upd = '';
$newID = '';
if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}
if ($keyName != '' and $keyValue == '') {
	$db->setcreated_at(date('Y-m-d h:i:s'));
	$newID = $db->saveAsNew();
}
$out = array(
	'update' => $upd,
	'insert' => $newID
);
# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	