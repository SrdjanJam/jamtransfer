<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Terminals.class.php';
require_once ROOT . '/db/v4_Places.class.php';

$db = new v4_Terminals();
$dbT = new DataBaseMysql();
$dbP = new v4_Places();

$keyName = 'TerminalID';
$ItemName='TerminalID ';
$type='MP';
#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'TerminalID', // dodaj ostala polja!
	'PlaceNameEN' // dodaj ostala polja!
);

