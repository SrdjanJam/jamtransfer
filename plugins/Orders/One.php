<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

	$PaymentStatus = array(
		'0'	=>	'Not Paid',
		'1'	=>	'Warning sent',
		'2' =>	'Sued',
		'3' =>  'Refunded',
		'10'=>	'Lost - will not be paid',
		'91'=>	'Compensated',
		'99'=>	'Paid'
	);	

	# Driver Payment
	$DriverPayment = array(
		'0' => 'Not Paid',
		'1' => 'Partly paid',
		'2'	=> 'Paid',
		'3' => 'Compensated'
	);
	
	#
	$DocumentType = array(
		'0' => 'Choose document',
		'1' => 'Proforma',
		'2'	=> 'Prepayment Invoice',
		'3' => 'Invoice',
		'4' => 'Invoice Item',
		'5' => 'Cancellation Invoice',
		'6' => 'Credit Note'
	);

	# init vars
	$out = array();
	$relatedTransfers = array();
	$orderLog = array();
	$oeServices=array();
	
	
# filters
$db->getRow($_REQUEST['ItemID']);

# OrderID za OrdersMaster
$OrderID = $db->getOrderID();
$DetailsID = $db->getDetailsID();

# get fields and values
$detailFlds = $db->fieldValues();


# Vezani transfer, ako postoji
$odk = $db->getKeysBy('DetailsID', 'asc' , ' WHERE OrderID='. $OrderID);
foreach ($odk as $key => $value)
{
	$db->getRow($value);
	if ($db->getDetailsID() != $DetailsID) {
		$relatedTransfers = array(
			"RelatedTransfer" => $db->getDetailsID(),
			"RelatedTransferText" => $db->getOrderID().'-'.$db->getTNo()
		);
	}	
}
$detailFlds["RelatedTransfers"]=$relatedTransfers;

$db->getRow($_REQUEST['ItemID']);

//payment method
$pm=$detailFlds["PaymentMethod"];
$detailFlds["PaymentMethodName"]=$PaymentMethod[$pm];
//zamena naziva mesta sa engleskim nazivom iz tabele places
$PickupID=$db->getPickupID();
$DropID=$db->getDropID();
if ($PickupID!=0) {
	$pl->getRow($PickupID);
	$detailFlds["PickupName"]=$pl->getPlaceNameEN();
	$detailFlds["PlaceType"]=$pl->getPlaceType(); 
}
if ($DropID!=0) {
	$pl->getRow($DropID);
	$detailFlds["DropName"]=$pl->getPlaceNameEN();
}


$detailFlds['DriversPrice'] = number_format($db->getDriversPrice()*$_SESSION['CurrencyRate'],2);
$detailFlds['DetailPrice'] = number_format($db->getDetailPrice()*$_SESSION['CurrencyRate'],2);
$detailFlds['ExtraCharge'] = number_format($db->getExtraCharge()*$_SESSION['CurrencyRate'],2);
$detailFlds['DriverExtraCharge'] = number_format($db->getDriverExtraCharge()*$_SESSION['CurrencyRate'],2);
$detailFlds['PayLater'] = number_format($db->getPayLater()*$_SESSION['CurrencyRate'],2);
$detailFlds['PayNow'] = number_format($db->getPayNow()*$_SESSION['CurrencyRate'],2);
$detailFlds['InvoiceAmount'] = number_format($db->getInvoiceAmount()*$_SESSION['CurrencyRate'],2);
$detailFlds['Provision'] = number_format($db->getProvision()*$_SESSION['CurrencyRate'],2);
$detailFlds['ProvisionAmount'] = number_format($db->getProvisionAmount()*$_SESSION['CurrencyRate'],2);
$detailFlds['Discount'] = number_format($db->getDiscount()*$_SESSION['CurrencyRate'],2);
$detailFlds['DriverPaymentAmt'] = number_format($db->getDriverPaymentAmt()*$_SESSION['CurrencyRate'],2);
$detailFlds['DriversPriceEUR'] = number_format($db->getDriversPrice(),2);
$detailFlds['DetailPriceEUR'] = number_format($db->getDetailPrice(),2);
$detailFlds['ExtraChargeEUR'] = number_format($db->getExtraCharge(),2);
$detailFlds['DriverExtraChargeEUR'] = number_format($db->getDriverExtraCharge(),2);
$detailFlds['PayLaterEUR'] = number_format($db->getPayLater(),2);
$detailFlds['PayNowEUR'] = number_format($db->getPayNow(),2);
$detailFlds['InvoiceAmountEUR'] = number_format($db->getInvoiceAmount(),2);
$detailFlds['ProvisionEUR'] = number_format($db->getProvision(),2);
$detailFlds['ProvisionAmountEUR'] = number_format($db->getProvisionAmount(),2);
$detailFlds['DiscountEUR'] = number_format($db->getDiscount(),2);
$detailFlds['DriverPaymentAmtEUR'] = number_format($db->getDriverPaymentAmt(),2);

