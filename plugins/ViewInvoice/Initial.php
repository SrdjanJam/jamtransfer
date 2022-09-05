<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Invoices.class.php';
$db = new v4_Invoices();
$dbT = new DataBaseMysql();

$keyName = 'ID';
$ItemName='InvoiceNumber ';
$type='Type';
#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'InvoiceNumber' // dodaj ostala polja!
);

