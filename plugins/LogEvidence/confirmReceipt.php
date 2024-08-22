<?php
require_once "../../config.php";
require_once ROOT . '/db/v4_OfficeHours.class.php';
$oh=new v4_OfficeHours();
$oh->getRow($_REQUEST['id']);
$oh->setStatus(3);
$oh->saveRow();
echo "<img width='500px' src='".ROOT_HOME."/i/logo.png' />";
echo "<h1>Message receipt confirmed! Thank you.</h1>";

