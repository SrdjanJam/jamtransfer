<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Customers.class.php';

$db = new v4_Customers();
$dbT = new DataBaseMysql();

$keyName = 'CustID';
$ItemName='CustID ';
// Check:
// $ItemName='PlaceNameEN ';
// $type='PlaceType';
#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'CustID' // dodaj ostala polja!
	// 'TerminalName' // dodaj ostala polja!  CHECK
);

