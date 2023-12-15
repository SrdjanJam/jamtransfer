<?php

require_once "../config.php";
require_once ROOT . '/db/v4_Modules.class.php';
require_once ROOT . '/db/v4_FieldsDescriptions.class.php';

$md = new v4_Modules();
$fs = new v4_FieldsDescriptions();

// Spare:
$where = " WHERE (Code = '" . $_REQUEST['Module'] . "' )";
$kd = $md->getKeysBy('ModulID', 'asc', $where);
$result=array();
if (count($kd>0)) {
	$md->getRow($kd[0]);
	$help = $md->getHelp();
	$where = " WHERE (ModuleID = '" . $md->getModulID() . "' )";
	$dbk = $fs->getKeysBy('ID', 'asc', $where);
	$out=array();
	$contents="";
	if (count($dbk) != 0) {
		foreach ($dbk as $nn => $key)
		{
			$fs->getRow($key);
			$detailFlds = $fs->fieldValues();
			$out[] = $detailFlds; 
		}
		$smarty->assign('out',$out);
		ob_start();
		$smarty->display('fieldDescription.tpl');
		echo $contents = ob_get_contents();
		ob_end_clean();
	}
	$result=array("help"=>$help, "fd"=>htmlentities($contents));
}
echo json_encode($result);