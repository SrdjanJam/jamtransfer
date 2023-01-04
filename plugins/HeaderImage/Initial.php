<?
require_once '../../config.php';
require_once ROOT . '/db/v4_HpImages.class.php';
$db = new v4_HpImages();
$keyName = 'ID';
$ItemName='ImgDesc ';
#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'ID', // dodaj ostala polja!
	'ImgDesc',
);
