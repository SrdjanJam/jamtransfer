<?
	require_once ROOT . '/db/v4_OrdersMaster.class.php';
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_Invoices.class.php';
	require_once ROOT . '/db/v4_InvoiceDetails.class.php';
	
	$om = new v4_OrdersMaster();
	$od = new v4_OrderDetails();
	$in = new v4_Invoices();
	$id = new v4_InvoiceDetails();

	if(isset($_REQUEST['agentid'])) $a = $_REQUEST['agentid'];
	else $a	= $_REQUEST['agentid'] = 0; // AgentID

	if(isset($_REQUEST['StartDate'])) $start = $_REQUEST['StartDate'];
	else $start	= $_REQUEST['StartDate'] = 0; // start date

	if(isset($_REQUEST['EndDate'])) $end = $_REQUEST['EndDate'];
	else $end	= $_REQUEST['EndDate'] = 0; // end date

	if(isset($_REQUEST['NoShow'])) $ns = $_REQUEST['NoShow'];
	else $ns = $_REQUEST['NoShow'] = 0; // noshow

	if(isset($_REQUEST['DrErr'])) $de = $_REQUEST['DrErr'];
	else $de	= $_REQUEST['DrErr'] = 0; // driverError

	if(isset($_REQUEST['CompletedTransfers'])) $ct = $_REQUEST['CompletedTransfers'];
	else $ct	= $_REQUEST['CompletedTransfers'] = 0; // Completed Transfers Only

	if(isset($_REQUEST['Sistem'])) $si = $_REQUEST['Sistem'];
	else $si	= $_REQUEST['Sistem'] = 0; // Sistem

	if(isset($_REQUEST['k'])) $knjigovodstvo = $_REQUEST['k'];
	else $knjigovodstvo	= $_REQUEST['k'] = 0; // 1 = racun za knjigovodstvo

	
	if(isset($_REQUEST['SumSubTotal'])) $_REQUEST['SumSubTotal'];
	else $_REQUEST['SumSubTotal'] = 0;
	if(isset($_REQUEST['CommSubtotal'])) $_REQUEST['CommSubtotal'];
	else $_REQUEST['CommSubtotal'] = 0;
	if(isset($_REQUEST['CommPrice'])) $_REQUEST['CommPrice'];
	else $_REQUEST['CommPrice'] = 0;
	if(isset($_REQUEST['TotalPriceEUR'])) $_REQUEST['TotalPriceEUR'];
	else $_REQUEST['TotalPriceEUR'] = 0;
	if(isset($_REQUEST['TotalSubTotalEUR'])) $_REQUEST['TotalSubTotalEUR'];
	else $_REQUEST['TotalSubTotalEUR'] = 0;
	if(isset($_REQUEST['VATNotApp'])) $_REQUEST['VATNotApp'];
	else $_REQUEST['VATNotApp'] = 0;
	if(isset($_REQUEST['VATBaseTotal'])) $_REQUEST['VATBaseTotal'];
	else $_REQUEST['VATBaseTotal'] = 0;
	if(isset($_REQUEST['VATtotal'])) $_REQUEST['VATtotal'];
	else $_REQUEST['VATtotal'] = 0;
	if(isset($_REQUEST['GrandTotal'])) $_REQUEST['GrandTotal'];
	else $_REQUEST['GrandTotal'] = 0;



	$detailsID = array();
	$invoiceExists = false;
	
	// $knjigovodstvo = 0;
	
	
	$taxPercent = 0;
	$taxAmt 	= 0;
	$driversPriceSum = 0;
	$isInSerbia = false;
	$saved = false;
	
	// uzmi podatke o tecaju RSD iz file-a
	// $filename = ROOT . '/cms/exchangeRate.inc'; // Ova putanja definisana u index.php fajlu
	$tecaj = file_get_contents($filename);
	$_SESSION['TecajRSD'] = $tecaj;
	
	$Date = date("Y-m-d"); // invoice date - default danas
	$dueDate = date('Y-m-d', strtotime($Date. ' + 15 days')); // za strane racune rok placanja 15 dana


	
	// ako je InvoiceDate ispunjen u prvom koraku
	if(isset($_REQUEST['InvoiceDate'])) {
		$dueDate = date('Y-m-d', strtotime($_REQUEST['InvoiceDate']. ' + 15 days'));
	}

	$sum = 0;
	$i = 0;

	 // User Object
	$u = (array)getUser($a); // User Object
	// print_r($u);
	$smarty->assign('u',$u);

	// FILTER PODATAKA
	//$whereD  = " WHERE UserID ='" . $d ."' ";
	if (getConnectedUser($a)>0) $whereD = " WHERE (UserID = '" . $a. "'  OR UserID =  '".getConnectedUser($a). "') "; 
	else $whereD  = " WHERE UserID ='" . $a ."' ";
	
	if($si != 1) {
		$whereD .= " AND OrderDate >= '{$start}' AND OrderDate <= '{$end}' ";
	} else {
		$whereD .= " AND PickupDate >= '{$start}' AND PickupDate <= '{$end}' ";
	}
	if($ct != 1) {
		$whereD .= " AND TransferStatus != 3 ";// cancel
		$whereD .= " AND TransferStatus != 4 ";// temp
		$whereD .= " AND TransferStatus != 9 ";//deleted
	} else {
		$whereD .= "AND TransferStatus = 5 ";//completed only
	}

	if($ns != 1) $whereD .= " AND DriverConfStatus != 5 ";//no-show
	if($de != 1) $whereD .= " AND DriverConfStatus != 6 ";//driver error
	
	$whereD .= " AND PaymentMethod in (4,6) ";

	if (isset($_REQUEST['Exclude'])) $whereD .= " AND DetailsID  NOT IN (".$_REQUEST['Exclude'].") ";
	// echo $whereD;
	
	$kd = $od->getKeysBy('DetailsID', 'asc', $whereD);
	// kliknut je Save botun
	if( isset($_REQUEST['Save']) and 
		$_REQUEST['Save'] == '1' and 
		isset($_REQUEST['InvoiceNumber']) and 
		!empty($_REQUEST['InvoiceNumber']) ) {
		
		// Provjera postoji li vec racun sa ovim brojem
		$inKey = $in->getKeysBy('ID', 'ASC', " WHERE InvoiceNumber='" . $_REQUEST['InvoiceNumber'] . "'");
		
		if(count($inKey) > 0) {
			$in->getRow($inKey[0]);
			if( $in->getInvoiceNumber() == $_REQUEST['InvoiceNumber'] ) {
				// exit('Alert');
				$invoiceExists = true;

			}
		}

		// upis podataka u v4_OrderDetails i v4_Invoices
		if(!$invoiceExists) {
			
			foreach($_SESSION['details'] as $key => $detail) {
				$DetailsID = $key;
				$desc = $detail['Description'];
				$qty = $detail['Qty'];
				$price = $detail['Price'];
				$subTotal = $detail['SubTotal'];
				$od->getRow($DetailsID);
				$od->setInvoiceNumber( $_REQUEST['InvoiceNumber'] );
				$od->setInvoiceDate( date_change_format ($_REQUEST['InvoiceDate'] ));
				$od->setPaymentStatus( '1' ); // Invoice sent
			
				$od->saveRow();
				
				if($u['CountryName'] == 'Serbia') {
					$om->getRow($od->getOrderID());
					$om->setMEurToCurrencyRate($_SESSION['TecajRSD']);
					$om->saveRow();
				}
				
				$id->setInvoiceNumber( $_REQUEST['InvoiceNumber'] );
				$id->setDescription( $desc );
				$id->setQty( $qty );
				$id->setPrice( $price );
				$id->setSubTotal( $subTotal );
				$id->setDetailsID( $DetailsID );
				
				$id->saveAsNew();
				
				
				
			}
		
			$in->setType( '1' ); // Agentski racun
			$in->setInvoiceNumber( $_REQUEST['InvoiceNumber'] );
			$in->setInvoiceDate( date_change_format ($_REQUEST['InvoiceDate'] ));
			$in->setStartDate( $start );
			$in->setEndDate( $end );
			$in->setUserID( $a );

			$in->setDueDate( $_REQUEST['DueDate'] );
	
			
			
			

			$in->setSumSubtotal( $_REQUEST['SumSubTotal'] );
			$in->setCommPrice( $_REQUEST['CommPrice'] );
			$in->setCommSubtotal( $_REQUEST['CommSubtotal'] );
			$in->setTotalPriceEUR( $_REQUEST['TotalPriceEUR'] );
			$in->setTotalSubTotalEUR( $_REQUEST['TotalSubTotalEUR'] );
			$in->setVATNotApp( $_REQUEST['VATNotApp'] );
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
				//die();	
			}		
		} else {
			$saved = true;
			$_SESSION['detailsID'] = array();
		} // endif invoiceExists
	
		$replaceChars = array('/','\\');
		if (isset($_REQUEST['proforma']) && $_REQUEST['proforma']=='proforma') {
			$PDFfile = 	'pdf/PR_'. str_replace($replaceChars,'-',$_REQUEST['InvoiceNumber']).'.pdf';
		}
		else $PDFfile = 	'pdf/RA_'. str_replace($replaceChars,'-',$_REQUEST['InvoiceNumber']).'.pdf';	
		$smarty->assign('Date', $Date);
		$smarty->assign('dueDate', $dueDate);	
		$smarty->assign('PDFfile',$PDFfile);
		
		
		// Working:
		if($u['CountryName'] != 'Serbia') require_once ROOT . '/plugins/AgentsTransfers/invoiceForeign.php';
		else require_once ROOT . '/plugins/AgentsTransfers/invoiceSerbian.php';

		if($saved) {
			
			ob_start();	
			if($u['CountryName'] == 'Serbia') $smarty->display("plugins/AgentsTransfers/templates/invoiceSerbian.tpl");			
			else $smarty->display("plugins/AgentsTransfers/templates/invoiceForeign.tpl");			
			$html = ob_get_contents();
			ob_end_clean();
			

			//****************
			// PDF GENERATION
			//****************
			
			require_once ROOT ."/common/mpdf60/mpdf.php";
			// $path1 = ROOT ."\common\mpdf60\mpdf.php";
			// echo $path1;
			// exit();

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
		}

	} 
	else {
		
		// Prikazi inicijalni racun - bez broja

		// exit($u['CountryName']);

		if($u['CountryName'] != 'Serbia') require_once ROOT . '/plugins/AgentsTransfers/invoiceForeign.php';
		else require_once ROOT . '/plugins/AgentsTransfers/invoiceSerbian.php';
		
				
	}// endif Save



