<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Messages.class.php';

$db = new v4_Messages();
$dbT = new DataBaseMysql();

$keyName = 'ID';
$ItemName='ID ';
// Check:
// $ItemName='PlaceNameEN ';
// $type='PlaceType';
#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'ID' // dodaj ostala polja!
	// 'TerminalName' // dodaj ostala polja!  CHECK
);

