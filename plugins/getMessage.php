<?
require_once "../config.php";
require_once ROOT . '/db/v4_Modules.class.php';
require_once ROOT . '/db/v4_Messages.class.php';
$md = new v4_Modules();
$ms = new v4_Messages();
$md->getRow($_REQUEST['ModulID']);
$where=" WHERE `PageID`=".$_REQUEST['ModulID']." AND `Status`=0";
$dbk=$ms->getKeysBy('DateTime', 'Desc', $where);
if (count($dbk) != 0) {
	$message = "";
	
    foreach ($dbk as $nn => $key)
    {
		$ms->getRow($key);
		$message .= "<small><b>".$ms->getFromName()." at ".$ms->getDateTime()."</b><br>"; 
		$message .= $ms->getBody()."</small><br>"; 
	}
}
//$message = $md->getMessage();
echo $message;