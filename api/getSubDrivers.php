<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../config.php';

# init vars
$out = array();

if (isset($_REQUEST['OwnerID'])&& $_REQUEST['OwnerID']>0) {
	$oid=$_REQUEST['OwnerID'];

	foreach($users as $u) {
		if ($u->DriverID==$oid) {
			$out[] = array(
						'UserID'		=> $u->AuthUserID, 
						'AuthUserRealName' 	=> $u->AuthUserRealName,
						'Mob' 			=> $u->AuthUserMob,
						'Tel' 			=> $u->AuthUserTel,
						'Email'			=> $u->AuthUserMail,
						'SubVehicle'	=> 'vehicle'
			);
		}
	}
}
# send output back
$output = json_encode($out);

unset($out);
//print_r($output);
echo $_REQUEST['callback'] . '(' . $output . ')';


