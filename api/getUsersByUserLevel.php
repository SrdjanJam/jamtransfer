<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once '../config.php';

# init libs
require_once ROOT . '/db/v4_AuthUsers.class.php';
# init vars
$out = array();
# init class
$au = new v4_AuthUsers();

$lid=$_REQUEST['LevelID'];
$Where = ' WHERE AuthLevelID = ' . $lid . ' AND Active =1';
$auKeys = $au->getKeysBy('AuthUserID', 'asc', $Where);
foreach($auKeys as $n => $ID) {
	$au->getRow($ID);
	$out[] = array(
				'UserID'		=> $au->getAuthUserID(), 
				'AuthUserRealName' 	=> $au->getAuthUserRealName(),
				'Mob' 			=> $au->getAuthUserMob(),
				'Tel' 			=> $au->getAuthUserTel(),
				'Email'			=> $au->getAuthUserMail(),
	);
}
# send output back
$output = json_encode($out);

unset($out);
//print_r($output);
echo $_REQUEST['callback'] . '(' . $output . ')';


