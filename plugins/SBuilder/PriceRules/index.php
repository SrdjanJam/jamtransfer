<?
require_once ROOT . '/db/sb_Basic.class.php';
$bs = new sb_Basic();
$bs->getRow($_SESSION['UseDriverID']);

if (isset($_REQUEST['submit'])) {
	$bs->setPriceRules(json_encode($_REQUEST['cell']));
	$bs->saveRow();
}
if ($bs->getPriceRules()==NULL) {
	$arrY=array();
	for ($i = 0; $i < 24; $i++) {	
		$arrX=array();	
		for ($j = 0; $j < 7; $j++) {
			$arrX[]=0;
		}	
		$arrY[]=$arrX;
	}
	$cell=$arrY;
}	else $cell=(array) json_decode($bs->getPriceRules());
$smarty->assign('cell',$cell);

$timestamp = strtotime('next Sunday');
$days = array();
for ($i = 0; $i < 7; $i++) {
    $days[] = strftime('%A', $timestamp);
    $timestamp = strtotime('+1 day', $timestamp);
}
$hours = array();
for ($i = 0; $i < 24; $i++) {
	$j=$i+1;
    $hours[] = $i."-".$j;
}
$smarty->assign('days',$days);
$smarty->assign('hours',$hours);
	
?>
