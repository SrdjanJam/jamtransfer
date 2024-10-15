<?
require_once '../config.php';
unset($_SESSION['confirmDayStart']);
if ($_REQUEST['confirm']==1) {
	require_once ROOT . '/db/v4_LogUser.class.php';
	$lu = new v4_LogUser();
	$luk = $lu->getKeysBy('ID', '' , " WHERE `SessionID`='".session_id()."' AND Type>2");
	if (count($luk)>0) {
		$lu->getRow($luk[0]);
		$lu->setType($lu->getType()-2);
		date_default_timezone_set('Europe/Paris');
		$lu->setDateTime(date('Y-m-d H:i:s'));
		$lu->saveRow();
		echo "You confirm start of the day";
	} else echo "You have already confirmed the start of the day";
} else echo "Something is wrong. Try again.";



