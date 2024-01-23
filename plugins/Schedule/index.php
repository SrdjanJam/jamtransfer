<?

// Timetable sa prikazom transfera po vozacima za odabrani datum

if (isset($_REQUEST["ScheduleDate"])) {
	$DateFrom	= $_REQUEST["ScheduleDate"];
	if (isset($_REQUEST["ScheduleDate2"])) $DateTo=$_REQUEST["ScheduleDate2"];
	else $DateTo	= $_REQUEST["ScheduleDate"];
}
else {	
	//if (!isset($_POST["DateFrom"])) $DateFrom = "2022-09-04";
	if (!isset($_POST["DateFrom"])) $DateFrom = date('Y-m-d');
	else $DateFrom	= $_POST["DateFrom"];
	//if (!isset($_POST["DateTo"])) $DateTo = "2022-09-04";
	if (!isset($_POST["DateTo"])) $DateTo = date('Y-m-d');
	else $DateTo		= $_POST["DateTo"];
}
if (!isset($_POST["NoColumns"])) $NoColumns = 3;
else $NoColumns	= $_POST["NoColumns"];
if (!isset($_POST["DriverStatus"])) $DriverStatus = 0;
else $DriverStatus	= $_POST["DriverStatus"];
$smarty->assign("DateFrom",$DateFrom);
$smarty->assign("DateTo",$DateTo);
$smarty->assign("NoColumns",$NoColumns);
$smarty->assign("NoColumnsADD",$NoColumns+1);
$smarty->assign("DriverStatus",$DriverStatus);
if ($DateFrom<=date('Y-m-d') && $DateTo>=date('Y-m-d')) $todayshow='';
else $todayshow='hide';
$smarty->assign("todayshow",$todayshow);


require_once ROOT . '/db/v4_AuthUsers.class.php';

$au = new v4_AuthUsers();

require_once ROOT . '/db/db.class.php';
require_once ROOT . '/db/v4_OrdersMaster.class.php';
require_once ROOT . '/db/v4_OrderDetails.class.php';	
require_once ROOT . '/db/v4_OrderExtras.class.php';
require_once ROOT . '/db/v4_Places.class.php';
require_once ROOT . '/db/v4_Routes.class.php';
require_once ROOT . '/db/v4_OrderLog.class.php';
require_once ROOT . '/db/v4_SubVehicles.class.php';
require_once ROOT . '/db/v4_Notifications.class.php';

$db = new DataBaseMysql();
$om = new v4_OrdersMaster();
$od = new v4_OrderDetails();
$d2 = new v4_OrderDetails();
$oe = new v4_OrderExtras();
$op = new v4_Places();
$or = new v4_Routes();
$ol = new v4_OrderLog();
$sv = new v4_SubVehicles();
$nt = new v4_Notifications();


$ordersArray = array();
$sdArray = array();
$sddArray = array();


$BsColumnWidth = 12 / $NoColumns;
$smarty->assign("BsColumnWidth",$BsColumnWidth);
// Da li je interno
$au->getRow($_SESSION['UseDriverID']);
if($au->ContractFile == 'inter'){
	$inter = true;
}else{
	$inter = false;
}
$smarty->assign("inter",$inter);
// promjena pickup time
$whereL = " WHERE Description LIKE '%PickupTime%'";
$olKeys = $ol->getKeysBy('ID', 'DESC', $whereL);
foreach ($olKeys as $olid) {
	$ol->getRow($olid);	
	$olKeys2[]=$ol->getDetailsID();
	}


// customers by email
$qC = "SELECT `LevelID`,`CustEmail` FROM `v4_Customers`" ;
$rC = $db->RunQuery($qC);
$customers=array();
while ($tC = $rC->fetch_object()) {
	$customers[$tC->CustEmail]=$tC->LevelID;
}


// Svi transferi za hvatanje other transfer
$details=array();
// za proveru return transfer-a
$q2 = "SELECT DetailsID,OrderID FROM v4_OrderDetails ORDER BY DetailsID DESC" ;
$r2 = $db->RunQuery($q2);
while ($t2 = $r2->fetch_object()) {
	$row_array=array();
	$row_array['DetailsID']=$t2->DetailsID; 
	$row_array['OrderID']=$t2->OrderID; 
	
	$details[]=$row_array;
}

// dobavi sve transfere za odabrani datum za trenutnog vlasnika timetable-a
$q = "
SELECT *
	FROM v4_OrderDetails, v4_OrdersMaster, v4_AuthUsers 
	WHERE 
		v4_OrderDetails.DriverID = " . $_SESSION['UseDriverID']; 
