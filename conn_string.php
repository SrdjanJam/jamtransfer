<? 
if(!isset($_SESSION)) session_start();

define("MONITOR", 0);
define("ALLOW_REFRESH", 1);
define("CMS_ONLY", true); 
if ($_SERVER['HTTP_HOST']=='wis.jamtransfer.com' || (isset($cronjob) && $cronjob)) define("LOCAL",false);
else  define("LOCAL",true);
if (LOCAL) {
	define("ROOT_HOME", "http://localhost/jamtransfer/");
	define("ROOT", "c:\\wamp\\www\\jamtransfer");
	define("ROOT_INDEX",1);
}	
else {
	define("ROOT", $_SERVER['DOCUMENT_ROOT']);
	define("ROOT_HOME", 'https://'.$_SERVER['HTTP_HOST'].'/');
	define("ROOT_INDEX",0);
	if (isset($cronjob) && $cronjob) define("ROOT", '/home/jamtrans/laravel/public/wis.jamtransfer.com');
}	
define("ROOTPATH", ROOT.'/cms');
define("SITE_CODE", '1');
	
 
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
//error_reporting(E_ALL);
?>
