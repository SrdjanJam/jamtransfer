<?
require_once '../../config.php';
require_once ROOT . '/db/v4_SpecialDates.class.php';
$db = new v4_SpecialDates();
$dbT = new DataBaseMysql();
$keyName = 'OwnerID';
$ItemName='StartDate ';
#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
);