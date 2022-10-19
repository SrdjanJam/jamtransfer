<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
	
$keyValue = $_REQUEST['id'];
$fldList = array();
$out = array();
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);

$text_array=array();
$text_array['en']=$_REQUEST['text_en'];
$text_array['de']=$_REQUEST['text_de'];
$text_array['fr']=$_REQUEST['text_fr'];
$text_array['ru']=$_REQUEST['text_ru'];
$_REQUEST['text']=json_encode($text_array);

foreach ($db->fieldNames() as $name) {
	$content=$db->myreal_escape_string($_REQUEST[$name]);
	if(isset($_REQUEST[$name])) {
		eval("\$db->set".$name."(\$content);");	
	}	
}	
$upd = '';
$newID = '';
if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}
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
	