# VehicleTypes
$detailFlds['VehicleTypeName'] = $vehicletypes[$db->getVehicleType()]->VehicleTypeName;
$detailFlds['VehicleClass'] = $vehicletypes[$db->getVehicleType()]->VehicleClass;

//partneri
/*$au->getRow($db->getDriverID());
$contractFile=$au->getContractFile();
if ($contractFile!='inter') {
	$detailFlds['ContactName'] = $au->getContactPerson();
	if (empty($au->getAuthUserMob())) $detailFlds['ContactMob'] = $au->getAuthUserTel();
	else $detailFlds['ContactMob'] = $au->getAuthUserMob();	
	if ($subdriverid>0) {
		$au->getRow($subdriverid);
		$detailFlds['SubDriverName'] = $au->getAuthUserRealName();
		$detailFlds['SubDriverMob'] = $au->getAuthUserMob();
	}	
}
//JAM grupa
else {	
	$subdriverid=$db->getSubDriver();
	$detailFlds['SubDriverName'] = $au->getContactPerson();
	$detailFlds['SubDriverMob'] = $au->getAuthUserMob();		
	if ($subdriverid>0) {
		$au->getRow($subdriverid);
		$detailFlds['ContactName'] = $au->getAuthUserRealName();
		$detailFlds['ContactMob'] = $au->getAuthUserMob();
	}
}*/

