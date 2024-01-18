<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
//error_reporting(E_ALL);
# init vars
$priceChanged = false;
$data = array();
$icon = 'fa fa-cloud-upload bg-blue';
$logDescription = '';
$logAction = 'Update';
$logTitle = 'Order Updated by ' . $_SESSION['UserRealName'];
$showToCustomer = 0;
$customerDescription = '';


$keyValue = $_REQUEST['id'];
$nameList = array();
$out = array();
if ($keyName != '' && $keyValue != ''){
	$db->getRow($keyValue);
	$om->getRow($db->getOrderID());
}	
else {
	$logAction = 'Insert';
	$logDescription="Insert new transfer";
	$logTitle = 'Order Inserted by ' . $_SESSION['UserRealName'];
}		
// user data
$isAgent = false;
$MAgentCommisionPercent = 0;

if($od->getUserLevelID() == '2') {
	$au->getRow( $od->getUserID() );
	$MAgentCommisionPercent = $au->getProvision();
	$isAgent = true;
}
$payment_arr=array("DetailPrice", "DriversPrice", "Discount", "ExtraCharge", "DriverExtraCharge", "PaymentMethod", "PayNow", "PayLater", "InvoiceAmount");
foreach ($db->fieldNames() as $name) {
	if(isset($_REQUEST[$name]) && gettype($_REQUEST[$name])!='array') {
		$content=$db->myreal_escape_string($_REQUEST[$name]);
		eval("\$old_content=\$db->get".$name."();");	
		eval("\$db->set".$name."(\$content);");	
		if ($db->getTransferStatus()==6) $db->setPriceClassID(1);
		if(gettype($old_content)==gettype($content) && $old_content != $content) {
			$logDescription .= 'Changed: '. $name . ' <b>from:</b> ' . $old_content . ' <b>to:</b> ' . 
								$content . '<br>';
			// ako se promenio status transfera
			if ($name == 'TransferStatus') {
				switch ($content) {
					case 1:
						$icon = 'fa fa-times bg-green';
						$logDescription = 'Order status is now ACTIVATED';
						$logAction = 'Active';
						$logTitle = 'Order activated by ' . $_SESSION['UserRealName'];
						$showToCustomer = 1;
						break;
					case 3:
						$icon = 'fa fa-times bg-red';
						$logDescription = 'Order status is now CANCELLED';
						$logAction = 'Cancel';
						$logTitle = 'Order cancelled by ' . $_SESSION['UserRealName'];
						$showToCustomer = 1;
						break;					
					case 5:
						$icon = 'fa fa-cloud-upload bg-blue';
						$logDescription = 'Order status is now FINISHED';
						$logAction = 'Finished';
						$logTitle = 'Order finished by ' . $_SESSION['UserRealName'];
						$showToCustomer = 0;
						break;
					case 9:
						$icon = 'fa fa-times bg-red';
						$logDescription = 'Order status is now DELETED';
						$logAction = 'Delete';
						$logTitle = 'Order Deleted by ' . $_SESSION['UserRealName'];
						$showToCustomer = 0;
						break;
				}
			}
			if ($name == 'DriverConfStatus') {
				$DriverNotes = $_REQUEST['DriverNotes'];
				switch ($content) {
					// obavesti izabranog vozaca pri promeni statusa iz NO DRIVER u NOT CONFIRMED
					case 1:
						if ($old_content==0) $logDescription .= informNewDriver($db->getOrderID(),$db->getTNo(),$_REQUEST['DriverID']) .'<br>';
					case 5:
						$icon = 'fa fa-minus-square bg-red';
						$logDescription = 'Order status is now NO SHOW<br>'.$DriverNotes.'<br>';
						$logAction = 'NoShow';
						$logTitle = 'No-Show reported by ' . $_SESSION['UserRealName'];
						$showToCustomer = 0;
						break;
					case 6:				
						$icon = 'fa fa-taxi bg-red';
						$logDescription = 'Order status is now Driver Error<br>'.$DriverNotes.'<br>';
						$logAction = 'DriverError';
						$logTitle = 'Driver Error reported by ' . $_SESSION['UserRealName'];
						$showToCustomer = 0;
						break;
					case 8:
						$icon = 'fa fa-tasks bg-red';
						$logDescription = 'Order status is now Operator Error<br>'.$DriverNotes.'<br>';
						$logAction = 'OperatorError';
						$logTitle = 'Operator Error reported by ' . $_SESSION['UserRealName'];
						$showToCustomer = 0;
						break;
					case 9:
						$icon = 'fa fa-road bg-red';
						$logDescription = 'Order status is now Dispatcher Error<br>'.$DriverNotes.'<br>';
						$logAction = 'DispatcherError';
						$logTitle = 'Dispatcher Error reported by ' . $_SESSION['UserRealName'];
						$showToCustomer = 0;
						break;
					case 10:						
						$icon = 'fa fa-road bg-red';
						$logDescription = 'Order status is now Agent Error<br>'.$DriverNotes.'<br>';
						$logAction = 'AgentError';
						$logTitle = 'Agent Error reported by ' . $_SESSION['UserRealName'];
						$showToCustomer = 0;
						break;
					case 11:							
						$icon = 'fa fa-road bg-red';
						$logDescription = 'Order status is now Force majeure<br>'.$DriverNotes.'<br>';
						$logAction = 'Force majeure';
						$logTitle = 'Force majeure reported by ' . $_SESSION['UserRealName'];
						$showToCustomer = 0;
						break;
					case 12:						
						$icon = 'fa fa-road bg-red';
						$logDescription = 'Order status is now Pending<br>'.$DriverNotes.'<br>';
						$logAction = 'Pending';
						$logTitle = 'Pending reported by ' . $_SESSION['UserRealName'];
						$showToCustomer = 0;
						break;
				}
			}	
			// ako se promijenio vozac
			if ($name == 'DriverID') {
				// obavijesti starog vozaca
				if ($old_content>0) $logDescription .= informOldDriver($db->getOrderID(),$db->getTNo(),$old_content) . '<br>';

				// obavesti novog vozaca ako je driverconf status NOT CONFIRMED
				if ($_REQUEST['DriverConfStatus']==1) $logDescription .= informNewDriver($db->getOrderID(),$db->getTNo(),$content) .'<br>';

				// obavijesti kupca 
				$customerDescription .= YOUR_NEW_DRIVER_NAME . ' : ' . $_REQUEST['DriverName'] . '<br>';
				$customerDescription .= YOUR_NEW_DRIVER_TEL . ' : ' . $_REQUEST['DriverTel'] . '<br>';
			}
			if($name == 'StaffNote' && !empty($db->getStaffNote() )) {
				$db->setStaffNote(date("Y-m-d"). " - " .$_SESSION['UserRealName'] ." / ".$db->getStaffNote());
			}
			if($name == 'DetailPrice') {
				$priceChanged = true;
				if($isAgent) {
					// izracunaj nove vrijednosti za v4_OrderDetails
					$db->setProvisionAmount(number_format( ($_REQUEST['DetailPrice'] * $MAgentCommisionPercent / 100) ,2,'.'));
					$db->setInvoiceAmount(number_format( ($_REQUEST['DetailPrice'] - $db->getProvisionAmount()) ,2,'.'));
				}
				// ako nije placanje racunom (agenti) onda povecaj ili umanji cash za razliku cijena
				if($db->getInvoiceAmount() == 0) {
					$db->setPayLater(number_format( $_REQUEST['DetailPrice'] - $db->getPayNow(),2,'.'));
				}
			}
			if (in_array($name,$payment_arr))  {
				$priceChanged = true;
			}
		}
	}	
}
if ($priceChanged) $logDescription .= '<b>PAYMENT DATA CHANGE</b>';  
$au->getRow($db->getDriverID());
$db->setDriverName($au->getAuthUserRealName());

