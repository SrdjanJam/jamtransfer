<?php
/*
	AJAX Script !!!!
*/
require_once "../../config.php";
require_once ROOT . '/db/v4_OfficeHours.class.php';
$oh=new v4_OfficeHours();

$where= " WHERE WorkDate='".$_REQUEST["date"]." '";	
$ohk=$oh->getKeysBy("ID","",$where);
$userdate=array();
if (count($ohk)>0) {
	foreach ($ohk as $key) {
		$oh->getRow($key);
		$row=array();
		$row["userid"]=$oh->getUserID();
		$row["begin"]=substr($oh->getBegin(),0,5);
		$row["end"]=substr($oh->getEnd(),0,5);
		$userdate[]=$row;
	}
}
echo json_encode($userdate);	



