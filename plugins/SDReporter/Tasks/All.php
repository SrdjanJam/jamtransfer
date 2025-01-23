<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);

require_once 'Initial.php';

@session_start();

if (isset($selectapproved)) {
	if (!isset($_REQUEST['Approved']) or $_REQUEST['Approved'] == 99) {
		$filter .= "  AND ".$selectapproved." > -1 ";
	}
	else {
		$filter .= "  AND ".$selectapproved." = " . $_REQUEST['Approved'] ;
	}
}


class v4_SubActivityJoin extends v4_SubActivity {
	public function getKeysBy($column, $order, $where = NULL){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("
			SELECT v4_SubActivity.ID, v4_AuthUsers.AuthUserRealName FROM v4_SubActivity 
			LEFT JOIN v4_AuthUsers ON v4_SubActivity.DriverID = v4_AuthUsers.AuthUserID 
			$where AND v4_SubActivity.Approved<9 ORDER BY $column $order");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$keys[$i] = $row["ID"];
			$i++;
		}
	return $keys;
	}
}
# init class
$se = new v4_SubActivityJoin();

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
if (isset($_SESSION['UseDriverID']))  $DB_Where .=	" AND OwnerID = '".$_SESSION['UseDriverID']."' ";
if (isset($_REQUEST['vehicleID']) && $_REQUEST['vehicleID']>0) $DB_Where .= " AND VehicleID=".$_REQUEST['vehicleID'];
if (isset($_REQUEST['subdriverID']) && $_REQUEST['subdriverID']>0) $DB_Where .= " AND v4_SubActivity.DriverID=".$_REQUEST['subdriverID'];
if (isset($_REQUEST['actionID']) && $_REQUEST['actionID']>0) $DB_Where .= " AND Expense=".$_REQUEST['actionID'];
if (isset($_REQUEST['orderFromDate']) && $_REQUEST['orderFromDate']>0) $DB_Where .= " AND Datum >='".$_REQUEST['orderFromDate']."'";
if (isset($_REQUEST['orderToDate']) && $_REQUEST['orderToDate']>0) $DB_Where .= " AND Datum <='".$_REQUEST['orderToDate']."'";

#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'ID',
	'AuthUserRealName',
	'Expense',
    'Note',
    'Datum'
);

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



// 2017-02-13 za pretrazivanje po imenu vozaca potrebno je napraviti join -R
$DB_Where = "LEFT JOIN v4_AuthUsers ON v4_SubActivity.DriverID = v4_AuthUsers.AuthUserID" . $DB_Where;

$dbTotalRecords = $db->getKeysBy('ID ASC', '',$DB_Where);

# test za LIMIT - trebalo bi ga iskoristiti za pagination! 'asc' . ' LIMIT 0,50'
$dbk = $db->getKeysBy('ID ' . $sortOrder, '' . $limit , $DB_Where);

//select za nazive vozila
$sql="SELECT * FROM `v4_SubVehicles` WHERE `OwnerID`=".$_SESSION["OwnerID"]." and `Active`=1";



$query=mysqli_query($dbf->conn, $sql) or die('Error in RequestCheckList query' . mysqli_connect_error());
while($list = mysqli_fetch_object($query) ) {
	$vehiclesnames[$list->VehicleID]=$list->VehicleDescription;	
}	


if (count($dbk) != 0) {
    foreach ($dbk as $nn => $key)  
    {	
    	$db->getRow($key);

		// ako treba neki lookup, onda to ovdje
		
		# get all fields and values
		$detailFlds = $db->fieldValues();
		
		// ako postoji neko custom polje, onda to ovdje.
		// npr. $detailFlds["AuthLevelName"] = $nekaDrugaDB->getAuthLevelName().' nesto';
		$detailFlds["AuthUserRealName"] = $users[$db->getDriverID()]->AuthUserRealName;
		$ac->getRow($db->getExpense());
		$detailFlds["ExpanceTitle"] = $ac->getTitle();
		$detailFlds["VehicleDescription"] = $vehiclesnames[$db->VehicleID];

		$out[] = $detailFlds;
    }
}

# send output back
$output = array(
'recordsTotal' => count($dbTotalRecords),
'data' =>$out
);

echo $_GET['callback'] . '(' . json_encode($output) . ')';

