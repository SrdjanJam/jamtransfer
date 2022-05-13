<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Places.class.php';
require_once ROOT . '/db/v4_OrderDetails.class.php';
require_once ROOT . '/db/v4_OrdersMaster.class.php';
require_once ROOT . '/db/v4_OrderDocument.class.php';
require_once ROOT . '/db/v4_Places.class.php';

class v4_OrdersJoin extends v4_OrderDetails {
	public function getFullOrderByDetailsID($column, $order, $where = NULL) {
		$keys = array(); $i = 0;
		$sql="
			SELECT v4_OrderDetails.*,v4_OrdersMaster.*,v4_AuthUsers.AuthUserRealName FROM v4_OrderDetails AS v4_OrderDetails, v4_OrdersMaster, v4_AuthUsers $where
			AND v4_OrderDetails.OrderID = v4_OrdersMaster.MOrderID AND v4_AuthUsers.AuthUserID=UserID ORDER BY $column $order";
		$result = $this->connection->RunQuery($sql);
			
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["DetailsID"];
				$i++;
			}
	return $keys;
	}
}

$od = new v4_OrdersJoin();
$pl = new v4_Places();
$om = new v4_OrdersMaster();
$odoc = new v4_OrderDocument();

$keyName = 'DetailsID';
//$ItemName='PlaceNameEN ';
$type='TransferStatus';
#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'v4_OrderDetails.OrderID',
	'v4_OrderDetails.PaxName',
	'v4_OrderDetails.PickupName',
	'v4_OrderDetails.DropName',
	'v4_OrderDetails.PickupDate',
	'v4_OrderDetails.InvoiceNumber',
	'v4_OrderDetails.UserID',	
	'v4_OrderDetails.DriverName',	
	'v4_OrderDetails.DriverInvoiceNumber',	
	'v4_OrdersMaster.MPaxEmail',
	'v4_OrdersMaster.MCardNumber',
	'v4_OrdersMaster.MOrderKey',
	'v4_OrdersMaster.MConfirmFile',
	'v4_AuthUsers.AuthUserRealName'
);