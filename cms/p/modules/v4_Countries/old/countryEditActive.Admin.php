<?
	if (isset($_REQUEST['rec_no'])) $userProfileID = $_REQUEST['rec_no'];
	else $userProfileID = $_SESSION['AuthUserID'];

?>
<!-- PLACEHOLDER DIV za Edit Form -->
<div class="container-fluid white pad1em">
	<div class="col-md-12" id="oneUser<?= $userProfileID?>"></div>
</div>

<? 
	$inList = 'false'; 
	require_once 'p/modules/users/usersEditForm.Admin.php';
	require_once 'p/modules/users/userEditJS.php';
?>

<script type="text/javascript">
	showOneUser(<?= $userProfileID?>, false);	
</script>
