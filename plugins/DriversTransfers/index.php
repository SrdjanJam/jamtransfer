<?
// Obrisati
// require_once $_SERVER['DOCUMENT_ROOT'] . '/db/db.class.php';
// $db = new DataBaseMysql();

# Submitted
// exit('nesto drugo');

$StartDate 	= $_REQUEST['StartDate'];
$EndDate	= $_REQUEST['EndDate'];

if(!isset($_REQUEST['includePaymentMethod'])){
	$Online    = $_REQUEST['Online'];
	$Cash    = $_REQUEST['Cash'];
	$OnlineCash      = $_REQUEST['OnlineCash'];
	$Invoice     = $_REQUEST['Invoice'];
	$Invoice2     = $_REQUEST['Invoice2'];

	$includePaymentMethod = "";
	if($Online == 1) $includePaymentMethod .= "1,";
	if($Cash == 1) $includePaymentMethod .= "2,";
	if($OnlineCash == 1) $includePaymentMethod .= "3,";
	if($Invoice == 1) $includePaymentMethod .= "4,";
	if($Invoice2 == 1) $includePaymentMethod .= "6,";

	$includePaymentMethod = substr_replace($includePaymentMethod,"",strlen($includePaymentMethod)-1,1); // Replace the words of a text in a string
}else{
	
	$includePaymentMethod = $_REQUEST['includePaymentMethod'];
	// exit('poruka');
}
	// SQL: ====================================================
	$q = 	"SELECT DriverID, sum(DriversPrice) AS DriversPriceTotal, sum(DriverExtraCharge) AS DriverExtraChargeTotal, sum(PayLater) AS PayLaterTotal FROM v4_OrderDetails 
			 WHERE PickupDate >= '{$StartDate}'  
			 AND PickupDate <= '{$EndDate}' 
			 AND TransferStatus != '3' 
			 AND TransferStatus != '4' 
			 AND TransferStatus != '9'";
	if(!empty($includePaymentMethod)) $q.=" AND PaymentMethod in (".$includePaymentMethod.")"; 
	$q .=	 " GROUP BY DriverID";
	$q .=	 " ORDER BY DriverID ASC";
			 
	$w = $db->RunQuery($q);
	// End of SQL ===============================================

	
	$user = array();
	//$userData = array();
	$driverId = array();
	$driversBalance = array();
	$connectedUserNamePlus = array();
	$totalBalance = 0;

	while($o = $w->fetch_object()) {
		$driverId[] = $o->DriverID;
		// $o->DriverID from database

		$user[] = getUserData($o->DriverID);
		
		//$userData[] = trim($user['Country']).' - '.trim($user['Terminal']).' - '.trim($user['AuthUserCompany']).' - '.trim($user['AuthUserTel']);
		// $driversBalance[] = nf(getDriversBalance($StartDate, $EndDate, $o->DriverID,$includePaymentMethod ));
		$driversPriceSum = $o->DriversPriceTotal + $o->DriverExtraChargeTotal;
		$cashTotal = $o->PayLaterTotal;

		$connectedUserNamePlus[] = getConnectedUserNamePlus($o->DriverID);
		
		$totalPrice += $o->DriversPriceTotal;
		$driversBalance[] = $cashTotal - $driversPriceSum;
		$totalBalance +=  $cashTotal - $driversPriceSum;
	
	}
	// SMARTY ASSIGN: ===================================================================
	$smarty->assign('user',$user);
	$smarty->assign('driverId',$driverId);
	$smarty->assign('driversBalance',$driversBalance);
	$smarty->assign('connectedUserNamePlus',$connectedUserNamePlus);
	$smarty->assign('totalBalance',$totalBalance);
	$smarty->assign('includePaymentMethod',$includePaymentMethod);

// Functions: ===========================================================
function GetDriverNameNew($driver) {
	$q = "SELECT * FROM Drivers WHERE DriverID = '" . $driver ."'";
	$w = mysql_query($q) or die( mysql_error() . ' GetDriverName');
	$d = mysql_fetch_object($w);
	return trim($d->Country).' - '.trim($d->Terminal).' - '.trim($d->Prezime).' - '.trim($d->Tel);
}

// Nije potrebno stara verzija:
// function getDriversBalance($start, $end, $driver,$includePaymentMethod) {
// 	require_once ROOT . '/db/v4_OrderDetails.class.php';

	
// 	$od = new v4_OrderDetails();

// 	//$whereD  = " WHERE DriverID ='" . $driver ."' ";
// 	if (getConnectedUser($driver)>0) $whereD= ' WHERE (DriverID = ' . $driver . '  OR DriverID =  '.getConnectedUser($driver). ') '; 
// 	else $whereD  = " WHERE DriverID ='" . $driver ."' ";
	
// 	$whereD .= " AND PickupDate >= '{$start}' AND PickupDate <= '{$end}' ";
// 	$whereD .= " AND TransferStatus != 3 ";
// 	$whereD .= " AND TransferStatus != 4 ";
// 	$whereD .= " AND TransferStatus != 9 ";	
// 	if(!empty($includePaymentMethod)) $q.=" AND PaymentMethod in (".$includePaymentMethod.")"; 
	
// 	$kd = $od->getKeysBy('DetailsID', 'asc', $whereD);						
						
// 	foreach($kd as $nn => $id) {
// 		$od->getRow($id);
// 		$driversPriceSum += $od->getDriversPrice()+$od->DriverExtraCharge;
// 		$cashTotal		+= $od->getPayLater();

// 	} //endforeach	

// 	// Balans je primnjene kes minus vozaceva cena 
// 	return $cashTotal - $driversPriceSum;	
// }

