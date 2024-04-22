<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

@session_start();

if (isset($selectactive)) {
	if (!isset($_REQUEST['Active']) or $_REQUEST['Active']==99) {
		$filter .= "  AND ".$selectactive." > -1 ";
	}
	else {
		$filter .= "  AND ".$selectactive." = " . $_REQUEST['Active'] ;
	}
}
$filter .= "  AND AuthLevelID=31 " ;
$page 		= $_REQUEST['page'];
$length 	= $_REQUEST['length'];
$sortOrder 	= $_REQUEST['sortOrder'];

$start = ($page * $length) - $length;

if ($length > 0) {
	$limit = ' LIMIT '. $start . ','. $length;
}
else $limit = '';

if(empty($sortOrder)) $sortOrder = 'ASC';

if (isset($_REQUEST["orderFromDate"]) && !empty($_REQUEST["orderFromDate"])) $dateFrom=$_REQUEST["orderFromDate"];
else $dateFrom="2012-01-01";
if (isset($_REQUEST["orderToDate"]) && !empty($_REQUEST["orderToDate"])) $dateTo=$_REQUEST["orderToDate"];
else $dateTo=date("Y-m-d");
# init vars
$out = array();
$flds = array();

# kombinacija where i filtera
$DB_Where = " " . $_REQUEST['where'];
$DB_Where .= $filter;

# dodavanje search parametra u qry
# DB_Where sad ima sve potrebno za qry
if ( $_REQUEST['Search'] != "" )
{
	$DB_Where .= " AND (";

	for ( $i=0 ; $i< count($aColumns) ; $i++ )
	{
		# If column name exists
		if ($aColumns[$i] != " ")
		$DB_Where .= $aColumns[$i]." LIKE '%"
		.$db->myreal_escape_string( $_REQUEST['Search'] )."%' OR ";
	}
	$DB_Where = substr_replace( $DB_Where, "", -3 );
	$DB_Where .= ')';
}
$sql="SELECT UserID,count(*) as countCD from v4_DriversCD WHERE CD=1 AND DateAdded>='".$dateFrom."' AND DateAdded<='".$dateTo."' GROUP by UserID";
$result = $dbT->RunQuery($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$confirm_arr[$row['UserID']]=$row['countCD'];
}	
$sql="SELECT UserID,count(*) as countCD from v4_DriversCD WHERE CD=2 AND DateAdded>='".$dateFrom."' AND DateAdded<='".$dateTo."' GROUP by UserID";
$result = $dbT->RunQuery($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$decline_arr[$row['UserID']]=$row['countCD'];
}
$sql="SELECT DriverID,count(*) as countCD from v4_OrderRequests WHERE ConfirmDecline=1 AND RequestDate>='".$dateFrom."' AND RequestDate<='".$dateTo."' GROUP by DriverID";
$result = $dbT->RunQuery($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$confirmR_arr[$row['DriverID']]=$row['countCD'];
}
$sql="SELECT DriverID,count(*) as countCD from v4_OrderRequests WHERE ConfirmDecline=2 AND RequestDate>='".$dateFrom."' AND RequestDate<='".$dateTo."' GROUP by DriverID";
$result = $dbT->RunQuery($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$declineR_arr[$row['DriverID']]=$row['countCD'];
}
$sql="SELECT DriverID,count(*) as countCE from v4_OrderDetails WHERE TransferStatus not in (3,9) and DriverConfStatus=7 AND OrderDate>='".$dateFrom."' AND OrderDate<='".$dateTo."' GROUP by DriverID";
$result = $dbT->RunQuery($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$completeT_arr[$row['DriverID']]=$row['countCE'];
}
$sql="SELECT DriverID,count(*) as countCE from v4_OrderDetails WHERE TransferStatus not in (3,9) and DriverConfStatus=6 AND OrderDate>='".$dateFrom."' AND OrderDate<='".$dateTo."' GROUP by DriverID";
$result = $dbT->RunQuery($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$errorT_arr[$row['DriverID']]=$row['countCE'];
}
	
$dbTotalRecords = $db->getKeysBy($ItemName . $sortOrder, '',$DB_Where);
# test za LIMIT - trebalo bi ga iskoristiti za pagination! 'asc' . ' LIMIT 0,50'
$dbk = $db->getKeysBy($ItemName . $sortOrder, '' . $limit , $DB_Where);

if (count($dbk) != 0) {
    foreach ($dbk as $nn => $key)
    {
    	$db->getRow($key);
		// ako treba neki lookup, onda to ovdje
		# get all fields and values
		$detailFlds = $db->fieldValues();
		if ($detailFlds["DBImage"]<>'') $detailFlds["DBImage"]='1';
		else $detailFlds["DBImage"]='';
		// ako postoji neko custom polje, onda to ovdje.
		// npr. $detailFlds["AuthLevelName"] = $nekaDrugaDB->getAuthLevelName().' nesto';
		
		if (array_key_exists($key, $confirm_arr)) $confirm=$confirm_arr[$key];
		else $confirm=0;
		if (array_key_exists($key, $decline_arr)) $decline=$decline_arr[$key];
		else $decline=0;
		$uk=$confirm+$decline;
		$proc=number_format($confirm*100/$uk,2);
		if ($uk>0) $detailFlds["ConfirmDecline"] = $proc." (".$confirm."/".$uk.")";
		else $detailFlds["ConfirmDecline"] = ""; 		
		if (array_key_exists($key, $confirmR_arr)) $confirmR=$confirmR_arr[$key];
		else $confirmR=0;
		if (array_key_exists($key, $declineR_arr)) $declineR=$declineR_arr[$key];
		else $declineR=0;
		$ukR=$confirmR+$declineR;
		$procR=number_format($confirmR*100/$ukR,2);
		if ($ukR>0) $detailFlds["ConfirmDeclineR"] = $procR." (".$confirmR."/".$ukR.")";
		else $detailFlds["ConfirmDeclineR"] = ""; 
		if (array_key_exists($key, $completeT_arr)) $completeT=$completeT_arr[$key];
		else $completeT=0;
		if (array_key_exists($key, $errorT_arr)) $errorT=$errorT_arr[$key];
		else $errorT=0;
		$ukT=$completeT+$errorT;
		$procT=number_format($completeT*100/$ukT,2);
		if ($ukT>0) $detailFlds["CompleteError"] = $procT." (".$completeT."/".$ukT.")";
		else $detailFlds["ConfirmDeclineR"] = ""; 		
		$out[] = $detailFlds;    	
    }
}
# send output back
$output = array(
'recordsTotal' => count($dbTotalRecords),
'data' =>$out
);
echo $_GET['callback'] . '(' . json_encode($output) . ')';	

