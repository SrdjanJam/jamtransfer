<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

@session_start();

# sastavi filter - posalji ga $_REQUEST-om
# sastavi filter prema Active
if (isset($_REQUEST['active']) and $_REQUEST['active'] == 1) {
	$filter .= "  AND Active = '1' "; 
}
else if (isset($_REQUEST['active']) and $_REQUEST['active'] == 0) {
	$filter .= "  AND Active = '0' "; 
}
else if (isset($_REQUEST['active']) and $_REQUEST['active'] == 2) {
	$filter .= "  AND Active = '2' "; 
}
else if (isset($_REQUEST['active']) and $_REQUEST['active'] == 3) {
	$filter .= "  AND Active = '3' "; 
}
else if (isset($_REQUEST['active']) and $_REQUEST['active'] == '99') {
	$filter .= "  AND ( Active > '0') "; 
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


$dbTotalRecords = $db->getKeysBy('ID ASC', '',$DB_Where);
// prazan red za eventualni unos
	$db->getRow(0);	
	$detailFlds = $db->fieldValues();
	$out[] = $detailFlds; 
# test za LIMIT - trebalo bi ga iskoristiti za pagination! 'asc' . ' LIMIT 0,50'
$dbk = $db->getKeysBy('DisplayOrder ' . $sortOrder, '' . $limit , $DB_Where);

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