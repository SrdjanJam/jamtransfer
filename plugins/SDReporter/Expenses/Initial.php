<?
require_once '../../../config.php';
require_once ROOT . '/db/v4_SubExpenses.class.php';
require_once ROOT . '/db/v4_AuthUsers.class.php';
require_once ROOT . '/db/v4_Actions.class.php';

$db = new v4_SubExpenses();
$ac = new v4_Actions();
$dbT = new DataBaseMysql();

$keyName = 'ID';
$ItemName='Datum ';
$selectapproved='Approved';


#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'Title' // dodaj ostala polja!
);