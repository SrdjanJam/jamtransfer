<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_OrderDetailsTemp.class.php';


	# init class
	$db = new v4_OrderDetailsTemp();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();


# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);


	if(isset($_REQUEST['SiteID'])) { $db->setSiteID($db->myreal_escape_string($_REQUEST['SiteID']) ); } 

		 	
	if(isset($_REQUEST['DetailsID'])) { $db->setDetailsID($db->myreal_escape_string($_REQUEST['DetailsID']) ); } 

		 	
	if(isset($_REQUEST['OrderID'])) { $db->setOrderID($db->myreal_escape_string($_REQUEST['OrderID']) ); } 

		 	
	if(isset($_REQUEST['TNo'])) { $db->setTNo($db->myreal_escape_string($_REQUEST['TNo']) ); } 

		 	
	if(isset($_REQUEST['UserID'])) { $db->setUserID($db->myreal_escape_string($_REQUEST['UserID']) ); } 

		 	
	if(isset($_REQUEST['UserLevelID'])) { $db->setUserLevelID($db->myreal_escape_string($_REQUEST['UserLevelID']) ); } 

		 	
	if(isset($_REQUEST['AgentID'])) { $db->setAgentID($db->myreal_escape_string($_REQUEST['AgentID']) ); } 

		 	
	if(isset($_REQUEST['CustomerID'])) { $db->setCustomerID($db->myreal_escape_string($_REQUEST['CustomerID']) ); } 

		 	
	if(isset($_REQUEST['TransferStatus'])) { $db->setTransferStatus($db->myreal_escape_string($_REQUEST['TransferStatus']) ); } 

		 	
	if(isset($_REQUEST['OrderDate'])) { $db->setOrderDate($db->myreal_escape_string($_REQUEST['OrderDate']) ); } 

		 	
	if(isset($_REQUEST['TaxidoComm'])) { $db->setTaxidoComm($db->myreal_escape_string($_REQUEST['TaxidoComm']) ); } 

		 	
	if(isset($_REQUEST['ServiceID'])) { $db->setServiceID($db->myreal_escape_string($_REQUEST['ServiceID']) ); } 

		 	
	if(isset($_REQUEST['RouteID'])) { $db->setRouteID($db->myreal_escape_string($_REQUEST['RouteID']) ); } 

		 	
	if(isset($_REQUEST['FlightNo'])) { $db->setFlightNo($db->myreal_escape_string($_REQUEST['FlightNo']) ); } 

		 	
	if(isset($_REQUEST['FlightTime'])) { $db->setFlightTime($db->myreal_escape_string($_REQUEST['FlightTime']) ); } 

		 	
	if(isset($_REQUEST['PaxName'])) { $db->setPaxName($db->myreal_escape_string($_REQUEST['PaxName']) ); } 

		 	
	if(isset($_REQUEST['PickupID'])) { $db->setPickupID($db->myreal_escape_string($_REQUEST['PickupID']) ); } 

		 	
	if(isset($_REQUEST['PickupName'])) { $db->setPickupName($db->myreal_escape_string($_REQUEST['PickupName']) ); } 

		 	
	if(isset($_REQUEST['PickupPlace'])) { $db->setPickupPlace($db->myreal_escape_string($_REQUEST['PickupPlace']) ); } 

		 	
	if(isset($_REQUEST['PickupAddress'])) { $db->setPickupAddress($db->myreal_escape_string($_REQUEST['PickupAddress']) ); } 

		 	
	if(isset($_REQUEST['PickupDate'])) { $db->setPickupDate($db->myreal_escape_string($_REQUEST['PickupDate']) ); } 

		 	
	if(isset($_REQUEST['PickupTime'])) { $db->setPickupTime($db->myreal_escape_string($_REQUEST['PickupTime']) ); } 

		 	
	if(isset($_REQUEST['PickupNotes'])) { $db->setPickupNotes($db->myreal_escape_string($_REQUEST['PickupNotes']) ); } 

		 	
	if(isset($_REQUEST['DropID'])) { $db->setDropID($db->myreal_escape_string($_REQUEST['DropID']) ); } 

		 	
	if(isset($_REQUEST['DropName'])) { $db->setDropName($db->myreal_escape_string($_REQUEST['DropName']) ); } 

		 	
	if(isset($_REQUEST['DropPlace'])) { $db->setDropPlace($db->myreal_escape_string($_REQUEST['DropPlace']) ); } 

		 	
	if(isset($_REQUEST['DropAddress'])) { $db->setDropAddress($db->myreal_escape_string($_REQUEST['DropAddress']) ); } 

		 	
	if(isset($_REQUEST['DropNotes'])) { $db->setDropNotes($db->myreal_escape_string($_REQUEST['DropNotes']) ); } 

		 	
	if(isset($_REQUEST['PriceClassID'])) { $db->setPriceClassID($db->myreal_escape_string($_REQUEST['PriceClassID']) ); } 

		 	
	if(isset($_REQUEST['DetailPrice'])) { $db->setDetailPrice($db->myreal_escape_string($_REQUEST['DetailPrice']) ); } 

		 	
	if(isset($_REQUEST['DriversPrice'])) { $db->setDriversPrice($db->myreal_escape_string($_REQUEST['DriversPrice']) ); } 

		 	
	if(isset($_REQUEST['Discount'])) { $db->setDiscount($db->myreal_escape_string($_REQUEST['Discount']) ); } 

		 	
	if(isset($_REQUEST['ExtraCharge'])) { $db->setExtraCharge($db->myreal_escape_string($_REQUEST['ExtraCharge']) ); } 

		 	
	if(isset($_REQUEST['PaymentMethod'])) { $db->setPaymentMethod($db->myreal_escape_string($_REQUEST['PaymentMethod']) ); } 

		 	
	if(isset($_REQUEST['PaymentStatus'])) { $db->setPaymentStatus($db->myreal_escape_string($_REQUEST['PaymentStatus']) ); } 

		 	
	if(isset($_REQUEST['PayNow'])) { $db->setPayNow($db->myreal_escape_string($_REQUEST['PayNow']) ); } 

		 	
	if(isset($_REQUEST['PayLater'])) { $db->setPayLater($db->myreal_escape_string($_REQUEST['PayLater']) ); } 

		 	
	if(isset($_REQUEST['InvoiceAmount'])) { $db->setInvoiceAmount($db->myreal_escape_string($_REQUEST['InvoiceAmount']) ); } 

		 	
	if(isset($_REQUEST['ProvisionAmount'])) { $db->setProvisionAmount($db->myreal_escape_string($_REQUEST['ProvisionAmount']) ); } 

		 	
	if(isset($_REQUEST['PaxNo'])) { $db->setPaxNo($db->myreal_escape_string($_REQUEST['PaxNo']) ); } 

		 	
	if(isset($_REQUEST['VehiclesNo'])) { $db->setVehiclesNo($db->myreal_escape_string($_REQUEST['VehiclesNo']) ); } 

		 	
	if(isset($_REQUEST['VehicleType'])) { $db->setVehicleType($db->myreal_escape_string($_REQUEST['VehicleType']) ); } 

		 	
	if(isset($_REQUEST['VehicleID'])) { $db->setVehicleID($db->myreal_escape_string($_REQUEST['VehicleID']) ); } 

		 	
	if(isset($_REQUEST['DriverID'])) { $db->setDriverID($db->myreal_escape_string($_REQUEST['DriverID']) ); } 

		 	
	if(isset($_REQUEST['DriverName'])) { $db->setDriverName($db->myreal_escape_string($_REQUEST['DriverName']) ); } 

		 	
	if(isset($_REQUEST['DriverEmail'])) { $db->setDriverEmail($db->myreal_escape_string($_REQUEST['DriverEmail']) ); } 

		 	
	if(isset($_REQUEST['DriverTel'])) { $db->setDriverTel($db->myreal_escape_string($_REQUEST['DriverTel']) ); } 

		 	
	if(isset($_REQUEST['DriverConfStatus'])) { $db->setDriverConfStatus($db->myreal_escape_string($_REQUEST['DriverConfStatus']) ); } 

		 	
	if(isset($_REQUEST['DriverConfDate'])) { $db->setDriverConfDate($db->myreal_escape_string($_REQUEST['DriverConfDate']) ); } 

		 	
	if(isset($_REQUEST['DriverConfTime'])) { $db->setDriverConfTime($db->myreal_escape_string($_REQUEST['DriverConfTime']) ); } 

		 	
	if(isset($_REQUEST['DriverNotes'])) { $db->setDriverNotes($db->myreal_escape_string($_REQUEST['DriverNotes']) ); } 

		 	
	if(isset($_REQUEST['DriverPayment'])) { $db->setDriverPayment($db->myreal_escape_string($_REQUEST['DriverPayment']) ); } 

		 	
	if(isset($_REQUEST['DriverPaymentAmt'])) { $db->setDriverPaymentAmt($db->myreal_escape_string($_REQUEST['DriverPaymentAmt']) ); } 

		 	
	if(isset($_REQUEST['Rated'])) { $db->setRated($db->myreal_escape_string($_REQUEST['Rated']) ); } 

		 	
	if(isset($_REQUEST['DriverPickupDate'])) { $db->setDriverPickupDate($db->myreal_escape_string($_REQUEST['DriverPickupDate']) ); } 

		 	
	if(isset($_REQUEST['DriverPickupTime'])) { $db->setDriverPickupTime($db->myreal_escape_string($_REQUEST['DriverPickupTime']) ); } 

		 	
	if(isset($_REQUEST['SubDriver'])) { $db->setSubDriver($db->myreal_escape_string($_REQUEST['SubDriver']) ); } 

		 	
	if(isset($_REQUEST['Car'])) { $db->setCar($db->myreal_escape_string($_REQUEST['Car']) ); } 

		 	
	if(isset($_REQUEST['SubDriver2'])) { $db->setSubDriver2($db->myreal_escape_string($_REQUEST['SubDriver2']) ); } 

		 	
	if(isset($_REQUEST['Car2'])) { $db->setCar2($db->myreal_escape_string($_REQUEST['Car2']) ); } 

		 	
	if(isset($_REQUEST['SubDriver3'])) { $db->setSubDriver3($db->myreal_escape_string($_REQUEST['SubDriver3']) ); } 

		 	
	if(isset($_REQUEST['Car3'])) { $db->setCar3($db->myreal_escape_string($_REQUEST['Car3']) ); } 

		 	
	if(isset($_REQUEST['SubPickupDate'])) { $db->setSubPickupDate($db->myreal_escape_string($_REQUEST['SubPickupDate']) ); } 

		 	
	if(isset($_REQUEST['SubPickupTime'])) { $db->setSubPickupTime($db->myreal_escape_string($_REQUEST['SubPickupTime']) ); } 

		 	
	if(isset($_REQUEST['SubFlightNo'])) { $db->setSubFlightNo($db->myreal_escape_string($_REQUEST['SubFlightNo']) ); } 

		 	
	if(isset($_REQUEST['SubFlightTime'])) { $db->setSubFlightTime($db->myreal_escape_string($_REQUEST['SubFlightTime']) ); } 

		 	
	if(isset($_REQUEST['TransferDuration'])) { $db->setTransferDuration($db->myreal_escape_string($_REQUEST['TransferDuration']) ); } 

		 	
	if(isset($_REQUEST['PDFFile'])) { $db->setPDFFile($db->myreal_escape_string($_REQUEST['PDFFile']) ); } 

		 	
	if(isset($_REQUEST['Extras'])) { $db->setExtras($db->myreal_escape_string($_REQUEST['Extras']) ); } 

		 	
	if(isset($_REQUEST['SubDriverNote'])) { $db->setSubDriverNote($db->myreal_escape_string($_REQUEST['SubDriverNote']) ); } 

		 	
	if(isset($_REQUEST['StaffNote'])) { $db->setStaffNote($db->myreal_escape_string($_REQUEST['StaffNote']) ); } 

		 	
	if(isset($_REQUEST['InvoiceNumber'])) { $db->setInvoiceNumber($db->myreal_escape_string($_REQUEST['InvoiceNumber']) ); } 

		 	
	if(isset($_REQUEST['InvoiceDate'])) { $db->setInvoiceDate($db->myreal_escape_string($_REQUEST['InvoiceDate']) ); } 

		 	
	if(isset($_REQUEST['DriverInvoiceNumber'])) { $db->setDriverInvoiceNumber($db->myreal_escape_string($_REQUEST['DriverInvoiceNumber']) ); } 

		 	
	if(isset($_REQUEST['DriverInvoiceDate'])) { $db->setDriverInvoiceDate($db->myreal_escape_string($_REQUEST['DriverInvoiceDate']) ); } 

		 	
	if(isset($_REQUEST['CashIn'])) { $db->setCashIn($db->myreal_escape_string($_REQUEST['CashIn']) ); } 

		 	
	if(isset($_REQUEST['FinalNote'])) { $db->setFinalNote($db->myreal_escape_string($_REQUEST['FinalNote']) ); } 

		 	
	if(isset($_REQUEST['SubFinalNote'])) { $db->setSubFinalNote($db->myreal_escape_string($_REQUEST['SubFinalNote']) ); } 

		 	

$upd = '';
$newID = '';

// ako je update, azuriraj trazeni slog

if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}

// inace dodaj novi slog	
if ($keyName != '' and $keyValue == '') {
	$newID = $db->saveAsNew();
}


$out = array(
	'update' => $upd,
	'insert' => $newID
);

# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	