<?
// za kartu
require_once ROOT . '/db/v4_AuthUsers.class.php';
require_once ROOT . '/db/v4_Places.class.php';
require_once ROOT . '/db/v4_DriverTerminals.class.php';
$au = new v4_AuthUsers();
$pl=new v4_Places;
$dt = new v4_DriverTerminals();
$api_key="5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb";
$driverID=$_SESSION['UseDriverID'];
$where=" WHERE AuthLevelID=32 and Active=1 and DriverID=".$driverID." ";;
$auk=$au->getKeysBy('AuthUserID','',$where);

$where=" WHERE DriverID=".$driverID;
$dtk=$dt->getKeysBy('TerminalID','',$where);
if (count($dtk)>0) {
	$terminal_row['name']=SELECT;
	$terminal_row['id']=0;
	$terminals[]=$terminal_row;
	$slat=0;
	$slong=0;
	foreach ($dtk as $key) {
		$dt->getRow($key);
		$pl->getRow($dt->getTerminalID());
		if ($pl->getLongitude()<>0 && $pl->getLatitude()<>0) {
			$mlat[]=$pl->getLatitude();
			$mlong[]=$pl->getLongitude();
			$terminal_row['name']=$pl->getPlaceNameEN();
			$terminal_row['id']=$pl->getPlaceID();
			$terminal_row['lng']=$pl->getLongitude();
			$terminal_row['lat']=$pl->getLatitude();
			$terminals[]=$terminal_row;
		}	
	}
	
	$minlong=min($mlong);
	$minlat=min($mlat);
	$maxlong=max($mlong);
	$maxlat=max($mlat);
	$lat=($minlat+$maxlat)/2;
	$long=($minlong+$maxlong)/2;
	$dd1=vincentyGreatCircleDistance($minlat, $minlong, $maxlat, $maxlong);	
	$dd2=vincentyGreatCircleDistance($maxlat, $minlong, $minlat, $maxlong);	
	$dd=max(array($dd1,$dd2));
	$dd=$dd/1000;
	$scale=11;
	if 	($dd>50) $scale=10;
	if 	($dd>100) $scale=9;
	if 	($dd>300) $scale=8;			
	if 	($dd>500) $scale=7;			
	if 	($dd>800) $scale=6;			
	if 	($dd>1500) $scale=5;			

} else {
	$long=0;
	$lat=0;
	$scale=1;	
}	
$smarty->assign('lat',$lat);
$smarty->assign('long',$long);
$smarty->assign('scale',$scale);

// za vozila
require_once ROOT . '/db/sb_Vehicles.class.php';
$vh = new sb_Vehicles();
$where=" WHERE OwnerID=".$_SESSION["UseDriverID"];
$vhk=$vh->getKeysBy("VehicleID","",$where);
$vehicles=array();
foreach ($vhk as $key) {
	$vh->getRow($key);
	$row=$vh->fieldValues();
	$vehicles[]=$row;
}
//za unete rute
require_once ROOT . '/db/sb_Routes.class.php';
$rt = new sb_Routes();
$where=" WHERE OwnerID=".$_SESSION["UseDriverID"];
$rtk=$rt->getKeysBy("RouteID","",$where);
$routes=array();
foreach ($rtk as $key) {
	$rt->getRow($key);
	$row=$rt->fieldValues();
	$arr=json_decode($rt->getLine());
	$mid=number_format((count($arr))/2,0);
	$row['midll']=json_encode($arr[$mid]);
	$vprices=json_decode($rt->getVPrices());
	$vp_arr=array();
	foreach ($vprices as $vp) {
		$vp_row=array();
		$vh->getRow($vp[0]);
		$vp_row['name']=$vh->getVehicleName()." ".$vh->getMaxPax()." pax.";
		$vp_row['price']=number_format($vp[1],2);
		$vp_arr[]=$vp_row;
	}	
	$row['vprices']=$vp_arr;
	$routes[]=$row;
}	
$smarty->assign('terminals',$terminals);
$smarty->assign('vehicles',$vehicles);
$smarty->assign('routes',$routes);

?>
