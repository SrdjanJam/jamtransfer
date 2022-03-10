<?php
/* Smarty version 3.1.32, created on 2022-03-10 10:24:08
  from 'C:\wamp\www\jamtransfer\templates\pageList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6229d1c8bc23d8_65615274',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92e96250fffaa08dbecfe646d2822cc78842a78f' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\pageList.tpl',
      1 => 1646907841,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6229d1c8bc23d8_65615274 (Smarty_Internal_Template $_smarty_tpl) {
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
		oneItem(<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
);
	});	
<?php echo '</script'; ?>
>

<div class=" container">
	<?php if ($_smarty_tpl->tpl_vars['parentID']->value != 5) {?><a class="btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['root_home']->value;
echo $_smarty_tpl->tpl_vars['code']->value;?>
/new"><?php echo $_smarty_tpl->tpl_vars['NNEW']->value;?>
</a><?php }?>
	<br><br>
	<input type="hidden"  id="whereCondition" name="whereCondition" 
	value=" WHERE <?php echo $_smarty_tpl->tpl_vars['ItemID']->value;?>
 > 0">
	
	<div class="row pad1em">
		<div class="col-md-2" id="infoShow"></div>
		<?php if (isset($_smarty_tpl->tpl_vars['selecttype']->value)) {?>
		<div class="col-sm-2">
			<i class="fa fa-list-ul"></i>
			<select id="Type" class="w75" onchange="allItems();">
				<option value="0"><?php echo $_smarty_tpl->tpl_vars['ALL']->value;?>
</option>
				<?php
$__section_pom_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['options']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom_0_total = $__section_pom_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom'] = new Smarty_Variable(array());
if ($__section_pom_0_total !== 0) {
for ($__section_pom_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] = 0; $__section_pom_0_iteration <= $__section_pom_0_total; $__section_pom_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']++){
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['options']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['options']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['name'];?>
</option>
				<?php
}
}
?>
			</select>
		</div>	
		<?php }?>	
		<div class="col-md-2">
			<i class="fa fa-eye"></i>
			<select id="length" class="w75" onchange="allItems();">
				<option value="5"> 5 </option>
				<option value="10" selected> 10 </option>
				<option value="20"> 20 </option>
				<option value="50"> 50 </option>
				<option value="100"> 100 </option>
			</select>
		</div>

		<div class="col-md-2">
			<i class="fa fa-text-width"></i>
			<input type="text" id="Search" class=" w75" onchange="allItems();" placeholder="Text + Enter to Search">
		</div>

		<div class="col-md-2">
			<i class="fa fa-sort-amount-asc"></i> 
			<select name="sortOrder" id="sortOrder" onchange="allItems();">
				<option value="ASC" selected="selected"> <?php echo $_smarty_tpl->tpl_vars['ASCENDING']->value;?>
 </option>
				<option value="DESC"> <?php echo $_smarty_tpl->tpl_vars['DESCENDING']->value;?>
 </option>
			</select>			
		</div>
		
		<?php if (isset($_smarty_tpl->tpl_vars['selectactive']->value)) {?>		
		<div class="col-sm-2">
			<i class="fa fa-filter"></i> 
			<select name="Active" id="Active" onchange="allItems();">
				<option value="99" selected="selected"><?php echo $_smarty_tpl->tpl_vars['ALL']->value;?>
</option>			
				<option value="1"> Active </option>
				<option value="0"> Not Active </option>
			</select>
			
		</div>
		<?php }?>
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
