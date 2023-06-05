<?php

require_once "../config.php";

require_once ROOT . '/db/v4_FieldsSettings.class.php';

$fs = new v4_FieldsSettings();
if (isset($_REQUEST['LevelID'])) $levelID=$_REQUEST['LevelID'];
else $levelID=$_SESSION['AuthLevelID'];
$where = " WHERE `ModuleID` = " . $_REQUEST['ModuleID'] . " AND LevelID = " . $levelID;
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
$output = array(
'data' =>$out
);	
echo $_GET['callback'] . '(' . json_encode($output) . ')';	

