<?php
/* Smarty version 3.1.32, created on 2022-05-06 06:55:37
  from 'C:\wamp\www\jamtransfer\templates\pageList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6274c6699ccc99_28078347',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92e96250fffaa08dbecfe646d2822cc78842a78f' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\pageList.tpl',
      1 => 1651817323,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6274c6699ccc99_28078347 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['isNew']->value) {?>
<div id="ItemWrapperNew" class="editFrame container-fluid" style="display:none" ">
	<div id="inlineContentNew" class="row">
		<div id="new_Item"></div>
	</div>
</div>	
<?php } else { ?>
	<div id="show_Items"><?php echo $_smarty_tpl->tpl_vars['THERE_ARE_NO_DATA']->value;?>
</div>
<?php }
}
}
