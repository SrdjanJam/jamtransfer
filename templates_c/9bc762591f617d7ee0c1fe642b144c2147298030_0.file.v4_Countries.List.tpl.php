<?php
/* Smarty version 3.1.32, created on 2022-01-10 13:05:57
  from 'C:\wamp\www\jamtransfer\plugins\v4_Countries\templates\v4_Countries.List.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_61dc2f352c9540_12725975',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9bc762591f617d7ee0c1fe642b144c2147298030' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\plugins\\v4_Countries\\templates\\v4_Countries.List.tpl',
      1 => 1641819953,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61dc2f352c9540_12725975 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function(){
		<?php echo $_smarty_tpl->tpl_vars['function_all']->value;?>
; 
	});	
<?php echo '</script'; ?>
>

<div class=" container">
	<h1><?php echo $_smarty_tpl->tpl_vars['pages']->value;?>
</h1>
	<a class="btn btn-primary btn-xs" href="new_v4_Countries"><?php echo $_smarty_tpl->tpl_vars['NNEW']->value;?>
</a>
	<br><br>
	<input type="hidden"  id="whereCondition" name="whereCondition" 
	value=" WHERE CountryID > 0">
	
	<div class="row pad1em">
		<div class="col-md-3" id="infoShow"></div>
		<div class="col-md-3">
			<i class="fa fa-eye"></i>
			<select id="length" class="w75" onchange="<?php echo $_smarty_tpl->tpl_vars['function_all']->value;?>
;">
				<option value="5"> 5 </option>
				<option value="10" selected> 10 </option>
				<option value="20"> 20 </option>
				<option value="50"> 50 </option>
				<option value="100"> 100 </option>
			</select>
		</div>

		<div class="col-md-3">
			<i class="fa fa-text-width"></i>
			<input type="text" id="Search" class=" w75" onchange="<?php echo $_smarty_tpl->tpl_vars['function_all']->value;?>
;" placeholder="Text + Enter to Search">
		</div>

		<div class="col-md-3">
			<i class="fa fa-sort-amount-asc"></i> 
			<select name="sortOrder" id="sortOrder" onchange="<?php echo $_smarty_tpl->tpl_vars['function_all']->value;?>
;">
				<option value="ASC" selected="selected"> <?php echo $_smarty_tpl->tpl_vars['ASCENDING']->value;?>
 </option>
				<option value="DESC"> <?php echo $_smarty_tpl->tpl_vars['DESCENDING']->value;?>
 </option>
			</select>			
		</div>
	</div>

	<div id="show_v4_Countries"><?php echo $_smarty_tpl->tpl_vars['THERE_ARE_NO_DATA']->value;?>
</div>
	<br>
	<div id="pageSelect" class="col-sm-12"></div>
	<br><br><br><br>
</div><?php }
}
