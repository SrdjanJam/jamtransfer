<?
require_once '../../config.php';

require_once ROOT . '/db/v4_AuthUsers.class.php';
require_once ROOT . '/db/v4_OrderDetails.class.php';
$db = new v4_AuthUsers();
$od = new v4_OrderDetails();
$keyName = 'AuthUserID';
$ItemName='AuthUserRealName ';
$type='AuthLevelID';
$selectactive='Active';
#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'AuthUserID',
	'AuthUserName',
	'DriverID',
	'AuthUserRealName',
	'AuthUserCompany',
	'AuthUserMail',
	'Terminal',
	'CountryName'
);
