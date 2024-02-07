<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

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

if(empty($sortOrder)) $sortOrder = 'DESC';


# init vars
$out = array();
$flds = array();

# kombinacija where i filtera
$DB_Where = " " . $_REQUEST['where']." AND datetime3<>''";
$DB_Where .= $filter;
if (in_array($_SESSION['BrandName'],array('EN','FR','RU','DE'))) $DB_Where .= " AND `Language` = '".strtolower($_SESSION['BrandName'])."'";

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
$dbkA = $db->getKeysBy($ItemName . $sortOrder, '',$DB_Where);
# test za LIMIT - trebalo bi ga iskoristiti za pagination! 'asc' . ' LIMIT 0,50'
$dbk = $db->getKeysBy($ItemName . $sortOrder, '' . $limit , $DB_Where);

if (count($dbkA) != 0) {
    foreach ($dbkA as $nn => $key)
    {
    	$db->getRow($key);
		// ako treba neki lookup, onda to ovdje
		if ($db->getAvans()==0 and $db->getMonriID()>0) {
			$whereM= " WHERE MCardNumber=".$db->getOrderNumber();	
			$omk = $om->getKeysBy("MOrderID ASC", "" , $whereM);
			$om->getRow($omk[0]);
			$OrderID=$om->getMOrderID();
			$whereD= " WHERE OrderID=".$om->getMOrderID();
			$odk = $od->getKeysBy("OrderID ASC", "" , $whereD);
			if (count($odk)>0) {
				$od->getRow($odk[0]);	
				$orderM=(explode("-",$od->getOrderDate()))[1];
				$pickupM=(explode("-",$od->getPickupDate()))[1];
				if ($orderM==$pickupM) $db->setAvans(2);
				else $db->setAvans(1);
				$db->setPickupDate($od->getPickupDate());
				$db->setOrderID($OrderID);
				$db->setEU(isEU($od->getPickupID(),$od->getDropID(),$pl));
				$db->saveRow();	
				if (count($odk)==2) {
					$od->getRow($odk[1]);		
					$orderM=(explode("-",$od->getOrderDate()))[1];
					$pickupM=(explode("-",$od->getPickupDate()))[1];	
					if ($orderM<>$pickupM && $db->getAvans()==2)	{
						$db->setAmount($db->getAmount()/2);
						$db->saveRow(); 							
						foreach ($db->fieldValues() as $key=>$fv) {
							eval("\$db->set".$key."(\$fv);");		
						}
						$k=$db->saveAsNew();
						$dbN = new v4_OnlinePayments();					
						$dbN->getRow($k);
						$dbN->setAvans(1);
						$dbN->setPickupDate($od->getPickupDate());
						$dbN->setOrderID($OrderID);
						$dbN->saveRow(); 
					}	
				}
			}	
		}	  	
    }
}

if (count($dbk) != 0) {
    foreach ($dbk as $nn => $key)
    {
    	$db->getRow($key);
		// ako treba neki lookup, onda to ovdje
		# get all fields and values
		$detailFlds = $db->fieldValues();
		if ($detailFlds["Avans"]==1) $detailFlds["Avans"]="Avans";
		else $detailFlds["Avans"]="";		
		if ($detailFlds["EU"]==1) $detailFlds["EU"]="EU";
		else $detailFlds["EU"]="";
		// ako postoji neko custom polje, onda to ovdje.
		// npr. $detailFlds["AuthLevelName"] = $nekaDrugaDB->getAuthLevelName().' nesto';
		$out[] = $detailFlds;    	
    }
}
function isEU($PickupID,$DropID,$pl) {
	$pl->getRow($PickupID);
	$cID1=$pl->getPlaceCountry();
	$pl->getRow($DropID);
	$cID2=$pl->getPlaceCountry();	
	$arrayEU=array(55,14,21,35,57,58,59,69,71,72,74,75,76,77,81,83,84,86,96,101,104,115,121,122,130,131,138,148,149,150,167,168,169,172,177,186,187,192,204,227);
	if (in_array($cID1,$arrayEU) || in_array($cID2,$arrayEU)) return 1;
	else return 0;
}	

# send output back
$output = array(
'recordsTotal' => count($dbTotalRecords),
'data' =>$out
);
echo $_GET['callback'] . '(' . json_encode($output) . ')';	