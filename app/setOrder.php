<?
require_once "../config.php";
require_once ROOT . '/db/v4_AuthUsers.class.php';
$extras=array();
$au = new v4_AuthUsers();
$pass=false;
$agentKeys = $au->getKeysBy('AuthUserID','asc',"WHERE AuthLevelID=2 and Active=1");
foreach($agentKeys as $ki => $id) {
	$au->getRow($id);
	if ($_REQUEST['code']==md5($au->getAuthUserPass())) {
		$pass=true;
		$userID=$au->getAuthUserID();
		break;
	}	
}
if($pass) {
	$data = file_get_contents('php://input');
	$data=json_decode($data);
	/*ob_start();
	Print_r($data);
	$content = ob_get_contents();
	ob_end_clean();
	file_put_contents('test'.$userID.'.html', $content);*/
	require_once "putOrder.php";
	/*$OrderKey="NDZ7375U87";
	$omOrderID=156629;
	$agentMail="jam.bgprogrameri@gmail.com";*/
		ob_start();
		printVoucher($omOrderID, false);
		$potvrda = ob_get_contents();
		ob_end_clean();
		//****************
		// PDF GENERATION
		//****************
		require_once ROOT."/common/mpdf60/mpdf.php";
		$mpdf=new mPDF();
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->autoScriptToLang = true;
		$mpdf->baseScript = 1;
		// LOAD a stylesheet
		$stylesheet = '
			@media print {
				table, tr, td, * {font-size:11px !important; font-family: Arial, sans-serif !important;}
			}
		';
		$mpdf->WriteHTML($stylesheet,1);    // The parameter 1 tells that this is css/style only and no body/html/text
		$html = $potvrda .'<small style="font-family:Arial, sans-serif;">'. pdfFooter(2) . '</small>';
		$mpdf->WriteHTML($html);
		$content = $mpdf->Output('', 'S');
		$content = chunk_split(base64_encode($content));
		$mpdf->Output('../pdf/'.$OrderKey.'.pdf');
		/* END PDF ***********************************************************************************************/
		mail_html($agentMail, 'confirmation@jamtransfer.com', 'JamTransfer', 'info@jamtransfer.com',
				  $OrderKey, '<br>'.$html, $pdfFile);			
		mail_html('cms@jamtransfer.com', 'confirmation@jamtransfer.com', 'JamTransfer', 'info@jamtransfer.com',
				  'Agent: ' . $_SESSION['UserCompany'] . ' Order - '.$OrderKey, '<br>'.$html, $pdfFile);	
		sendDriverNotification($omOrderID, $OrderKey); 		
	
	echo "OK - Set Order: ".$OrderKey;
	header("HTTP/1.1 200 OK");
}	
