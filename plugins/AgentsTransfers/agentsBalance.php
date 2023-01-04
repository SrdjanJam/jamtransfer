<?
	// proveriti:
	// session_start();
	// require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/f/csv.class.php';
	// require_once $_SERVER['DOCUMENT_ROOT'] . '/db/db.class.php';
	// $db = new DataBaseMysql();
	
	require_once ROOT . '/common/class/csv.class.php';

	// CSV Setup
	$csv = new ExportCSV;
	$csv->File = 'AgentBalance';
	$csv->totalOnCols = array('7');


if (isset($_REQUEST['reset']) and $_REQUEST['reset'] != 0) $_REQUEST = array();	
	
if (isset($_REQUEST['StartDate']) and isset($_REQUEST['EndDate'])){

	// NE KORISTE SE:
	// $total = 0;
	// $totOnline = 0;
	// $totCash = 0;
	// $toPay = 0;
	// $weOwe = 0;
	
	
	$totInv = 0;
	$totNetto = 0;
	$noshow = 0;
	$driverError = 0;
	$CompletedTransfers = 0;
	$Sistem = 0;
	
	// assigned:
	$noshow = $_REQUEST ['NoShow'];
	$driverError = $_REQUEST['DrErr'];
	$CompletedTransfers = $_REQUEST['CompletedTransfers'];
	$Sistem = $_REQUEST['Sistem'];
		
	#++++++++++++++++++++++++++++++++++++++++++++++++++
	# polazni transferi
	#++++++++++++++++++++++++++++++++++++++++++++++++++

	$q  = " SELECT v4_OrderDetails.*,v4_OrdersMaster.MConfirmFile FROM v4_OrderDetails,v4_OrdersMaster ";

	if($Sistem != 0) { //Ako je sistem onda ide po pickup dateu
		$q .= " WHERE MOrderID=OrderID AND PickupDate >= '{$_REQUEST['StartDate']}' ";
		$q .= " AND PickupDate <= '{$_REQUEST['EndDate']}' ";

	} else { //Za ostale agente ide po datumu rezervacije
		$q .= " WHERE MOrderID=OrderID AND OrderDate >= '{$_REQUEST['StartDate']}' ";
		$q .= " AND OrderDate <= '{$_REQUEST['EndDate']}' ";
	}

		$q .= "AND PaymentMethod = '4' ";
	 	
	if($CompletedTransfers != 0) { //Samo odvozene transfere
		$q .= "AND TransferStatus = '5' ";

	} else { //Sve ostale
		$q .= " AND TransferStatus != '3' ";
		$q .= " AND TransferStatus != '4' ";
		$q .= " AND TransferStatus != '9' ";
	}

	if($noshow != 1) $q .= " AND DriverConfStatus != '5' ";
	if($driverError != 1) $q .= " AND DriverConfStatus != '6' ";

	if (!empty($_REQUEST['agentid'])) { 
		if (getConnectedUser($_REQUEST['agentid'])>0) $q .= ' AND (UserID = ' . $_REQUEST['agentid'] . '  OR UserID =  '.getConnectedUser($_REQUEST['agentid']). ') '; 
		else $q .= ' AND UserID = ' . $_REQUEST['agentid'] . ' ';
	}

    //$q .= " ORDER BY  PickupDate ASC, UserID ASC, PickupTime ASC";
    $q .= " ORDER BY  OrderID ASC, UserID ASC";
	// echo $q;
	$e = $db->RunQuery($q);
	// exit($q);
    
   	$u = getUser($_REQUEST['agentid']);
   	

	$smarty->assign('connectedAgent', $u->AuthUserCompany . getConnectedUserName($_REQUEST['agentid']));
	
	$i = 0;

	// Delimiter
	$dlm = ";";
	
	# CSV first row
	$csv->addHeader(array(
			'ReferenceNo',
			'OrderKey',
			'PickupDate', 
			'Passenger',
			'PaxNo',
			'Veh.Type',
			'Route',
			'Agent',
			'InvoiceAmt',
			'DriversPrice'
			) );	


	$transfers = array();
	$drivers = array();
	
	while( $o = $e->fetch_object() ){
		// exit('asd');

		$transfers_row = array();
		foreach($o as $key=>$dv){
			$transfers_row[$key] = $dv;
		}
		

		$transfers[] = $transfers_row;

		$totInv += $o->InvoiceAmount;
		$totNetto += $o->DriversPrice * $o->VehiclesNo;

		
			// echo $o->VehicleType;
			// echo $o->PaxNo;
			# CSV rows

			$csv->addRow(array(
					$o->MConfirmFile,
					$o->OrderID.'-'.$o->TNo ,
					$o->PickupDate ,
					$o->PaxName,
					$o->PaxNo,
					$o->VehicleType,
					$o->PickupName. '-' . $o->DropName, // error
					Agent($o->UserID), // error
					number_format($o->InvoiceAmount,2),
					$o->DriversPrice
					));	
		
	} # end polazni transferi
	

		// echo $o->PickupName;
		// echo $o->DropName;
		// echo Agent($o->UserID);

	// print_r($transfers);

	$csv->addTotalRow();
	$csv->save();
	
	$csv->File.$csv->Extension;
	
}
// exit($totInv);

#
# hidden polja
#
function hiddenField($name,$value)
{
	echo '<input name="'.$name.'" id="'.$name.'" type="hidden" value="'.$value.'" />';
}

function Agent($agentid)
{
    if (!empty($agentid))
    {
		$data = getUserData($agentid);
		
		return $data['AuthUserCompany'];
    }
    else return '<b>None</b>';
}


function PickDriver()
{
    global $db;
    
    $qd = "SELECT * FROM v4_AuthUsers 
    	   WHERE AuthLevelID = '2' 
    	   AND Active = '1' 
    	   ORDER BY AuthUserCompany ASC";
    	   
    $wd = $db->RunQuery($qd);
    
    echo '<select name="agentid" id="agentid">';
    echo '<option value=""> All Agents </option>';
    while ($d = $wd->fetch_object())
    {
        echo '<option value="'.$d->AuthUserID.'">';
        echo trim($d->AuthUserCompany);
        echo '</option>';
    }
    
    echo '</select>';
}


// ASSIGN:
$smarty->assign('totInv',$totInv);
$smarty->assign('totNetto',$totNetto);

$smarty->assign('transfers', $transfers);
 
?>