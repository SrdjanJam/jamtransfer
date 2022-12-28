<?

// ("LOCAL",false) is Server
// ("DEVELOPMENT",true) is Server

if(!isset($_SESSION)) session_start(); 

if(isset($_SESSION['AuthUserID'])) $_SESSION['AuthUserID'];
else $_SESSION['AuthUserID'] = "";

//ovde ubaciti userid-ije za user-e koji ce koristiti glavnu bazu a ne testnu
$privusers=array(874,3012,3011,3013);

if (in_array($_SESSION['AuthUserID'],$privusers) ) define("DEVELOPMENT",false); // This is localhost
else define("DEVELOPMENT",true); 

define("MONITOR", 0);
define("ALLOW_REFRESH", 1);
define("CMS_ONLY", true); 

if ($_SERVER['HTTP_HOST']=='wis.jamtransfer.com') define("LOCAL",false);
else  define("LOCAL",true);

if (LOCAL) { // This is local host
	define("ROOT_HOME", "http://localhost/jamtransfer/");
	define("ROOT", "c:\\xampp\\htdocs\\jamtransfer");
}	
else { // Server
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
	if (DEVELOPMENT) define("DB_USER", "jamtrans_api");
	else define("DB_USER", "jamtrans_cms");
	if (DEVELOPMENT) define("DB_PASSWORD", "i97zo5X&ftt4");
	else define("DB_PASSWORD", "~5%OuH{etSL)");
	if (DEVELOPMENT) define("DB_NAME", "jamtrans_test");
	else define("DB_NAME", "jamtrans_touradria");
}	

if (DEVELOPMENT) error_reporting(E_ALL); // Turn on error
// if (DEVELOPMENT) error_reporting(1); // turn off error

else error_reporting(E_ALL);


?>
