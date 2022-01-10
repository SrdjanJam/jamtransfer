<? 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

# Session lifetime of 3 hours
ini_set('session.gc_maxlifetime', 10800);
ini_set("session.cookie_lifetime","10800"); //3 sata

# Enable session garbage collection with a 1% chance of
# running on each session_start()
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);

define("DEVELOPMENT",true);
define("MONITOR", 0);
define("ALLOW_REFRESH", 1);
define("CMS_ONLY", true); 
if (!DEVELOPMENT) {
	define("ROOT", $_SERVER['DOCUMENT_ROOT'].'/jamtransfer');
	define("ROOT_HOME", $_SERVER['HTTP_HOST'].'/jamtransfer');
}	
else {
	define("ROOT_HOME", "http://localhost/jamtransfer/");
	define("ROOT", "c:\\wamp\\www\\jamtransfer");
}	
define("ROOTPATH", ROOT.'/cms');
define("SITE_CODE", '1');

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "jamtrans_touradria");

if (DEVELOPMENT) error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
else error_reporting(E_PARSE);

?>
	

