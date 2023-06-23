<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Statuses.class.php';
$db = new v4_Statuses();
$dbT = new DataBaseMysql();

$keyName = 'ID';
$ItemName='Type,Value ';
#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'Type',
	'Description'
);
