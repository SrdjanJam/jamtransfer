<?
require_once '../config.php';
require_once ROOT . '/db/v4_AuthUsers.class.php';
$au= new v4_AuthUsers();
$where=" WHERE Temp_pass='".$_REQUEST['key']."'";
$auk=$au->getKeysBy("AuthUserID","",$where);
if (count($auk)==1) {
	if (isset($_REQUEST['log'])) {
		$_REQUEST["MobileLog"]=1;
		if ($_REQUEST['log']=='login') saveLog($auk[0],1);
		if ($_REQUEST['log']=='logout') saveLog($auk[0],2);
		$au->getRow($auk[0]);
		echo $au->getAuthUserRealName();
	}
}	
else echo 0;
