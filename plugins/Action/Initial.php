<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Actions.class.php';
require_once ROOT . '/db/v4_Request.class.php';

$db = new v4_Actions();
$rq = new v4_Request();
$dbc = new DataBaseMysql();
$keyName = 'ID';
$ItemName='Title ';
$type='Active'; 

#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'Title' // dodaj ostala polja!
);