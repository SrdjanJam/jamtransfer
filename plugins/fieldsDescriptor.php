<?php
require_once "../config.php";
require_once ROOT . '/db/v4_FieldsDescriptions.class.php';
$fs = new v4_FieldsDescriptions();
$where = " WHERE `ModuleID` = " . $_REQUEST['ModuleID'] . " AND Name = '" . $_REQUEST['Name'] . "'";
$dbk = $fs->getKeysBy('ID', 'asc', $where);
if (count($dbk) != 0) $fs->getRow($dbk[0]);	
$fs->setModuleID($_REQUEST['ModuleID']);
$fs->setName($_REQUEST['Name']);
$fs->setDescription($_REQUEST['SetValue']);
if (count($dbk) != 0) $fs->saveRow();
else $fs->saveAsNew();
echo "1";

