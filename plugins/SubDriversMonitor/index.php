<?

require_once ROOT . '/config.php';
require_once ROOT . '/db/db.class.php';
$db = new DataBaseMysql();
require_once ROOT . '/db/v4_AuthUsers.class.php';
$au = new v4_AuthUsers();
require_once ROOT . '/db/v4_SubVehicles.class.php';
$sv = new v4_SubVehicles();

$sdArray = array();
$where=" WHERE AuthLevelID=32 and Active=1 and DriverID=".$_SESSION['UseDriverID']." ";;
$auk=$au->getKeysBy('AuthUserID','',$where);
	// dobavi sve parove vozaca i vozila za driver-a
	$q = "SELECT * FROM v4_SubVehicles";
	$q .= "	WHERE OwnerID = " . $_SESSION['UseDriverID']; 
	$r = $db->RunQuery($q);
	while ($d = $r->fetch_object()) {
		$vehicles[$d->AssignSDID]=$d->VehicleDescription;
	}

	foreach	($auk as $d) {
		$au->getRow($d);
		$row = array();
		$row['DriverID'] = $au->AuthUserID;
		$row['DriverName'] = $au->AuthUserRealName;
		$row['Active'] = $au->Active;
		$row['Mob'] = $au->AuthUserMob;
		if (array_key_exists($au->AuthUserID,$vehicles)) $row['Vehicle'] = $vehicles[$au->AuthUserID];
		else $row['Vehicle'] = "";
		
		// hvatanje trenutne lokacije
		$lng=0;
		$lat=0;				
		$time1=time()-1200;
		$time2=time()-60;	
		// lokacija i vreme iz UserLocation
		$timestart=time()-12*3600;
		$q = "SELECT * FROM `v4_UserLocations` WHERE 
			`UserID`=".$au->AuthUserID." and
			`Time` > ".$timestart."
			order by time desc"; 
		$rL = $db->RunQuery($q);
		$loc=array(); 
		$foundlocation=false;
		while ($tL = $rL->fetch_object()) {
			$loc[] = $tL;
			$foundlocation=true;
		}
		if ($foundlocation) {
			$lc=$loc[0];
			$row['Lat']=$lc->Lat;
			$row['Lng']=$lc->Lng;			
			$row['Location']=$lc->Label;
			$row['Device']=$lc->Device.' at '.date('H:i:s',$lc->Time);
			$row['DeviceTime']=$lc->Time;
			$row['foundlocation']=true;
		}
		else $row['foundlocation']=false;
		$sdArray[] = $row;		
	}	
function cmp($a, $b)
{
    return strcmp($b['Device'], $a['Device']);
}

usort($sdArray, "cmp");		
	
	$smarty->assign('sdArray',$sdArray);





?>

