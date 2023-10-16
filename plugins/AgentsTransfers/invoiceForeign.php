<?php

$_SESSION['details'] = array();

// Assigned:
$transfersInSerbia = 0;
$subTotal = 0;
$commissionAmt = 0;
$totalEur = 0;
$VATbase = 0;
$VATtotal = 0;
$counter = 0;
$pagecount = 1;
$transfersSum = 0;
$extrasSum = 0;
$provisionSum = 0;
$noVAT = 0;
$driversPriceTotal = 0;
$TecajRSD = 0;
$vat = 0;

if(isset($_REQUEST['InvoiceNumber'])) $_REQUEST['InvoiceNumber'];
else $_REQUEST['InvoiceNumber'] = 0;

// ako je InvoiceDate ispunjen u prvom koraku
if(isset($_REQUEST['InvoiceDate'])) {
	$dueDate = date('Y-m-d', strtotime($_REQUEST['InvoiceDate']. ' + 15 days'));
}


// FOREACH:

// Path:
//$od = new v4_OrderDetails(); // Path: cms\cronJobs\v4_OrderDetails.class.php
//$kd = $od->getKeysBy('DetailsID', 'asc', $whereD); // From AgentsTransfers/invoice.php file 

$orders = array();

foreach ($kd as $nn => $id) {
	// echo $id;

	$counter++;

	if ($pagecount == 1) $limit = 16;
	else $limit = 30;

	if ($counter > $limit) {
		$pagecount++;
		$counter = 1;
	}


	$od->getRow($id); 
	// print_r($od);

	$orders_row = array();

	foreach($od as $key=>$ord){ 
		$orders_row[$key] = $ord;
	}
	

	$orders[] = $orders_row;


	$order=$od->getOrderID().'-'. $od->getTNo();


	$incl=true;
	if (isset($_REQUEST[$order]) && $_REQUEST[$order] == 'NO') { 
		$incl=false;
		
	}

	$detailsID = $od->getDetailsID();
					
	$driversPrice = $od->getDriversPrice();
	$driversPriceSum += $driversPrice;

	$transferPrice 	= $od->getDetailPrice();
	$extrasPrice 	= $od->getExtraCharge();
	$driverextrasPrice 	= $od->getDriverExtraCharge();
	$provision		= $od->getProvisionAmount();

	$transfersSum	+= $transferPrice;
	$extrasSum		+= $extrasPrice;
	$provisionSum	+= $provision;

	$i += 1;


	$description = '
		<strong>'. 
		$od->getOrderID().'-'. $od->getTNo() .
		'</strong><em>'. 
		$od->PickupName . ' - ' . $od->DropName . 
		'</em><br><span class="s">'.
		$od->PaxName .','. $od->PaxNo .
		' pax. | '.
		$od->PickupDate .' '. $od->PickupTime .
		'</span>';


	$_SESSION['details'][$detailsID] = array(
		'InvoiceNumber' => $_REQUEST['InvoiceNumber'],
		'Description' => $description,
		'Qty' => '1',
		'Price' => $transferPrice,
		'SubTotal' => $transferPrice
	);


	$fullPrice = $transferPrice + $extrasPrice;
	$subTotal += $fullPrice;

	$isInSerbia = InSerbia($od->RouteID);
	$noVAT += nfT($fullPrice -  $provision - $driversPrice - $driverextrasPrice);

	$commissionAmt += $provision;
	$totalEur += nfT($fullPrice -  $provision);

	$driversPriceTotal += nfT($driversPrice+$driverextrasPrice);

	$VATbase +=  ($fullPrice - $driversPrice - $provision) / ((100 + $vat) / 100);

	
} //endforeach


	// OBREADA PODATAKA
	// uskladjeno sa Dusicom 

	//$subTotal = $transfersSum + $extrasSum;

	// ako je samo jedan transfer iz Srbije, podaci se prikazuju
	// znaci ako je isInSerbia false, onda se ispituje 
	// ako je vec true, ne treba dalje ispitivati, 
	// nego se podaci moraju prikazati - vidi dolje

	/*

		if($isInSerbia == false) $isInSerbia = InSerbia($od->RouteID);
		
		$commissionAmt = nfT( $provisionSum ); 

		$totalEur = nfT( $subTotal -  $commissionAmt );

		$noVAT = nfT( $totalEur - $driversPriceSum);
	*/


	//$knjigovodstvo = '1';
	if ($transfersInSerbia == 0 and $knjigovodstvo != '1') $noVAT = '0.00';
	else if ($$transfersInSerbia > 0) $noVAT = '0.00';

	//$VATbase = nfT( ($subTotal - $driversPriceSum - $commissionAmt) / ((100+$vat)/100));
	if ($transfersInSerbia == 0) $VATbase = '0.00';

	//$VATtotal = nfT( $VATbase * $vat / 100);
	if ($transfersInSerbia == 0) $VATtotal = '0.00';


	// Assign:
	$subTotal_TecajRSD =  $subTotal * $TecajRSD;
	$smarty->assign('subTotal_TecajRSD',$subTotal_TecajRSD);

	$commissionAmt_TecajRSD = $commissionAmt * $TecajRSD;
	$smarty->assign('commissionAmt_TecajRSD',$commissionAmt_TecajRSD);

	$totalEur_TecajRSD = $totalEur * $TecajRSD;
	$smarty->assign('totalEur_TecajRSD',$totalEur_TecajRSD);

	$noVAT_TecajRSD = $noVAT * $TecajRSD;
	$smarty->assign('noVAT_TecajRSD',$noVAT_TecajRSD);

	$VATbase_TecajRSD = $VATbase * $TecajRSD;
	$smarty->assign('VATbase_TecajRSD',$VATbase_TecajRSD);

	$VATbase_vat_TecajRSD = $VATbase * $vat * $TecajRSD / 100;
	$smarty->assign('VATbase_vat_TecajRSD',$VATbase_vat_TecajRSD);

	$VATbase_vat = $VATbase * $vat / 100;
	$smarty->assign('VATbase_vat',$VATbase_vat);

	$driversPriceTotal_TecajRSD = $driversPriceTotal * $TecajRSD;
	$smarty->assign('driversPriceTotal_TecajRSDt',$driversPriceTotal_TecajRSD);

	$totalEur_TecajRSD = $totalEur * $TecajRSD;
	$smarty->assign('totalEur_TecajRSD',$totalEur_TecajRSD);



	// Assign:
	$smarty->assign('transfersInSerbia', $transfersInSerbia);
	$smarty->assign('subTotal', $subTotal);
	$smarty->assign('commissionAmt', $commissionAmt);
	$smarty->assign('totalEur', $totalEur);
	$smarty->assign('VATbase', $VATbase);
	$smarty->assign('VATtotal', $VATtotal);
	$smarty->assign('counter', $counter);
	$smarty->assign('pagecount', $pagecount);

	$smarty->assign('Date', $Date);
	$smarty->assign('dueDate', $dueDate);

	$smarty->assign('description', $description);

	$smarty->assign('fullPrice', $fullPrice);
	$smarty->assign('subTotal', $subTotal);

	$smarty->assign('noVAT', $noVAT);

	$smarty->assign('incl', $incl);

	$smarty->assign('orders', $orders);

	$smarty->assign('knjigovodstvo', $knjigovodstvo);
	$smarty->assign('saved', $saved);

	$smarty->assign('vat', $vat);

?>


<script>
	$(".jqdatepicker").datepicker({
		dateFormat: 'yy-mm-dd'
	});
</script>