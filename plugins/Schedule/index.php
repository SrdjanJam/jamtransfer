<?

// Timetable sa prikazom transfera po vozacima za odabrani datum

if (!isset($DateFrom)) $DateFrom = "2022-09-04";
else $DateFrom	= $_POST["DateFrom"];
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

// promjena pickup time
$whereL = " WHERE Description LIKE '%PickupTime%'";
$olKeys = $ol->getKeysBy('ID', 'DESC', $whereL);
foreach ($olKeys as $olid) {
	$ol->getRow($olid);	
	$olKeys2[]=$ol->getDetailsID();
	}

// dobavi sve transfere za odabrani datum za trenutnog vlasnika timetable-a
$q = "
SELECT *
	FROM v4_OrderDetails, v4_OrdersMaster, v4_AuthUsers 
	WHERE 
		v4_OrderDetails.DriverID = " . $_SESSION['UseDriverID'] . " 
		AND PickupDate >= '" . $DateFrom . "' 
		AND PickupDate <= '" . $DateTo . "' 
		AND TransferStatus < '6' 
		AND TransferStatus != '4' 
		AND DriverConfStatus != '3' 
		AND AuthUserID=UserID
		AND MorderID=OrderID
	ORDER BY DetailsID ASC";
$r = $db->RunQuery($q);
$subDArray = array();
while ($t = $r->fetch_object()) {
	//niz vozaca koji imaju transfere u zadatom vremenu
	if ($t->SubDriver != 0) $subDArray[] = $t->SubDriver;
	if ($t->SubDriver2 != 0) $subDArray[] = $t->SubDriver2;
	if ($t->SubDriver3 != 0) $subDArray[] = $t->SubDriver3;
	
	// da li flight time u datumskom konfliktu sa pickuptime ili droptime
	$t->flightTimeConflict=false;
	if (abs($t->SubPickupTime-$t->FlightTime)>12) $t->flightTimeConflict=true;
	// da li je bilo promene pickup time
	$changedIcon = '';
	$t->color= '';
	$t->color2= '';
	if (in_array($t->DetailsID,$olKeys2)) {
		$t->changedIcon = '<i class="fa fa-circle text-red"></i>';
		$t->color='red';
	}	
	if ($t->SubPickupTime==$t->PickupTime) $color2='';
	else $t->color2='red';
	$t->carColor = 'text-lightgrey';
	// naziv tipa vozila	
	$t->VehicleTypeName = $t->VehicleType;
	if($t->VehicleType >= 100 and $t->VehicleType < 200) {
		$t->carColor = 'text-green white';
		$t->VehicleTypeName = 'P'.($t->VehicleType - 100);
	}
	if($t->VehicleType >= 200) {
		$t->carColor = 'text-red white';
		$t->VehicleTypeName = 'FC'.($t->VehicleType - 200);
	}
	// rjesenje problema kad su SubPickupDate ili SubPickupTime prazni
	if($t->SubPickupDate == '0000-00-00') $t->SubPickupDate=$t->PickupDate ;
	if($t->SubPickupTime == '') $t->SubPickupTime=$t->PickupTime ;
	if(!empty($t->RouteID) && empty($t->TransferDuration) ) {
		$or->getRow($t->RouteID);
		$t->TransferDuration=$or->getDuration();
	}	
	// dohvacanje extra usluga
	$t->extras = '';
	$oeArray = $oe->getKeysBy('OrderDetailsID', 'ASC', 'WHERE OrderDetailsID = '.$t->DetailsID);

	foreach ($oeArray as $val => $ID) {
		$oe->getRow($ID);
		$t->extras .= $oe->getServiceName();
		$t->extras .= '<br>';
	}
	
	$order_row=(array) $t;
		
	$ordersArray[]=$order_row;
}
$subDArray = array_unique($subDArray); // ostavi samo jedinstvene subdrivere u nizu
$sdd="";
foreach ($subDArray as $sd) {
	$sdd.=$sd.",";
}
$sdd = substr($sdd,0,strlen($sdd)-1);

// dobavi vozace od trenutnog vlasnika timetable-a, slozi ih u sdArray sa podacima
$q = "SELECT * FROM v4_AuthUsers";
$q .= "	WHERE DriverID = " . $_SESSION['UseDriverID']; 
//$q .= " WHERE AuthUserID in (".$sdd.") ORDER BY AuthUserRealName ASC";
$r = $db->RunQuery($q);
$sdArray = array();
$sddArray = array();
while ($d = $r->fetch_object()) {
	if (in_array($d->AuthUserID,$subDArray)) {
		$row = array();
		$row['DriverID'] = $d->AuthUserID;
		$row['DriverName'] = $d->AuthUserRealName;
		$row['Active'] = $d->Active;
		$row['Mob'] = $d->AuthUserMob;
		$sdArray[] = $row;
	}	
	if ($d->Active==1) {
		$row = array();
		$row['DriverID'] = $d->AuthUserID;
		$row['DriverName'] = $d->AuthUserRealName;
		$sddArray[] = $row;
	}
}

$smarty->assign('ordersArray',$ordersArray);
$smarty->assign('sdArray',$sdArray);
$smarty->assign('sddArray',$sddArray);


?>

