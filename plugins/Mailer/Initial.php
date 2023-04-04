<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Mailer.class.php';
// require_once ROOT . '/db/v4_Modules.class.php';

$db = new v4_Mailer();
$dbT = new DataBaseMysql();
// $md= new v4_Modules();

$keyName = 'MailID';
$ItemName='MailID ';

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

