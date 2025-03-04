<?
require_once ROOT . '/db/v4_DriverTerminals.class.php';
require_once ROOT . '/db/v4_Places.class.php';
$dt = new v4_DriverTerminals();
$pl = new v4_Places();
if (isset($_REQUEST['submit'])) {
	/*foreach ($bs->fieldNames() as $name) {
		$content=$bs->myreal_escape_string($_REQUEST[$name]);
		if(isset($_REQUEST[$name])) eval("\$bs->set".$name."(\$content);");	
	}	
	$bs->deleteRow($_SESSION["UseDriverID"]);
	$bs->saveAsNew();*/
}
//$where=" WHERE DriverID=".$_SESSION["UseDriverID"];
$where=" WHERE 1=1";
$dtk=$dt->getKeysBy("TerminalID","",$where);
$dts=array();
foreach($dtk as $key) {
	$dt->getRow($key);
	$dts[]=$dt->getTerminalID();
}
$dtkeys="0,".implode(",",$dts);
$where2=" WHERE PlaceID in (".$dtkeys.")";
$plk=$pl->getKeysBy("PlaceID","",$where2);
$terminals=array();
$t_row=array();
$t_row['id']=-1;
$t_row['name']="Choose terminal/airport";
$t_row['lon']=0;
$t_row['lat']=0;
$terminals[]=$t_row;
$shTerminals = new SmartyHtmlSelection("terminals",$smarty);
foreach($plk as $key) {
	$pl->getRow($key);
	$t_row=array();
	$t_row['id']=$pl->getPlaceID();
	$t_row['name']=$pl->getPlaceNameEN();
	$t_row['lon']=$pl->getLongitude();
	$t_row['lat']=$pl->getLatitude();
	$terminals[]=$t_row;
}
$smarty->assign("terminals",$terminals);

