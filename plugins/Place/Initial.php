<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Places.class.php';
require_once ROOT . '/db/v4_Countries.class.php';
$db = new v4_Places();
$ct = new v4_Countries();
$dbT = new DataBaseMysql();

$keyName = 'PlaceID';
$ItemName='PlaceNameEN ';
$type='PlaceType';
#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'PlaceID', // dodaj ostala polja!
	'PlaceNameEN',
	'PlaceNameSEO',
	'CountryNameEN'
);

