<?

	if(!isset($_REQUEST['StartDate'])) $_REQUEST['StartDate'] = "";
	if(!isset($_REQUEST['EndDate'])) $_REQUEST['EndDate'] = "";
	if(!isset($_REQUEST['Online'])) $_REQUEST['Online'] = "";
	if(!isset($_REQUEST['Cash'])) $_REQUEST['Cash'] = "";
	if(!isset($_REQUEST['OnlineCash'])) $_REQUEST['OnlineCash'] = "";
	if(!isset($_REQUEST['Invoice'])) $_REQUEST['Invoice'] = "";
	if(!isset($_REQUEST['Invoice2'])) $_REQUEST['Invoice2'] = "";


	$StartDate 	= $_REQUEST['StartDate'];
	$EndDate	= $_REQUEST['EndDate'];
	$Online    = $_REQUEST['Online'];
	$Cash    = $_REQUEST['Cash'];
	$OnlineCash      = $_REQUEST['OnlineCash'];
	$Invoice     = $_REQUEST['Invoice'];
	$Invoice2     = $_REQUEST['Invoice2'];


	$totalPrice = 0;


	if(!isset($_REQUEST['includePaymentMethod'])){

		$includePaymentMethod = "";
		if($Online == 1) $includePaymentMethod .= "1,";
		if($Cash == 1) $includePaymentMethod .= "2,";
		if($OnlineCash == 1) $includePaymentMethod .= "3,";
		if($Invoice == 1) $includePaymentMethod .= "4,";
		if($Invoice2 == 1) $includePaymentMethod .= "6,";

		$includePaymentMethod = substr_replace($includePaymentMethod,"",strlen($includePaymentMethod)-1,1); // Replace the words of a text in a string
	}else{
		$includePaymentMethod = $_REQUEST['includePaymentMethod'];
	}
	// SQL: ====================================================
	$q = 	"SELECT DriverID, sum(DriversPrice) AS DriversPriceTotal, sum(DriverExtraCharge) AS DriverExtraChargeTotal, sum(PayLater) AS PayLaterTotal FROM v4_OrderDetails 
			 WHERE PickupDate >= '{$StartDate}'  
			 AND PickupDate <= '{$EndDate}' 
			 AND TransferStatus != '3' 
			 AND TransferStatus != '4' 
			 AND TransferStatus != '9'
			 AND DriverID > 0";
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
		$user[] = getUserData($o->DriverID);		
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