<?
require_once '../../config.php';
require_once ROOT . '/db/v4_ExternalLinks.class.php';
$db = new v4_ExternalLinks();
$keyName = 'ID';
$ItemName='ID ';
#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'ID',
	'Title' // dodaj ostala polja!
);