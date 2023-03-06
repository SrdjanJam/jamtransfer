<?
header('Content-Type: text/javascript; charset=UTF-8');

require_once 'Initial.php';
	
$keyValue = $_REQUEST['id'];

$fldList = array();
$out = array();
$des_array=array();
if ($keyName != '' and $keyValue != '' and in_array($_SESSION['BrandName'],array('EN','FR','RU','DE'))) {
	$db->getRow($keyValue);
	$des_array['en']=str_replace("'","`",$_REQUEST['des_en']);
	$des_array['de']=str_replace("'","`",$_REQUEST['des_de']);
	$des_array['fr']=str_replace("'","`",$_REQUEST['des_fr']);
	$des_array['ru']=str_replace("'","`",$_REQUEST['des_ru']);
} else {
	$des_array['en']=str_replace("'","`",$_REQUEST['des']);
	$des_array['de']=str_replace("'","`",$_REQUEST['des']);
	$des_array['fr']=str_replace("'","`",$_REQUEST['des']);
	$des_array['ru']=str_replace("'","`",$_REQUEST['des']);
}	

$_REQUEST['Description']=json_encode($des_array);
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);

foreach ($db->fieldNames() as $name) {
	$content=$db->myreal_escape_string($_REQUEST[$name]);
	if(isset($_REQUEST[$name])) {
		eval("\$db->set".$name."(\$content);");	
	}
	// $db->setPlaceDescEN($db->getPlaceDesc()); //Check
}


$upd = '';

if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}

$out = array(
	'update' => $upd
);

	
	

# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	