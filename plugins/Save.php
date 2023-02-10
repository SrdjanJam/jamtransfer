<?php

require_once "../config.php";

require_once ROOT . '/db/v4_Modules.class.php';


$md = new v4_Modules();

$md->getRow($_REQUEST['ModulID']);
$md->setMessage($_REQUEST['Message']);
$message = $md->getMessage();
$md->saveRow($message);

