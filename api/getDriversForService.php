<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../config.php';

# init libs
require_once '../db/v4_Services.class.php';

# init vars
$out = array();

# init class
$sr = new v4_Services();
# service

$rid=$_REQUEST['RouteID'];
$vtid=$_REQUEST['VehicleTypeID'];
$srWhere = ' WHERE RouteID = ' . $rid . ' AND VehicleTypeID = ' . $vtid . ' AND Active =1';
$srKeys = $sr->getKeysBy('OwnerID', 'asc', $srWhere);
$i=0;
//ista ruta i tip vozila
foreach($srKeys as $n => $ID) {
	$i++;	
	$sr->getRow($ID);
	$serviceID[]=$sr->getServiceID();
	$driverID[]=$sr->getOwnerID();
	$dprice[]=$sr->getServicePrice1();
	$dvt[]=$sr->getVehicleTypeID();
}
$srWhere2 = ' WHERE RouteID = ' . $rid . ' AND Active=1 ';
$srKeys2 = $sr->getKeysBy('OwnerID', 'asc', $srWhere2);
//ista ruta ali ne i tip vozila
foreach($srKeys2 as $n => $ID) {
	$sr->getRow($ID);
	if(!in_array($sr->getServiceID(),$serviceID)) {
		$serviceID[]=$sr->getServiceID();
		$driverID[]=$sr->getOwnerID();
		$dprice[]=$sr->getServicePrice1();
		$dvt[]=$sr->getVehicleTypeID();
	}
}
$j=0;
foreach($driverID as $n => $ID) {
	if (array_key_exists($ID, $users)) {
		$u=$users[$ID];
		$out[] = array(
					'UserID'		=> $u->AuthUserID, 
					'RealName' 		=> $u->AuthUserRealName,
					'Company'		=> $u->Country."/".$u->AuthUserCompany,
					'Tel' 			=> $u->AuthUserTel,
					'Email'			=> $u->AuthUserMail,
					'Country'       => $u->Country,
					'Terminal'      => "",
					'DriverPrice'   => $dprice[$j],
					'VehicleType'   => $dvt[$j]
		);
	}
	$j++;		
}

$out2 = array();

foreach($users as $u) {
	if (!in_array($u->AuthUserID,$driverID) && $u->AuthLevelID==31) {
		$out2[] = array(
					'UserID'		=> $u->AuthUserID, 
					'RealName' 		=> $u->AuthUserRealName,
					'Tel' 			=> $u->AuthUserTel,
					'Email'			=> $u->AuthUserMail,
					'Terminal'      => $u->Terminal,
					'DriverPrice'   => "",
					'VehicleType'   => "0",
					'Company'		=> $u->Country."/".$u->AuthUserCompany 
		);
	}
}

$key_values = array_column($out2, 'Company'); 
array_multisort($key_values, SORT_ASC, $out2);


$out = array_merge($out, $out2);

# send output back
$output = json_encode($out);

unset($out);
//print_r($output);
echo $_REQUEST['callback'] . '(' . $output . ')';


