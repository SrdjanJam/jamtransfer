<?php
/*
	AJAX Script !!!!
*/
require_once "../../config.php";
require_once ROOT . '/db/v4_OfficeHours.class.php';
$oh=new v4_OfficeHours();

$where= " WHERE UserID=".$_REQUEST["userid"]." AND WorkDate='".$_REQUEST["date"]." '";	
$ohk=$oh->getKeysBy("ID","",$where);
if (count($ohk)==1) $oh->getRow($ohk[0]);
$oh->setUserID($_REQUEST["userid"]);
$oh->setWorkDate($_REQUEST["date"]);
$oh->setBegin($_REQUEST["begin"]);
$oh->setEnd($_REQUEST["end"]);
if (count($ohk)==1) {
	if (empty($_REQUEST["begin"]) && empty($_REQUEST["end"])) $oh->deleteRow($ohk[0]);
	else $oh->saveRow();
}	
else $oh->saveAsNew();

