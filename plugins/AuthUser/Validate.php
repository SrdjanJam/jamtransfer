<?
require_once 'Initial.php';
$where=" WHERE AuthUserName='".$_REQUEST['input']."'";
$dbk=$db->getKeysBy("AuthUserID","",$where);
if (count($dbk)>0)	echo 1;
else echo 0;	
	