// FUNCTIONS:					

function InSerbia($RouteID) {

	if($RouteID > 0) {

		require_once ROOT .'/db/db.class.php';
		$db = new DataBaseMysql();

		$q2 = "SELECT * FROM v4_Routes WHERE RouteID = '{$RouteID}'";
		$w2 = $db->RunQuery($q2);
	
		$r = $w2->fetch_object();
	
		$q3 = " SELECT * FROM v4_Places 
				WHERE PlaceID = '{$r->FromID}' 
				OR PlaceID = '{$r->ToID}' 
				AND PlaceCountry = '181'";
		$w3 = $db->RunQuery($q3);

		while ($p = $w3->fetch_object() ) {

			if ($p->PlaceCountry == '181') {
				return true; // u Srbiji je
			}
			
		}
		
		return false; // nije u Srbiji
		
	} else return false; // RouteID je nula, pretpostavka je da nije u Srbiji
}

function date_change_format ($date) {
	$date_arr=explode('.',$date);
	if (count($date_arr)>1) $new_date=$date_arr[2]."-".	$date_arr[1]."-". $date_arr[0];
	else $new_date=$date;
	return $new_date;	
}	

function nfT($number) { 
	return number_format($number,2,'.','');
	//return nf($number);
}

// End of functions =========================================================================

