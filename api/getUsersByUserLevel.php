<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../config.php';

$out = array();
$lid=$_REQUEST['LevelID'];
foreach($users as $u) {
	if (($u->AuthLevelID==$lid and $lid!=32) or ($u->AuthLevelID==$lid and $lid==32 and $_SESSION['UseDriverID']==$u->DriverID) or $lid==0) {
		$out[] = array(
					'UserID'		=> $u->AuthUserID, 
					'LevelID' 	=> $u->AuthLevelID,
					'AuthUserRealName' 	=> $u->AuthUserRealName,
					'Mob' 			=> $u->AuthUserMob,
					'Tel' 			=> $u->AuthUserTel,
					'Email'			=> $u->AuthUserMail,
		);
	}
}
usort($out,function($first,$second){
	return $first['AuthUserRealName'] > $second['AuthUserRealName'];
});

# send output back
$output = json_encode($out);

unset($out);
echo $_REQUEST['callback'] . '(' . $output . ')';


