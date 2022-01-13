<?php
/* Smarty version 3.1.32, created on 2022-01-13 09:38:14
  from 'C:\wamp\www\jamtransfer\templates\page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_61dff306421b64_06977051',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec9530c76a9d0df6c4c8835f9e1e76d773598cb8' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\page.tpl',
      1 => 1642066680,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61dff306421b64_06977051 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
window.root = 'plugins/<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/';
window.currenturl = '<?php echo $_smarty_tpl->tpl_vars['currenturl']->value;?>
';
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="js/list.js"><?php echo '</script'; ?>
>

<?php if ($_smarty_tpl->tpl_vars['isNew']->value) {?>

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
</div>	
<?php } else { ?>

<?php echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function(){
		allItems(); 
	});	
<?php echo '</script'; ?>
>

<div class=" container">
	<a class="btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['root_home']->value;
echo $_smarty_tpl->tpl_vars['code']->value;?>
/new"><?php echo $_smarty_tpl->tpl_vars['NNEW']->value;?>
</a>
	<br><br>
	<input type="hidden"  id="whereCondition" name="whereCondition" 
	value=" WHERE CountryID > 0">
	
	<div class="row pad1em">
		<div class="col-md-3" id="infoShow"></div>
		<div class="col-md-3">
			<i class="fa fa-eye"></i>
			<select id="length" class="w75" onchange="allItems();">
				<option value="5"> 5 </option>
				<option value="10" selected> 10 </option>
				<option value="20"> 20 </option>
				<option value="50"> 50 </option>
				<option value="100"> 100 </option>
			</select>
		</div>

		<div class="col-md-3">
			<i class="fa fa-text-width"></i>
			<input type="text" id="Search" class=" w75" onchange="allItems();" placeholder="Text + Enter to Search">
		</div>

		<div class="col-md-3">
			<i class="fa fa-sort-amount-asc"></i> 
			<select name="sortOrder" id="sortOrder" onchange="allItems();">
				<option value="ASC" selected="selected"> <?php echo $_smarty_tpl->tpl_vars['ASCENDING']->value;?>
 </option>
				<option value="DESC"> <?php echo $_smarty_tpl->tpl_vars['DESCENDING']->value;?>
 </option>
			</select>			
		</div>
	</div>

	<div id="show_Items"><?php echo $_smarty_tpl->tpl_vars['THERE_ARE_NO_DATA']->value;?>
</div>
	<br>
	<div id="pageSelect" class="col-sm-12"></div>
	<br><br><br><br>
</div>
<?php }?>

<?php }
}
