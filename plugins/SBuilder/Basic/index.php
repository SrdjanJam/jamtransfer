<?
require_once ROOT . '/db/sb_Basic.class.php';
$bs = new sb_Basic();
if (isset($_REQUEST['submit'])) {
	foreach ($bs->fieldNames() as $name) {
		$content=$bs->myreal_escape_string($_REQUEST[$name]);
		if(isset($_REQUEST[$name])) eval("\$bs->set".$name."(\$content);");	
	}	
	$bs->deleteRow($_SESSION["UseDriverID"]);
	$bs->setPriceRules(json_encode(array()));
	$bs->saveAsNew();
}
$bs->getRow($_SESSION["UseDriverID"]);
$basics=$bs->fieldValues();
foreach ($bs->fieldValues() as $key=>$name) $smarty->assign($key,$name);

