<? 
if(!isset($_SESSION)) session_start();
//ovde ubaciti userid-ije za user-e koji ce koristiti glavnu bazu a ne testnu
if (isset($_SESSION['AuthUserID'])) {
	$privusers=array(874,3012,3011,3013,3064,3066);
	$testusers=array(3068,3069);
	$database="TEST";
	if (in_array($_SESSION['AuthUserID'],$privusers)) $database="REAL";
	if (in_array($_SESSION['AuthUserID'],$testusers)) $database="NEW_TEST";
}	
define("MONITOR", 0);
define("ALLOW_REFRESH", 1);
define("CMS_ONLY", true); 
if ($_SERVER['HTTP_HOST']=='wis.jamtransfer.com') define("LOCAL",false);
else  define("LOCAL",true);
if (LOCAL) {
	define("ROOT_HOME", "http://localhost/jamtransfer/");
	define("ROOT", "c:\\wamp\\www\\jamtransfer");
}	
else {
	define("ROOT", $_SERVER['DOCUMENT_ROOT']);
	define("ROOT_HOME", 'https://'.$_SERVER['HTTP_HOST'].'/');
}	
define("ROOTPATH", ROOT.'/cms');
define("SITE_CODE", '1');
if (LOCAL) {
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "jamtrans_touradria");
}
else {
	define("DB_HOST", "127.0.0.1");
	if ($database=="TEST") define("DB_USER", "jamtrans_api");
	else if ($database=="NEW_TEST") define("DB_USER", "jamtrans_new");
	else define("DB_USER", "jamtrans_cms");
	if ($database=="TEST") define("DB_PASSWORD", "i97zo5X&ftt4");
	else if ($database=="NEW_TEST") define("DB_PASSWORD", "Dw@~6(aQ%;;s");
	else define("DB_PASSWORD", "~5%OuH{etSL)");
	if ($database=="TEST") define("DB_NAME", "jamtrans_test");
	else if ($database=="NEW_TEST") define("DB_NAME", "jamtrans_newTest");
	else define("DB_NAME", "jamtrans_touradria");
}	
 
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
//error_reporting(E_ALL);
?>
