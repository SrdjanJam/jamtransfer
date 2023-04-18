<?

require_once 'conn_string.php';
require_once ROOT. '/definitions.php';

global $DB_USER;
global $DB_PASSWORD;
global $DB_NAME;

if (LOCAL) {
	define("DB_HOST", "localhost");
	$DB_USER="root";
	$DB_PASSWORD="";
	$DB_NAME="jamtrans_touradria";
}
else {	
	define("DB_HOST", "127.0.0.1");
	$DB_USER="jamtrans_cms";
	$DB_PASSWORD="~5%OuH{etSL)";
	$DB_NAME="jamtrans_touradria";

}	
require_once ROOT . '/db/db.class.php';	
$db = new DataBaseMysql();	

if (isset($_SESSION['log_db']) && !LOCAL) {	
	$result = $db->RunQuery("SELECT * FROM ".DB_PREFIX."LogDB WHERE ID = ".$_SESSION['log_db']); 
	if($result->num_rows == 1)
	{
		$row = $result->fetch_assoc();				
		$DB_USER=$row['User'];
		$DB_PASSWORD=$row['Password'];
		$DB_NAME=$row['Name'];
		$db = new DataBaseMysql();	
		$_SESSION['log_db']=$row['ID'];	
	}
}

// AUTOLOAD FUNCTION
spl_autoload_register(
	function($classname) {
		//if ($classname<>'Smarty_Autoloader') require_once ROOT.'/db/'. $classname . '.class.php';	
	}
);	

require_once ROOT. '/sessionThingy.php';
require_once ROOT.'/common/functions/f.php';
require_once ROOT.'/common/class/PathVars.php';

require_once ROOT.'/common/class/smartyHelper.php';
require_once ROOT.'/common/class/class.smartypluginblock.php';
require_once ROOT.'/common/libs/Smarty.class.php'; 
require_once ROOT.'/common/libs/SmartyValidate.class.php';
require_once ROOT.'/common/libs/SmartyPaginate.class.php';

require_once ROOT.'/common/class/SortLink.class.php';
require_once ROOT.'/common/class/adminTable.php';
require_once ROOT.'/common/class/factoryBase.php';
require_once ROOT.'/common/class/ObjectFactory.class.php';



$smarty = new Smarty;
$smarty->compile_check = true;
$smarty->debugging =false;   
$modulesPath = ROOT . '/plugins'; // base folder for modules
$smarty->assign('root_home',ROOT_HOME);
$smarty->assign('root',ROOT);

// LANGUAGES
if ( isset($_SESSION['CMSLang']) and $_SESSION['CMSLang'] != '') {
	$languageFile = 'lng/' . $_SESSION['CMSLang'] . '_text.php';
	if ( file_exists( $languageFile) ) require_once $languageFile;
	else {
		$_SESSION['CMSLang'] = 'en';
		require_once 'lng/en_text.php';
	}
} else {
	$_SESSION['CMSLang'] = 'en';
	require_once 'lng/en_text.php';
}
require_once 'lng/var-en.php';

$defvar=get_defined_vars();
foreach ($defvar as $key => $dv) {
	if (gettype($dv)=='string' or gettype($dv)=='array') $smarty->assign($key,$dv);
}	
$defcon=get_defined_constants();
foreach ($defcon as $key => $dc) {
	$smarty->assign($key,$dc);
}	
$smarty->assign('language',$_SESSION['CMSLang']);

// END OF LANGUAGES	

// pdv
$filename = ROOT . '/plugins/vatRate/vatRate.inc';	
$vat = file_get_contents($filename, FILE_USE_INCLUDE_PATH);
$_SESSION['vat'] = $vat;

// COMPANY DATA FROM DATABASE
if (!is('co_name')) {
	require_once ROOT . '/db/v4_CoInfo.class.php';
	$co = new v4_CoInfo();
	$co->getRow('1');
	$companyData = $co->fieldValues();
	$co->endv4_CoInfo();
	
	foreach($companyData as $name => $value) {
		$_SESSION[$name] = $value;
	}
}

if (isset($_SESSION['AuthUserID'])) {
	$AuthUserID=$_SESSION['AuthUserID'];
	$local = isLocalAgent($AuthUserID);
	$smarty->assign('local',$local);
}	
$smarty->assign('isNew',false);
//inicijalizacija promenljivih
$filter='';
// preuzimanje niza iz sesije
/*$users=$_SESSION['users'];
$extras=$_SESSION['extras'];
$vehicletypes=$_SESSION['vehicletypes'];*/



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
		while ($u = $rU->fetch_object()) {
			$users[$u->AuthUserID]=$u;
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
		while ($ex = $rEx->fetch_object()) {
			$extras[$ex->ID]=$ex;
		}		
		// vehicleType
		$qVT = "SELECT 
			`VehicleTypeID`, 
			`VehicleTypeName`, 
			`VehicleClass`
			FROM `v4_VehicleTypes` " ;
		$rVT = $db->RunQuery($qVT);
		while ($vt = $rVT->fetch_object()) {
			$vehicletypes[$vt->VehicleTypeID]=$vt;
		}		
		
?>