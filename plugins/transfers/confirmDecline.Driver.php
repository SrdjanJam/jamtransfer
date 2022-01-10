<?
	@session_start();

	require_once ROOT . '/f/f.php';
	

	//echo '<pre>'; print_r($_REQUEST); echo '</pre>';
		
	// classes
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_OrdersMaster.class.php';
	
	// Drivers
	require_once ROOT . '/db/v4_AuthUsers.class.php';
	
	// Log
	require_once ROOT . '/db/v4_OrderLog.class.php';
	
	$d = new v4_OrderDetails();
	$m = new v4_OrdersMaster();
	$u = new v4_AuthUsers();
	$ol= new v4_OrderLog();
	
	$showConfirmDecline = false;

	// uzmi podatke u svakom slucaju
	$DetailsID 	= $_REQUEST['code'];
	$OrderKey 	= $_REQUEST['control'];
	$DriverID	= $_REQUEST['id'];

	$d->getRow($DetailsID);
	$m->getRow($d->OrderID);
	
	$u->getRow($DriverID);
	if($u->getAuthUserID() != $DriverID) die('Error: Inform support team!');

/*
	// get out - something wrong
	if(!is_numeric($DetailsID)) die ('<h1>Error - Parameter not valid.</h1>');
	if(!is_numeric($DriverID)) die ('<h1>Error - Parameter not valid.</h1>');



    if($m->MOrderStatus == '3') die('<h1>Transfer has been Cancelled.</h1>');
    if($d->TransferStatus == '3') die('<h1>Transfer has been Cancelled.</h1>');

	if($m->MOrderKey != $OrderKey) die('<h1>Error - Parameter not valid.</h1>');

	$u->getRow($DriverID);
	if($u->getAuthUserID() != $DriverID) die ('<h1>Error - Parameter not valid.</h1>');	
	
	if($u->getAuthUserID() != $d->getDriverID() and $d->getDriverID() != '0') 
	die('<h2>Error - transfer cannot be confirmed.</h2>');		

	if($u->getAuthUserID() == $d->getDriverID() and $d->getDriverConfStatus() == '2') 
	die('<h2>You have already confirmed this transfer.</h2>');	

	if($u->getAuthUserID() == $d->getDriverID() and $d->getDriverConfStatus() == '4') 
	die('<h2>You have already declined this transfer.</h2>');	
*/	
	// button pressed
	if( isset($_REQUEST['Confirm']) ) { 
		
		if($_REQUEST['Confirm'] == 'Confirmed') {
			
			$d->setDriverConfStatus('2');
			$d->setDriverID( $DriverID);
			$d->setDriverName( $u->getAuthUserCompany() );
			$d->setDriverEmail( $u->getAuthUserMail() );
			$d->setDriverTel( $u->getAuthUserTel() );
			$d->setDriverConfDate( date("Y-m-d") );
			$d->setDriverConfTime( date("H:i:s") );
			
			$d->saveRow();
			$message = CONFIRMED;
			
			// Ovdje obavijestiti kupca da je vozac promijenjen, odnosno da je prihvatio transfer
			$mailMessage = '<span style="font-weight:bold">PLEASE DO NOT REPLY TO THIS MESSAGE</span><br>
			Hello ' . ucwords($d->PaxName) . '!<br>
			We have assigned one of our best drivers to look after You.<br>
			<br>
			Reservation Code: ' . $m->MOrderKey . '-' . $m->MOrderID . '<br>
			TransferID: ' . $d->OrderID . '-' . $d->TNo . '<br>
			Direction: ' . $d->PickupName . ' to ' . $d->DropName . '<br>
			Pickup Point: ' . htmlspecialchars($_REQUEST['PickupPoint']) . '<br>
			<br><br>
			<span style="font-weight:bold">
			Your Driver\'s Name: ' . htmlspecialchars($_REQUEST['SubDriverName']) . '<br>
			Driver\'s Telephone/GSM: ' . htmlspecialchars($_REQUEST['SubDriverTel']) . '</span><br>
			<br>
			You can contact Your driver directly in case You are delayed etc.<br>
			or you can call our Customer Service 24/7 as well.<br>
			<br>
			If you can not reach driver\'s phone number, please contact our Call Centre +381646597200<br>
			If you need to contact us, please send an email to info@jamtransfer.com<br>
			<br>
			Have a nice trip and please recommend us if You like our service!<br>
			<br>
			Kindest regards, <br>
			<br>
			JamTransfer.com Team';
			
			$mailto = $m->MPaxEmail;
			$subject = 'Important Update for Transfer: '. ' ' . $m->MOrderKey.'-'.$m->MOrderID . '-' . $d->TNo;
			
			mail_html($mailto, 'driver-info@jamtransfer.com', 'JamTransfer.com', 'info@jamtransfer.com',
		  	$subject , $mailMessage);

			mail_html('cms@jamtransfer.com', 'driver-info@jamtransfer.com', 'JamTransfer.com', 'info@jamtransfer.com',
		  	$subject , $mailMessage);			

			
			// Log
			$ol->setOrderID($m->getMOrderID);
			$ol->setDetailsID($DetailsID);
			$ol->setAction('Driver');
			$ol->setTitle('Driver Confirmed');
			//$ol->setDescription('Driver ' . $u->getAuthUserRealName() . ' confirmed this transfer.');
			$ol->setDescription('Driver ' . $u->getAuthUserRealName() . ' confirmed this transfer. Subdriver phone:'.$_REQUEST['SubDriverTel']);

			$ol->setDateAdded(date("Y-m-d"));
			$ol->setTimeAdded(date("H:i:s"));
			$ol->setUserID($u->getAuthUserID());
			$ol->setIcon('fa fa-check bg-blue');
			$ol->setShowToCustomer('0');

			$ol->saveAsNew();			
		
		}
		
		if($_REQUEST['Confirm'] == 'Declined') {
			$d->setDriverConfStatus('4');
			$d->setDriverID('');
			$d->saveRow();
			$message = DECLINED;
			
			// Log
			$ol->setOrderID($m->getMOrderID);
			$ol->setDetailsID($DetailsID);
			$ol->setAction('Driver');
			$ol->setTitle('Driver declined');
			$ol->setDescription('Driver ' . $u->getAuthUserCompany() . ' DECLINED this transfer.');
			$ol->setDateAdded(date("Y-m-d"));
			$ol->setTimeAdded(date("H:i:s"));
			$ol->setUserID($u->getAuthUserID());
			$ol->setIcon('fa fa-remove bg-red');
			$ol->setShowToCustomer('0');

			$ol->saveAsNew();	
			$subject = 'Important Update for Transfer: '. ' ' . $m->MOrderKey.'-'.$m->MOrderID . '-' . $d->TNo;			

			$mailMessage = 'Driver ' . $u->getAuthUserCompany() .'<br>
							has DECLINED the transfer:<br><br>' .
							$d->OrderID .'-'.$d->TNo.'<br><br>
							Passenger: '.$d->PaxName.'<br>
							Pickup Date: '.$d->PickupDate.'.<br><br>
							Please select and inform another driver.';
							
			mail_html('cms@jamtransfer.com', 'transfer-update@jamtransfer.com', 'JamTransfer.com', $u->getAuthUserMail(),
		  	$subject , $mailMessage);			

		
		}
	}

