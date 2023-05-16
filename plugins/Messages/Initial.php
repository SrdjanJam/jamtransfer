<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Messages.class.php';
require_once ROOT . '/db/v4_Modules.class.php';
require_once ROOT . '/db/v4_AuthUsers.class.php';

$db = new v4_Messages();
$md= new v4_Modules();
$au= new v4_AuthUsers();
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
	'PageID',
	'PageLink'
	// dodaj ostala polja!
);

