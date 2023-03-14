<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Customers.class.php';
require_once ROOT . '/db/v4_OrdersMaster.class.php';

$db = new v4_Customers();
$om = new v4_OrdersMaster();
$dbT = new DataBaseMysql();

$keyName = 'CustID';
$ItemName='CustID ';
$type='Active';
$selectactive='CustActive';
#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'CustID' // dodaj ostala polja!
	// 'TerminalName' // dodaj ostala polja!  CHECK
);

