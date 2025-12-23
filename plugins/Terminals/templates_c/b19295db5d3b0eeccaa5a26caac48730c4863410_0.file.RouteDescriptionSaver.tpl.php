<?php
/* Smarty version 3.1.32, created on 2025-11-13 06:54:36
  from '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/Terminals/templatesN/RouteDescriptionSaver.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_691580ac5437b1_19390207',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b19295db5d3b0eeccaa5a26caac48730c4863410' => 
    array (
      0 => '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/Terminals/templatesN/RouteDescriptionSaver.tpl',
      1 => 1763016874,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_691580ac5437b1_19390207 (Smarty_Internal_Template $_smarty_tpl) {
?><h2><?php if ($_REQUEST['main'] == 1) {?>Main<?php } else { ?>Top<?php }?> route Description Saver</h2>
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
<button id="copy" type="button">COPY</button>
<form action="" method="post">
	<fieldset>
		<legend>Route ID</legend>

		<label for="name">Route ID:</label><br>
		<input type="text" id="RouteID" name="RouteID" required><br><br>


	<fieldset>
		<legend>Generated HTML</legend>
		<label for="message">Generated HTML:</label><br>
		<textarea id="HTML" name="HTML" rows="5" cols="100"></textarea><br><br>
	</fieldset>

	<input type="submit" name="submit" value="Submit">
</form>
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
	$('document').ready(function(){
		$('.routeid').click(function(){
			$('#RouteID').val($(this).html());
		})	
		$('#copy').click(function(){
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val($('table').text()).select();
			document.execCommand("copy");
			$temp.remove();
		})
	})	
	
<?php echo '</script'; ?>
><?php }
}
