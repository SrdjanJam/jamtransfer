<?
require_once '../../config.php';
require_once ROOT . '/db/v4_SubDrivers.class.php';
$db = new v4_SubDrivers();
$dbT = new DataBaseMysql();

$keyName = 'DriverID';
$ItemName='DriverName ';
#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'DriverID',
	'DriverName',
	'DriverEmail',
	'DriverTel'
);

