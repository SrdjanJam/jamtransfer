<?php
/* Smarty version 3.1.32, created on 2025-11-21 09:03:12
  from '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/Terminals/templatesN/RouteChecker.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_69202ad0d50f97_03662564',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ed36b66a6f898e32bf1a3d58794cf355503cfa0' => 
    array (
      0 => '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/Terminals/templatesN/RouteChecker.tpl',
      1 => 1763715791,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69202ad0d50f97_03662564 (Smarty_Internal_Template $_smarty_tpl) {
?><h2><?php echo $_smarty_tpl->tpl_vars['ROUTE_CHECKER']->value;?>
x</h2>
<h1><?php echo $_smarty_tpl->tpl_vars['terminalname']->value;?>
</h1>
<table>
	<tr>
		<th>ID</th>
		<th>Route</th>
		<th>Km</th>
		<th>Duration</th>
		<th>Link</th>
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
			<td><?php echo $_smarty_tpl->tpl_vars['routes']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['km'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['routes']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['duration'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['routes']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['link'];?>
</td>
		</tr>
	<?php
}
}
?>
</table>	
<?php }
}
