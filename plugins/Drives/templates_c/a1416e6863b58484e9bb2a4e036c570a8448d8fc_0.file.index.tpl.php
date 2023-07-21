<?php
/* Smarty version 3.1.32, created on 2023-04-07 11:31:40
  from '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/Tasks/template/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_642fff1c305f91_67552889',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a1416e6863b58484e9bb2a4e036c570a8448d8fc' => 
    array (
      0 => '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/Tasks/template/index.tpl',
      1 => 1680867096,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_642fff1c305f91_67552889 (Smarty_Internal_Template $_smarty_tpl) {
?>	<table>
		<tr>
			<th>
				Title
			</th>
			<?php
$__section_pom_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['list_all']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom_0_total = $__section_pom_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom'] = new Smarty_Variable(array());
if ($__section_pom_0_total !== 0) {
for ($__section_pom_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] = 0; $__section_pom_0_iteration <= $__section_pom_0_total; $__section_pom_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']++){
?>
				<th>
					<?php echo $_smarty_tpl->tpl_vars['list_all']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['datum'];?>

				</th>		
			<?php
}
}
?>	
		</tr>
		<?php
$__section_pom2_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['checklist']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom2_1_total = $__section_pom2_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom2'] = new Smarty_Variable(array());
if ($__section_pom2_1_total !== 0) {
for ($__section_pom2_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] = 0; $__section_pom2_1_iteration <= $__section_pom2_1_total; $__section_pom2_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']++){
?>
			<tr>
				<td>
					<?php echo $_smarty_tpl->tpl_vars['checklist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['title'];?>

				</td>
				<?php
$__section_pom_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['list_all']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom_2_total = $__section_pom_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom'] = new Smarty_Variable(array());
if ($__section_pom_2_total !== 0) {
for ($__section_pom_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] = 0; $__section_pom_2_iteration <= $__section_pom_2_total; $__section_pom_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']++){
?>
					<td>
						<img width='100' src='<?php ob_start();
echo $_smarty_tpl->tpl_vars['list_all']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['id'];
$_prefixVariable1 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['checklist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['photo'][$_prefixVariable1];?>
'/>
					</td>		
				<?php
}
}
?>			
			</tr>	
		<?php
}
}
?>	
	</table>	

<?php }
}
