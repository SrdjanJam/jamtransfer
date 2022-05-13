<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../../config.php';

@session_start();

$userFilter = '';

$SAuthUserID = $_SESSION['AuthUserID'];

# FRANCUSKA FIX
$FRDriver = false;
require_once '../../fixDriverID.php';

foreach($fakeDrivers as $key => $fakeDriverID) {
    if($SAuthUserID == $fakeDriverID) {
        $SAuthUserID = $realDrivers[$key];
        $FRDriver = true;
    }
}


// sysadmin, admin, operator, accountant, driver i dispatcher vide sve bez obzira tko je transfer napravio
if(	$_SESSION['AuthLevelID'] != '99' and 
	$_SESSION['AuthLevelID'] != '91' and 
	$_SESSION['AuthLevelID'] != '31' and 
	$_SESSION['AuthLevelID'] != '41' and
	$_SESSION['AuthLevelID'] != '44' and
	$_SESSION['AuthLevelID'] != '45')
{
	$userFilter = ' AND v4_OrderDetails.UserID = ' . $SAuthUserID;
}
// ostali useri vide samo svoje transfere (agent, affiliate itd.)
else if($_SESSION['AuthLevelID'] == '31') {
	$userFilter = ' AND v4_OrderDetails.DriverID = ' . $SAuthUserID;
}
else $userFilter = '';

# init libs

if($FRDriver == true) require_once '../../db/v4_OrderDetailsFR.class.php';
else require_once '../../db/v4_OrderDetails.class.php';

require_once '../../db/v4_OrdersMaster.class.php';
require_once '../../db/v4_OrderDocument.class.php';
require_once '../../db/v4_Places.class.php';
if($FRDriver == true) {
    class v4_OrdersJoin extends v4_OrderDetailsFR {
	    public function getFullOrderByDetailsID($column, $order, $where = NULL) {
		    $keys = array(); $i = 0;
		    $result = $this->connection->RunQuery("
			    SELECT * FROM v4_OrderDetails AS v4_OrderDetails, v4_OrdersMaster $where 
			    AND v4_OrderDetails.OrderID = v4_OrdersMaster.MOrderID ORDER BY $column $order");
			    
			    while($row = $result->fetch_array(MYSQLI_ASSOC)){
				    $keys[$i] = $row["DetailsID"];
				    $i++;
			    }
	    return $keys;
	    }
    }
} else {
    class v4_OrdersJoin extends v4_OrderDetails {
	    public function getFullOrderByDetailsID($column, $order, $where = NULL) {
		    $keys = array(); $i = 0;
		    $result = $this->connection->RunQuery("
			    SELECT v4_OrderDetails.*,v4_OrdersMaster.*,v4_AuthUsers.AuthUserRealName FROM v4_OrderDetails AS v4_OrderDetails, v4_OrdersMaster, v4_AuthUsers $where 
			    AND v4_OrderDetails.OrderID = v4_OrdersMaster.MOrderID AND v4_AuthUsers.AuthUserID=UserID ORDER BY $column $order");
			    
			    while($row = $result->fetch_array(MYSQLI_ASSOC)){
				    $keys[$i] = $row["DetailsID"];
				    $i++;
			    }
	    return $keys;
	    }
    }
}

# init class
//$od = new v4_OrderDetails();
$db = new DataBaseMysql(); 
$od = new v4_OrdersJoin();
$pl = new v4_Places();
$om = new v4_OrdersMaster();
$odoc = new v4_OrderDocument();

#********************************************
# ulazni parametri su where, status i search
#********************************************

# sastavi filter prema statusima
if (!isset($_REQUEST['status']) or $_REQUEST['status'] == '0') {
	$filter = " "; 
}
else {
	$filter = "  AND v4_OrderDetails.TransferStatus = '" . $_REQUEST['status'] . "'"; 
	if($FRDriver == true) $filter = "  AND v4_OrderDetails.Expired = '0' AND v4_OrderDetails.TransferStatus = '" . $_REQUEST['status'] . "'"; 
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

# kombinacija where i filtera
$odWhere = " " . $_REQUEST['where'];
//$odWhere = " WHERE DetailsID > '3300' ";
$odWhere .= $filter . $userFilter;

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
		$odWhere .=" AND OrderID IN (".$orders_arr.") ";
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
		$odWhere .=" AND OrderID IN (".$orders_arr.") "; 
	/*}
	else $odWhere .=" AND OrderID IN (1) "; */
}

// ako nema potrebnih podataka, izlaz
// kod Delete transfer (kad je samo jedan na ekranu) 
// se pojavi 'undefined' u Where dijelu, pa se dogodi greska
// Da se to izbjegne, koristim ovaj dio:

if (strpos($odWhere, 'undefined') !== false) {
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


#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'v4_OrderDetails.OrderID',
	'v4_OrderDetails.PaxName',
	'v4_OrderDetails.PickupName',
	'v4_OrderDetails.DropName',
	'v4_OrderDetails.PickupDate',
	'v4_OrderDetails.InvoiceNumber',
	'v4_OrderDetails.UserID',	
	'v4_OrderDetails.DriverName',	
	'v4_OrderDetails.DriverInvoiceNumber',	
	'v4_OrdersMaster.MPaxEmail',
	'v4_OrdersMaster.MCardNumber',
	'v4_OrdersMaster.MOrderKey',
	'v4_OrdersMaster.MConfirmFile',
	'v4_AuthUsers.AuthUserRealName'
);


# dodavanje search parametra u qry
# odWhere sad ima sve potrebno za qry
if ( $_REQUEST['Search'] != "" )
{
	$odWhere .= " AND (";

	for ( $i=0 ; $i< count($aColumns) ; $i++ )
	{
		# If column name exists
		if ($aColumns[$i] != " ")
		$odWhere .= $aColumns[$i]." LIKE '%"
		.$od->myreal_escape_string( $_REQUEST['Search'] )."%' OR ";
	}
	$odWhere = substr_replace( $odWhere, "", -3 );
	$odWhere .= ')';
}

//Blogit('prije '. $odWhere);
$odTotalRecords = $od->getFullOrderByDetailsID('v4_OrderDetails.PickupDate DESC, v4_OrderDetails.PickupTime ASC', '',$odWhere);

//Blogit($odTotalRecords);
# test za LIMIT - trebalo bi ga iskoristiti za pagination! 'asc' . ' LIMIT 0,50'
$odk = $od->getFullOrderByDetailsID('v4_OrderDetails.PickupDate ' . $sortOrder.', v4_OrderDetails.PickupTime '. $sortOrder, '' . $limit , $odWhere);
//Blogit($odk);

if (count($odk) != 0) {

   
    foreach ($odk as $nn => $key)
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

//echo '<pre>'; print_r($out); echo '</pre>';
//Blogit($out);
# send output back
$output = array(
'draw' => '0',
'recordsTotal' => count($odTotalRecords),
'recordsFiltered' => $length,
'data' =>$out
);
//print_r($output);
echo $_GET['callback'] . '(' . json_encode($output) . ')';

