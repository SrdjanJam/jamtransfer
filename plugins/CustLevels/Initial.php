<?
require_once '../../config.php';
require_once ROOT . '/db/v4_CustLevels.class.php';

$db = new v4_CustLevels();
$dbc = new DataBaseMysql();

$keyName = 'LevelID';
$ItemName='LevelID ';
// $type='LevelName'; spare

#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'LevelName' // dodaj ostala polja!
	// 'TerminalName' // dodaj ostala polja!  CHECK
);