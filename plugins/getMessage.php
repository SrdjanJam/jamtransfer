<?php

require_once "../config.php";

require_once ROOT . '/db/v4_Modules.class.php';


$md = new v4_Modules();

// Spare:
// $where = " WHERE (ModuleID = '" . $_REQUEST['ModuleID'] . "' )";
// $kd = $md->getKeysBy('ModuleID', 'asc', $where);

$md->getRow($_REQUEST['ModulID']);
$message = $md->getMessage();

echo $message;