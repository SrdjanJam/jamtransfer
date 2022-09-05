<?php

	require_once ROOT . '/common/class/csv.class.php';

	// CSV Setup
	$csv = new ExportCSV;
	$csv->File = 'DriverBalance';
	$csv->totalOnCols = array('7', '8', '9');
	
	// Za brisanje vrednosti u formi:
	if (isset($_REQUEST['reset']) and $_REQUEST['reset'] != 0) $_REQUEST = array();

	// Razdvajamo deo za prikaz tabele nakon sabmita i prikaz forme pre sabmita	
	if (isset($_REQUEST['StartDate']) and isset($_REQUEST['EndDate'])){
	// Deo za prikaz tabele
		$total = 0;
		$totOnline = 0;
		$totCash = 0;
		$totInv = 0;
		$totNetto = 0;
		$toPay = 0;
		$weOwe = 0;
		
		#++++++++++++++++++++++++++++++++++++++++++++++++++
		# Svi transferi
		#++++++++++++++++++++++++++++++++++++++++++++++++++

		$q  = " SELECT * FROM v4_OrderDetails ";
		$q .= " WHERE PickupDate >= '{$_REQUEST['StartDate']}' ";
		$q .= " AND PickupDate <= '{$_REQUEST['EndDate']}' ";
		$q .= " AND TransferStatus != '3' "; // Kanselovan transfer
		$q .= " AND TransferStatus != '4' "; // Ne potvrdjen transfer
		$q .= " AND TransferStatus != '9' "; // Isbrisan transfer
		$q .= " AND DriverConfStatus != 5 "; // Vozacka greska - nije odvezen
		if(!empty($_REQUEST['includePaymentMethod'])) $q.=" AND PaymentMethod in (".$_REQUEST['includePaymentMethod'].")"; 
		// Visak:
		// $q .= " AND PayLater > DriversPrice ";	// kes transferi

		if (!empty($_REQUEST['driverid'])) 

		if (!empty($_REQUEST['driverid'])) { 
			if (getConnectedUser($_REQUEST['driverid'])>0) $q .= ' AND (DriverID = ' . $_REQUEST['driverid'] . '  OR DriverID =  '.getConnectedUser($_REQUEST['driverid']). ') '; 
			else $q .= ' AND DriverID = ' . $_REQUEST['driverid'] . ' ';
		}

		$q .= " ORDER BY  PickupDate ASC, DriverID ASC, PickupTime ASC";
				
		$e = $db->RunQuery($q);

		$i = 0;

		// Delimiter
		$dlm = ";";

		# CSV first row
		$csv->addHeader(array(
			'OrderKey',
			'Passenger',
			'PaxNo',
			'Veh.Type',
			'Route',
			'DriverName',
			'Cash',
			'DriverPrice',
			'Balance'
		) );	

		// INTALIZATION:
		// [
		$transfers = array();
		$balanceShow = array();
		$drivers = array();
		$driverPrices = array();
		// ]


		while( $o = $e->fetch_object() ){

			// Transfers:
			$transfers_row = array();

			foreach ($o as $key => $dv) {
				$transfers_row[$key] = $dv;
			}

			$transfers[] = $transfers_row;

			// Drivers:
			// Niz punimo rezultatom funkcije koja izvlaci podatke o drajveru iz relacionalne tabele v4_AuthUser:
			$drivers[] = Driver($o->DriverID);

			// ! Prebaciti u smarti ovih 6 polja:
			// Dodaju se tekuce vrednosti u totale
			$total += $o->DetailPrice;
			$totOnline += $o->PayNow;
			$totCash += $o->PayLater;
			$totInv += $o->InvoiceAmount;
			$totNetto += $o->DriversPrice * $o->VehiclesNo + $o->DriverExtraCharge;
			$balance += $o->PayLater - $o->DriversPrice - $o->DriverExtraCharge;

			// balanceShow
			// Kalkulacije balansa
			// payLater - primo kes
			// driverOrice - cena partnera
			// DriverExtraCharge - partnerova cena extrasa
			// balanceShow - iskakulisana nasa provizija
			$balanceShow_row= $o->PayLater - $o->DriversPrice - $o->DriverExtraCharge;
			$balanceShow[] = $balanceShow_row;
			// driverPrice
			$driverPrices[] = $o->DriversPrice + $o->DriverExtraCharge;

			# CSV rows
			$csv->addRow(array(
				$o->OrderID.'-'.$o->TNo ,
				$o->PaxName,
				$o->PaxNo,
				$o->VehicleType,
				$o->PickupName. '-' . $o->DropName,

				Driver($o->DriverID),

				number_format($o->PayLater,2),
				number_format(($o->DriversPrice + $o->DriverExtraCharge),2),
				number_format($balanceShow_row,2)
				)

			);	

			
		}

		$csv->addTotalRow();
		$csv->save();

		$csv->File . $csv->Extension;

		// SMARY ASSIGN:
		$smarty->assign('transfers',$transfers);
		$smarty->assign('balanceShow',$balanceShow);
		$smarty->assign('drivers',$drivers);
		$smarty->assign('driverPrices',$driverPrices);

		$smarty->assign('total',$total);
		$smarty->assign('totOnline',$totOnline);
		$smarty->assign('totCash',$totCash);
		$smarty->assign('totInv',$totInv);
		$smarty->assign('totNetto',$totNetto);
		$smarty->assign('balance',$balance);
		
	} // End of starDate and endDate

	// FUNCTION:

	function Driver($driverid){
		if (!empty($driverid)){
			$data = getUserData($driverid);
			
			return $data['AuthUserCompany'];
		}
		else return '<b>None</b>';
	}
    


