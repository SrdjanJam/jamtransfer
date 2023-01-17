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
$detailFlds['Language']=$_SESSION['BrandName'];
if ($_SESSION['BrandName']<>'EN') {
	$contTrans='Content'.$_SESSION['BrandName'];
	//if(isset($detailFlds['ContentTR'])) 
	$detailFlds['ContentTR']=$detailFlds[$contTrans];
	//else $detailFlds['ContentTR'] = "";
	$titleTrans='Title'.$_SESSION['BrandName'];
	//if(isset($detailFlds['TitleTR'])) 
	$detailFlds['TitleTR']=$detailFlds[$titleTrans];
	//else $detailFlds['TitleTR']=""; 
	$detailFlds['disabled']='disabled';
	$detailFlds['onlyEnglish']='hidden';
	$detailFlds['noEnglish']='';
}	
else {
	$detailFlds['disabled']='';
	$detailFlds['onlyEnglish']='';
	$detailFlds['noEnglish']='hidden';
}	
$out[] = $detailFlds;
# send output back

$output = json_encode($out);
echo $output;