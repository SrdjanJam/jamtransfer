<?php
	
	// Nepotrebno:
	// $vat=$_SESSION['vat'];

	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_Invoices.class.php';
	require_once ROOT . '/db/v4_InvoiceDetails.class.php';
	
	$od = new v4_OrderDetails();
	$in = new v4_Invoices();
	$id = new v4_InvoiceDetails();

	$saved = "";

// Nepotrebno:
// if(isset($_REQUEST['Submit']) and $_REQUEST['Submit'] == '1') {
	
	//$details = array();

	if(isset($_REQUEST['driverid'])) $d = $_REQUEST['driverid'];
	else $d = $_REQUEST['driverid'] = 0;

	
	if(isset($_REQUEST['StartDate'],$_REQUEST['EndDate'],$_REQUEST['includePaymentMethod'])){
		$start = $_REQUEST['StartDate']; // start date
		$end = $_REQUEST['EndDate']; // end date
		$_REQUEST['includePaymentMethod'];
	}else{
		$start = $_REQUEST['StartDate'] = ""; // start date
		$end = $_REQUEST['EndDate'] = ""; // end date
		$_REQUEST['includePaymentMethod'] = 0;
	}

	if(isset($_REQUEST['p'])) $p = $_REQUEST['p'];
	else $p = $_REQUEST['p'] = "";

	if(isset($_REQUEST['DriverInvoiceNumber'])) $DriverInvoiceNumber = $_REQUEST['DriverInvoiceNumber'];
	else $DriverInvoiceNumber = $_REQUEST['DriverInvoiceNumber'] = 0;

	if(isset($_REQUEST['DriverInvoiceDate'])) $DriverInvoiceDate = $_REQUEST['DriverInvoiceDate'];
	else $DriverInvoiceDate = $_REQUEST['DriverInvoiceDate'] = 0;

	if(isset($_REQUEST['Description'])) $Description = $_REQUEST['Description'];
	else $Description = $_REQUEST['Description'] = "";

	if(isset($_REQUEST['si'])) $si = $_REQUEST['si'];
	else $si = $_REQUEST['si'] = "";

	if(isset($_REQUEST['ct'])) $ct = $_REQUEST['ct'];
	else $ct = $_REQUEST['ct'] =  "";
	


	$taxPercent = 0;
	$taxAmt 	= 0;
	
	// Date:
	$Date = date("m/d/Y"); // invoice date - default danas
	$dueDate = date('Y-m-d', strtotime($Date. ' + 15 days')); // za strane racune rok placanja 15 dana

	// ako je InvoiceDate ispunjen u prvom koraku
	if(isset($_REQUEST['DriverInvoiceDate'])) {
		$dueDate = date('Y-m-d', strtotime($_REQUEST['DriverInvoiceDate']. ' + 15 days'));
	}
	
	$sum = 0;
	$transferIDs = '';
	$transfersCount = 0;
		
	if (getConnectedUser($d)>0) $whereD = " WHERE (DriverID = '" . $d. "'  OR DriverID =  '".getConnectedUser($d). "') "; 
	else $whereD  = " WHERE DriverID ='" . $d ."' ";
	
	$whereD .= " AND PickupDate >= '{$start}' AND PickupDate <= '{$end}' ";
	$whereD .= " AND TransferStatus NOT IN (3,4,9)";
	$whereD .= " AND DriverConfStatus != 5 ";//no-show
	if(!empty($_REQUEST['includePaymentMethod'])) $whereD.=" AND PaymentMethod in (".$_REQUEST['includePaymentMethod'].")"; 
	
	// Dobijeni su kljucevi koji ispunjavaju uslov iz whereD
	$kd = $od->getKeysBy('DetailsID', 'asc', $whereD);
 
	$u = (array)getUser($d); // User Object
	
	
	if( isset($_REQUEST['Save']) and 
		$_REQUEST['Save'] == '1' and 
		isset($_REQUEST['DriverInvoiceNumber']) and 
		!empty($_REQUEST['DriverInvoiceNumber']) ) {

				$invoiceExists = "";

		// Provjera postoji li vec racun sa ovim brojem
		$inKey = $in->getKeysBy('ID', 'ASC', " WHERE InvoiceNumber='" . 
									$_REQUEST['DriverInvoiceNumber'] . "'");
		
		if(count($inKey) > 0) {
			$in->getRow($inKey[0]);
			if( $in->getInvoiceNumber() == $_REQUEST['DriverInvoiceNumber'] ) {
				$invoiceExists = true;
			}
		}
		
		// upis podataka u v4_OrderDetails i v4_Invoices
		if(!$invoiceExists) {
			
			foreach($_SESSION['detailsID'] as $nn => $DetailsID) {
				$od->getRow($DetailsID);
			
				$od->setDriverInvoiceNumber( $_REQUEST['DriverInvoiceNumber'] );
				$od->setDriverInvoiceDate( $_REQUEST['DriverInvoiceDate'] );
				
				$od->saveRow();
			}

			//$id->setDetailsID($DetailsID);
			$id->setInvoiceNumber( $_REQUEST['DriverInvoiceNumber'] );
			$id->setQty( $_REQUEST['Qty'] );
			$id->setPrice( $_REQUEST['Price'] );
			$id->setSubTotal( $_REQUEST['SubTotal'] );
			$id->setDescription( $_REQUEST['Description'] );
			$id->setChanged( date("Y-m-d H:i:s") );
			
			$id->saveAsNew();
		
			$in->setType( '2' ); // za Drivere
			$in->setInvoiceNumber( $_REQUEST['DriverInvoiceNumber'] );
			$in->setInvoiceDate($_REQUEST['DriverInvoiceDate']);
			$in->setStartDate( $start );
			$in->setEndDate( $end );
			$in->setUserID( $d );
			$in->setDueDate( $_REQUEST['DueDate'] );
			$in->setSumPrice( $_REQUEST['SumPrice'] );
			$in->setSumSubtotal( $_REQUEST['SumSubTotal'] );
			// $in->setCommPrice( $_REQUEST['CommPrice'] ); // Undefined index
			// $in->setCommSubtotal( $_REQUEST['CommSubtotal'] ); // Undefined index
			$in->setTotalPriceEUR( $_REQUEST['TotalPriceEUR'] );
			$in->setTotalSubTotalEUR( $_REQUEST['TotalSubTotalEUR'] );
			// $in->setVATNotApp( $_REQUEST['VATNotApp'] ); // Undefined index
			$in->setVATBaseTotal( $_REQUEST['VATBaseTotal'] );
			$in->setVATtotal( $_REQUEST['VATtotal'] );
			$in->setGrandTotal( $_REQUEST['GrandTotal'] );
			$in->setCreatedBy( $_SESSION['AuthUserID'] );
			$in->setCreatedDate( date("Y-m-d") );
			$in->setStatus( '0' );
					
			$result = $in->saveAsNew(); // vraca ID novog racuna

			
	
			if( $result > 0 ) {
		 		// OBRADA ZAVRSENA, MOZE SE PRIKAZATI PDF
				$saved = true;

			} else {
				echo '	<div class="center alert-danger pad1em" style="visibility:screenonly !important">
							<h1>Warning: Invoice already exists!</h1>
						</div>
					';
				$saved = true;
			}		
		
		} // endif invoiceExists
		else {
			$saved = true;
			$_SESSION['detailsID'] = array();
		}
		// Request:
		if(isset($_REQUEST['Submit'],$_REQUEST['Save'],$_REQUEST['GrandTotal'])){
			$Submit = $_REQUEST['Submit'];
			$Save = $_REQUEST['Save'];
			$GrandTotal = $_REQUEST['GrandTotal'];
		}else{
			$Submit = $_REQUEST['Submit'] = "";
			$Save = $_REQUEST['Save'] = "";
			$GrandTotal = $_REQUEST['GrandTotal'] = 0;
		}
		
		
	} // End of - if $_REQUEST['Save']
		
	$replaceChars = array('/','\\');
	$PDFfile = 	'pdf/RD_'. str_replace($replaceChars,'-',$_REQUEST['DriverInvoiceNumber']).'.pdf';
	

	$countries = array();
	$transfersInSerbia = 0;

	$transfersSum = 0;
	$driversPriceSum = 0;
	$cashTotal = 0;
	$driverExtraChargeTotal = 0;
	$paidOnline = 0;
							
	foreach($kd as $nn => $id) {
		// Orderditails i klasa v4_OrderDetails.class.php
		$od->getRow($id); // uzima red
		
		$isInSerbia = InSerbia($od->RouteID, $od->PickupID,$od->DropID);			
		if($isInSerbia) $transfersInSerbia += 1;
		// da znamo sto treba azurirati u invoiceCumulativeAgent
		$_SESSION['detailsID'][] = $od->getDetailsID();

		$driversPriceSum += $od->getDriversPrice();

		$transferPrice 	= $od->getDetailPrice()+$od->getExtraCharge();
		$cash 			= $od->getPayLater();
		$driverExtraCharge = $od->getDriverExtraCharge();

		$transfersSum	+= $transferPrice;
		$cashTotal		+= $cash;
		$driverExtraChargeTotal += $driverExtraCharge;
		
		$paidOnline += $od->getPayNow();

		$transfersCount += 1;
		

		// These lines
		$pickupCountry 	= getPlaceCountry ($od->getPickupID());
		$dropCountry 	= getPlaceCountry ($od->getDropID());
		
		

		if(!in_array($pickupCountry, $countries ) and $pickupCountry > 0) {
			$countries[] = $pickupCountry; 
		}

		if(!in_array($dropCountry, $countries )  and $dropCountry > 0) {
			$countries[] = $dropCountry; 
		}
	//echo '<br>Transfer price: '.$transferPrice . ' ID:' . $od->getOrderID();
	} // End of foreach	
				
	$sum = $cashTotal - $driversPriceSum - $driverExtraChargeTotal;
	//$sum = $transfersSum - $driversPriceSum - $paidOnline;
	
	$VATtotal = '0.00';		
	
	$Description = "
					Commission fee for ".$transfersCount." transfers realized from ". formatDate($start, 'd. M Y')." - ". formatDate($end, 'd. M Y') .	" in: ";

					$cList = '';
					foreach($countries as $nn => $country) {
						$cList .= getCountryName($country) . '+';
					}
				
					$cList = substr( str_replace('++','+',$cList), 0, -1) ;
					if($cList == '') $cList = $u['CountryName'];
				
					$Description .= $cList;
					$Description .= ' / ';
					$Description .= $u['Terminal'];
					$Description .= " (according to specification) 
					";  
					$Description = trim(strip_tags($Description));

	

	if($saved) {
		ob_start(); // 
		$smarty->display("plugins/DriversTransfers/templates/invoice.tpl");	

		$html = ob_get_contents();
		ob_end_clean();
		//****************
		// PDF GENERATION
		//****************
		
		require_once ROOT ."/common/mpdf60/mpdf.php";

			$mpdf=new mPDF();
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->autoScriptToLang = true;
			$mpdf->baseScript = 1;


		// LOAD a stylesheet
		$stylesheet = file_get_contents('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css').
						//file_get_contents('css/theme.css').
						file_get_contents('css/simplegrid.css');
		$stylesheet .= '
			table {font-family:"Roboto",sans-serif;font-size:10px !important}
			.nav, .footer {display:none}
			button, .btn, .pdfHide {visibility:screenonly !important;display:none !important}	
			.pdf-input {border-color:white !important;background-color:white !important}
		';

		// The parameter 1 tells that this is css/style only and no body/html/text
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML($html); 
		$content = $mpdf->Output('', 'S');
		$content = chunk_split(base64_encode($content));

		$mpdf->Output(ROOT . "/".$PDFfile);	
		
	} // End of - if saved


