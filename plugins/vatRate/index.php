<?
	$filename = ROOT . '/plugins/vatRate/vatRate.inc';

	$message = "";
	
	if(isset($_POST['setRate']) and $_POST['setRate'] == 1){

		$vat = $_POST['vatRate'];

		// Let's make sure the file exists and is writable first.
		if (is_writable($filename)) {

			// In our example we're opening $filename in append mode.
			// The file pointer is at the bottom of the file hence
			// that's where $somecontent will go when we fwrite() it.
			if (!$handle = fopen($filename, 'w')) {
				 $message =  "Cannot open to file ." . $filename;
			}

			// Write $somecontent to our opened file.
			if (fwrite($handle, $vat) === FALSE) {
				$message =  "Cannot write to file ." . $filename;
			}

			$message = "New Vat Rate - " . $vat . "- is now active.";

			fclose($handle);

		} else {
			$message =  "The file" . $filename . "is not writable";
		}		
				
	
	} else {
		
		// uzmi podatke iz file-a
		$vat = file_get_contents($filename, FILE_USE_INCLUDE_PATH);
		$_SESSION['vat'] = $vat;
 	}

	 $smarty->assign('vat', $vat);
	 $smarty->assign('message', $message);