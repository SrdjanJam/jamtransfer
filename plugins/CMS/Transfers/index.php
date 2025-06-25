<?
	$page="https://cms.jamtransfer.com/cms/codeLogin.php?userCode=".$_SESSION['userCode']."&userID=".$_SESSION['AuthUserID']."&page=transfersList";
	header("Location: ".$page);
	


