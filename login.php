<?
//session_start();
require_once 'config.php';
//$_SESSION = array();

# Language

if (isset($_REQUEST['language'])) $_SESSION['CMSLang'] = $_REQUEST['language'];
else if(!empty($_COOKIE['CMSLang'])) $_SESSION['CMSLang'] = $_COOKIE['CMSLang'];
else $_SESSION['CMSLang'] = "en";
setcookie("CMSLang", $_SESSION['CMSLang'], time() + (7*24*60*60),"/");
require_once('lng/' . $_SESSION['CMSLang'] . '_text.php');

	# Config File

	$showLoginForm = true;
	$message='';
	$error='';

		if (isset($_REQUEST['passwordT'])) $passwordT=$_REQUEST['passwordT'];
		if ($_REQUEST['tempPass']!='') {	
			$_REQUEST['passwordT']="qlVX5D*99Dxe";	
			$_REQUEST['Login']=1;	
		}
		if(isset($_REQUEST['Login']))
		{
			if($_REQUEST['passwordT']!='' || LOCAL) {
				if (!LOCAL) {
					define("DB_HOST", "127.0.0.1");
					$DB_USER="jamtrans_cms";
					$DB_PASSWORD="~5%OuH{etSL)";
					$DB_NAME="jamtrans_touradria";
					require_once ROOT . '/db/db.class.php';	
					$db = new DataBaseMysql();	
					$result = $db->RunQuery("SELECT * FROM ".DB_PREFIX."LogDB 
							WHERE LogPass = '".md5($_REQUEST['passwordT'])."'"); 
				}			
				if($result->num_rows == 1 || LOCAL)
				{
					if (!LOCAL) {
						$row = $result->fetch_assoc();				
						$DB_USER=$row['User'];
						$DB_PASSWORD=$row['Password'];
						$DB_NAME=$row['Name'];
						$db = new DataBaseMysql();	
						$_SESSION['log_db']=$row['ID'];	
						$_SESSION['log_title']=$row['Title'];	
					}
					else $_SESSION['log_title']="Local";
					if($_REQUEST['username']!='' && ($_REQUEST['password']!='' || $_REQUEST['tempPass']!=''))
					{
						$_SESSION['CMSLang'] 	= $_REQUEST['language'];

						if ($_REQUEST['tempPass']!='') $tempPass=$_REQUEST['tempPass'];
						else $tempPass = md5($_REQUEST['password']);
						$cleanUserName 	= $db->conn->real_escape_string($_REQUEST['username']);
						$cleanPass		= $db->conn->real_escape_string($tempPass);

						//Use the input username and password and check against 'users' table
						$sql = "SELECT * FROM ".DB_PREFIX."AuthUsers 
											WHERE `AuthUserName` = '".$cleanUserName."' 
											AND `AuthUserPass` = '".$cleanPass."'";
						$result = $db->RunQuery($sql);			
						
						if($result->num_rows == 1)
						{
							$row = $result->fetch_assoc();
							
							// $smarty->assign('active',$row['Active']);
							if($row['Active'] == 1)
							{
								saveLog($row['AuthUserID'],1);
								$sql = 'SELECT Average FROM v4_ExchangeRate WHERE Name = "EUR"';
								$rEur = $db->RunQuery($sql);
								$Eur = $rEur->fetch_assoc();
								
								if ($row['CountryName']=='Serbia' &&  $row['AuthLevelID']==2) {	
									$_SESSION['Currency'] = 'EUR';
									$_SESSION['ExchFaktor'] = 1.035;
								}		
								else { 
									$_SESSION['Currency'] = 'EUR';	
									$_SESSION['ExchFaktor'] = 1;
								}
								if (in_array($row['AuthUserID'], array(2828,2830,2831,2846))) {
									$_SESSION['CurrencyRate'] = $Eur['Average'];
									$_SESSION['Currency2'] = 'HRK';
								}
								else {
									$_SESSION['CurrencyRate'] = 1;
									$_SESSION['Currency2'] = 'EUR';
								}		
								$_SESSION['UserName'] = $row['AuthUserName'];
								$_SESSION['UserRealName'] = $row['AuthUserRealName'];
								$_SESSION['UserCompany'] = $row['AuthUserCompany'];
								$_SESSION['BrandName'] = $row['BrandName'];
								$_SESSION['UserIDD'] = $row['AuthUserCompanyMB'];
								
								$_SESSION['AuthUserID'] = $row['AuthUserID'];
								$_SESSION['OwnerID'] = $row['AuthUserID'];
								$_SESSION['PermAuthUserID'] = $row['AuthUserID'];
								
								//za Josku premostavanje
								if ($row['AuthUserID']==3088) {
									$_SESSION['AuthUserID'] = 876;
									$_SESSION['OwnerID'] = 876;
									$_SESSION['PermAuthUserID'] = 876;									
								}	

								$_SESSION['AuthLevelID'] = $row['AuthLevelID'];
								$_SESSION['MemberSince'] = $row['DateAdded'];
								$_SESSION['AuthUserNote1'] = $row['AuthUserNote1'];
								
								if($row['AuthLevelID'] == '2') $_SESSION['Provision'] = $row['Provision'];
								if($row['AuthLevelID'] == '4') $_SESSION['Provision'] = $row['Provision'];
								if($row['AuthLevelID'] == '5') $_SESSION['Provision'] = $row['Provision'];
								
								$r = $db->RunQuery("SELECT * FROM ".DB_PREFIX."AuthLevels 
													WHERE AuthLevelID = " . $row['AuthLevelID']);
								$level = $r->fetch_object();
								$_SESSION['GroupProfile'] = ucfirst(strtolower($level->AuthLevelName));
								
								$_SESSION['UserAuthorized'] = TRUE;
								$_SESSION['UserImage'] = $row['Image'];
								$_SESSION['UserEmail'] = $row['AuthUserMail'];
								
								if($_REQUEST['phone']==1) $_SESSION['mobile']=true;
								$showLoginForm = false;
								
								$qu  = "UPDATE v4_AuthUsers SET LastVisited = '".date("Y-m-d H:i:s") ."' ";
								$qu .= " WHERE AuthUserID = '" .$_SESSION['AuthUserID']. "'";
								$db->RunQuery($qu);
								if (isset($_COOKIE['pageEx'])&& $_COOKIE['pageEx']<>'logout') $page=$_COOKIE['pageEx'];
								else $page='dashboard';
								//makeSessionArrays($db);
								$levels=array(41,43,44,91,92,99);
								if (in_array($_SESSION['AuthLevelID'],$levels)) createNotification($_SESSION['AuthUserID'],"Thank you for login. If not, confirm your login by scanning the QR code.","https://wis.jamtransfer.com/");
								header("Location: " .$page);
								exit();
									
							}

							else{
								$error = true;
								$message = 1;
							}
						}
						else {
							// $error = LOGIN_FAILED;
							$error = true;
							$message = 2;
						}
					}
					else {
						// $error = USE_BOTH;
						$error = true;
						$message = 3;
					}
				}
			}
			else {
				$error = true;
				$message = 2;
			}	
		}	
		else{
			if (!isset($_REQUEST["testDB"])) $passwordT="qlVX5D*99Dxe";
			else $passwordT="#rH#@KT12MX8";
		}
	// Smarty assign:
	$smarty->assign('error',$error);
	$smarty->assign('message',$message);

	if ($showLoginForm) {
		$smarty->assign("passwordT",$passwordT);
		$smarty->display('login.tpl');

	} 

	
	function makeSessionArrays($db) {
		// punjenje stalnih nizova
		// users
		$qU = "SELECT 
			`AuthUserID`, 
			`AuthLevelID`, 
			`AuthUserRealName`, 
			`AuthUserName`,  
			`AuthUserCompany`, 
			`Country`, 
			`DriverID`,  
			`AuthUserTel`, 
			`AuthUserMob`, 
			`EmergencyPhone`, 
			`AuthUserFax`, 
			`AuthUserMail`,
			`Image`, 
			`AcceptedPayment`,		
			`Active` 
			FROM `v4_AuthUsers` WHERE Active=1" ;
		$rU = $db->RunQuery($qU);
		unset($_SESSION['users']);			
		while ($u = $rU->fetch_object()) {
			$_SESSION['users'][$u->AuthUserID]=$u;
		}		
		// extras
		$qEx = "SELECT 
			`ID`, 
			`OwnerID`, 
			`ServiceID`, 
			`ServiceEN`,  
			`DriverPrice`, 
			`Provision`,  
			`Price` 
			FROM `v4_Extras` " ;
		$rEx = $db->RunQuery($qEx);
		unset($_SESSION['extras']);					
		while ($ex = $rEx->fetch_object()) {
			$_SESSION['extras'][$ex->ID]=$ex;
		}		
		// vehicleType
		$qVT = "SELECT 
			`VehicleTypeID`, 
			`VehicleTypeName`, 
			`VehicleClass`
			FROM `v4_VehicleTypes` " ;
		$rVT = $db->RunQuery($qVT);
		unset($_SESSION['vehicletypes']);							
		while ($vt = $rVT->fetch_object()) {
			$_SESSION['vehicletypes'][$vt->VehicleTypeID]=$vt;
		}			
	}	
?>	
