<?
require_once "../config.php";
require_once ROOT . '/db/v4_AuthUsers.class.php';
$extras=array();
$au = new v4_AuthUsers();
$pass=false;
$agentKeys = $au->getKeysBy('AuthUserID','asc',"WHERE AuthLevelID=2 and Active=1");
foreach($agentKeys as $ki => $id) {
	$au->getRow($id);
	if ($_REQUEST['code']==md5($au->getAuthUserPass())) {
		$pass=true;
		$userID=$au->getAuthUserID();
		break;
	}	
}
if($pass) {
	$data = file_get_contents('php://input');
	$data=json_decode($data);

	ob_start();
	Print_r($data);
	$content = ob_get_contents();
	ob_end_clean();
	file_put_contents('test.html', $content);

	echo "OK";
	header("HTTP/1.1 200 OK");
}	
