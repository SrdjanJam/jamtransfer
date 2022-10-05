<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Modules.class.php';
$db = new v4_Modules();
$keyName = 'ModulID';
$ItemName='ParentID,MenuOrder ';
#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'ModulID', // dodaj ostala polja!
	'Name',
);
