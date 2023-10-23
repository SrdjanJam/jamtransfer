<?
require_once '../../config.php';
require_once ROOT . '/db/v4_OnlinePayments.class.php';
$db = new v4_OnlinePayments();
$keyName = 'ID';
$ItemName='ID ';
#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'ID',
	'OrderID',
	'OrderNumber'
	// dodaj ostala polja!
);