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
$driverConfStatus 	= $_REQUEST['driverConfStatus'];
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
$dbWhere .= $filter;

$dbWhere .=	" AND v4_OrderDetails.DriverConfStatus not in (0,1,2,4) AND v4_OrderDetails.SubDriver>0 AND v4_OrderDetails.DriverID = '".$_SESSION['UseDriverID']."' ";
if (isset($_REQUEST['orderFromDate']) && $_REQUEST['orderFromDate']>0) $dbWhere .= " AND PickupDate >='".$_REQUEST['orderFromDate']."'";
if (isset($_REQUEST['orderToDate']) && $_REQUEST['orderToDate']>0) $dbWhere .= " AND PickupDate <='".$_REQUEST['orderToDate']."'";


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


$odTotalRecords = $od->getFullOrderByDetailsID($sortField, $sortDirection, '' , $dbWhere);
	
$dbk = $od->getFullOrderByDetailsID($sortField, $sortDirection, $limit  , $dbWhere);
//$dbWhere .= " GROUP BY SubDriver "; 
//$odSD1 = $od->getFullOrderByDetailsID("SubDriver", $sortDirection, '' , $dbWhere);

/*$subdrivers=array();
foreach ($odTotalRecords as $nn => $key)
{
	$od->getRow($key);  
	$subdrivers[$od->getSubDriver()]+=1;	
	if ($od->getSubDriver2()>0) $subdrivers[$od->getSubDriver2()]+=1;
	if ($od->getSubDriver3()>0) $subdrivers[$od->getSubDriver3()]+=1;
}	
foreach ($subdrivers as $nn => $key) {
	$row['sdid']=$nn;
	$row['not']=$key;
	$sum[]=$row;
}*/
if (count($dbk) != 0) {
    foreach ($dbk as $nn => $key)
    {
    	$od->getRow($key);    	
    	# get fields and values
		$detailFlds = $od->fieldValues();

		$detailFlds['VehicleTypeName'] = $vehicletypes[$od->getVehicleType()]->VehicleTypeName;

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
		$au->getRow($od->getSubDriver());
		$detailFlds["SubDriverName"]=$au->getAuthUserRealName();
		$sv->getRow($od->getCar());
		$detailFlds["Vehicle"]=$sv->getVehicleDescription();
		$detailFlds["VehicleNo"]="1";
		$out[] = $detailFlds; 
		if ($od->getSubDriver2()>0) {
			$au->getRow($od->getSubDriver2());
			$detailFlds["SubDriverName"]=$au->getAuthUserRealName();
			$sv->getRow($od->getCar2());
			$detailFlds["Vehicle"]=$sv->getVehicleDescription();
			$detailFlds["VehicleNo"]="2";
			$out[] = $detailFlds; 
		}		
		if ($od->getSubDriver3()>0) {
			$au->getRow($od->getSubDriver3());
			$detailFlds["SubDriverName"]=$au->getAuthUserRealName();
			$sv->getRow($od->getCar3());
			$detailFlds["Vehicle"]=$sv->getVehicleDescription();
			$detailFlds["VehicleNo"]="3";
			$out[] = $detailFlds; 
		}
    }	
}
	

# send output back
$output = array(
'sum' =>$sum,
'sortField' => $sortField,
'sortDirection' => $sortDirection,
'recordsTotal' => count($odTotalRecords),
'data' =>$out
);
echo $_GET['callback'] . '(' . json_encode($output) . ')';	