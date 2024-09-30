<?

/*
* Menjanje status Customer-a 
* prema dosadasnjim kupovinama
 */
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';
$cronjob=true;
//require_once $root . '/config.php';
define("DB_HOST", "127.0.0.1");
$DB_USER="jamtrans_cms";
$DB_PASSWORD="~5%OuH{etSL)";
$DB_NAME="jamtrans_touradria";
require_once $root . '/db/db.class.php';
require_once $root . '/db/v4_OrderDetails.class.php';
require_once $root . '/db/v4_OrdersMaster.class.php';
require_once $root . '/db/v4_Customers.class.php';

$db = new DataBaseMysql();
$od = new v4_OrderDetails();
$om = new v4_OrdersMaster();
$cs = new v4_Customers();

//$today=date("Y-m-d");
$today=date("Y-m-d", time()-600);
$yearsago=date("Y-m-d", time()-365*24*3600);
//$where=" WHERE (OrderDate='".$today."' or OrderDate='".$yearsago."') and UserLevelID in (3,12) and CustomerID>0";
$where=" WHERE OrderDate='".$today."' and UserLevelID in (3,12)";
$keys=$od->getKeysBy('OrderID', 'ASC', $where);
$cids=array();
foreach ($keys as $key) {
	$od->getRow($key);
	if ($od->getCustomerID()==0) {
		$om->getRow($od->getOrderID());	
		$email=$om->getMPaxEMail();
		$where2= ' WHERE CustEmail="'.$email.'" ';
		$csk=$cs->getKeysBy('CustID','ASC', $where2);
		if (count($csk)>0) {
			$od->setCustomerID($csk[0]);
			$od->saveRow();
		}	
	}	
	if ($od->getCustomerID()>0)  $cids[]=$od->getCustomerID();
}
$cids=array_unique($cids);

$sql  = "SELECT * FROM `v4_CustLevels`";
$r = $db->RunQuery($sql);
while ($k = $r->fetch_object()) {
	$arr_count[]=$k->CountRange;	
	$arr_value[]=$k->ValueRange;	
	$arr_discount[]=$k->Discount;	
}	

foreach ($cids as $cid) {
	$sql  = "SELECT count(*) as cnt, sum(DetailPrice) as sum FROM `v4_OrderDetails` WHERE `OrderDate`>NOW() - INTERVAL 1 year and `TransferStatus` not in (3,9) and CustomerID=".$cid;
	$r = $db->RunQuery($sql);
	$k=$r->fetch_object();
	$count=$k->cnt;

	$value=$k->sum;
	
	for ($i=0; $i<3; $i++) {
		if ($count>$arr_count[$i]-1) $c=$i+1;	
		if ($value>$arr_value[$i]-1) $v=$i+1;		
	}
	$type=max($c,$v);
	$discount=$arr_discount[$type-1];
	if ($type<4) {
		$nlc=$arr_count[$type]-$count;
		$nlv=$arr_value[$type]-$value;
	} else {
		$nlc=0;
		$nlv=0;
	}		
	$cs->getRow($cid);
	$cs->setOrdersCount($count);
	$cs->setOrdersValue($value);
	$cs->setNextLevelCount($nlc);
	$cs->setNextLevelValue($nlv);
	$cs->setDiscount($discount);
	$cs->setLevelID($type);
	$cs->saveRow();
}	



