<?
require_once '../../config.php';
require_once ROOT . '/db/v4_OnlinePayments.class.php';
require_once ROOT . '/db/v4_OrdersMaster.class.php';
require_once ROOT . '/db/v4_OrderDetails.class.php';
require_once ROOT . '/db/v4_Places.class.php';
$db = new v4_OnlinePayments();
$om = new v4_OrdersMaster();
$od = new v4_OrderDetails();
$pl = new v4_Places();
$keyName = 'ID';
$ItemName='ID ';
$selectapproved='Status';
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