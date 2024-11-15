<?php
require_once "../../config.php";
require_once ROOT . '/db/v4_LogUser.class.php';
$lu = new v4_LogUser();
$luk = $lu->getKeysBy('ID', '' , " WHERE `SessionID`='".$_REQUEST['sid']."' AND Type>2");
if (count($luk)>0) {
	$lu->getRow($luk[0]);
		$lu->setType($lu->getType()-2);
		$lu->saveRow();
		echo "<h1>LOGIN / LOGOUT APPROVED</h1>";
} else echo "<h1>SOMETHING WRONG / YOU ARE ALREADY LOGGED</h1>";


