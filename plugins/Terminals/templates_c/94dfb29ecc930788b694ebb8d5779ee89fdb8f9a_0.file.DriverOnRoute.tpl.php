<?php
/* Smarty version 3.1.32, created on 2025-11-17 07:25:10
  from '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/Terminals/templatesN/DriverOnRoute.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_691acdd61d9f72_06110397',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '94dfb29ecc930788b694ebb8d5779ee89fdb8f9a' => 
    array (
      0 => '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/Terminals/templatesN/DriverOnRoute.tpl',
      1 => 1763364309,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_691acdd61d9f72_06110397 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>Check Driver on Route</h2>
<h1><?php echo $_smarty_tpl->tpl_vars['terminalname']->value;?>
</h1>
<table>
	<tr>
		<th>ID</th>
		<th>Route</th>
		<th>Count</th>
	</tr>
	<?php
$__section_pom_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['routes']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom_0_total = $__section_pom_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom'] = new Smarty_Variable(array());
if ($__section_pom_0_total !== 0) {
for ($__section_pom_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] = 0; $__section_pom_0_iteration <= $__section_pom_0_total; $__section_pom_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']++){
?>
		<tr>
			<td class='routeid'><?php echo $_smarty_tpl->tpl_vars['routes']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['id'];?>
</td>		
			<td><?php echo $_smarty_tpl->tpl_vars['routes']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['name'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['routes']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['count'];?>
</td>
		</tr>
	<?php
}
}
?>
</table>	

<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
	$('document').ready(function(){
	})	
	
<?php echo '</script'; ?>
><?php }
}
