<?
require_once '../../../config.php';
require_once ROOT . '/db/v4_TunnelPassAH.class.php';
require_once ROOT . '/db/v4_TunnelPass.class.php';
$db = new v4_TunnelPassAH();
$tp = new v4_TunnelPass();

$keyName = 'ID';
$ItemName='AssignTime ';
$type='Status'; 


#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'AssignTime' // dodaj ostala polja!
);