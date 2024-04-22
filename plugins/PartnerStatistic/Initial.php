<?
require_once '../../config.php';
require_once ROOT . '/db/v4_AuthUsers.class.php';
require_once ROOT . '/db/v4_DriversCD.class.php';
require_once ROOT . '/db/v4_OrderRequest.class.php';
require_once ROOT . '/db/v4_OrderDetails.class.php';

$dbT = new DataBaseMysql();
$db = new v4_AuthUsers();
$dcd = new v4_DriversCD();
$or = new v4_OrderRequest();
$od = new v4_OrderDetails();

$keyName = 'AuthUserID';
$ItemName='AuthUserName ';
//$type='AuthLevelID';
$selectactive='Active';
#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'AuthUserID',
	'AuthUserName',
	'AuthUserRealName',
	'AuthUserCompany',
	'AuthUserMail',
);
