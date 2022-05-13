<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

@session_start();

# sastavi filter - posalji ga $_REQUEST-om
if (isset($type)) {
	if (!isset($_REQUEST['Type']) or $_REQUEST['Type'] == 0 or $_REQUEST['Type'] == 99) {
		$filter = "  AND ".$type." != 0 ";
	}
	else {
		$filter = "  AND ".$type." = '" . $_REQUEST['Type'] . "'";
	}
}

$page 		= $_REQUEST['page'];
$length 	= $_REQUEST['length'];
$sortOrder 	= $_REQUEST['sortOrder'];

$start = ($page * $length) - $length;

if ($length > 0) {
	$limit = ' LIMIT '. $start . ','. $length;
}
else $limit = ' LIMIT 0, ' .$length;

if(empty($sortOrder)) $sortOrder = 'ASC';


# init vars
$out = array();
$flds = array();

$dbWhere = " " . $_REQUEST['where'];
$dbWhere .= $filter . $userFilter;

if (!isset($_REQUEST['PickupDate'])) $_REQUEST['PickupDate']='2022-01-01';
$dbWhere .=' AND PickupDate>='.$_REQUEST['PickupDate'];

$documentType=$_REQUEST['document'];
if ($documentType>0 && $documentType<10) {	 
	//$where = ' WHERE DocumentType = '.$documentType;
	$where='';
	$group = ' GROUP BY OrderID';
	$odock = $odoc->getKeysByMax('ID', 'desc' , $where , $group );
	$orders_arr="";
	if (count($odock)>0) {
		foreach ($odock as $dnn => $key)
		{
			# document row
			$odoc->getRow($key); 
			$documentOrderID=$odoc->getOrderID();
			if ($odoc->getDocumentType()==$documentType)
				$orders_arr.=$documentOrderID.",";
		}
		$orders_arr = substr($orders_arr,0,strlen($orders_arr)-1);
		$dbWhere .=" AND OrderID IN (".$orders_arr.") ";
	}
}

if ($documentType>9) {	
	$cd=$documentType-10;
	$query="SELECT * FROM `v4_VoutcherOrderRequests` WHERE ConfirmDecline=".$cd;
	$result = $db->RunQuery($query);
	$orders_arr="";
	//if (count($result->fetch_array(MYSQLI_ASSOC))>0) {
		while($row = $result->fetch_array(MYSQLI_ASSOC)){ 			
			$orders_arr.=$row['OrderID'].",";
		}
 
		$orders_arr = substr($orders_arr,0,strlen($orders_arr)-1);
		$dbWhere .=" AND OrderID IN (".$orders_arr.") "; 
	/*}
	else $dbWhere .=" AND OrderID IN (1) "; */
}

// ako nema potrebnih podataka, izlaz
// kod Delete transfer (kad je samo jedan na ekranu) 
// se pojavi 'undefined' u Where dijelu, pa se dogodi greska
// Da se to izbjegne, koristim ovaj dio:

if (strpos($dbWhere, 'undefined') !== false) {
	# send output back
	$output = array(
	'draw' => '0',
	'recordsTotal' => 0,
	'recordsFiltered' => 0,
	'data' =>array()
	);
	echo $_GET['callback'] . '(' . json_encode($output) . ')';
	die();
}

# dodavanje search parametra u qry
# DB_Where sad ima sve potrebno za qry
if ( $_REQUEST['Search'] != "" )
{
	$dbWhere .= " AND (";

	for ( $i=0 ; $i< count($aColumns) ; $i++ )
	{
		# If column name exists
		if ($aColumns[$i] != " ")
		$dbWhere .= $aColumns[$i]." LIKE '%"
		.$od->myreal_escape_string( $_REQUEST['Search'] )."%' OR ";
	}
	$dbWhere = substr_replace( $dbWhere, "", -3 );
	$dbWhere .= ')';
}

$odTotalRecords = $od->getFullOrderByDetailsID('v4_OrderDetails.PickupDate DESC, v4_OrderDetails.PickupTime ASC', '',$dbWhere);
$dbk = $od->getFullOrderByDetailsID('v4_OrderDetails.PickupDate ' . $sortOrder.', v4_OrderDetails.PickupTime '. $sortOrder, '' . $limit , $dbWhere);

