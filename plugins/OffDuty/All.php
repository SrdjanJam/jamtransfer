<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

@session_start();
require_once ROOT . '/db/v4_Vehicles.class.php';
require_once ROOT . '/db/v4_VehicleTypes.class.php';
# init class
$v = new v4_Vehicles();
$vt = new v4_VehicleTypes();

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

//$sortOrder = 'DESC';


# init vars
$out = array();
$flds = array();

# kombinacija where i filtera
$DB_Where = " " . $_REQUEST['where'];
$DB_Where .= $filter;

#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'ID', // dodaj ostala polja!
    'StartDate'
);
if (isset($_REQUEST['vehicleID']) && $_REQUEST['vehicleID']>0) $DB_Where .= " AND VehicleID=".$_REQUEST['vehicleID'];
$DB_Where .= " AND OwnerID=".$_SESSION['UseDriverID'];
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
if (isset($_REQUEST['vehicleID']) && $_REQUEST['vehicleID']>0) {
	$db->getRow(0);	
	$detailFlds = $db->fieldValues();
	$v->getRow( $_REQUEST['vehicleID'] );
	$vt->getRow($v->getVehicleTypeID() );
	$detailFlds["VehicleName"] = $vt->getVehicleTypeName();
	$detailFlds["VehicleID"] = $_REQUEST['vehicleID'];	
	$out[] = $detailFlds; 
}	

# test za LIMIT - trebalo bi ga iskoristiti za pagination! 'asc' . ' LIMIT 0,50'
$dbk = $db->getKeysBy($ItemName, '' . $limit , $DB_Where);

if (count($dbk) != 0) {
   
    foreach ($dbk as $nn => $key)
    {
    	
    	$db->getRow($key);
		
		// ako treba neki lookup, onda to ovdje
		$find=$v->getRow($db->getVehicleID());
		if (gettype($v->getRow($db->getVehicleID()))=='NULL') {
			$vt->getRow($v->getVehicleTypeID() );
			# get all fields and values
			$detailFlds = $db->fieldValues();
			// ako postoji neko custom polje, onda to ovdje.
			$detailFlds["VehicleName"] = $vt->getVehicleTypeName();
			$out[] = $detailFlds;  
		}
    }
}


# send output back
$output = array(
'recordsTotal' => count($dbTotalRecords),
'data' =>$out
);

echo $_GET['callback'] . '(' . json_encode($output) . ')';
	
