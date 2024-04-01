<?
require_once '../../config.php';
require_once ROOT . '/db/v4_WAN.class.php';
$dbT = new DataBaseMysql();
$db = new v4_WAN();


$keyName = 'ID';
$ItemName='ScheduleTime ';
$selectactive='Status';

#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'ID',
	'Title',
	'Status'
);

