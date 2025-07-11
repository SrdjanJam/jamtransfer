<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

@session_start();

# sastavi filter - posalji ga $_REQUEST-om
if (isset($type)) {
	if (!isset($_REQUEST['Type']) or $_REQUEST['Type'] == 0) {
		$filter .= "  AND ".$type." != 0 ";
	}
	else {
		$filter .= "  AND ".$type." = " . $_REQUEST['Type'] ;
	}
}
if (isset($selectactive)) {
	if (!isset($_REQUEST['Active']) or $_REQUEST['Active'] == 99) {
		$filter .= "  AND ".$selectactive." > -1 ";
	}
	else {
		$filter .= "  AND ".$selectactive." = " . $_REQUEST['Active'] ;
	}
}
if (isset($_REQUEST['userID']) && $_REQUEST['userID']>0) $filter .= " AND AuthUserID=".$_REQUEST['userID'];

if (isset($_SESSION['UseDriverID']) && $_SESSION['UseDriverID']>0) 
	$filter .= "  AND ((DriverID = " . $_SESSION['UseDriverID'] ." AND AuthLevelID=32) OR
				 (AuthUserID =" . $_SESSION['UseDriverID'] ." AND AuthLevelID=31))";
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
if (isset($_REQUEST['actionID']) && $_REQUEST['actionID']=="NT") {
	$DB_Where .= " AND AuthUserID not in (SELECT DriverID FROM v4_DriverTerminals)";
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
		if ($detailFlds["DBImage"]<>'') $detailFlds["DBImage"]='1';
		else $detailFlds["DBImage"]='';
		// ako postoji neko custom polje, onda to ovdje.
		// npr. $detailFlds["AuthLevelName"] = $nekaDrugaDB->getAuthLevelName().' nesto';
		
		// Leave one email:
		$email = $detailFlds["AuthUserMail"];
		$email = explode(" ",$email);
		$detailFlds["AuthUserMail"] = $email[0];
		$detailFlds["AuthUserMail"] = str_replace(","," ",$detailFlds["AuthUserMail"]);

		$out[] = $detailFlds;    	
    }
}
# send output back
$output = array(
'recordsTotal' => count($dbTotalRecords),
'data' =>$out
);
echo $_GET['callback'] . '(' . json_encode($output) . ')';	