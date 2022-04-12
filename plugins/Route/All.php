<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';
require_once ROOT . '/db/v4_DriverRoutes.class.php';
$dbC = new v4_DriverRoutes();

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

if (isset($_SESSION['UseDriverID'])) {
	$sql="SELECT RouteID FROM `v4_DriverTerminals`,v4_RoutesTerminals WHERE `DriverID`=".$_SESSION['UseDriverID']." and v4_DriverTerminals.TerminalID=v4_RoutesTerminals.TerminalID";	
	$result = $dbT->RunQuery($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$routes_arr.=$row['RouteID'].",";
	}
	$routes_arr = substr($routes_arr,0,strlen($routes_arr)-1);	
	$DB_Where .= " AND RouteID in (".$routes_arr.")";
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
		// ako treba neki lookup, onda to ovdje
		# get all fields and values
		$detailFlds = $db->fieldValues();
		$detailFlds['driver']='';
		$detailFlds['check']=-1;		
		if (isset($_SESSION['UseDriverID']) && $_SESSION['UseDriverID']>0) {
			$id=$db->getRouteID();
			$keys=$dbC->getKeysBy('ID', '', ' WHERE RouteID='.$id.' AND OwnerID='.$_SESSION['UseDriverID']);		
			if (count($keys)>0) {
				$detailFlds['driver']=$_SESSION['UseDriverName'];
				$detailFlds['check']=1;
				$dbC->getRow($keys[0]);
				$cid=$dbC->getID();
				$driverlink='driverRoutes/'.$cid;
				$detailFlds['driverlink']=$driverlink;
			}	
			else {
				$detailFlds['driver']='*';
				$detailFlds['check']=0;
				$detailFlds['driverlink']='driverRoutes/connect/'.$id;
			}	
		}
		// ako postoji neko custom polje, onda to ovdje.
		// npr. $detailFlds["AuthLevelName"] = $nekaDrugaDB->getAuthLevelName().' nesto';
		$out[] = $detailFlds;    	
    }
}
# send output back
$output = array(
'recordsTotal' => count($dbTotalRecords),
'data' =>$out
);
echo $_GET['callback'] . '(' . json_encode($output) . ')';	