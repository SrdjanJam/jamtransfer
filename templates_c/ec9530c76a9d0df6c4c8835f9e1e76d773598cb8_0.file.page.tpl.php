<?php
/* Smarty version 3.1.32, created on 2022-01-11 12:45:53
  from 'C:\wamp\www\jamtransfer\templates\page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_61dd7c01692680_04116582',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec9530c76a9d0df6c4c8835f9e1e76d773598cb8' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\page.tpl',
      1 => 1641905142,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61dd7c01692680_04116582 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function(){
		allItems(); 
	});	
<?php echo '</script'; ?>
>

<div class=" container">
	<a class="btn btn-primary btn-xs" href="new_v4_Countries"><?php echo $_smarty_tpl->tpl_vars['NNEW']->value;?>
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
</div><?php }
}
