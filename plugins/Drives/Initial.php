<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Places.class.php';
require_once ROOT . '/db/v4_Routes.class.php';
require_once ROOT . '/db/v4_OrderDetails.class.php';
require_once ROOT . '/db/v4_OrdersMaster.class.php';

require_once ROOT . '/db/v4_OrderLog.class.php';
require_once ROOT . '/db/v4_VehicleTypes.class.php';
require_once ROOT . '/db/v4_SubVehicles.class.php';
require_once ROOT . '/db/v4_OrderExtras.class.php';
require_once ROOT . '/db/v4_Extras.class.php';
require_once ROOT . '/db/v4_AuthUsers.class.php';


class v4_OrdersJoin extends v4_OrderDetails {
	public function getFullOrderByDetailsID($column, $order, $limit, $where = NULL) {
		$keys = array(); $i = 0;
		$sql="
			SELECT v4_OrderDetails.*,v4_OrdersMaster.*,v4_AuthUsers.AuthUserRealName FROM v4_OrderDetails AS v4_OrderDetails, v4_OrdersMaster, v4_AuthUsers $where
			AND v4_OrderDetails.OrderID = v4_OrdersMaster.MOrderID AND v4_AuthUsers.AuthUserID=UserID ORDER BY $column $order $limit";
		$result = $this->connection->RunQuery($sql);
			
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["DetailsID"];
				$i++;
			}
	return $keys;
	}
}

$db = new v4_OrderDetails();
$od = new v4_OrdersJoin();
$pl = new v4_Places();
$rt = new v4_Routes();
$om = new v4_OrdersMaster();
$ol = new v4_OrderLog();
$vt = new v4_VehicleTypes();
$sv = new v4_SubVehicles();
$oe = new v4_OrderExtras();
$ex = new v4_Extras();
$au = new v4_AuthUsers();
$dbT = new DataBaseMysql();

$keyName = 'DetailsID';
//$ItemName='PlaceNameEN ';
$type='TransferStatus';
$type3='DriverConfStatus';
#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'OrderID'
);