<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_OrdersMasterTemp.class.php';


	# init class
	$db = new v4_OrdersMasterTemp();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();


# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);


	if(isset($_REQUEST['SiteID'])) { $db->setSiteID($db->myreal_escape_string($_REQUEST['SiteID']) ); } 

		 	
	if(isset($_REQUEST['MOrderKey'])) { $db->setMOrderKey($db->myreal_escape_string($_REQUEST['MOrderKey']) ); } 

		 	
	if(isset($_REQUEST['MOrderID'])) { $db->setMOrderID($db->myreal_escape_string($_REQUEST['MOrderID']) ); } 

		 	
	if(isset($_REQUEST['MOrderStatus'])) { $db->setMOrderStatus($db->myreal_escape_string($_REQUEST['MOrderStatus']) ); } 

		 	
	if(isset($_REQUEST['MOrderType'])) { $db->setMOrderType($db->myreal_escape_string($_REQUEST['MOrderType']) ); } 

		 	
	if(isset($_REQUEST['MOrderDate'])) { $db->setMOrderDate($db->myreal_escape_string($_REQUEST['MOrderDate']) ); } 

		 	
	if(isset($_REQUEST['MOrderTime'])) { $db->setMOrderTime($db->myreal_escape_string($_REQUEST['MOrderTime']) ); } 

		 	
	if(isset($_REQUEST['MUserID'])) { $db->setMUserID($db->myreal_escape_string($_REQUEST['MUserID']) ); } 

		 	
	if(isset($_REQUEST['MUserLevelID'])) { $db->setMUserLevelID($db->myreal_escape_string($_REQUEST['MUserLevelID']) ); } 

		 	
	if(isset($_REQUEST['MTransferPrice'])) { $db->setMTransferPrice($db->myreal_escape_string($_REQUEST['MTransferPrice']) ); } 

		 	
	if(isset($_REQUEST['MDriverExtrasPrice'])) { $db->setMDriverExtrasPrice($db->myreal_escape_string($_REQUEST['MDriverExtrasPrice']) ); } 

		 	
	if(isset($_REQUEST['MProvision'])) { $db->setMProvision($db->myreal_escape_string($_REQUEST['MProvision']) ); } 

		 	
	if(isset($_REQUEST['MExtrasPrice'])) { $db->setMExtrasPrice($db->myreal_escape_string($_REQUEST['MExtrasPrice']) ); } 

		 	
	if(isset($_REQUEST['MOrderPriceEUR'])) { $db->setMOrderPriceEUR($db->myreal_escape_string($_REQUEST['MOrderPriceEUR']) ); } 

		 	
	if(isset($_REQUEST['MEurToCurrencyRate'])) { $db->setMEurToCurrencyRate($db->myreal_escape_string($_REQUEST['MEurToCurrencyRate']) ); } 

		 	
	if(isset($_REQUEST['MOrderCurrencyPrice'])) { $db->setMOrderCurrencyPrice($db->myreal_escape_string($_REQUEST['MOrderCurrencyPrice']) ); } 

		 	
	if(isset($_REQUEST['MOrderCurrency'])) { $db->setMOrderCurrency($db->myreal_escape_string($_REQUEST['MOrderCurrency']) ); } 

		 	
	if(isset($_REQUEST['MPaymentMethod'])) { $db->setMPaymentMethod($db->myreal_escape_string($_REQUEST['MPaymentMethod']) ); } 

		 	
	if(isset($_REQUEST['MPaymentStatus'])) { $db->setMPaymentStatus($db->myreal_escape_string($_REQUEST['MPaymentStatus']) ); } 

		 	
	if(isset($_REQUEST['MPayNow'])) { $db->setMPayNow($db->myreal_escape_string($_REQUEST['MPayNow']) ); } 

		 	
	if(isset($_REQUEST['MPayLater'])) { $db->setMPayLater($db->myreal_escape_string($_REQUEST['MPayLater']) ); } 

		 	
	if(isset($_REQUEST['MInvoiceAmount'])) { $db->setMInvoiceAmount($db->myreal_escape_string($_REQUEST['MInvoiceAmount']) ); } 

		 	
	if(isset($_REQUEST['MAgentCommision'])) { $db->setMAgentCommision($db->myreal_escape_string($_REQUEST['MAgentCommision']) ); } 

		 	
	if(isset($_REQUEST['MCustomerID'])) { $db->setMCustomerID($db->myreal_escape_string($_REQUEST['MCustomerID']) ); } 

		 	
	if(isset($_REQUEST['MPaxFirstName'])) { $db->setMPaxFirstName($db->myreal_escape_string($_REQUEST['MPaxFirstName']) ); } 

		 	
	if(isset($_REQUEST['MPaxLastName'])) { $db->setMPaxLastName($db->myreal_escape_string($_REQUEST['MPaxLastName']) ); } 

		 	
	if(isset($_REQUEST['MPaxTel'])) { $db->setMPaxTel($db->myreal_escape_string($_REQUEST['MPaxTel']) ); } 

		 	
	if(isset($_REQUEST['MPaxEmail'])) { $db->setMPaxEmail($db->myreal_escape_string($_REQUEST['MPaxEmail']) ); } 

		 	
	if(isset($_REQUEST['MCardType'])) { $db->setMCardType($db->myreal_escape_string($_REQUEST['MCardType']) ); } 

		 	
	if(isset($_REQUEST['MCardFirstName'])) { $db->setMCardFirstName($db->myreal_escape_string($_REQUEST['MCardFirstName']) ); } 

		 	
	if(isset($_REQUEST['MCardLastName'])) { $db->setMCardLastName($db->myreal_escape_string($_REQUEST['MCardLastName']) ); } 

		 	
	if(isset($_REQUEST['MCardEmail'])) { $db->setMCardEmail($db->myreal_escape_string($_REQUEST['MCardEmail']) ); } 

		 	
	if(isset($_REQUEST['MCardTel'])) { $db->setMCardTel($db->myreal_escape_string($_REQUEST['MCardTel']) ); } 

		 	
	if(isset($_REQUEST['MCardAddress'])) { $db->setMCardAddress($db->myreal_escape_string($_REQUEST['MCardAddress']) ); } 

		 	
	if(isset($_REQUEST['MCardCity'])) { $db->setMCardCity($db->myreal_escape_string($_REQUEST['MCardCity']) ); } 

		 	
	if(isset($_REQUEST['MCardZip'])) { $db->setMCardZip($db->myreal_escape_string($_REQUEST['MCardZip']) ); } 

		 	
	if(isset($_REQUEST['MCardCountry'])) { $db->setMCardCountry($db->myreal_escape_string($_REQUEST['MCardCountry']) ); } 

		 	
	if(isset($_REQUEST['MCardNumber'])) { $db->setMCardNumber($db->myreal_escape_string($_REQUEST['MCardNumber']) ); } 

		 	
	if(isset($_REQUEST['MCardCVD'])) { $db->setMCardCVD($db->myreal_escape_string($_REQUEST['MCardCVD']) ); } 

		 	
	if(isset($_REQUEST['MCardExpDate'])) { $db->setMCardExpDate($db->myreal_escape_string($_REQUEST['MCardExpDate']) ); } 

		 	
	if(isset($_REQUEST['MConfirmFile'])) { $db->setMConfirmFile($db->myreal_escape_string($_REQUEST['MConfirmFile']) ); } 

		 	
	if(isset($_REQUEST['MCancelFile'])) { $db->setMCancelFile($db->myreal_escape_string($_REQUEST['MCancelFile']) ); } 

		 	
	if(isset($_REQUEST['MChangeFile'])) { $db->setMChangeFile($db->myreal_escape_string($_REQUEST['MChangeFile']) ); } 

		 	
	if(isset($_REQUEST['MSubscribe'])) { $db->setMSubscribe($db->myreal_escape_string($_REQUEST['MSubscribe']) ); } 

		 	
	if(isset($_REQUEST['MAcceptTerms'])) { $db->setMAcceptTerms($db->myreal_escape_string($_REQUEST['MAcceptTerms']) ); } 

		 	
	if(isset($_REQUEST['MSendEmail'])) { $db->setMSendEmail($db->myreal_escape_string($_REQUEST['MSendEmail']) ); } 

		 	
	if(isset($_REQUEST['MEmailSentDate'])) { $db->setMEmailSentDate($db->myreal_escape_string($_REQUEST['MEmailSentDate']) ); } 

		 	
	if(isset($_REQUEST['MCustomerIP'])) { $db->setMCustomerIP($db->myreal_escape_string($_REQUEST['MCustomerIP']) ); } 

		 	
	if(isset($_REQUEST['MOrderLang'])) { $db->setMOrderLang($db->myreal_escape_string($_REQUEST['MOrderLang']) ); } 

		 	

$upd = '';
$newID = '';

// ako je update, azuriraj trazeni slog

if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}

// inace dodaj novi slog	
if ($keyName != '' and $keyValue == '') {
	$newID = $db->saveAsNew();
}


$out = array(
	'update' => $upd,
	'insert' => $newID
);

# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	