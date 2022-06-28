<?
	$smarty->assign('page',$md->getName());	
	@session_start();
	echo "Final";

/*if ( isset($_SESSION['CMSLang']) and $_SESSION['CMSLang'] != '') {
    $languageFileCMS = ROOT.'/cms/lng/' . $_SESSION['CMSLang'] . '_text.php';
    $languageFileSite = ROOT.'/lng/' . $_SESSION['CMSLang'] . '.php';
    if ( file_exists( $languageFileCMS) and file_exists($languageFileSite) ){
        require_once $languageFileCMS;
        require_once $languageFileSite;
    }
    else {
        $_SESSION['CMSLang'] = 'en';
        require_once ROOT.'/cms/lng/en_text.php';
        require_once ROOT.'/lng/en.php';
    }
}
else {
    $_SESSION['CMSLang'] = 'en';
    require_once ROOT.'/cms/lng/en_text.php';
    require_once ROOT.'/lng/en.php';
}*/


require_once ROOT . '/db/v4_Countries.class.php';
require_once "scripts.php";
if(s('VehiclesNo') > 1) echo  '<i class="red-text fa fa-car"></i> x ' .s('VehiclesNo');
if(s('VehiclesNo') > 1) echo s('VehiclesNo') . ' x ';
if(s('VehiclesNo') > 1) echo ' x ' . s('VehiclesNo');
?>
<h5><strong><?= nf( toCurrency(s('Price')) ) . ' ' . s('Currency') ?> - <?= nf( toCurrency(s('Price')*($_SESSION['Provision'])/100) ) . ' ' . s('Currency') ?></strong></h5>
<?= countryName( s('CountryID') )?>,
<strong><?= getPlaceName( s('FromID') ) ?></strong>
<?  if(getPlaceType( s('FromID') ) == '1') $pickupAddress = AIRPORT;
else $pickupAddress = s('PickupAddress');
?>