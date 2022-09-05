<?

if(isset($_REQUEST['NoShow'])) {
	
	$StartDate 	= $_REQUEST['StartDate'];
	$EndDate	= $_REQUEST['EndDate'];

	if(!isset($_REQUEST ['NoShow'])) $_REQUEST ['NoShow'] = 0;
	if(!isset($_REQUEST ['DrErr'])) $_REQUEST ['DrErr'] = 0;
	if(!isset($_REQUEST ['Sistem'])) $_REQUEST ['Sistem'] = 0;
	if(!isset($_REQUEST ['CompletedTransfers'])) $_REQUEST ['CompletedTransfers'] = 0;

	$noshow = $_REQUEST ['NoShow'];
	$driverError = $_REQUEST['DrErr'];
	$Sistem = $_REQUEST['Sistem'];
	$CompletedTransfers = $_REQUEST['CompletedTransfers'];


	$q = "SELECT DISTINCT(UserID) FROM v4_OrderDetails ";


	if($Sistem == 1){
		$q = 	"SELECT DISTINCT(UserID) FROM v4_OrderDetails 
				 WHERE PickupDate >= '{$StartDate}'  
				 AND PickupDate <= '{$EndDate}' ";
	}			 
		
	else {
		$q = 	"SELECT DISTINCT(UserID) FROM v4_OrderDetails 
				 WHERE OrderDate >= '{$StartDate}'  
				 AND OrderDate <= '{$EndDate}' ";
	}	
	if($CompletedTransfers != 1) {
		//iskljuceni cancel,temp deleted
		$q .=	"AND TransferStatus != '3' 
				 AND TransferStatus != '4' 
				 AND TransferStatus != '9' ";
	}
	else {	
		// samo completed
		$q .=	"AND TransferStatus = '5' ";
	}
		 
	$q .= "AND PaymentMethod = '4' ";
		 
	//  iskljucen noshow
	if($noshow != 1) $q .=	"AND DriverConfStatus != '5' ";
	// iskljucen driver error
	if($driverError != 1) $q .=	"AND DriverConfStatus != '6' ";
	
	$q .=	" ORDER BY UserID ASC";
			 
	// exit($q);
	$w = $db->RunQuery($q);
	// print_r($w);


	$totalPrice = $totalInvoice = $totalProvision = 0;

    $user = array();
    $connectedUserNamePlus = array();
	
	while($o = $w->fetch_object()) {
		// echo $o->UserID;
		$user[] = getUserData($o->UserID);
		// print_r(getUserData($o->UserID));
		// exit();
        // Nepotrebno:
		// $userData = trim($user['AuthUserCompany']);
        $connectedUserNamePlus[] = getConnectedUserNamePlus($o->UserID);
		
	}
	// print_r($user);
	$smarty->assign('user',$user);
	$smarty->assign('connectedUserNamePlus',$connectedUserNamePlus);
}
else {

}





