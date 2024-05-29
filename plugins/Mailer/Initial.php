<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Mailer.class.php';
// require_once ROOT . '/db/v4_Modules.class.php';

$db = new v4_Mailer();
$dbT = new DataBaseMysql();
// $md= new v4_Modules();

$keyName = 'MailID';
$ItemName='CreateTime ';
$type='Type';
$type2='OwnerID';
$selectapproved='Status';

#********************************
# kolone za koje je moguc Search
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'MailID',
	'Subject',
	'Body',
	'OwnerID'
);

