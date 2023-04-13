<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../config.php';

$out = array();

$lid=$_REQUEST['LevelID'];
foreach($users as $u) {
	if ($u->AuthLevelID==$lid) {
		$out[] = array(
					'UserID'		=> $u->AuthUserID, 
					'AuthUserRealName' 	=> $u->AuthUserRealName,
					'Mob' 			=> $u->AuthUserMob,
					'Tel' 			=> $u->AuthUserTel,
					'Email'			=> $u->AuthUserMail,
		);
	}
}
# send output back
$output = json_encode($out);

unset($out);
//print_r($output);
echo $_REQUEST['callback'] . '(' . $output . ')';


