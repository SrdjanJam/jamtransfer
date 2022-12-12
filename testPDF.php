<?php
error_reporting(E_ALL);
		$pdfname='test.pdf';
		$message='TESTIRANJE';
		include_once('common/fpdf185/fpdf.php');
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->SetDisplayMode('fullpage');
		//$stylesheet = file_get_contents('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css').file_get_contents('css/registerevenet.css');
		$stylesheet = file_get_contents('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css');
		$pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
		$pdf->WriteHTML($message);
		//$content = $pdf->Output('', 'S');
		//$content = chunk_split(base64_encode($content));
		$pdf->Output('F','pdf/'.$pdfname);



