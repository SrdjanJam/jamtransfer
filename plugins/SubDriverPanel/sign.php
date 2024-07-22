<?php
require_once "../../config.php";
$strLength = strlen($_REQUEST['paxname']);
if ($strLength < 13) {
    $size = 10;
} else {
    $size = 7;
}
$smarty->assign('paxname',$_REQUEST['paxname']);
$smarty->assign('size',$size);
$smarty->display('sign.tpl');		


