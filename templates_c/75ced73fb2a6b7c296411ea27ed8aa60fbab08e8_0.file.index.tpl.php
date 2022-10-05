<?php
/* Smarty version 3.1.32, created on 2022-10-04 08:13:03
  from 'c:\wamp\www\jamtransfer\plugins\HeaderImage\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_633beb0f3876a7_70993949',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '75ced73fb2a6b7c296411ea27ed8aa60fbab08e8' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\HeaderImage\\templates\\index.tpl',
      1 => 1662542496,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_633beb0f3876a7_70993949 (Smarty_Internal_Template $_smarty_tpl) {
?><form name="headerImages" method="post" action="">
<div class="container">
<div class="box box-info pad1em shadowLight">
<br>

	<div class="row">
		<div class="col-md-6"><?php echo $_smarty_tpl->tpl_vars['FIRST_IMAGE']->value;?>
</div>
		<div class="col-md-6"><input type="text" name="firstImage" value="<?php echo $_smarty_tpl->tpl_vars['img']->value[0];?>
"></div>

		<div class="col-md-6"><?php echo $_smarty_tpl->tpl_vars['SECOND_IMAGE']->value;?>
</div>
		<div class="col-md-6"><input type="text" name="secondImage" value="<?php echo $_smarty_tpl->tpl_vars['img']->value[1];?>
"></div>
	
		<div class="col-md-6"><?php echo $_smarty_tpl->tpl_vars['THIRD_IMAGE']->value;?>
</div>
		<div class="col-md-6"><input type="text" name="thirdImage" value="<?php echo $_smarty_tpl->tpl_vars['img']->value[2];?>
"></div>
	
		<div class="col-md-6"></div>
		<div class="col-md-6">
			<br>
			<button name="setImages" type="submit" class="btn btn-primary" value="1"><?php echo $_smarty_tpl->tpl_vars['SET_IMAGES']->value;?>
</button>
		</div>		
	</div>
</div><?php }
}
