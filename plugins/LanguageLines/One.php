<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

$out = array();
# Details  red
$db->getRow($_REQUEST['ItemID']);
# get fields and values
$detailFlds = $db->fieldValues();
# remove slashes 
foreach ($detailFlds as $key=>$value) {
	$detailFlds[$key] = stripslashes($value);
}
$arr=json_decode($detailFlds['text']);
$detailFlds['text_arr']= (array) $arr;	
if (in_array($_SESSION['BrandName'],array('EN','FR','RU','DE'))) {
	$detailFlds['language']=strtolower($_SESSION['BrandName']);
	$detailFlds['disabled']='disabled';
}	
else {
	$detailFlds['language']=" ";
	$detailFlds['disabled']='';
}	

$out[] = $detailFlds;
# send output back
$output = json_encode($out);
echo $_GET['callback'] . '(' . $output . ')';