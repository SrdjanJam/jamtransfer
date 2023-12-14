<?php

require_once "../config.php";

require_once ROOT . '/db/v4_Modules.class.php';
require_once ROOT . '/db/v4_FieldsDescriptions.class.php';
$md = new v4_Modules();
$fs = new v4_FieldsDescriptions();

// Spare:
// $where = " WHERE (ModuleID = '" . $_REQUEST['ModuleID'] . "' )";
// $kd = $md->getKeysBy('ModuleID', 'asc', $where);

$md->getRow($_REQUEST['ModulID']);
$help = $md->getHelp();

echo $help;

$where = $fs->getRow($_REQUEST['ModulID']);
$dbk = $fs->getKeysBy('ID', 'asc', $where);

$out=array();
if (count($dbk) != 0) {
    foreach ($dbk as $nn => $key)
    {
		$fs->getRow($key);
		$detailFlds = $fs->fieldValues();
		$out[] = $detailFlds; 
	}
}


$smarty->assign('out',$out);
$smarty->display('fieldDescription.tpl');

