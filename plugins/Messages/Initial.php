<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Messages.class.php';
require_once ROOT . '/db/v4_Modules.class.php';

$db = new v4_Messages();
$md= new v4_Modules();
$dbT = new DataBaseMysql();

$keyName = 'ID';
$ItemName='ID ';

$selectapproved='Status';

#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'ID',
	'PageID'
	// dodaj ostala polja!
);

