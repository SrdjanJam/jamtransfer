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
if (isset($type3)) {
	if (!isset($_REQUEST['Type3']) or $_REQUEST['Type3'] == 0 ) {
		$filter .= "  AND ".$type3." != 0 ";
	}
	else {
		$filter = "  AND ".$type3." = '" . $_REQUEST['Type3'] . "'";
	}	

}

if(!isset($_REQUEST['page'])) $_REQUEST['page']="";
if(!isset($_REQUEST['length'])) $_REQUEST['length']="";
if(!isset($_REQUEST['sortField'])) $_REQUEST['sortField']="";
if(!isset($_REQUEST['sortDirection'])) $_REQUEST['sortDirection']="";
$page 		= $_REQUEST['page'];
$length 	= $_REQUEST['length'];
$sortField 	= $_REQUEST['sortField'];
$sortDirection 	= $_REQUEST['sortDirection'];

$start = ((int)$page * (int)$length) - (int)$length;
// var_dump($start);

if ($length > 0) {
	$limit = ' LIMIT ' .$start . ','. $length;
}
else $limit = ' LIMIT 0, ' .$length;

if(empty($sortField)) $sortField = 'PickupDate';
if(empty($sortDirection)) $sortDirection = 'DESC';


# init vars
$out = array();
$flds = array();
$sum=array();

$dbWhere = " " . $_REQUEST['where'];
$sql="SELECT min(`PickupDate`) as min,`SubDriver`,`PickupDate`,count(*) as quant, 
	sum(DriversPrice) as price,
	sum(PayLater) as payLater,
	sum(CashIn) as cashIn
	FROM `v4_OrderDetails` WHERE `TransferStatus` not in (3,9) AND `SubDriver`>0 AND DriverConfStatus not in (0,1,2,4)  AND DriverID = '".$_SESSION['UseDriverID']."'";
if (isset($_REQUEST['subdriverID']) && $_REQUEST['subdriverID']>0) $sql .= " AND SubDriver = ".$_REQUEST['subdriverID'];
if (isset($_REQUEST['orderFromDate']) && $_REQUEST['orderFromDate']>0) $sql .= " AND PickupDate >='".$_REQUEST['orderFromDate']."'";
if (isset($_REQUEST['orderToDate']) && $_REQUEST['orderToDate']>0) $sql .= " AND PickupDate <='".$_REQUEST['orderToDate']."'";
$sql .= $filter;
$sql .=" GROUP BY PickupDate,SubDriver ";
$result = $dbT->RunQuery($sql);
$min=$result->fetch_array(MYSQLI_ASSOC)['min'];
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$sdid=$row['SubDriver'];
	$sd_not[$sdid]+=$row['quant']."<br>";
	$sd_price[$sdid]+=$row['price'];
	$sd_payLater[$sdid]+=$row['payLater'];
	$sd_cashIn[$sdid]+=$row['cashIn'];
	$sd_workingdates[$sdid][]=$row['PickupDate'];
}
	
$sql="SELECT `SubDriver2`,count(*) as quant, sum(DriversPrice) as price FROM `v4_OrderDetails` WHERE `TransferStatus` not in (3,9) AND `SubDriver2`>0 AND DriverConfStatus not in (0,1,2,4)  AND DriverID = '".$_SESSION['UseDriverID']."'";
if (isset($_REQUEST['subdriverID']) && $_REQUEST['subdriverID']>0) $sql .= " AND SubDriver2 = ".$_REQUEST['subdriverID'];
if (isset($_REQUEST['orderFromDate']) && $_REQUEST['orderFromDate']>0) $sql .= " AND PickupDate >='".$_REQUEST['orderFromDate']."'";
if (isset($_REQUEST['orderToDate']) && $_REQUEST['orderToDate']>0) $sql .= " AND PickupDate <='".$_REQUEST['orderToDate']."'";
$sql .= $filter;
$sql .=" GROUP BY PickupDate,SubDriver2 ";
	$result = $dbT->RunQuery($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$sdid=$row['SubDriver2'];
		$sd_not[$sdid]+=$row['quant'];
		$sd_price[$sdid]+=$row['price'];	
		$sd_workingdates[$sdid][]=$row['PickupDate'];
	}
$sql="SELECT `SubDriver3`,count(*) as quant, sum(DriversPrice) as price FROM `v4_OrderDetails` WHERE `TransferStatus` not in (3,9) AND `SubDriver3`>0 AND DriverConfStatus not in (0,1,2,4)  AND DriverID = '".$_SESSION['UseDriverID']."'";
if (isset($_REQUEST['subdriverID']) && $_REQUEST['subdriverID']>0) $sql .= " AND SubDriver3 = ".$_REQUEST['subdriverID'];
if (isset($_REQUEST['orderFromDate']) && $_REQUEST['orderFromDate']>0) $sql .= " AND PickupDate >='".$_REQUEST['orderFromDate']."'";
if (isset($_REQUEST['orderToDate']) && $_REQUEST['orderToDate']>0) $sql .= " AND PickupDate <='".$_REQUEST['orderToDate']."'";
$sql .= $filter;
$sql .=" GROUP BY PickupDate,SubDriver3 ";
	$result = $dbT->RunQuery($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$sdid=$row['SubDriver3'];
		$sd_not[$sdid]+=$row['quant'];
		$sd_price[$sdid]+=$row['price'];
		$sd_workingdates[$sdid][]=$row['PickupDate'];
	}	
foreach ($sd_not as $nn => $key) {
	$sdids .= $nn.",";
}	
$sdids = substr($sdids,0,strlen($sdids)-1);	
$dbWhere .= " AND AuthUserID in (".$sdids.") ";
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
		.$db->myreal_escape_string( $_REQUEST['Search'] )."%' OR ";
	}
	$dbWhere = substr_replace( $dbWhere, "", -3 );
	$dbWhere .= ')';
}



$dbTotalRecords = $db->getKeysBy($keyName. ' ASC', '',$dbWhere);
$dbk = $db->getKeysBy($keyName .' '. $sortOrder, $limit , $dbWhere);


if (count($dbk) != 0) {
    foreach ($dbk as $nn => $key)
    {
    	$db->getRow($key);    	
    	# get fields and values
		$detailFlds = $db->fieldValues();
		$detailFlds["SubDriverName"]=$db->getAuthUserRealName();
		$detailFlds["NoT"]=$sd_not[$key];
		$detailFlds["Value"]=number_format($sd_price[$key],2);
		$detailFlds["PayLater"]=number_format($sd_payLater[$key],2);
		$detailFlds["CashIn"]=number_format($sd_cashIn[$key],2);
		if (empty($_REQUEST['orderFromDate']) ) $_REQUEST['orderFromDate']=$min;
		if (empty($_REQUEST['orderToDate'])) $_REQUEST['orderToDate']=date('Y-m-d');
		$workingDaysAll=((strtotime($_REQUEST['orderToDate'])-strtotime($_REQUEST['orderFromDate']))/(3600*24))+1;
		
		$detailFlds["FreeDays"]=$workingDaysAll-count(array_filter(array_unique($sd_workingdates[$key])));
		$detailFlds["Date1"]= $_REQUEST['orderFromDate'];
		$detailFlds["Date2"]= $_REQUEST['orderToDate'];

		$out[] = $detailFlds; 

    }	
	
}
	

# send output back
$output = array(
'sortField' => $sortField,
'sortDirection' => $sortDirection,
'recordsTotal' => count($dbTotalRecords),
'data' =>$out
);
echo $_GET['callback'] . '(' . json_encode($output) . ')';	