if (isset($_REQUEST['ServiceID'])) {
	//cuvanje extrasa
	$sumDriverPrice=0;
	$sumPrice=0;
	foreach ($_REQUEST['ServiceID'] as $key=>$serviceid) {
		if ($serviceid>0) {
			if ($key>0) $oe->getRow($key);
			// za naziv servisa
			$ex->getRow($serviceid);
			$oe->setServiceName($ex->getServiceEN());
			$oe->setServiceID($_REQUEST['ServiceID'][$key]);
			$sumDriverPrice+=$_REQUEST['DriverPrice'][$key]*$_REQUEST['Qty'][$key];
			$sumPrice+=$_REQUEST['Price'][$key]*$_REQUEST['Qty'][$key];
			$oe->setDriverPrice($_REQUEST['DriverPrice'][$key]);
			$oe->setPrice($_REQUEST['Price'][$key]);
			$oe->setQty($_REQUEST['Qty'][$key]);
			$oe->setOrderDetailsID($_REQUEST['DetailsID']);
			if ($key>0) $oe->saveRow();	
			else $oe->saveAsNew();
		}
		elseif ($key>0) $oe->deleteRow($key);
	}
	$db->setDriverExtraCharge($sumDriverPrice);
	$db->setExtraCharge($sumPrice);
	$db->setDriverPaymentAmt($_REQUEST['DriversPrice']+$sumDriverPrice);
}
if (isset($_REQUEST['DetailPriceX']) && $_REQUEST['DetailPriceX']>0) $db->setDetailPrice($_REQUEST['DetailPriceX']);
if (isset($_REQUEST['MPaxFirstName']) && isset($_REQUEST['MPaxLastName']) ) $db->setPaxName($_REQUEST['MPaxFirstName'] . ' ' . $_REQUEST['MPaxLastName']);
$OrderID=$db->getOrderID();