# Invoice data
$inid = $ind->getKeysBy('ID', 'asc', "WHERE `DetailsID` =  ".$db->getDetailsID());
$cinid=count($inid);
if ($cinid>0) {	
	$ind->getRow($inid[$cinid-1]);
	$detailFlds['InvoiceNumberO'] = $ind->getInvoiceNumber();
	$inid2 = $in->getKeysBy('ID', 'asc', "WHERE `InvoiceNumber` =  '".$ind->getInvoiceNumber()."'");
	$in->getRow($inid2[0]);
	$detailFlds['InvoiceDateO'] = $in->getInvoiceDate();
	$detailFlds['DueDateO'] = $in->getDueDate();
	$detailFlds['PaymentStatusO'] = $PaymentStatus[$in->getStatus()];
	$detailFlds['GrandTotalO'] = $in->getGrandTotal();
}
# Driver Invoice data
$inid = $in->getKeysBy('ID', 'asc', "WHERE `UserID` =  '".$db->getDriverID()."' 
	AND `EndDate` >= '".$db->getPickupDate()."' 
	AND `StartDate` <= '".$db->getPickupDate()."'");
 if (count($inid)>0) {	 
	$in->getRow($inid[0]);
	$detailFlds['DriverInvoiceNumberO'] = $in->getInvoiceNumber();	
	$detailFlds['DriverInvoiceDateO'] = $in->getInvoiceDate();
	$detailFlds['DriverDueDateO'] = $in->getDueDate();	
	$detailFlds['DriverPaymentStatusO'] = $PaymentStatus[$in->getStatus()];
	$detailFlds['DriverGrandTotalO'] = $in->getGrandTotal();
}


//prarametri za racune
/*if ($_SESSION['AuthLevelID']==44) {
	//service type
	switch ($db->PaymentMethod) {
		case 1:
		case 4:
		case 5:
		case 6:
			$detailFlds['ServiceType']="Usluga prevoza";
			$detailFlds['DocumentValue']=$db->PayNow+$db->InvoiceAmount;
			break;
		case 2:
			$detailFlds['ServiceType']="Usluga nalaženja putnika";
			$detailFlds['DocumentValue']=$db->PayLater-$db->DriversPrice-$db->DriverExtraCharge;
			break;
		case 3:
			$detailFlds['ServiceType']="Usluga nalaženja prevoznika";
			$detailFlds['DocumentValue']=$db->PayNow;			
			break;	
	}
	// transfer arrea
	$pl->getRow($db->PickupID);
	$country1=$pl->CountryNameEN;
	$pl->getRow($db->DropID);
	$country2=$pl->CountryNameEN;
	if ($country1=='Serbia'	&& $country2=='Serbia') $detailFlds['TransferArea']="Srbija";
	if ($country1!='Serbia'	&& $country2!='Serbia') $detailFlds['TransferArea']="Van Srbije";
	//if ($country1!='Serbia'	&& $country2=='Serbia') $detailFlds['TransferArea']="Prekogranično";
	//if ($country1=='Serbia'	&& $country2!='Serbia') $detailFlds['TransferArea']="Prekogranično";
	// Document recepient
	if ($detailFlds['ServiceType']=="Usluga nalaženja putnika") $rid=$db->DriverID;
	else  $rid=$db->UserID;
	$au->getRow($rid);
	$detailFlds['DocumentRecepient']=$au->AuthUserRealName;
	// Type of document recipient
	$arrayX=array(2,5,6,31);
	if (in_array($au->AuthLevelID,$arrayX)) $detailFlds['TypeDocumentRecepient']="Pravno lice";
	else $detailFlds['TypeDocumentRecepient']="Fizičko lice";
	// Origin of document recipient	
	if ($au->CountryName=="Serbia") $detailFlds['OriginDocumentRecepient']="Domaće";
	else $detailFlds['OriginDocumentRecepient']="Strano";
	// vat document status
	if ($detailFlds['TransferArea']=="Srbija" && $detailFlds['OriginDocumentRecepient']=="Domaće") $detailFlds['VatDocumentStatus']="Uključen PDV";	
	else $detailFlds['VatDocumentStatus']="Oslobođen PDV-a";
	// document currency
	//service type
	switch ($db->PaymentMethod) {
		case 1:
		case 3:
			$detailFlds['DocumentCurrency']="RSD";			
			break;
		case 2:
		case 4:
		case 5:
		case 6:
			if ($detailFlds['OriginDocumentRecepient']=="Domaće") $detailFlds['DocumentCurrency']="RSD";
			else $detailFlds['DocumentCurrency']="EUR";
			break;
	}	
	$detailFlds['DocumentType']=0;
	
	
}*/

# documents
$odock = $odoc->getKeysBy('ID', 'asc' , ' WHERE OrderID = ' . $OrderID);
$orderDocument=array();
if(count($odock) > 0) {
	foreach ($odock as $key => $value) {
		$odoc->getRow($value);
		$doc=$odoc->fieldValues();
		$doc['DocumentTypeName']=$DocumentType[$odoc->getDocumentType()];
		$orderDocument[] = $doc;
	}
}
$detailFlds['Documents']=$orderDocument;


# master row
$om->getRow($OrderID);
$email=$om->getMPaxEmail();

# get fields and values
$masterFlds = $om->fieldValues();
$masterFlds['CountryPhonePrefix'] = '+' . getCountryPrefix( $om->getMCardCountry() ) .'-';

# log entries
$olk = $ol->getKeysBy('ID', 'asc' , ' WHERE DetailsID = ' . $DetailsID);
if(count($olk) > 0) {
	foreach ($olk as $key => $value) {
		$ol->getRow($value);
		$orderLog[] = $ol->fieldValues();
	}
}

#other bookings
if ($db->getUserLevelID()<>2) {
	$omk = $om->getKeysBy('MOrderID', 'asc' , " WHERE MPaxEmail = '" . $email . "'");
	$otherbookings="";
	if(count($omk) > 0) {
		foreach ($omk as $key => $value) {
			$om->getRow($value);
			$otherbookings.=$value.",";
		}
		$otherbookings = substr($otherbookings,0,strlen($otherbookings)-1);
	}
	$odk = $db->getKeysBy('DetailsID', 'desc' , " WHERE OrderID in (". $otherbookings .")");
	if(count($odk) > 0) {
		$otherTransfers=array();
		foreach ($odk as $key => $value)
		{
			$db->getRow($value);
			if ($db->getDetailsID() != $DetailsID) {
				$otherTransfersrow = array(
					"OtherTransferID" => $db->getDetailsID(),
					"OtherTransferText" => $db->getOrderID().'-'.$db->getTNo()
				);
			}
			$otherTransfers[]=$otherTransfersrow;
		}
	}
	$detailFlds['otherTransfers']=$otherTransfers;
}
# extra services
$OrderDetailsID = $DetailsID;
$oek = $oe->getKeysBy('ID', 'ASC', ' WHERE OrderDetailsID = ' . $OrderDetailsID);
if(count($oek) > 0) {
	foreach ($oek as $key => $value) {
		$oe->getRow($value);
		$oeServices_row = $oe->fieldValues();
		$ex->getRow($oe->getServiceID());
		if ($ex->getOwnerID()<>$db->getDriverID()) $oeServices_row['ChangeDriverConflict']=1;
		else $oeServices_row['ChangeDriverConflict']=0;
		//$oeServices_row['ChangeDriverConflict']=1;
		$oeServices[] = $oeServices_row;
	}
}
$oe_array = $oe->fieldNames();
foreach($oe_array as $oeX) {
	$oeServices_row[$oeX]='';
}	
$oeServices_row['ID']=0;
$oeServices_row['ExtrasID']=0;
$oeServices_row['Qty']=1;
$oeServices[] = $oeServices_row;

// output everything
$out[] = array(
	'tab'			=> $_REQUEST['tab'],
	'details' 		=> $detailFlds,
	'master'  		=> $masterFlds,
	'orderLog'		=> $orderLog,
	'oeServices' 	=> $oeServices
);

	# send output back
	$output = json_encode($out);
	echo $output;
	