if (count($dbk) != 0) {
    foreach ($dbk as $nn => $key)
    {
    	$od->getRow($key);
    	
    	
		# OrderID za OrdersMaster
		$OrderID = $od->getOrderID();


		# master key
		$omk = $om->getKeysBy('MOrderID', 'asc' , ' WHERE MOrderID = ' . $OrderID);

		# master row
		$om->getRow($omk[0]);

		# get fields and values
		$detailFlds = $od->fieldValues();

		$detailFlds['DriversPrice'] = number_format($od->getDriversPrice()*$_SESSION['CurrencyRate'],2);
		$detailFlds['DetailPrice'] = number_format($od->getDetailPrice()*$_SESSION['CurrencyRate'],2);
		$detailFlds['ExtraCharge'] = number_format($od->getExtraCharge()*$_SESSION['CurrencyRate'],2);
		$detailFlds['DriverExtraCharge'] = number_format($od->getDriverExtraCharge()*$_SESSION['CurrencyRate'],2);
		$detailFlds['PayLater'] = number_format($od->getPayLater()*$_SESSION['CurrencyRate'],2);
		$detailFlds['PayNow'] = number_format($od->getPayNow()*$_SESSION['CurrencyRate'],2);
		$detailFlds['InvoiceAmount'] = number_format($od->getInvoiceAmount()*$_SESSION['CurrencyRate'],2);
		$detailFlds['Provision'] = number_format($od->getProvision()*$_SESSION['CurrencyRate'],2);
		$detailFlds['ProvisionAmount'] = number_format($od->getProvisionAmount()*$_SESSION['CurrencyRate'],2);
		$detailFlds['Discount'] = number_format($od->getDiscount()*$_SESSION['CurrencyRate'],2);
		$detailFlds['DriverPaymentAmt'] = number_format($od->getDriverPaymentAmt()*$_SESSION['CurrencyRate'],2);

		$pm=$detailFlds["PaymentMethod"];
		$detailFlds["PaymentMethodName"]=$PaymentMethod[$pm];

		# document key
		$odock = $odoc->getKeysBy('DocumentDate', 'desc' , ' WHERE OrderID = ' . $OrderID);
		if (count($odock)>0) {
			# document row
			$odoc->getRow($odock[0]);
			$detailFlds["Document"]=$odoc->getDocumentCode();	
			$detailFlds["DocumentDate"]=$odoc->getDocumentDate();
			if ($odoc->getDocumentType()==3) $detailFlds["DocumentType"]=$odoc->getDocumentType()+1;	
			else $detailFlds["DocumentType"]=$odoc->getDocumentType();
		}	
		else {
			$detailFlds["Document"]="No document";
			$detailFlds["DocumentDate"]="";	
			$detailFlds["DocumentType"]=0;	
		}	

		$ordermonth=date("m",strtotime($od->getOrderDate()));
		$orderyear=date("Y",strtotime($od->getOrderDate()));
		$orderym=$orderyear*12+$ordermonth;
		
		$pickupmonth=date("m",strtotime($od->getPickupDate()));
		$pickupyear=date("Y",strtotime($od->getPickupDate()));
		$pickupym=$pickupyear*12+$pickupmonth;	
		
		if ($orderym==$pickupym) $detailFlds["Advance"]=2;
		else $detailFlds["Advance"]=99;

		//zamena naziva mesta sa engleskim nazivom iz tabele places
		$PickupID=$od->getPickupID();
		$DropID=$od->getDropID();
		if ($PickupID!=0) {
			$pl->getRow($PickupID);
			$detailFlds["PickupName"]=$pl->getPlaceNameEN(); 
		}
		if ($DropID!=0) {
			$pl->getRow($DropID);
			$detailFlds["DropName"]=$pl->getPlaceNameEN();
		}
				
		# get fields and values
		$masterFlds = $om->fieldValues();
		$masterFlds['CountryPhonePrefix'] = getCountryPrefix( $om->getMCardCountry() );

		$out[] = array_merge($detailFlds , $masterFlds);    	  	
    }
}
# send output back
$output = array(
'draw' => '0',
'recordsTotal' => count($odTotalRecords),
'recordsFiltered' => $length,
'data' =>$out
);
echo $_GET['callback'] . '(' . json_encode($output) . ')';	