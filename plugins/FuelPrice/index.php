<?
	//$smarty->assign('page',$md->getName());	
	$filename = ROOT . '/plugins/'.$md->getBase(). '/approvedFuelPrice_'.$_SESSION['UseDriverID'].'.inc';
	if (isset($_POST['setRate'])) {
		$somecontent = r('approvedFuelPrice');
		// Let's make sure the file exists and is writable first.
		if (is_writable($filename)) {
			if (!$handle1 = fopen($filename, 'w')) {
				 $message =   "Cannot open file ($filename)";
			}
			// Write $somecontent to our opened file.
			if (fwrite($handle1, $somecontent) === FALSE) {
				$message =  "Cannot write to file ($filename)";
			}
			fclose($handle1);
		} else $message =   "The file $filename is not writable";
	} 
	// uzmi podatke iz file-a
	$afp = file_get_contents($filename, FILE_USE_INCLUDE_PATH);
	$smarty->assign('afp',$afp);
	$smarty->assign('message', $message);	



