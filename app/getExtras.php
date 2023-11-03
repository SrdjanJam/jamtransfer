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
	require_once ROOT . '/db/v4_Services.class.php';
	$s 	= new v4_Services();
	// Request u varijable
	$ServiceID	= $_REQUEST['ServiceID'];
	$serviceKeys = $s->getKeysBy('OwnerID','asc',"WHERE ServiceID=".$ServiceID);
	if(count($serviceKeys) == 1) {
		$s->getRow($serviceKeys[0]);
		$ownerID=$s->getOwnerID();
		require_once ROOT . '/db/v4_Extras.class.php';
		$ex 	= new v4_Extras();
		$extrasKeys = $ex->getKeysBy('OwnerID','asc',"WHERE OwnerID=".$ownerID);
		if(count($extrasKeys) >0) {
			foreach ($extrasKeys as $exid) {
				$ex->getRow($exid);
				$extrasrow=array();
				$extrasrow['ServiceEN']=$ex->getServiceEN();
				$extrasrow['Price']=$ex->getPrice();
				$extras[$exid]=$extrasrow;
			}
		}	
	}
}
echo json_encode($extras);