$q .= " AND PickupDate >= '" . $DateFrom . "'"; 
$q .= " AND PickupDate <= '" . $DateTo . "'";
$q .= " AND TransferStatus < '6'";
$q .= " AND TransferStatus != '4'"; 
if ($DriverStatus==2) $q .= "	AND DriverConfStatus > 2 ";
if ($DriverStatus==1) $q .= "	AND DriverConfStatus < 3 ";	
if (isset($_REQUEST["subDriverID"])) $q .= " AND PayLater-CashIn<>0 ";
if (isset($_REQUEST["subDriverID"]) && $_REQUEST["subDriverID"]>0) $q .= " AND (SubDriver = ". $_REQUEST["subDriverID"] . " OR SubDriver2=". $_REQUEST["subDriverID"] . " OR SubDriver3=" . $_REQUEST["subDriverID"] .")";
$q .= " AND AuthUserID=UserID ";
$q .= " AND MorderID=OrderID ";
$q .= " ORDER BY PickupDate ASC, PickupTime ASC";
$r = $db->RunQuery($q);
if ($r->num_rows>0) {
	$ordersArray = array();

	// za proveru return transfer-a
	$details=array();
	$q2 = "SELECT DetailsID,OrderID FROM v4_OrderDetails ORDER BY DetailsID DESC" ;
	$r2 = $db->RunQuery($q2);
	while ($t2 = $r2->fetch_object()) {
		$row_array=array();
		$row_array['DetailsID']=$t2->DetailsID; 
		$row_array['OrderID']=$t2->OrderID; 
		$details[]=$row_array;
	}

	$tx=array();
	$nonconect=false;
	while ($t = $r->fetch_object()) {
		if ($t->SubDriver==0) $nonconect=true;
		$tx[] = $t;	
	}

	$subDArray = array();
	if ($nonconect) $subDArray[] = $_SESSION['UseDriverID'];
	$tx=(object) $tx;
	// extrasi
	$ordersdetail="";
	foreach ($tx as $t) {
		$ordersdetail.=$t->DetailsID.",";
	}
	$ordersdetail = substr($ordersdetail,0,strlen($ordersdetail)-1);
	$extras=array();
	$q3 = "SELECT *
		FROM v4_OrderExtras
		WHERE OrderDetailsID in (" . $ordersdetail . ")"; 
	$r3 = $db->RunQuery($q3);
	while ($t3 = $r3->fetch_object()) {
		$extras_row=array();
		$extras_row['DetailID']=$t3->OrderDetailsID;
		$extras_row['ServiceName']=$t3->ServiceName;
		$extras_row['Qty']=$t3->Qty;
		$extras[]=$extras_row;
	}
	// $t
	if (!isset($_REQUEST["subDriverID"])) {	
		foreach ($tx as $t) {
			//niz vozaca koji imaju transfere u zadatom vremenu
			if ($t->SubDriver != 0) $subDArray[] = $t->SubDriver;
			if ($t->SubDriver2 != 0) $subDArray[] = $t->SubDriver2;
			if ($t->SubDriver3 != 0) $subDArray[] = $t->SubDriver3;	
		}
	}
	else $subDArray[]= $_REQUEST["subDriverID"];	

	$subDArray = array_unique($subDArray); // ostavi samo jedinstvene subdrivere u nizu
	$sdd="";
	foreach ($subDArray as $sd) {
		$sdd.=$sd.",";
	}
	$sdd = substr($sdd,0,strlen($sdd)-1);

	// dobavi sve parove vozaca i vozila za driver-a
	//$q = "SELECT * FROM v4_SubVehiclesSubDrivers";
	$q = "SELECT * FROM v4_SubVehicles";
	$q .= "	WHERE OwnerID = " . $_SESSION['UseDriverID']; 
	
	$r = $db->RunQuery($q);
	while ($d = $r->fetch_object()) {
			$row = array();
			//$row['SubVehicleID'] = $d->SubVehicleID;
			//$sv->getRow($d->SubVehicleID);
			$sv->getRow($d->VehicleID);
			$row['SubVehicleName']=$sv->getVehicleDescription();
			//$vehicles[$d->SubDriverID]=$row;
			$vehicles[$d->AssignSDID]=$row;
	}

	date_default_timezone_set("Europe/Paris");		
	// dobavi vozace iz rasporeda
	/*$q = "SELECT * FROM v4_AuthUsers";
	$q .= " WHERE AuthUserID in (".$sdd.") ORDER BY DriverID,AuthUserID ASC";
	$r = $db->RunQuery($q);
	while ($d = $r->fetch_object()) {*/
	foreach	($users as $d) {
		if (in_array($d->AuthUserID,$subDArray)) {
			$row = array();
			$row['DriverID'] = $d->AuthUserID;
			$row['DriverName'] = $d->AuthUserRealName;
			$row['Active'] = $d->Active;
			$row['Mob'] = $d->AuthUserMob;
			$op->getRow($d->IBAN);
			$row['Accomodation']=$op->getPlaceNameEN();		
			
			// hvatanje trenutne lokacije
			if ($DateFrom<=date('Y-m-d') && $DateTo>=date('Y-m-d')) {
				$lng=0;
				$lat=0;				
				$time1=time()-1200;
				$time2=time()-60;	
				// lokacija i vreme iz UserLocation
				$timestart=time()-12*3600;
				$q = "SELECT * FROM `v4_UserLocations` WHERE 
					`UserID`=".$d->AuthUserID." and
					`Time` > ".$timestart."
					order by time desc"; 
				$rL = $db->RunQuery($q);
				$loc=array(); 
				$foundlocation=false;
				while ($tL = $rL->fetch_object()) {
					$loc[] = $tL;
					$foundlocation=true;
				}
				$row['ForTransferBreak']=true;
				if ($foundlocation) {
					$lc=$loc[0];
					$row['Lat']=$lc->Lat;
					$row['Lng']=$lc->Lng;			
					$row['Location']=$lc->Label;
					$row['Device']=$lc->Device.' at '.date('H:i:s',$lc->Time);
					$row['DeviceTime']=$lc->Time;
					if ((time()-$lc->Time)/3600<4 && (time()-$lc->Time)/3600>0) $inTime=true;
					else $inTime=false;
					$distACC=vincentyGreatCircleDistance($row['Lat'], $row['Lng'], $op->Latitude, $op->Longitude, $earthRadius = 6371000);
					$distACC=$distACC/1000; //distanca od prenocista
					/*echo $row['Lat'].'-'.$row['Lng'].' / '.$op->PlaceNameEN.$op->Latitude.'-'.$op->Longitude. ' / ';
					echo $distACC*1000;
					echo "<br>";*/
					if ($distACC<5) $row['IconPositon']='fa fa-home';
					else $row['IconPositon']='fa fa-road';
					if ($distACC>5 && $inTime) $row['ForTransferBreak']=false;
				}
			}
			// hvatanje notifikacije
			$ntk = $nt->getKeysBy('NotificationID', 'asc' , ' WHERE 
				SubDriverID= '.$d->AuthUserID.' AND DateToSend = "'.$DateFrom.'" AND NotificationType=1');
			$row['TimeToSend']="";
			$row['NotificationID']=0;			
			if (count($ntk)>0) {
				$nt->getRow($ntk[0]);
				$tt=explode(":",$nt->getTimeToSend());
				$timeToSend=$tt[0].":".$tt[1];
				$row['TimeToSend']=$timeToSend;
				$row['NotificationID']=$nt->getNotificationID();
			} 
			$sdArray[] = $row;
		}
	}	
	// dobavi vozace od trenutnog vlasnika timetable-a, slozi ih u sdArray sa podacima
	/*$q = "SELECT * FROM v4_AuthUsers";
	$q .= "	WHERE DriverID = " . $_SESSION['UseDriverID'] ." AND ACTIVE>0 ORDER BY DriverID,AuthUserID ASC"; 
	$r = $db->RunQuery($q);
	while ($d = $r->fetch_object()) {*/
	foreach ($users as $u) {
		if ($u->DriverID==$_SESSION['UseDriverID']) {
			$row = array();
			$row['DriverID'] = $u->AuthUserID;
			$row['DriverName'] = $u->AuthUserRealName;
			$row['Mob'] = $u->AuthUserMob;		
			//ovde izvuci vozacevo vozilo
			$row['DriverCar'] = $vehicles[$row['DriverID']]['SubVehicleName'];		
			$op->getRow($u->IBAN);
			$row['DriverAcomodation'] = $op->PlaceNameEN;		
			$sddArray[] = $row;
		}
	}

	// $t
	/*foreach ($tx as $t) {	
		require("oneTransfer.php"); // oneTransfer.php ===========================================================================
	}*/
	$sdArrayExt=array();
	foreach ($sdArray as $sd) {
		$ordersArray=array();	
		foreach($tx as $t) {						
			if ($sd['DriverID']==$t->SubDriver) {
				$key = array_search($t->SubDriver, array_column($sdArray, 'DriverID'));
				require("oneTransfer.php"); // oneTransfer.php ===========================================================================
			}		
			if ($sd['DriverID']==$t->SubDriver2) {
				$key = array_search($t->SubDriver2, array_column($sdArray, 'DriverID'));
				require("oneTransfer.php"); // oneTransfer.php ===========================================================================
			}			
			if ($sd['DriverID']==$t->SubDriver3) {
				$key = array_search($t->SubDriver3, array_column($sdArray, 'DriverID'));
				require("oneTransfer.php"); // oneTransfer.php ===========================================================================
			}			
			if (($sd['DriverID']==$_SESSION['UseDriverID']) && $t->SubDriver==0) {
				$key=0;
				require("oneTransfer.php"); // oneTransfer.php ===========================================================================
			}	
		}	
		$sd['Transfers']=$ordersArray;
		$sdArrayExt[]=$sd;
	}
	
	$smarty->assign('sdArray',$sdArrayExt);
	$smarty->assign('sddArray',$sddArray);
	$smarty->assign('vehicles',$vehicles);
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


# Pretvaranje formata datuma
function YMD_to_DMY ($date) {
	$elementi = explode ('-', $date);
	$new_date = $elementi[2] . '.' . $elementi[1] . '.' . $elementi[0];
	return $new_date;
}

function vincentyGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  return $angle * $earthRadius;
}


?>

