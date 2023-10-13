<?
	header('Content-Type: text/javascript; charset=UTF-8');
	session_start();

	$mailTo = $_REQUEST['mailTo'];
	$mailFrom = $_REQUEST['mailFrom'];
	$fromName = $_REQUEST['fromName'];
	$subject = $_REQUEST['subject'];
	$message = $_REQUEST['message'];
	$profile = $_REQUEST['profile'];
	$DetailsID = $_REQUEST['DetailsID'];
	$reason = $_REQUEST['reason'];

	require_once '../config.php';
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_OrdersMaster.class.php';
	require_once ROOT . '/db/v4_AuthUsers.class.php';

	// classes
	$od = new v4_OrderDetails();
	$om = new v4_OrdersMaster();
	$au = new v4_AuthUsers();

	$od->getRow($DetailsID);
	$OrderID = $od->getOrderID();
	$oKey = $om->getKeysBy('MOrderID', 'ASC', ' WHERE MOrderID = ' .$OrderID);

	$om->getRow($oKey[0]);
	$AuthUserID = $om->getMUserID();


	// Podaci o useru - Taxi site ili partner, agent 
	//$users = array('2', '4', '5', '6', '12');

	// ticket 662 - kaze da mail vozacu stize sa mail adrese agenta. fix:
	$users = array('12');
	
	$au->getRow($AuthUserID);
	$level = $au->getAuthLevelID();
	
	if(in_array($level, $users)) {
		$fromName = $au->getAuthUserCompany();
		$mailFrom = $au->getAuthUserMail();
	}
	else {
		$fromName = 'JamTransfer.com';
		$mailFrom = 'info@jamtransfer.com';
	}



	// slaganje potvrde za poslati vozacu ili putniku
	ob_start();
	if ($reason<>"") $reason2='-Change/'.$reason;
	if ($profile == 'driver') {
		$subject = $om->MOrderKey.'-'.$om->MOrderID.'-'.$od->TNo.$reason2;
		if ($reason<>"") {
		?>
		<div style="font-weight:bold;color:red">
			Hello, there is a change of <u><?= $reason ?></u> in the reservation. Please, check and confirm new details by email reply.
		</div>
		<?
		}
		newPrintReservation($DetailsID, 'driver', $od, $om);
	}
	else if ($profile == 'pax') {
		$subject = $om->MOrderKey.'-'.$om->MOrderID.'-'.$od->TNo.$reason2;
		if ($reason<>"") {		
		?>
		<div style="font-weight:bold;color:red">
			There is a change of <u><?= $reason ?></u> in the reservation.
		</div>		
		<?
		}
		if ($level==2) printVoucher($od->getOrderID(),false);
		else printVoucher($od->getOrderID());
	}
	$message = ob_get_contents();
	ob_end_clean();

	// slanje maila
	if ($message != '' and $mailTo != '') {
		$sent = mail_html_send($mailTo, $mailFrom, $fromName, $mailFrom, $subject, $message);
		$sent = true;
	}
	else $sent = false;

	if ($sent) $output = '<span class="badge bg-green"><i class="ic-happy"></i> Message sent to mail queue</span>';
	else $output = '<span class="badge bg-red"><i class="ic-sad"></i> Message not sent to mail queue</span>';

	echo $_GET['callback'] . '(' . json_encode($output) . ')';


