<?
require_once '../../config.php';
require_once ROOT . '/db/v4_Articles.class.php';
$db = new v4_Articles();
$keyName = 'ID';
$ItemName='Title ';
#********************************
# kolone za koje je moguc Search 
# treba ih samo nabrojati ovdje
# Search ce ih sam pretraziti
#********************************
$aColumns = array(
	'ID', // dodaj ostala polja!
	'Title',
	'Language',
	'Page'
);

function urlize($val)
{
	global $lh;	
	$val = iconv('UTF-8', 'ASCII//TRANSLIT', $val);
	$val = str_replace('"', '', $val);
    $val = strtolower(asciify(trim($val)));
    $val = str_replace('&quot', '', $val);
	$val = str_replace('&', 'i', $val);
    $val = str_replace(' ', '-', $val);
    $val = str_replace("'", '', $val);
    $val = preg_replace('/[^a-z0-9]+/', '-', $val);
    $val = preg_replace('/^[^a-z0-9]+/', '', $val);
    $val = preg_replace('/[^a-z0-9]+$/', '', $val);

	return $val;
}

function asciify($str)
{
	$str = str_replace("č","c",$str); $str = str_replace("Č","C",$str);	
	$str = str_replace("ć","c",$str); $str = str_replace("Ć","C",$str);
	$str = str_replace("š","s",$str); $str = str_replace("Š","S",$str);
	$str = str_replace("ž","z",$str); $str = str_replace("Ž","Z",$str);
	$str = str_replace("đ","dj",$str); $str = str_replace("Đ","Dj",$str);
		
	return $str;
}