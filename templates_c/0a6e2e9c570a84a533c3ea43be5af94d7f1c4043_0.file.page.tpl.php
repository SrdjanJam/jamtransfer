<?php
/* Smarty version 3.1.32, created on 2022-01-19 08:10:28
  from 'c:\wamp\www\jamtransfer\plugins\FuelPrice\templates\page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_61e7c774404369_33215470',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0a6e2e9c570a84a533c3ea43be5af94d7f1c4043' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\FuelPrice\\templates\\page.tpl',
      1 => 1642579698,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61e7c774404369_33215470 (Smarty_Internal_Template $_smarty_tpl) {
?><form name="approvedFuelPrice" method="post" action="">
	<div class="container">
		<div class="box box-info pad1em shadowLight">
		<br>
			<div <?php echo $_smarty_tpl->tpl_vars['style1']->value;?>
 class="row">
				<div class="col-md-3">
					<label>Nice:</label>
				</div>		
				<div class="col-md-6">
					<input type="text" name="approvedFuelPrice1" value="<?php echo $_smarty_tpl->tpl_vars['afp1']->value;?>
"> 		
				</div>	
			</div>
			<div <?php echo $_smarty_tpl->tpl_vars['style2']->value;?>
 class="row">
				<div class="col-md-3">
					<label>Lyon:</label>
				</div>		
				<div class="col-md-6">
					<input type="text" name="approvedFuelPrice2" value="<?php echo $_smarty_tpl->tpl_vars['afp2']->value;?>
"> 		
				</div>	
			</div>	
			<div <?php echo $_smarty_tpl->tpl_vars['style3']->value;?>
 class="row">
				<div class="col-md-3">
					<label>Split:</label>
				</div>		
				<div class="col-md-6">
					<input type="text" name="approvedFuelPrice3" value="<?php echo $_smarty_tpl->tpl_vars['afp3']->value;?>
"> 		
				</div>	
			</div>		
			<button name="setRate" type="submit" class="btn btn-primary " value="1"><?php echo $_smarty_tpl->tpl_vars['SET_NEW_RATE']->value;?>
</button>
		</div>
	</div>
</form><?php }
}
