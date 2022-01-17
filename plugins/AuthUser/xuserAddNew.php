<?
	// Kreiranje dummy sloga
	require_once '../db/db.class.php';
	require_once '../db/v4_AuthUsers.class.php';

	
	$au =  new v4_AuthUsers();
	$keys = $au->getKeysBy('AuthUserID', 'desc');
	$dummy = 'New Temp user created - ' . $keys[0]+1;
	$au->setAuthUserID($keys[0]+1);
	$au->setAuthUserName($dummy);
	$au->setAuthUserMail($dummy);
	$au->setAuthUserRealName($dummy);
	$id = $au->saveAsNew();

?>
		<div id="usersWrapper<?= $id ?>" class="editFrame container-fluid" style="display:none">
			<div id="inlineContent<?= $id ?>" class="row">
				<div id="oneUser<?= $id ?>" class="xcol-md-12">
					Creating user ...
				</div>
			</div>
		</div>
<?
	define("READ_ONLY_FLD","");
	$inList = "false";

	require_once 'p/modules/users/usersEditForm.Admin.php';
	require_once 'p/modules/users/userEditJS.php';
?>
<script>
	showOneUser('<?= $id ?>', 'false');
</script>
