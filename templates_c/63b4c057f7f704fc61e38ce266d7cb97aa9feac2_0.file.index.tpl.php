<?php
/* Smarty version 3.1.32, created on 2022-09-01 07:37:51
  from 'c:\wamp\www\jamtransfer\plugins\DriversTransfers\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6310614f805fc2_46659307',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '63b4c057f7f704fc61e38ce266d7cb97aa9feac2' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\DriversTransfers\\templates\\index.tpl',
      1 => 1662017841,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6310614f805fc2_46659307 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['root']->value)."/templates/add-style.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<div class="container white">

	<?php if (isset($_REQUEST['StartDate']) && isset($_REQUEST['EndDate'])) {?>
		<h2>Select driver</h2> 
		<?php echo $_REQUEST['StartDate'];?>
 - <?php echo $_REQUEST['EndDate'];?>
<br><br>

		<div class="row" style="font-weight:bold;border-bottom:1px solid #ccc; padding-bottom:5px">
			<div class="col-md-1 text-right">
				ID
			</div>
			<div class="col-md-8">
				Driver
			</div>
			<div class="col-md-1">
				Balance
			</div>
	
		</div> 
		<?php
$__section_index_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_index_0_total = $__section_index_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_index'] = new Smarty_Variable(array());
if ($__section_index_0_total !== 0) {
for ($__section_index_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] = 0; $__section_index_0_iteration <= $__section_index_0_total; $__section_index_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']++){
?>

						<div class="row row_e" style="border-bottom: 1px solid #ccc">

				<div class="col-md-1 text-right"><?php echo $_smarty_tpl->tpl_vars['driverId']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)];?>
</div>

				<a href="<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
driversTransfers/driversBalance/<?php echo $_smarty_tpl->tpl_vars['user']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['AuthUserID'];?>
/<?php echo $_REQUEST['StartDate'];?>
/<?php echo $_REQUEST['EndDate'];?>
/<?php echo $_smarty_tpl->tpl_vars['includePaymentMethod']->value;?>
">
					<div class="col-md-8">
						<?php echo $_smarty_tpl->tpl_vars['user']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['Country'];?>
 - <?php echo $_smarty_tpl->tpl_vars['user']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['Terminal'];?>
 - <?php echo $_smarty_tpl->tpl_vars['user']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['AuthUserCompany'];?>
 - <?php echo $_smarty_tpl->tpl_vars['user']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['AuthUserTel'];?>
 - <?php echo $_smarty_tpl->tpl_vars['connectedUserNamePlus']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)];?>

					</div>
				</a>

				<div class="col-md-1 text-right">
					<?php if ($_smarty_tpl->tpl_vars['driversBalance']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)] > 0) {?>
												<span style="color:rgb(51, 180, 100)"><?php echo $_smarty_tpl->tpl_vars['driversBalance']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)];?>
</span>
						<?php } elseif ($_smarty_tpl->tpl_vars['driversBalance']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)] == 0) {?>
							<span style="color:rgb(39, 37, 29)"><?php echo $_smarty_tpl->tpl_vars['driversBalance']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)];?>
</span>
													<?php } else { ?>
							<span style="color:rgb(180, 52, 52)"><?php echo $_smarty_tpl->tpl_vars['driversBalance']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)];?>
</span>
												<?php }?>
				</div>
							
			</div> 
		<?php
}
}
?> 
		<div class="row" style="font-weight:bold;background:#f5f5f5">
			<div class="col-md-2 col-md-offset-3 text-right"><?php echo number_format($_smarty_tpl->tpl_vars['totalBalance']->value,2);?>
</div>
		</div>
		<?php } else { ?>

			<form action="" method="post">
			
				<div class="row">
					<div class="col-md-12">
						<h2>New Driver Invoice</h2> 
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label>Start Date:</label>
					</div>
					<div class="col-md-4 col-md-4_e">
						<input type="text" name="StartDate" class="form-control datepicker">
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label>End Date:</label>
					</div>
					<div class="col-md-4">
						<input type="text" name="EndDate" class="form-control datepicker">
					</div>
				</div>
								<div class="row">
					<div class="col-md-2">
						<label><b>Include</b></label>
					</div>
					<div class="col-md-2">
						Online<input type="checkbox" name="Online" class="form-control" value="1">
					</div>
					<div class="col-md-2">
						Cash<input type="checkbox" name="Cash" class="form-control" value="1">
					</div>			
					<div class="col-md-2">
						Online + Cash <input type="checkbox" name="OnlineCash" class="form-control" value="1">
					</div>
					<div class="col-md-2">
						Invoice <input type="checkbox" name="Invoice" class="form-control" value="1">
					</div>
					<div class="col-md-2">
						Invoice 2 <input type="checkbox" name="Invoice2" class="form-control" value="1">
					</div>				
				</div>

				<div class="row">
					<div class="col-md-4 col-md-offset-2">
						<br>
						<button class="btn btn-primary" type="submit" name="Submit" value="1">Go</button>
					</div>
				</div>

			</form>

	<?php }?> 
</div> 

<?php }
}
