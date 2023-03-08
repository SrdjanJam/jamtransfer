<?php
require_once "../config.php";
require_once ROOT . '/db/v4_Modules.class.php';
require_once ROOT . '/db/v4_Messages.class.php';
$md = new v4_Modules();
$ms = new v4_Messages();
$md->getRow($_REQUEST['ModulID']);
//$md->setMessage($_REQUEST['Message']);
//$message = $md->getMessage();
//$md->saveRow($message);
$ms->setPageID($_REQUEST['ModulID']);
$ms->setFromName($_SESSION['UserRealName']);
$ms->setPageLink($md->getCode());
$ms->setBody($_REQUEST['Message']);
$ms->setUserID($_SESSION['AuthUserID']);
$ms->setDateTime(date("Y-m-d h:i:s"));
$ms->setUserLevel($_SESSION['AuthLevelID']);
$ms->setStatus(0);
$ms->saveAsNew();