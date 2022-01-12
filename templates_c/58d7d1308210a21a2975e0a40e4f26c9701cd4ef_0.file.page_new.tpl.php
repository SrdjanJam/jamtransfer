<?php
/* Smarty version 3.1.32, created on 2022-01-12 07:51:57
  from 'C:\wamp\www\jamtransfer\templates\page_new.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_61de889d0b18f4_27660847',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '58d7d1308210a21a2975e0a40e4f26c9701cd4ef' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\page_new.tpl',
      1 => 1641973907,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61de889d0b18f4_27660847 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
window.root = 'plugins/<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/';
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="js/list.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function(){
		new_Item(); 
	});	
<?php echo '</script'; ?>
>

<div id="ItemWrapperNew" class="editFrame container-fluid" style="display:none">
	<div id="inlineContentNew" class="row">
		<div id="new_Item"></div>
	</div>
</div>	<?php }
}
