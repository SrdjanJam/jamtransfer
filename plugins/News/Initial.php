<?
require_once '../../config.php';
require_once ROOT . '/db/v4_News.class.php';
$db = new v4_News();
$keyName = 'NewsID';
$ItemName='Header ';
#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'NewsID', // dodaj ostala polja!
	'Header',
);
