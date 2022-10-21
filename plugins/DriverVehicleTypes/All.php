<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
require_once ROOT . '/db/v4_Vehicles.class.php';
$dbC = new v4_Vehicles();

@session_start();

# sastavi filter - posalji ga $_REQUEST-om
if (isset($type)) {
	if (!isset($_REQUEST['Type']) or $_REQUEST['Type'] == 0) {
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
else $limit = '';

if(empty($sortOrder)) $sortOrder = 'ASC';


# init vars
$out = array();
$flds = array();

# kombinacija where i filtera
$DB_Where = " " . $_REQUEST['where'];
$DB_Where .= $filter;

	if ($_REQUEST['Type']>0) {
		$sql="SELECT VehicleTypeID FROM `v4_Vehicles` WHERE `OwnerID`=".$_SESSION['UseDriverID'];					
		$result = $dbT->RunQuery($sql);
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$vehicles .= $row['VehicleTypeID'].",";
		}
		$vehicles = substr($vehicles,0,strlen($vehicles)-1);	
	
		if ($_REQUEST['Type']==1) $DB_Where .= " AND VehicleTypeID in (".$vehicles.")";
		else $DB_Where .= " AND VehicleTypeID not in (".$vehicles.")";
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
$dbTotalRecords = $db->getKeysBy($ItemName . $sortOrder, '',$DB_Where);
# test za LIMIT - trebalo bi ga iskoristiti za pagination! 'asc' . ' LIMIT 0,50'
$dbk = $db->getKeysBy($ItemName . $sortOrder, '' . $limit , $DB_Where);

if (count($dbk) != 0) {
    foreach ($dbk as $nn => $key)
    {
    	$db->getRow($key);
		$detailFlds = $db->fieldValues();
		$detailFlds["DriverVehicle"]=0;
		$detailFlds["PriceRules"]=1;
		$detailFlds["PriceRules2"]=0;
		$result = $dbT->RunQuery("SELECT * FROM v4_Vehicles WHERE VehicleTypeID=".$key." AND OwnerID=".$_SESSION['UseDriverID']);
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$detailFlds["DriverVehicle"]=1;
				$detailFlds["PriceRules"]=$row['SurCategory'];
				$detailFlds["PriceRules2"]=$row['SurCategory'];
			}			
		$out[] = $detailFlds;  
    }
}
# send output back
$output = array(
'recordsTotal' => count($dbTotalRecords),
'data' =>$out
);
echo $_GET['callback'] . '(' . json_encode($output) . ')';	