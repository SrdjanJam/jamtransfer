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
$logTitle = 'Order Updated by ' . $_SESSION['UserName'];
$showToCustomer = 0;
$customerDescription = '';

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


$keyValue = $_REQUEST['id'];
$nameList = array();
$out = array();
if ($keyName != '' and $keyValue != '') {
	$db->getRow($keyValue);
	$om->getRow($db->getOrderID());
}	
// user data
$isAgent = false;
$MAgentCommisionPercent = 0;

if($om->getMUserLevelID() == '2') {
	$au->getRow( $om->getMUserID() );
	$MAgentCommisionPercent = $au->getProvision();
	$isAgent = true;
}

foreach ($db->fieldNames() as $name) {
	if(isset($_REQUEST[$name]) && gettype($_REQUEST[$name])!='array') {
		$content=$db->myreal_escape_string($_REQUEST[$name]);
		eval("\$old_content=\$db->get".$name."();");	
		eval("\$db->set".$name."(\$content);");	
		if(gettype($old_content)==gettype($content) && $old_content != $content) {
			$logDescription .= 'Changed: '. $name . ' <b>from:</b> ' . $old_content . ' <b>to:</b> ' . 
								$content . '<br>';
			// ako se promijenio vozac
			if ($name == 'DriverID') {
				// obavijesti starog vozaca
				//$logDescription .= informOldDriver($db->getOrderID(),$db->getTNo(),$old_content) . '<br>';

				// obavijesti novog vozaca
				//$logDescription .= informNewDriver($db->getOrderID(),$db->getTNo(),$content) .'<br>';

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
					$db->setProvisionAmount(number_format( $_REQUEST['DetailPrice'] * $MAgentCommisionPercent / 100 ),2,'.');
					$db->setInvoiceAmount(number_format( $_REQUEST['DetailPrice'] - $db->getProvisionAmount() ),2,'.');
				}
				// ako nije placanje racunom (agenti) onda povecaj ili umanji cash za razliku cijena
				if($db->getInvoiceAmount() == 0) {
					$db->setPayLater(number_format( $_REQUEST['DetailPrice'] - $db->getPayNow()),2,'.');
				}
			}
			if($name == 'PayNow' or $name == 'PayLater') {
				$priceChanged = true;
			}
		}
	}	
}
$db->setDriverExtraCharge(number_format($sumDriverPrice));
$db->setExtraCharge(number_format($sumPrice));
$db->setPaxName($_REQUEST['MPaxFirstName'] . ' ' . $_REQUEST['MPaxLastName']);
$OrderID=$db->getOrderID();

$upd = '';
$newID = '';
foreach ($om->fieldNames() as $name) {
	if(isset($_REQUEST[$name]) && gettype($_REQUEST[$name])!='array') {
		$content=$om->myreal_escape_string($_REQUEST[$name]);
		eval("\$old_content=\$om->get".$name."();");			
		eval("\$om->set".$name."(\$content);");	
		if(gettype($old_content)==gettype($content) && $old_content != $content) {
			$logDescription .= 'Changed: '. $name . ' <b>from:</b> ' . $old_content . ' <b>to:</b> ' . $content . '<br>';
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

if($logDescription != '') { // ako nema promjena u podacima, ne treba nista upisivati

	$ol->setOrderID($db->getOrderID());
	$ol->setDetailsID($db->getDetailsID());
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
	$ol->setOrderID($db->getOrderID());
	$ol->setDetailsID($db->getDetailsID());
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

if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$resOM = $om->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}
/*if ($keyName != '' and $keyValue == '') {
	$newID = $db->saveAsNew();
	$newIDOM = $om->saveAsNew();
}*/
$out = array(
	'update' => $upd,
	'insert' => $newID
);





# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	