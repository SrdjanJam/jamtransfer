<?
require_once '../../config.php';
require_once ROOT . '/db/v4_TunnelPass.class.php';
$dbT = new DataBaseMysql();
$db = new v4_TunnelPass();


$keyName = 'TunnelPassID';
$ItemName='TunnelPassCode ';
$selectactive='Active';

#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'TunnelPassID',
	'TunnelPassCode',
	'PassNumber'
);

