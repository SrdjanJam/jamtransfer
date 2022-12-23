<?
// OLDER:
// 	$smarty->assign('page',$md->getName());	
// 	@session_start();
// 	if (!$_SESSION['UserAuthorized']) die('Bye, bye');

// $variabla = "tekst";

// $smarty->assign('varijabla', $variabla);

 //require_once 'exchangeRate.php';

//==============================================================================
 $filename = ROOT . '/plugins/ExchangeRate/exchangeRate.inc';
 
 		$message = "";
	
		if(isset($_POST['setRate']) and $_POST['setRate'] == 1){

		$tecaj = $_POST['exchangeRate'];
		

		// Let's make sure the file exists and is writable first.
		if (is_writable($filename)) {

			// In our example we're opening $filename in append mode.
			// The file pointer is at the bottom of the file hence
			// that's where $somecontent will go when we fwrite() it.
			if (!$handle = fopen($filename, 'w')) {
				$message =  "Cannot open to file ." . $filename;
			}

			// Write $somecontent to our opened file.
			if (fwrite($handle, $tecaj) === FALSE) {
				$message =  "Cannot write to file ." . $filename;
			}

			$message = "New Exchange Rate -" . $tecaj . " - is now active.";

			fclose($handle);

		} else {
			$message =  "The file" . $filename . "is not writable";
		}		
				
	
	} else {
		
		// uzmi podatke iz file-a
		$tecaj = file_get_contents($filename, FILE_USE_INCLUDE_PATH);
		$_SESSION['TecajRSD'] = $tecaj;

	}

	$smarty->assign('tecaj', $tecaj);
	$smarty->assign('message', $message);
