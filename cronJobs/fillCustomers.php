<?

/*
 * CRON JOB za popunjavanje tabele v4_Customers
 * puni tabelu cutomerima koji su imali vise od 2 rezervacije

 */
$root='/home/jamtrans/laravel/public/wis.jamtransfer.com';

require_once $root . '/config.php';

require_once $root . '/db/db.class.php';
require_once $root . '/db/v4_OrdersMaster.class.php';
require_once $root . '/db/v4_Customers.class.php';

$db = new DataBaseMysql();
$om = new v4_OrdersMaster();
$cs = new v4_Customers();



// uzmi ordere 
$sql  = "SELECT `MPaxFirstName`,`MPaxLastName`,`MPaxTel`,`MPaxEmail`, count(*) as cnt, sum(`MOrderPriceEUR`) as value FROM `v4_OrdersMaster` ";
$sql  .= " WHERE `MOrderStatus` not in (3,9) and `MUserLevelID` in (3,12) and `MPaxEmail`<>'' ";
$sql  .= " GROUP BY  `MPaxEmail`";

$r = $db->RunQuery($sql);

while ($k = $r->fetch_object()) {
	if ($k->cnt>2) {
		$where=" WHERE CustEmail='".$k->MPaxEmail."'";
		$keys=$cs->getKeysBy('CustID', 'ASC', $where);
		// racunanje tipa customer-a po vrednosti
		/*$avgprice=$k->value/$k->cnt; // prosecna cena
		$kor=0;
		if ($avgprice>500) $kor=1; // korekcija nagore
		if ($avgprice<200) $kor=-1; // korekcija nadole
		$type=0;
		if ($k->value>1500) $type=1;
		if ($k->value>2500) $type=2;
		if ($k->value>3500) $type=3;
		if ($k->value>5000) $type=4; 		
		$type=$type+$kor; 
		if ($type<0) $type=0;
		if ($type>4) $type=4;*/
		
		// racunanje tipa customer-a po broju rezervacija
		$type=0;
		if ($k->cnt>4) $type=1;
		if ($k->cnt>10) $type=2;
		if ($k->cnt>20) $type=3;
		if ($k->cnt>40) $type=4;
		
		
		if (count($keys)>0) {
			$cs->getRow($keys[0]);
			$cs->setOrdersCount($k->cnt);
			$cs->setOrdersValue($k->value);
			$cs->setCustType($type);
			$cs->saveRow();
		} 
		else {
			$cs->setOrdersCount($k->cnt);
			$cs->setOrdersValue($k->value);			
			$cs->setCustFirstName($k->MPaxFirstName);
			$cs->setCustLastName($k->MPaxLastName);
			$cs->setCustEmail($k->MPaxEmail);
			$cs->setCustMobile($k->MPaxTel);
			$cs->setCustType($type);			
			$cs->saveAsNew();
		}	
	}
}


