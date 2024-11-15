<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);

require_once 'Initial.php';

@session_start();


#********************************************
# ulazni parametri su where, status i search
#********************************************

# sastavi filter - posalji ga $_REQUEST-om


$page 		= $_REQUEST['page'];
$length 	= $_REQUEST['length'];
$sortOrder 	= $_REQUEST['sortOrder'];

$start = ($page * $length) - $length;

if ($length > 0) {
	$limit = ' LIMIT '. $start . ','. $length;
}
else $limit = '';

if(empty($sortOrder)) $sortOrder = 'ASC';


# init vars
$out = array();
$flds = array();
# kombinacija where i filtera
$DB_Where = " " . $_REQUEST['where'];
$DB_Where .= $filter;


if (isset($_REQUEST['orderFromDate']) && $_REQUEST['orderFromDate']>0) $DB_Where .= " AND AssignTime>='".$_REQUEST['orderFromDate']."'";
if (isset($_REQUEST['orderToDate']) && $_REQUEST['orderToDate']>0) $DB_Where .= " AND AssignTime<='".$_REQUEST['orderToDate']."'";
if (isset ($_REQUEST['subdriverID']) && $_REQUEST['subdriverID']>0) $DB_Where .= " AND AssignSDID=".$_REQUEST['subdriverID'];
if (isset($_SESSION['UseDriverID']) && $_SESSION['UseDriverID']>0) {
	$auk = $au->getKeysBy('AuthUserID', '', " WHERE DriverID=".$_SESSION['UseDriverID']);
	$subdrivers="99999";
	if (count($auk)>0) $subdrivers.= implode(', ', $auk);
	$DB_Where .= " AND AssignSDID in (".$subdrivers.") ";
}

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
$dbTotalRecords = $db->getKeysBy($ItemName.' ASC', '',$DB_Where);

$dlm = ";";
$header='VID'.$dlm.'Name'.$dlm.'Vehicle'.$dlm.'Date&Time'.$dlm. 'Status'.$dlm."\n";

$table_row="";


# test za LIMIT - trebalo bi ga iskoristiti za pagination! 'asc' . ' LIMIT 0,50'
$dbk = $db->getKeysBy($ItemName.' ' . $sortOrder, '' . $limit , $DB_Where);
if (count($dbk) != 0) {
    foreach ($dbk as $nn => $key)  
    {	
    	$db->getRow($key);
		// ako treba neki lookup, onda to ovdje	
		# get all fields and values
		$detailFlds = $db->fieldValues();
		$sv->getRow($db->getVehicleID());
		$detailFlds["VehicleName"]=$sv->getVehicleDescription();		
		$au->getRow($db->getAssignSDID());
		$detailFlds["SubDriverName"]=$au->getAuthUserRealName();
		if ($db->getStatus()==0) $detailFlds["Status"]=UNASSIGN;
		else $detailFlds["Status"]=ASSIGN;
		$out[] = $detailFlds;
		$table_row.=$detailFlds["ID"]. $dlm. 
				$detailFlds["SubDriverName"] . $dlm .
				$detailFlds["VehicleName"] . $dlm .
				$detailFlds["AssignTime"] . $dlm . 
				$detailFlds["Status"] .  $dlm .
				"\n";	
    }
}
$dbk = $db->getKeysBy($ItemName.' ' . $sortOrder, '' , $DB_Where);
if (count($dbk) != 0) {
    foreach ($dbk as $nn => $key)  
    {	
    	$db->getRow($key);
		// ako treba neki lookup, onda to ovdje	
		# get all fields and values
		$detailFlds = $db->fieldValues();
		$sv->getRow($db->getVehicleID());
		$detailFlds["VehicleName"]=$sv->getVehicleDescription();		
		$au->getRow($db->getAssignSDID());
		$detailFlds["SubDriverName"]=$au->getAuthUserRealName();
		if ($db->getStatus()==0) $detailFlds["Status"]=UNASSIGN;
		else $detailFlds["Status"]=ASSIGN;
		$table_row.=$detailFlds["ID"]. $dlm. 
				$detailFlds["SubDriverName"] . $dlm .
				$detailFlds["VehicleName"] . $dlm .
				$detailFlds["AssignTime"] . $dlm . 
				$detailFlds["Status"] .  $dlm .
				"\n";	
    }
}
ob_start(); 
echo $header.$table_row;
$csv = ob_get_contents();
ob_end_clean();
$fp = fopen('VehicleList_'.($_SESSION['UseDriverID']).'.csv', 'w');
fwrite($fp, $csv);
fclose($fp);	

# send output back
$output = array(
'recordsTotal' => count($dbTotalRecords),
'data' =>$out
);

echo $_GET['callback'] . '(' . json_encode($output) . ')';

