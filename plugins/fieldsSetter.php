<?php

require_once "../config.php";

require_once ROOT . '/db/v4_FieldsSettings.class.php';

$fs = new v4_FieldsSettings();

$where = " WHERE `ModuleID` = " . $_REQUEST['ModuleID'] . " AND LevelID = " . $_REQUEST['LevelID'] . " AND Name = '" . $_REQUEST['Name'] . "'";
$dbk = $fs->getKeysBy('ID', 'asc', $where);
if (count($dbk) != 0) $fs->getRow($dbk[0]);	
$fs->setModuleID($_REQUEST['ModuleID']);
$fs->setLevelID($_REQUEST['LevelID']);
$fs->setName($_REQUEST['Name']);
if ($_REQUEST['SetType']=='required') $fs->setRequired($_REQUEST['SetValue']);
if ($_REQUEST['SetType']=='disabled') $fs->setDisabled($_REQUEST['SetValue']);
if ($_REQUEST['SetType']=='hidden') $fs->setHidden($_REQUEST['SetValue']);
if (count($dbk) != 0) $fs->saveRow();
else $fs->saveAsNew();
	
echo "1";

