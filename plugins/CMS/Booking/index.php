<?
	$page="https://cms.jamtransfer.com/cms/codeLogin.php?userCode=".$_SESSION['userCode']."&userID=".$_SESSION['AuthUserID']."&page=booking";
	header("Location: ".$page);
	


