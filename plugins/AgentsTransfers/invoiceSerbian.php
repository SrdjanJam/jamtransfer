<?php				

	$_SESSION['details'] = array();

	// Assigned:
	$transfersInSerbia = 0;
	$subTotal = 0;
	$commissionAmt = 0;
	$totalEur = 0;
	$VATbase = 0;
	$VATtotal = 0;

				
	foreach($kd as $nn => $id) {
						
		$od->getRow($id);

		$orders_row = array();
		foreach($od as $key=>$ord){ 
			$orders_row[$key] = $ord;
		}
		$orders[] = $orders_row;
		// print_r($orders);

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

		// FullPrice and SubTotal:
		$fullPrice = $transferPrice + $extrasPrice;
		$subTotal += $fullPrice;
		
		$isInSerbia = InSerbia($od->RouteID);

		if($isInSerbia == true) $transfersInSerbia += 1;

		// ako je racun za knjigovodstvo uvijek prikazi podatke! - ovo sam krivo shvatio
		//if($knjigovodstvo == '1') $isInSerbia = true;
		$commissionAmt += $provision;

		$totalEur += nf( $fullPrice -  $provision );

		if($isInSerbia) 
			$VATbaseTemp =  (($fullPrice - $driversPrice - $provision) / ((100+$vat)/100)* s('TecajRSD'));
			$VATbase += nfT( $VATbaseTemp);
			
		if($isInSerbia == false and $knjigovodstvo == '1') {
			$VATbase +=  nf( ($fullPrice - $driversPrice - $provision) * s('TecajRSD'));
		}
		
		//if($isInSerbia == false and $knjigovodstvo != '1') {
			//$VATbase = '0.00';
		//}						

		if($isInSerbia) $VATtotal +=  nf($VATbaseTemp * $vat / 100);
		//if($isInSerbia == false) $VATtotal = '0.00';

			
	} //endforeach
					
	// OBREADA PODATAKA
	// uskladjeno sa Dusicom 
/*				
	$subTotal = $transfersSum + $extrasSum;

	// ako je samo jedan transfer iz Srbije, podaci se prikazuju
	// znaci ako je isInSerbia false, onda se ispituje 
	// ako je vec true, ne treba dalje ispitivati, 
	// nego se podaci moraju prikazati - vidi dolje
	if($isInSerbia == false) $isInSerbia = InSerbia($od->RouteID);

	// ako je racun za knjigovodstvo uvijek prikazi podatke! - ovo sam krivo shvatio
	//if($knjigovodstvo == '1') $isInSerbia = true;
	$commissionAmt = nf( $provisionSum );

	$totalEur = nf( $subTotal -  $commissionAmt );

	$VATbase = nf( ( ($subTotal - $driversPriceSum - $commissionAmt) / ((100+$vat)/100)) * 
					s('TecajRSD'));

	if($isInSerbia == false and $knjigovodstvo == '1') {
		$VATbase =  nf(  ($subTotal - $driversPriceSum - $commissionAmt) * 
							s('TecajRSD'));
	}
*/							
	if($transfersInSerbia == 0 and $knjigovodstvo != '1') {
		$VATbase = '0.00';
	}						

	//$VATtotal = nf( $VATbase * $vat / 100 );
	if($transfersInSerbia == 0) $VATtotal = '0.00';


	$totalEur_TecajRSD = $totalEur * $TecajRSD;
	$VATbase_vat = $VATbase*$vat/100;
	$driversPriceSum_TecajRSD = $driversPriceSum * $TecajRSD;

	$smarty->assign('totalEur_TecajRSD',$totalEur_TecajRSD);
	$smarty->assign('VATbase_vat',$VATbase_vat);
	$smarty->assign('driversPriceSum_TecajRSD',$driversPriceSum_TecajRSD);
												
?>
					

<script>
	$(".jqdatepicker").datepicker({ dateFormat: 'dd.mm.yy' });

</script>


<?php

$smarty->assign('transfersInSerbia', $transfersInSerbia);
$smarty->assign('subTotal', $subTotal);
$smarty->assign('commissionAmt', $commissionAmt);
$smarty->assign('totalEur', $totalEur);
$smarty->assign('VATbase', $VATbase);
$smarty->assign('VATtotal', $VATtotal);

$smarty->assign('Date', $Date);
$smarty->assign('dueDate', $dueDate);

$smarty->assign('description', $description);

$smarty->assign('fullPrice', $fullPrice);
$smarty->assign('subTotal', $subTotal);

$smarty->assign('orders', $orders);

$smarty->assign('incl', $incl);

$smarty->assign('knjigovodstvo', $knjigovodstvo);
$smarty->assign('saved', $saved);