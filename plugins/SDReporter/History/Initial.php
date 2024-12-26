<?
require_once '../../../config.php';
require_once ROOT . '/db/v4_AuthUsers.class.php';
$db = new v4_AuthUsers();

$dbT = new DataBaseMysql();

$keyName = 'AuthUserID';
$type='TransferStatus';
$type3='DriverConfStatus';
#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'AuthUserID',
	'AuthUserRealName'
);