// FUNCTIONS: ================================================
	function InSerbia($RouteID,$PickupID,$DropID) {

		global $db;

		if($RouteID > 0) {
			// require_once $_SERVER['DOCUMENT_ROOT'].'/db/db.class.php';
			// $db = new DataBaseMysql();
			$q2 = "SELECT * FROM v4_Routes WHERE RouteID = '{$RouteID}'";
			$w2 = $db->RunQuery($q2);
		
			$r = $w2->fetch_object();
			$PickupID = $r->FromID;
			$DropID = $r->ToID;
			$pass = true;
			
		}else if($PickupID >0 and $DropID >0){
			$pass = true;
		}else{
			return false; // nije u Srbiji
		}

		if($pass == true){
			$q3 = " SELECT * FROM v4_Places 
					WHERE (PlaceID = '{$PickupID}' 
					OR PlaceID = '{$DropID}') 
					AND PlaceCountry = '181'";
			$w3 = $db->RunQuery($q3);
			
			$p = $w3->fetch_object();
			
			if(count(array($p))==1) return true;
			else return false;
		}
		else{
			return false; // RouteID je nula, pretpostavka je da nije u Srbiji
		} 
	}

	function formatDate($date, $format) {
		$date = new DateTime($date);
		return $date->format($format);
	}

	function date_change_format ($date) {
		$date_arr=explode('.',$date);
		if (count($date_arr)>1) $new_date=$date_arr[2]."-".	$date_arr[1]."-". $date_arr[0];
		else $new_date=$date_arr;
		return $new_date;	
	}	
?>
<script>
	$(".jqdatepicker").datepicker({ dateFormat: 'yy-mm-dd' });
</script>


<?php
// Smarty assign
	$smarty->assign('DriverId',$d);
	$smarty->assign('StartDate',$start);
	$smarty->assign('EndDate',$end);

	$smarty->assign('p',$p);

	$smarty->assign('Date',$Date);
	$smarty->assign('dueDate',$dueDate);

	$smarty->assign('toDay',date("Y-m-d"));

	
	$smarty->assign('saved',$saved);

	$smarty->assign('DriverInvoiceNumber', $DriverInvoiceNumber);
	$smarty->assign('DriverInvoiceDate', $DriverInvoiceDate);

	$smarty->assign('u',$u);

	$submit = "";
	$smarty->assign('Submit', $submit);

	$save = "";
	$smarty->assign('Save',$save);

	$GrandTotal = 0;
	$smarty->assign('GrandTotal',$GrandTotal);

	$smarty->assign('sum',$sum);

	$smarty->assign('Description',$Description);
	
	$smarty->assign('VATtotal',$VATtotal);

	$smarty->assign('PDFfile',$PDFfile);

?>