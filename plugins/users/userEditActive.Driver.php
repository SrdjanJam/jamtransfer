<?
	if (isset($_REQUEST['rec_no'])) $userProfileID = $_REQUEST['rec_no'];
	else $userProfileID = $_SESSION['AuthUserID'];

?>
<!-- PLACEHOLDER DIV za Edit Form -->
<div class="container-fluid xwhite pad1em">
	<div class="col-md-12" id="oneUser<?= $userProfileID?>"></div>
</div>

<? 
	$inList = 'false';
	if ( $userProfileID == $_SESSION['AuthUserID']) $isNew = false; 
	
	require_once 'p/modules/users/usersEditForm.Driver.php';
	require_once 'p/modules/users/userEditJS.php';
?>

<script type="text/javascript">
	editUser(<?= $userProfileID?>, false);	
</script>
