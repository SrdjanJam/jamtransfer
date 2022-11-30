<?

// Timetable sa prikazom transfera po vozacima za odabrani datum
// za svakog vozaca za odabran datum su izlistani transferi u stupcima (poput kalendarskog prikaza na dashboardu)
// POSTUPAK:
// - dobavi sve transfere za odabrani datum
// - dobavi sve vozace koji su vec postavljeni za te transfere (ovo bi moglo biti bez rezultata)
// - za svakog vozaca za odabrani datum ponovno dobavi (samo njegove) transfere
// - vozace izlistati u stupcima, njihove transfere u redovima unutar stupaca -

//if (!isset($DateFrom)) $DateFrom = date("Y-m-d");
if (!isset($DateFrom)) $DateFrom = "2022-09-04";
else $DateFrom	= $_POST["DateFrom"];
//if (!isset($DateTo)) $DateTo = date("Y-m-d");
if (!isset($DateTo)) $DateTo = "2022-09-04";
else $DateTo		= $_POST["DateTo"];
if (!isset($NoColumns)) $NoColumns = 3;
else $NoColumns	= $_POST["NoColumns"];
$smarty->assign("DateFrom",$DateFrom);
$smarty->assign("DateTo",$DateTo);
$smarty->assign("NoColumns",$NoColumns);

require_once ROOT . '/db/v4_AuthUsers.class.php';

$au = new v4_AuthUsers();

require_once ROOT . '/db/db.class.php';
require_once ROOT . '/db/v4_OrdersMaster.class.php';
require_once ROOT . '/db/v4_OrderDetails.class.php';	
require_once ROOT . '/db/v4_OrderExtras.class.php';
require_once ROOT . '/db/v4_Places.class.php';
require_once ROOT . '/db/v4_Routes.class.php';
require_once ROOT . '/db/v4_OrderLog.class.php';

$db = new DataBaseMysql();
$om = new v4_OrdersMaster();
$od = new v4_OrderDetails();
$d2 = new v4_OrderDetails();
$oe = new v4_OrderExtras();
$op = new v4_Places();
$or = new v4_Routes();
$ol = new v4_OrderLog();

$BsColumnWidth = 12 / $NoColumns;
$smarty->assign("BsColumnWidth",$BsColumnWidth);


# Pretvaranje formata datuma
function YMD_to_DMY ($date) {
	$elementi = explode ('-', $date);
	$new_date = $elementi[2] . '.' . $elementi[1] . '.' . $elementi[0];
	return $new_date;
}

function getOtherTransferID ($DetailsID) {
	$otherDetailsID = null;
	$d1 = new v4_OrderDetails();
	$d2 = new v4_OrderDetails();
	$d1->getRow($DetailsID);
	$MOrderID = $d1->getOrderID();
	$ArrayDetailID = $d2->getKeysBy('DetailsID', 'ASC', 'WHERE OrderID = '.$MOrderID);

	if (count($ArrayDetailID) == 2) {
		if ($DetailsID == $ArrayDetailID[0]) {
			$otherDetailsID = $ArrayDetailID[1];
		}
		else if ($DetailsID == $ArrayDetailID[1]) {
			$otherDetailsID = $ArrayDetailID[0];
		}
	}
	return $otherDetailsID;
}

function getOtherTransferIDArray ($DetailsID,$details) {
	$key = array_search($DetailsID, array_column($details, 'DetailsID'));
	$oid=$details[$key]['OrderID'];
	$keys = array_keys(array_column($details, 'OrderID'),$oid);
	$otherDetailsID=null;
	if (count($keys) == 2) {
		if ($DetailsID == $details[$keys[0]]['DetailsID']) {
			$otherDetailsID=$details[$keys[1]]['DetailsID'];
		}
		else if ($DetailsID == $details[$keys[1]]['DetailsID']) {
			$otherDetailsID=$details[$keys[0]]['DetailsID'];
		}		
	}	
	return $otherDetailsID;
}

# hidden polja
function hiddenField($name,$value) {
	echo '<input name="'.$name.'" id="'.$name.'" type="hidden" value="'.$value.'" />';
}

function query_to_csv($db_conn, $query, $filename, $attachment = false, $headers = true) {
	if($attachment) {
		// send response headers to the browser
		header( 'Content-Type: text/csv' );
		header( 'Content-Disposition: attachment;filename='.$filename);
		$fp = fopen('php://output', 'w');
	} else {
		$fp = fopen($filename, 'w');
	}

	$result = mysql_query($query, $db_conn) or die( mysql_error( $db_conn ) );

	if($headers) {
		// output header row (if at least one row exists)
		$row = mysql_fetch_assoc($result);
		if($row) {
		    fputcsv($fp, array_keys($row));
		    // reset pointer back to beginning
		    mysql_data_seek($result, 0);
		}
	}

	while($row = mysql_fetch_assoc($result)) {
		fputcsv($fp, $row);
	}

	fclose($fp);
}
// dobavi sve transfere za odabrani datum za trenutnog vlasnika timetable-a
$q = "
SELECT DetailsID, SubDriver, SubDriver2, SubDriver3 
	FROM v4_OrderDetails 
	WHERE 
		DriverID = " . $_SESSION['UseDriverID'] . " 
		AND PickupDate >= '" . $DateFrom . "' 
		AND PickupDate <= '" . $DateTo . "' 
		AND TransferStatus < '6' 
		AND TransferStatus != '4' 
		AND DriverConfStatus != '3' 
	ORDER BY DetailsID ASC";
$r = $db->RunQuery($q);
$subDArray = array();
while ($t = $r->fetch_object()) {
	if ($t->SubDriver != 0) $subDArray[] = $t->SubDriver;
	if ($t->SubDriver2 != 0) $subDArray[] = $t->SubDriver2;
	if ($t->SubDriver3 != 0) $subDArray[] = $t->SubDriver3;
	$ordersArray[]=(array) $t;
}
$subDArray = array_unique($subDArray); // ostavi samo jedinstvene subdrivere u nizu
$sdd="";
foreach ($subDArray as $sd) {
	$sdd.=$sd.",";
}
$sdd = substr($sdd,0,strlen($sdd)-1);

// dobavi vozace od trenutnog vlasnika timetable-a, slozi ih u sdArray sa podacima
$q = "SELECT * FROM v4_AuthUsers";
$q .= " WHERE AuthUserID in (".$sdd.") ORDER BY AuthUserRealName ASC";
$r = $db->RunQuery($q);
$sdArray = array();
while ($d = $r->fetch_object()) {
	$row = array();
    $row['DriverID'] = $d->AuthUserID;
    $row['DriverName'] = $d->AuthUserRealName;
	$row['Active'] = $d->Active;
	$row['Mob'] = $d->AuthUserMob;
    $sdArray[] = $row;
}

$smarty->assign('ordersArray',$ordersArray);
$smarty->assign('sdArray',$sdArray);


?>

