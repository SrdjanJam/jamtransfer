<?
	@session_start();

	require_once ROOT . '/f/f.php';
	

	//echo '<pre>'; print_r($_REQUEST); echo '</pre>';
		
	// classes
    require_once ROOT . '/db/db.class.php';	
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_OrdersMaster.class.php';
	
	// Drivers
	require_once ROOT . '/db/v4_AuthUsers.class.php';
	
	// Log
	require_once ROOT . '/db/v4_OrderLog.class.php';
	
    $db = new DataBaseMysql();	
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

	if($d->TransferStatus == '4') die('<h1>Transfer wait for customer confirmation.</h1>'); 

	// button pressed
	if( isset($_REQUEST['Confirm']) ) { 
		
		if($_REQUEST['Confirm'] == 'Confirmed') {
			
			//izracunavanje i punjenje driver extras charge
			$idd=$d->getDetailsID();
			$query="SELECT `ServiceID`,`Qty` FROM `v4_OrderExtras` WHERE `OrderDetailsID`=".$idd;
			$result = $db->RunQuery($query);
			$suma=0;
			while($row = $result->fetch_array(MYSQLI_ASSOC)){  
				$id=$row['ServiceID'];
				$kol=$row['Qty'];
				$query1="SELECT `ID`,`DriverPrice`,`Provision`  FROM `v4_Extras` WHERE `ID`=".$id	;
				$result1 = $db->RunQuery($query1);
				while($row1 = $result1->fetch_array(MYSQLI_ASSOC)){  
					$suma+=$row1['DriverPrice']*$kol;	
					$query4="UPDATE `v4_OrderExtras` SET 
						`DriverPrice`=".$row1['DriverPrice'].",
						`Provision`=".$row1['Provision'].",
						`DriverPriceSum`=".$row1['DriverPrice']."*`Qty`				
						where `ServiceID`=".$row1['ID'];		
					$result4 = $db->RunQuery($query4);			
				}
			}				
			$d->setDriverExtraCharge($suma);
			// kraj driver extras charge
			$d->setDriverConfStatus('2');
			$d->setDriverID( $DriverID);
			$d->setDriverName( $u->getAuthUserCompany() );
			$d->setDriverEmail( $u->getAuthUserMail() );
			$d->setDriverTel( $u->getAuthUserTel() );
			$d->setDriverConfDate( date("Y-m-d") );
			$d->setDriverConfTime( date("H:i:s") );			
			$d->saveRow();

			$message = CONFIRMED; 
			

			
			if ($u->getContractFile()=='inter') $phonemessage=' (do NOT send SMS, only for calls)';
			else $phonemessage='/GSM';
			
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
			<span style="font-weight:bold">';
			//$mailMessage .='Your Driver\'s Name: ' . htmlspecialchars($_REQUEST['SubDriverName']) . '<br>'; ne prikazivati
			$mailMessage .='Driver\'s Telephone';
			$mailMessage .=$phonemessage;
			$mailMessage .=': ' . htmlspecialchars($_REQUEST['SubDriverTel']) . '</span>
			<br>
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
			
			// blok za premostavanje blokade primanja mail-ova preko ticketing-a
			/*$agentmail=$mailto;
			$agentmail_arr=explode('@',$agentmail);
			$agentmail_pr=$agentmail_arr[1];
			
			if ($agentmail_pr<>'gmail.com' && $agentmail_pr<>'yahoo.com') {
				mail_html('jamtransfercomtransfers@jamtransfer.freshdesk.com', 'driver-info@jamtransfer.com', 'JamTransfer', 'driver-info@jamtransfer.com',
						  $subject.'-'.$agentmail, $mailMessage);	  					
			}*/
			// kraj bloka	

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
			$ol->setOrderID($d->OrderID);
			$ol->setDetailsID($DetailsID);
			$ol->setAction('Driver');
			$ol->setTitle('Driver declined');
			//$ol->setDescription('Driver ' . $u->getAuthUserCompany() . ' DECLINED this transfer.');			
			$ol->setDescription('Driver ' . $u->getAuthUserCompany() . ' DECLINED this transfer for reason: '.$_REQUEST['DeclineReason'].' / '. $_REQUEST['DeclineMessage']);			
			$ol->setDateAdded(date("Y-m-d"));
			$ol->setTimeAdded(date("H:i:s"));
			$ol->setUserID($u->getAuthUserID());
			$ol->setIcon('fa fa-remove bg-red');
			$ol->setShowToCustomer('0');

			$ol->saveAsNew();	
			$subject = 'Important Update for Transfer: '. ' ' . $m->MOrderKey.'-'.$m->MOrderID . '-' . $d->TNo;			

			$mailMessage = 'Driver ' . $u->getAuthUserCompany() .'<br>
							has DECLINED the transfer:<br><br>' .
							$d->OrderID .'-'.$d->TNo.'<br>for reason: '.$_REQUEST['DeclineReason'].' / '. $_REQUEST['DeclineMessage']. 
							'<br><br>
							Passenger: '.$d->PaxName.'<br>
							Pickup Date: '.$d->PickupDate.'.<br><br>
							Please select and inform another driver.';
							
			mail_html('cms@jamtransfer.com', 'transfer-update@jamtransfer.com', 'JamTransfer.com', $u->getAuthUserMail(),
		  	$subject , $mailMessage);			 

		
		}
	}

