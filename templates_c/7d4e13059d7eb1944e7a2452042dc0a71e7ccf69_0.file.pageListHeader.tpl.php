<?php
/* Smarty version 3.1.32, created on 2023-03-03 12:09:06
  from 'C:\wamp\www\jamtransfer\templates\pageListHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6401e362a35231_47473380',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d4e13059d7eb1944e7a2452042dc0a71e7ccf69' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\pageListHeader.tpl',
      1 => 1677750667,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6401e362a35231_47473380 (Smarty_Internal_Template $_smarty_tpl) {
?>
<input type="hidden"  id="whereCondition" name="whereCondition" 
value=" WHERE <?php echo $_smarty_tpl->tpl_vars['ItemID']->value;?>
 > 0">

<input type="hidden"  id="orderid" name="orderid" value="<?php echo $_smarty_tpl->tpl_vars['orderid']->value;?>
">
<input type="hidden"  id="detailid" name="detailid" value="<?php echo $_smarty_tpl->tpl_vars['detailid']->value;?>
">
<input type="hidden"  id="transfersFilter" name="transfersFilter" value="<?php echo $_smarty_tpl->tpl_vars['transfersFilter']->value;?>
">
<input type="hidden"  id="routeID" name="routeID" value="<?php echo $_smarty_tpl->tpl_vars['RouteID']->value;?>
">
<input type="hidden"  id="vehicleTypeID" name="vehicleTypeID" value="<?php echo $_smarty_tpl->tpl_vars['VehicleTypeID']->value;?>
">
<input type="hidden"  id="vehicleID" name="vehicleID" value="<?php echo $_smarty_tpl->tpl_vars['VehicleID']->value;?>
">
<input type="hidden"  id="subdriverID" name="subdriverID" value="<?php echo $_smarty_tpl->tpl_vars['SubDriverID']->value;?>
">
<input type="hidden"  id="actionID" name="actionID" value="<?php echo $_smarty_tpl->tpl_vars['ActionID']->value;?>
">

<div class="row itemsheader itemsheader-edit">
<?php if ($_smarty_tpl->tpl_vars['existNew']->value) {?>
	<a class="btn btn-primary btn-xs btn-xs-edit" href="<?php echo $_smarty_tpl->tpl_vars['currenturl']->value;?>
/new"><?php echo $_smarty_tpl->tpl_vars['NNEW']->value;?>
</a><br>
<?php }?>
	<div class="col-md-2 col-md-2-infoShow" id="infoShow"></div>
	<?php if (isset($_smarty_tpl->tpl_vars['selecttype']->value)) {?>
	<div class="col-md-2 asd">
		<i class="fa fa-list-ul edit-fa"></i>
		<div class="form-group group-edit">
		
			<select id="Type" class="w75 form-control control-edit" onchange="allItems();">
				<option value="0"><?php echo $_smarty_tpl->tpl_vars['ALL']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['STATUS']->value;?>
</option>
				<?php
$__section_pom_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['options']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom_2_total = $__section_pom_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom'] = new Smarty_Variable(array());
if ($__section_pom_2_total !== 0) {
for ($__section_pom_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] = 0; $__section_pom_2_iteration <= $__section_pom_2_total; $__section_pom_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']++){
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
	</div>
	<?php }?>	
	<?php if (isset($_smarty_tpl->tpl_vars['selecttype2']->value)) {?>
	<div class="col-md-2 asd">
		<i class="fa fa-list-ul edit-fa"></i>
		<div class="form-group group-edit">
		
			<select id="Type2" class="w75 form-control control-edit" onchange="allItems();">
				<option value="0"><?php echo $_smarty_tpl->tpl_vars['ALL']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['USERS']->value;?>
</option>
				<?php
$__section_pom2_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['options2']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom2_3_total = $__section_pom2_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom2'] = new Smarty_Variable(array());
if ($__section_pom2_3_total !== 0) {
for ($__section_pom2_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] = 0; $__section_pom2_3_iteration <= $__section_pom2_3_total; $__section_pom2_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']++){
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['options2']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['options2']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['name'];?>
</option>
				<?php
}
}
?>
			</select>
		</div>
	</div>
	<?php }?>

	<?php if (!isset($_smarty_tpl->tpl_vars['pagelength']->value)) {
$_smarty_tpl->_assignInScope('pagelength', "10");
}?>
	
	<div class="col-md-2 asd">
		<i class="fa fa-eye edit-fa"></i>
		<div class="form-group group-edit">
			<select id="length" class="w75 form-control control-edit" onchange="allItems();">
				<option value="5" <?php if ($_smarty_tpl->tpl_vars['pagelength']->value == '5') {?> selected <?php }?>> 5 </option>
				<option value="10" <?php if ($_smarty_tpl->tpl_vars['pagelength']->value == '10') {?> selected <?php }?>> 10 </option>
				<option value="20" <?php if ($_smarty_tpl->tpl_vars['pagelength']->value == '20') {?> selected <?php }?>> 20 </option>
				<option value="50" <?php if ($_smarty_tpl->tpl_vars['pagelength']->value == '50') {?> selected <?php }?>> 50 </option>
				<option value="100" <?php if ($_smarty_tpl->tpl_vars['pagelength']->value == '100') {?> selected <?php }?>> 100 </option>
			</select>
		</div>
	</div>

	<div class="col-md-2 asd">
		<i class="fa fa-text-width edit-fa"></i>
		<div class="form-group group-edit">
			<input type="text" id="Search" class=" w75 form-control control-edit" onchange="allItems();" placeholder="Text + Enter to Search">
		</div>
	</div>
	<div class="col-md-2 asd">
		<i class="fa fa-sort-amount-asc edit-fa"></i>
		<div class="form-group group-edit">
			<select name="sortOrder" id="sortOrder" onchange="allItems();" class="form-control control-edit">
				<option value="ASC"> <?php echo $_smarty_tpl->tpl_vars['ASCENDING']->value;?>
 </option>
				<option value="DESC" <?php if (isset($_smarty_tpl->tpl_vars['selectapproved']->value)) {?>SELECTED<?php }?>> <?php echo $_smarty_tpl->tpl_vars['DESCENDING']->value;?>
 </option>
			</select>
		</div>		
	</div>

	<?php if (isset($_smarty_tpl->tpl_vars['selectactive']->value)) {?>		
	<div class="col-md-2 asd">
		<i class="fa fa-filter edit-fa"></i> 
		<div class="form-group group-edit">
			<select name="Active" id="Active" onchange="allItems();" class="form-control control-edit">
				<option value="99" selected="selected"><?php echo $_smarty_tpl->tpl_vars['ALL']->value;?>
</option>			
				<option value="1"> Active </option>
				<?php if (isset($_smarty_tpl->tpl_vars['selectactive2']->value)) {?><option value="2"> Semi Active </option><?php }?>
				<option value="0"> Not Active </option>
			</select>
		</div>
	</div>
	<?php }?>	
	
	<?php if (isset($_smarty_tpl->tpl_vars['selectapproved']->value)) {?>		
	<div class="col-md-2 asd">
		<i class="fa fa-filter edit-fa"></i> 
		<div class="form-group group-edit">
			<select name="Approved" id="Approved" onchange="allItems();" class="form-control control-edit">
				<option value="99" selected="selected"><?php echo $_smarty_tpl->tpl_vars['ALL']->value;?>
</option>			
				<option value="1"> Approved </option>
				<option value="0"> Not Approved </option>
			</select>
		</div>
	</div>
	<?php }?>
</div>
<?php }
}
