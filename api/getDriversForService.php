<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../config.php';

# init libs
require_once '../db/v4_AuthUsers.class.php';
require_once '../db/v4_Services.class.php';

# init vars
$out = array();

# init class
$au = new v4_AuthUsers();
$sr = new v4_Services();
# service

$rid=$_REQUEST['RouteID'];
$vtid=$_REQUEST['VehicleTypeID'];
$srWhere = ' WHERE RouteID = ' . $rid . ' AND VehicleTypeID = ' . $vtid . ' AND Active =1 and ServicePrice1>0';
//$srWhere = ' WHERE RouteID = ' . $rid . ' AND Active =1 and ServicePrice1>0';
$srKeys = $sr->getKeysBy('OwnerID', 'asc', $srWhere);
$i=0;
//ista ruta i tip vozila
foreach($srKeys as $n => $ID) {
	$i++;	
	$sr->getRow($ID);
	$serviceID[]=$sr->getServiceID();
	$driverID[]=$sr->getOwnerID();
	$dprice[]=$sr->getServicePrice1().' EUR';
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
		$dprice[]=$sr->getServicePrice1().' EUR';
		$dvt[]=$sr->getVehicleTypeID();
	}
}

//$auWhere = " WHERE AuthLevelID = '31' AND Active='1' ";
//$auKeys = $au->getKeysBy('Country, Terminal, AuthUserCompany', 'asc', $auWhere);

$j=0;
foreach($driverID as $n => $ID) {
	$j++;
	$au->getRow($ID);
	$out[] = array(
				'UserID'		=> $au->getAuthUserID(), 
				'RealName' 		=> $au->getAuthUserRealName(),
				'Company' 		=> $au->getAuthUserCompany(),
				'Tel' 			=> $au->getAuthUserTel(),
				'Email'			=> $au->getAuthUserMail(),
				'Country'       => $au->getCountry(),
				'Terminal'      => "",
				'DriverPrice'   => $dprice[$j],
				'VehicleType'   => $dvt[$j]
	);
}

$auWhere = " WHERE AuthLevelID = '31' AND Active='1' ";
$auKeys = $au->getKeysBy('Country, Terminal, AuthUserCompany', 'asc', $auWhere);

foreach($auKeys as $n => $ID) {
	if (!in_array($ID,$driverID)) {
		$au->getRow($ID);
		$out[] = array(
					'UserID'		=> $au->getAuthUserID(), 
					'RealName' 		=> $au->getAuthUserRealName(),
					'Company' 		=> $au->getAuthUserCompany(),
					'Tel' 			=> $au->getAuthUserTel(),
					'Email'			=> $au->getAuthUserMail(),
					'Country'       => $au->getCountry(),
					'Terminal'      => $au->getTerminal(),
					'DriverPrice'   => "",
					'VehicleType'   => ""
		);
	}
}

# send output back
$output = json_encode($out);

unset($out);
//print_r($output);
echo $_REQUEST['callback'] . '(' . $output . ')';


