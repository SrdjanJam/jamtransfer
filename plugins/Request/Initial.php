<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Request.class.php';
$db = new v4_Request();
$keyName = 'ID';
$ItemName='DisplayOrder ';
$type='Active'; 

#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'Title' // dodaj ostala polja!
);