$upd = '';
$dID = '';
foreach ($om->fieldNames() as $name) {
	if(isset($_REQUEST[$name]) && gettype($_REQUEST[$name])!='array') {
		$content=$om->myreal_escape_string($_REQUEST[$name]);
		eval("\$old_content=\$om->get".$name."();");			
		eval("\$om->set".$name."(\$content);");	
		if(gettype($old_content)==gettype($content) && $old_content != $content) {
			$logDescription .= 'Changed: '. $name . ' <b>from:</b> ' . $old_content . ' <b>to:</b> ' . $content . '<br>' ;
		}		
	}	
}
if($priceChanged) {
	$MEurToCurrencyRate 	= $om->getMEurToCurrencyRate();	
	$MTransferPrice 		= $_REQUEST['DetailPrice'];
	$MExtrasPrice 			= $_REQUEST['ExtraCharge'];
	$MOrderPriceEUR			= $_REQUEST['DetailPrice']+$_REQUEST['ExtraCharge'];
	$MOrderCurrencyPrice 	= $MOrderPriceEUR*$MEurToCurrencyRate;
	$MPayNow				= $_REQUEST['PayNow'];
	$MPayLater				= $_REQUEST['PayLater'];
	$MInvoiceAmount			= $_REQUEST['InvoiceAmount'];
	$MAgentCommision		= $_REQUEST['ProvisionAmount'];
	

	// pronaci sve transfere
	$dKey = $db->getKeysBy('DetailsID', 'asc', " WHERE DetailsID <> '".$db->getDetailsID()."' AND OrderID = '".$db->getOrderID()."'");

	$db2=new v4_OrderDetails();
	foreach($dKey as $nn => $id) {
		$db2->getRow($id);
		$MTransferPrice 	+= $db2->getDetailPrice();
		$MExtrasPrice 		+= $db2->getExtraCharge();
		$MOrderPriceEUR 	+= $db2->getDetailPrice() + $db2->getExtraCharge();
		$MPayNow 			+= $db2->getPayNow();
		$MPayLater 			+= $db2->getPayLater();
		$MInvoiceAmount 	+= $db2->getInvoiceAmount();
		$MAgentCommision	+= $db2->getProvisionAmount();
		$MOrderCurrencyPrice+= ($db2->getDetailPrice() + $db2->getExtraCharge() ) * $MEurToCurrencyRate;
	}
	$om->getRow($OrderID);	
	//$om->setMUserID($MUserID);
	$om->setMTransferPrice($MTransferPrice);
	$om->setMExtrasPrice($MExtrasPrice);
	$om->setMOrderPriceEUR($MOrderPriceEUR);
	$om->setMPayNow($MPayNow);
	$om->setMPayLater($MPayLater);
	$om->setMInvoiceAmount($MInvoiceAmount);
	$om->setMAgentCommision($MAgentCommision);
	$om->setMOrderCurrencyPrice($MOrderCurrencyPrice);
	$om->saveRow();
}
if (isset($_REQUEST['UserID']) && $_REQUEST['UserID']>0) {
	$MUserID = $_REQUEST['UserID'];
	$om->setMUserID($MUserID);
}
// dodati i cuvanje povratnog transfera 
if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$resOM = $om->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}
if ($keyName != '' && $keyValue != '') {
	$dID=$db->getDetailsID();
	$mID=$db->getOrderID();
}
// dodavanje return transfera
if ($_REQUEST['return']==1) {
	$db->setTNo(2);	
	$pickupid=$db->getPickupID();
	$pickupname=$db->getPickupName();
	$pickupadress=$db->getPickupAddress();
	$db->setPickupID($db->getDropID());	
	$db->setPickupName($db->getDropName());	
	$db->setPickupAddress($db->getDropAddress());	
	$db->setDropID($pickupid);	
	$db->setDropName($pickupname);	
	$db->setDropAddress($pickupadress);	
	$mID=$db->getOrderID();	
	$db->setDriverConfStatus(0);	
	$db->setTransferStatus(4);	
	$dID = $db->saveAsNew();	
	$logAction = 'Insert';
	$logDescription="Insert return transfer";
	$logTitle = 'Order Inserted by ' . $_SESSION['UserRealName'];
}
// kopiranje transfera	
if ($_REQUEST['return']==2) {
	$om->setMOrderDate(date("Y-m-d"));
	$om->setMOrderTime(date("H:i:s"));
	$om->setMOrderKey(create_order_key()); // pravi OrderKey
	$mID = $om->saveAsNew();
	$db->setOrderID($mID);
	$db->setOrderDate(date("Y-m-d"));
	$db->setTNo(1);	
	$db->setDriverConfStatus(0);
	$db->setTransferStatus(4);
	$db->saveAsNew();
	$logAction = 'Insert';
	$logDescription="Insert copied transfer";
	$logTitle = 'Order Inserted by ' . $_SESSION['UserRealName'];	
}
// novi transfer	
if ($keyName != '' && $keyValue == '') {
	$om->setSiteID(2);
	$om->setMOrderDate(date("Y-m-d"));
	$om->setMOrderTime(date("H:i:s"));
	$om->setMUserLevelID($_SESSION["AuthLevelID"]);
	$om->setMUserID($_SESSION["AuthUserID"]);
	
	$om->setMOrderKey(create_order_key()); // pravi OrderKey
	$mID = $om->saveAsNew();
	$db->setSiteID(2);	
	$db->setOrderID($mID);
	$db->setTNo(1);	
	$db->setOrderDate(date("Y-m-d"));
	$db->setPickupDate(date("Y-m-d"));
	$db->setUserLevelID($_SESSION["AuthLevelID"]);
	if (isset($_SESSION['UseDriverID'])) $db->setDriverID($_SESSION["UseDriverID"]);
	$db->setUserID($_SESSION["AuthUserID"]);
	$db->setTransferStatus(4);	
	$db->setVehicleType(0);
	$db->setVehiclesNo(1);	
	
	$dID = $db->saveAsNew();
}
if($logDescription != '') { // ako nema promjena u podacima, ne treba nista upisivati

	$ol->setOrderID($mID);
	$ol->setDetailsID($dID);
	$ol->setAction($logAction);
	$ol->setTitle($logTitle);
	$ol->setDescription($logDescription);
	$ol->setDateAdded(date("Y-m-d"));
	$ol->setTimeAdded(date("H:i:s"));
	$ol->setUserID($_SESSION['AuthUserID']);
	$ol->setIcon($icon);
	$ol->setShowToCustomer($showToCustomer);
	$ol->saveAsNew();
}
if($customerDescription != '') {
	$ol->setOrderID($mID);
	$ol->setDetailsID($dID);
	$ol->setAction($logAction);
	$ol->setTitle(IMPORTANT_UPDATE);
	$ol->setDescription($customerDescription);
	$ol->setDateAdded(date("Y-m-d"));
	$ol->setTimeAdded(date("H:i:s"));
	$ol->setUserID('3');
	$ol->setIcon('fa fa-info-circle bg-purple');
	$ol->setShowToCustomer('1');
	$ol->saveAsNew(); 
}

$out = array(
	'update' => $upd,
	'insert' => $dID,
	'page' => 'orders',
	'orderid' => $mID,
	'returnT' => $_REQUEST['return']
);

# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	