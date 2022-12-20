<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

$out = array();
# Details  red
$db->getRow($_REQUEST['ItemID']);
# get fields and values
$detailFlds = $db->fieldValues();
if (isset($_SESSION['UseDriverID']) && $_SESSION['UseDriverID']>0) $detailFlds['UseDriverID']=$_SESSION['UseDriverID'];
else $detailFlds['UseDriverID']=0;

# remove slashes 
foreach ($detailFlds as $key=>$value) {
	$detailFlds[$key] = stripslashes($value);
}
$detailFlds['Language']=$_SESSION['BrandName'];
if (in_array($_SESSION['BrandName'],array('EN','FR','DE','RU'))) {
	$contTrans='VehicleTypeName'.$_SESSION['BrandName'];
	$detailFlds['VehicleTypeNameTR']=$detailFlds[$contTrans];	
	$titleTrans='Description'.$_SESSION['BrandName'];
	$detailFlds['DescriptionTR']=$detailFlds[$titleTrans];	
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