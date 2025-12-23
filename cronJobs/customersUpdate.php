<?
/*
* Azuriranje status Customer-a 
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
require_once $root . '/db/v4_Customers.class.php';

$db = new DataBaseMysql();
$cs = new v4_Customers();

if (isset($_REQUEST['CustID'])) $where=" WHERE CustID=".$_REQUEST['CustID'];
else $where=" WHERE 1=1" ;
$csk=$cs->getKeysBy('LastUpdate','LIMIT 10', $where);

$sql  = "SELECT * FROM `v4_CustLevels`";
$r = $db->RunQuery($sql);
while ($k = $r->fetch_object()) {
	$arr_count[]=$k->CountRange;	
	$arr_value[]=$k->ValueRange;	
	$arr_discount[]=$k->Discount;	
}	

foreach ($csk as $key) {
	$cs->getRow($key);
	//$sql  = "SELECT count(*) as cnt, sum(DetailPrice) as sum FROM `v4_OrderDetails` WHERE `OrderDate`>NOW() - INTERVAL 1 year and `TransferStatus` not in (3,6,9) and CustomerID=".$key;
	$sql  = "SELECT count(*) as cnt, sum(DetailPrice) as sum FROM `v4_OrderDetails` WHERE `TransferStatus` not in (3,6,9) and CustomerID=".$key;
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
	$cs->setLastUpdate(date("Y-m-d"));	
	$cs->saveRow();
}	











