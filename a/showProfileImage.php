<?
	require_once '../config.php';


	if (!isset($_REQUEST['UserID']) or $_REQUEST['UserID'] == '') {
		$img = file_get_contents(ROOT . '/cms/img/default.jpg');
		echo $img;
		die();
	}
				
	$r = $db->RunQuery("SELECT DBImage, DBImageType FROM v4_AuthUsers 
	                    WHERE AuthUserID = " . $_REQUEST['UserID']);
	$img = $r->fetch_object();
	if($r->num_rows > 0 and !empty($img->DBImage)) {
		ob_clean();
		header("Content-type: $img->DBImageType");
		echo ($img->DBImage);
	} 

	else {

		$r = $db->RunQuery("SELECT CustImage, CustImageType FROM v4_Customers 
		                    WHERE CustID = " . $_REQUEST['UserID']);
		$img = $r->fetch_object();
	
		if($r->num_rows > 0 and !empty($img->CustImage)) {
			ob_clean();
			header("Content-type: $img->CustImageType");
			echo $img->CustImage;
		}

		else { 
		ob_clean();
		header("Content-type: image/jpg");
		$img = file_get_contents(ROOT . '/cms/img/default.jpg');
		echo $img;
		}
	}
	

