<?
if (isset($_REQUEST['submit'])) {
	require_once ROOT . '/db/sb_Vehicles.class.php';
	$vh = new sb_Vehicles();	
	if(isset($_REQUEST['VehicleID']) && $_REQUEST['VehicleID']>0) $vh->getRow($_REQUEST['VehicleID']);		
	foreach ($vh->fieldNames() as $name) {
		$content=$vh->myreal_escape_string($_REQUEST[$name]);
		if(isset($_REQUEST[$name])) {
			eval("\$vh->set".$name."(\$content);");	
		}	
	}	
	$vh->setPicture('Picture');

	
	if($_REQUEST['VehicleID']>0) $vh->saveRow();	
	else $_REQUEST['VehicleID']=$vh->saveAsNew();
}

//za uneto
require_once ROOT . '/db/sb_Vehicles.class.php';
$vh = new sb_Vehicles();
$where=" WHERE OwnerID=".$_SESSION["UseDriverID"];
$vhk=$vh->getKeysBy("VehicleID","",$where);
$vehicles=array();
$vh->getRow(0);
$row["VehicleID"]=0;
$vehicles[]=$row;
$types=array(STANDARD,PREMIUM,FIRST_CLASS);
$shType = new SmartyHtmlSelection("type",$smarty);
$i=1;
foreach ($types as $t) 
{
	$shType->AddOutput($t);
	$shType->AddValue($i);
	$i++;		
}
$shType->SmartyAssign();
foreach ($vhk as $key) {
	$vh->getRow($key);
	$row=$vh->fieldValues();
	$vehicles[]=$row;
}			
$smarty->assign('vehicles',$vehicles);
	
?>
