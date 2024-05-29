<?

	@session_start();
	//echo $_SESSION['language'];

	if(
	    isset($_SESSION['language']) and 
	    $_SESSION['language'] != '' and 
    	file_exists($_SERVER['DOCUMENT_ROOT'] . '/lng2/var-' . strtolower($_SESSION['language']) . '.php')
	) {
	
		require $_SERVER['DOCUMENT_ROOT'] . '/lng2/var-' . strtolower($_SESSION['language']) . '.php';
	}
	else {
		$_SESSION['language'] = 'en';
		require $_SERVER['DOCUMENT_ROOT'] . '/lng2/var-en.php';
	}	

