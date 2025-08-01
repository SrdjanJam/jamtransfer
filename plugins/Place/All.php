<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

@session_start();

# sastavi filter - posalji ga $_REQUEST-om
if (isset($type)) {
	if (!isset($_REQUEST['Type']) or $_REQUEST['Type'] == 0 or $_REQUEST['Type'] == 99) {
		$filter = "  AND ".$type." != 0 ";
	}
	else if($_REQUEST['Type'] == -1 ) {
		$filter = "  AND ".$type." = 0";
	}
	else {
		$filter = "  AND ".$type." = '" . $_REQUEST['Type'] . "'";
	}
}


$page 		= (int) $_REQUEST['page'];
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

if ($_REQUEST['Type']==99) {
	$sql="SELECT TerminalID FROM `v4_Terminals`";	
	$result = $dbT->RunQuery($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$terminals_arr.=$row['TerminalID'].",";
	}
	$terminals_arr = substr($terminals_arr,0,strlen($terminals_arr)-1);	
	$DB_Where .= " AND PlaceID in (".$terminals_arr.")";
}
if (isset($_REQUEST['exclude']) && $_REQUEST['exclude']=="NT") {
	$DB_Where .= " AND (Longitude=0 OR Latitude=0)";
	$DB_Where .= " AND (`PlaceID` in (SELECT `FromID` FROM `v4_Routes`) OR `PlaceID` in (SELECT `ToID` FROM `v4_Routes` WHERE Approved=1))";
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

	