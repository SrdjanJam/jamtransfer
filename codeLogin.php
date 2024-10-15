<?
if (isset($_REQUEST['userCode'])) {
	require_once 'config.php';
	require_once ROOT . '/db/v4_AuthUsers.class.php';
	$au = new v4_AuthUsers();
	$agentKeys = $au->getKeysBy('AuthUserID','asc',"WHERE Active=1");
	foreach($agentKeys as $ki => $id) {
		$au->getRow($id);
		if ($_REQUEST['userCode']==md5($au->getAuthUserPass()) && $_REQUEST['userID']==$au->getAuthUserID()) {
			$_SESSION['UserName'] = $au->getAuthUserName();
			$_SESSION['UserRealName'] = $au->getAuthUserRealName();
			$_SESSION['UserCompany'] = $au->getAuthUserCompany();
			$_SESSION['BrandName'] = $au->getBrandName();
			$_SESSION['UserIDD'] = $au->getAuthUserCompanyMB();
			$_SESSION['AuthUserID'] = $au->getAuthUserID();
			$_SESSION['OwnerID'] = $au->getAuthUserID();
			$_SESSION['PermAuthUserID'] = $au->getAuthUserID();
			$_SESSION['AuthLevelID'] = $au->getAuthLevelID();
			$_SESSION['DriverID'] = $au->getDriverID();
			$_SESSION['MemberSince'] = $au->getDateAdded();
			$_SESSION['AuthUserNote1'] = $au->getAuthUserNote1();
			
			if($au->getAuthLevelID() == '2') $_SESSION['Provision'] = $au->getProvision();
			if($au->getAuthLevelID() == '4') $_SESSION['Provision'] = $au->getProvision();
			if($au->getAuthLevelID() == '5') $_SESSION['Provision'] = $au->getProvision();
			
			$_SESSION['UserAuthorized'] = TRUE;
			$_SESSION['UserImage'] = $au->getImage();
			$_SESSION['UserEmail'] = $au->getAuthUserMail();
			
			
			$qu  = "UPDATE v4_AuthUsers SET LastVisited = '".date("Y-m-d H:i:s") ."' ";
			$qu .= " WHERE AuthUserID = '" .$_SESSION['AuthUserID']. "'";
			$db->RunQuery($qu);
			$page='dashboard';
			saveLog($au->getAuthUserID(),1);
			header("Location: " .$page);
			exit();
		}   						
	} $error=true;
} else $error=true;
if ($error) {
	$page='login.php';
	header("Location: " .$page);
	exit();
}
						




	
?>	
