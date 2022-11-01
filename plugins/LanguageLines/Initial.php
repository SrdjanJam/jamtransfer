<?
require_once '../../config.php';
require_once ROOT . '/db/v4_LanguageLines.class.php';
$db = new v4_LanguageLines();
$keyName = 'key';
$ItemName='`key` ';
#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'text'
);