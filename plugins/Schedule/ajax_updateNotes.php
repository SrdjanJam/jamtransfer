<?
@session_start();
require_once "../../config.php";
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

// FRANCUSKA FIX
$SOwnerID = $_SESSION['OwnerID'];

// preko timetable se samo sljedeca polja mogu mijenjati
$data = array(
        'SubPickupTime' => $_REQUEST['SubPickupTime'],
        'FlightNo'   => $_REQUEST['FlightNo'],
        'FlightTime' => $_REQUEST['FlightTime'],
        'SubDriver'     => $_REQUEST['SubDriver'],
        'SubDriver2'    => $_REQUEST['SubDriver2'],
        'SubDriver3'    => $_REQUEST['SubDriver3'],
        'Car'           => $_REQUEST['Car'],
        'Car2'          => $_REQUEST['Car2'],
        'Car3'          => $_REQUEST['Car3'],
        'CashIn' 		=> $_REQUEST['CashIn'],
		'StaffNote'		=> addslashes($_REQUEST['StaffNote']),
        'SubDriverNote' => addslashes($_REQUEST['Notes']),
        'TransferDuration' => addslashes($_REQUEST['TransferDuration'])
);

$q = 'UPDATE v4_OrderDetails SET';

foreach ($data as $field => $value)	{
	$q .= " " . $field . " = '" . $value. "' ,";
}
if (isset($_REQUEST['Mail']) && $_REQUEST['Mail']==1) $q .= " `DriverConfStatus` = 2 ,";
// get rid of last ,
$q = substr_replace( $q, "", -1 );

$q .= ' WHERE DetailsID = ' . $_REQUEST['ID'];

unset($data);
$db->RunQuery($q) ;
echo ' <small>Saved.</small>';


//slanje mail-a
if (isset($_REQUEST['Mail']) && $_REQUEST['Mail']==1) {
	// Ovdje obavijestiti kupca da je vozac promijenjen, odnosno da je prihvatio transfer
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_OrdersMaster.class.php';	
	require_once ROOT . '/db/v4_AuthUsers.class.php';
	require_once ROOT . '/common/functions/f.php';
	
	
	$d = new v4_OrderDetails();
	$m = new v4_OrdersMaster();	
	$u = new v4_AuthUsers();
	
	$d->getRow($_REQUEST['ID']);
	$m->getRow($d->OrderID);
	$u->getRow($d->SubDriver);
	
	$mailMessage = 
		'<span style="font-weight:bold">PLEASE DO NOT REPLY TO THIS MESSAGE</span><br>
		Hello ' . ucwords($d->PaxName) . '!<br>
		We have assigned one of our best drivers to look after You.<br>';
	$mailMessage .= '
		<span style="font-weight:bold">';
		$mailMessage .='<span style="color:red;">Your New Driver\'s Name: </span>' . htmlspecialchars($u->getAuthUserRealName()) . '<br>'; 
		$mailMessage .='Driver\'s Telephone';
		$mailMessage .=': ' . htmlspecialchars($u->getAuthUserMob()) . '</span><br><br>';		
	$mailMessage .= 
		'Reservation Code: ' . $m->MOrderKey . '-' . $m->MOrderID . '<br>
		TransferID: ' . $d->OrderID . '-' . $d->TNo . '<br>
		Direction: ' . $d->PickupName . ' to ' . $d->DropName . '<br><br>';
	
	$mailMessage .= 'Pickup Point: ' .$d->PickupPlace. '<br>';

	echo $mailMessage .= '
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
	
	//$mailto = $m->MPaxEmail;
	$mailto = 'jam.bgprogrameri@gmail.com';
	$subject = 'Important Update for Transfer: '. ' ' . $m->MOrderKey.'-'.$m->MOrderID . '-' . $d->TNo;
	/*mail_html($mailto, 'driver-info@jamtransfer.com', 'JamTransfer.com', 'info@jamtransfer.com',
	$subject , $mailMessage);*/
	
}	


