<?
//session_start();
require_once 'config.php';

//$_SESSION = array();

# Language
$_SESSION['CMSLang'] = 'en';
if(!empty($_COOKIE['CMSLang'])) $_SESSION['CMSLang'] = $_COOKIE['CMSLang'];
require_once('lng/' . $_SESSION['CMSLang'] . '_text.php');
	# Config File

	require_once ROOT . '/db/db.class.php';
	$db = new DataBaseMysql();
	$showLoginForm = true;

		if(isset($_REQUEST['Login']))
		{
			if($_REQUEST['username']!='' && $_REQUEST['password']!='')
			{
				$_SESSION['CMSLang'] 	= $_REQUEST['language'];

				$tempPass = md5($_REQUEST['password']);
				$cleanUserName 	= $db->conn->real_escape_string($_REQUEST['username']);
				$cleanPass		= $db->conn->real_escape_string($tempPass);

				//Use the input username and password and check against 'users' table
				$result = $db->RunQuery('SELECT * FROM '.DB_PREFIX.'AuthUsers 
									WHERE AuthUserName = "'.$cleanUserName.'" 
									AND AuthUserPass = "'.$cleanPass.'"');			
						

				//blok za registrovanje ulaza u administraciju cms-a			
				$current_ip=$_SERVER['REMOTE_ADDR'];
				$visitor_ip=ip2long(ltrim(rtrim($current_ip)));
				$access_time=time();
				$result2 = $db->RunQuery('INSERT INTO `LogUser`(`ip_address`, `time`, `username`) VALUES ("'.$current_ip.'",'.$access_time.',"'.$_REQUEST['username'].'")');									
			
				
				if($result->num_rows == 1)
				{

					$row = $result->fetch_assoc();
					
					// $smarty->assign('active',$row['Active']);
					if($row['Active'] == 1)
					{
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
						$_SESSION['UserIDD'] = $row['AuthUserCompanyMB'];
						$_SESSION['AuthUserID'] = $row['AuthUserID'];

						$_SESSION['OwnerID'] = $row['AuthUserID'];
						$_SESSION['PermAuthUserID'] = $row['AuthUserID'];

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
						$showLoginForm = false;
						
						$qu  = "UPDATE v4_AuthUsers SET LastVisited = '".date("Y-m-d H:i:s") ."' ";
						$qu .= " WHERE AuthUserID = '" .$_SESSION['AuthUserID']. "'";
						$db->RunQuery($qu);
						if (isset($_COOKIE['page'])&& $_COOKIE['page']<>'logout') $page=$_COOKIE['page'];
						else $page='dashboard';
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

	// Smarty assign:
	$smarty->assign('error',$error);
	$smarty->assign('message',$message);

	if ($showLoginForm) {

		$smarty->display('login.tpl');

	} ?>

	

