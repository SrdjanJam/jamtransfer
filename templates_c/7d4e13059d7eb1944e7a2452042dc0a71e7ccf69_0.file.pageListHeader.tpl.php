<?php
/* Smarty version 3.1.32, created on 2023-09-11 07:16:49
  from 'C:\wamp\www\jamtransfer\templates\pageListHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64febee173e227_12029732',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d4e13059d7eb1944e7a2452042dc0a71e7ccf69' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\pageListHeader.tpl',
      1 => 1689835286,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64febee173e227_12029732 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
/* Filters: */
#pageListHeader-filters{
	float:left;
	background: #479de929;
	border-radius: 5px;
	padding-right: 5px;
	box-shadow: 3px 3px 4px 0px #3b75b9;
}

.button-toggle{
	cursor:pointer; font-weight:bold; color: #0584f1; text-shadow: #0584f1 0px 0px 1px;
}

.fa-bars-edit{
	font-size: 20px;margin: 5px;color: #0584f1;
}

.button-toggle:hover,.fa-bars-edit:hover{
	cursor:pointer; font-weight:bold; color: #0b70c9;
}

/* ------------------------------------------------------ */
</style>

<input type="hidden"  id="whereCondition" name="whereCondition" 
value=" WHERE <?php echo $_smarty_tpl->tpl_vars['ItemID']->value;?>
 > 0">

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

<!-- Show and Hide Filters buttons: -->
<div id="pageListHeader-filters">
	<div id="show" class="button-toggle"><i class="fa-solid fa-bars fa-bars-edit"></i><?php echo $_smarty_tpl->tpl_vars['SHOW_FILTERS']->value;?>
</div>
	<div id="hide" class="button-toggle"><i class="fa-solid fa-bars fa-bars-edit"></i><?php echo $_smarty_tpl->tpl_vars['HIDE_FILTERS']->value;?>
</div>
</div>

	<div class="filter">

		<?php if (isset($_smarty_tpl->tpl_vars['selecttype']->value)) {?>
		<div class="col-md-2">
			<i class="fa fa-list-ul edit-fa"></i>
			<div class="form-group group-edit">
			
				<select id="Type" class="w75 form-control control-edit" onchange="allItems();">
					<option value="0"><?php echo $_smarty_tpl->tpl_vars['ALL']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['STATUS']->value;?>
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
		</div>
		<?php }?>	
		<?php if (isset($_smarty_tpl->tpl_vars['selecttype2']->value)) {?>
		<div class="col-md-2">
			<i class="fa fa-list-ul edit-fa"></i>
			<div class="form-group group-edit">
			
				<select id="Type2" class="w75 form-control control-edit" onchange="allItems();">
					<option value="0"><?php echo $_smarty_tpl->tpl_vars['ALL']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['USERS']->value;?>
</option>
					<?php
$__section_pom2_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['options2']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom2_1_total = $__section_pom2_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom2'] = new Smarty_Variable(array());
if ($__section_pom2_1_total !== 0) {
for ($__section_pom2_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] = 0; $__section_pom2_1_iteration <= $__section_pom2_1_total; $__section_pom2_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']++){
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
		<?php if (isset($_smarty_tpl->tpl_vars['selecttype3']->value)) {?>
		<div class="col-md-2">
			<i class="fa fa-list-ul edit-fa"></i>
			<div class="form-group group-edit">
			
				<select id="Type3" class="w75 form-control control-edit" onchange="allItems();">
					<option value="0"><?php echo $_smarty_tpl->tpl_vars['ALL']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['STATUS']->value;?>
</option>
					<?php
$__section_pom3_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['options3']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom3_2_total = $__section_pom3_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom3'] = new Smarty_Variable(array());
if ($__section_pom3_2_total !== 0) {
for ($__section_pom3_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] = 0; $__section_pom3_2_iteration <= $__section_pom3_2_total; $__section_pom3_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']++){
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['options3']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['options3']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['name'];?>
</option>
					<?php
}
}
?>
				</select>
			</div>
		</div>
		<?php }?>

		<div class="col-md-2">
			<i class="fa fa-text-width edit-fa"></i>
			<div class="form-group group-edit">
				<input type="text" id="Search" class=" w75 form-control control-edit" onchange="allItems();" placeholder="Text + Enter to Search">
			</div>
		</div>

		<?php if ($_smarty_tpl->tpl_vars['pageList']->value != 'Orders') {?>
		<div class="col-md-2">
			<i class="fa fa-sort-amount-asc edit-fa"></i>
			<div class="form-group group-edit">
				<select name="sortOrder" id="sortOrder" onchange="allItems();" class="form-control control-edit">
					<option value="ASC"> <?php echo $_smarty_tpl->tpl_vars['ASCENDING']->value;?>
 </option>
					<option value="DESC" <?php if (isset($_smarty_tpl->tpl_vars['selectapproved']->value) || isset($_smarty_tpl->tpl_vars['selectsolved']->value)) {?>SELECTED<?php }?>> <?php echo $_smarty_tpl->tpl_vars['DESCENDING']->value;?>
 </option>
				</select>
			</div>	
		</div>		
		<?php }?>	
		<?php if (isset($_smarty_tpl->tpl_vars['selectactive']->value)) {?>		
		<div class="col-md-2">
			<i class="fa fa-filter edit-fa"></i> 
			<div class="form-group group-edit">
				<select name="Active" id="Active" onchange="allItems();" class="form-control control-edit">
					<option value="99" selected="selected"><?php echo $_smarty_tpl->tpl_vars['ALL']->value;?>
</option>			
					<option value="1"> <?php echo $_smarty_tpl->tpl_vars['ACTIVE']->value;?>
 </option>
					<?php if (isset($_smarty_tpl->tpl_vars['selectactive2']->value)) {?><option value="2"> <?php echo $_smarty_tpl->tpl_vars['SEMI_ACTIVE']->value;?>
 </option><?php }?>
					<option value="0"> <?php echo $_smarty_tpl->tpl_vars['NOT_ACTIVE']->value;?>
 </option>
				</select>
			</div>
		</div>
		<?php }?>	
		
		<?php if (isset($_smarty_tpl->tpl_vars['selectapproved']->value)) {?>		
		<div class="col-md-2">
			<i class="fa fa-filter edit-fa"></i> 
			<div class="form-group group-edit">
				<select name="Approved" id="Approved" onchange="allItems();" class="form-control control-edit">
					<option value="99" selected="selected"><?php echo $_smarty_tpl->tpl_vars['ALL']->value;?>
</option>			
					<option value="1"> <?php echo $_smarty_tpl->tpl_vars['APPROVED']->value;?>
 </option>
					<option value="0"> <?php echo $_smarty_tpl->tpl_vars['NOT_APPROVED']->value;?>
 </option>
				</select>
			</div>
		</div>
		<?php }?>
		
		<?php if (isset($_smarty_tpl->tpl_vars['selectsolved']->value)) {?>		
		<div class="col-md-2">
			<i class="fa fa-filter edit-fa"></i> 
			<div class="form-group group-edit">
				<select name="Approved" id="Approved" onchange="allItems();" class="form-control control-edit">
					<option value="99" selected="selected"><?php echo $_smarty_tpl->tpl_vars['ALL']->value;?>
</option>			
					<option value="1"> <?php echo $_smarty_tpl->tpl_vars['SOLVED']->value;?>
 </option>
					<option value="0"> <?php echo $_smarty_tpl->tpl_vars['NOT_SOLVED']->value;?>
 </option>
				</select>
			</div>
		</div>
		<?php }?>

		<?php if (isset($_smarty_tpl->tpl_vars['date1']->value)) {?>	
			<input id='orderFromDate' class="datepicker datepicker-edit" name='orderFromDate'  placeholder="From Date" onchange="allItems();" />		
		<?php }?>		
		<?php if (isset($_smarty_tpl->tpl_vars['date2']->value)) {?>	
			<input id='orderToDate' class="datepicker datepicker-edit" name='orderToDate'  placeholder="To Date" onchange="allItems();" />
		<?php }?>
		
	</div> <!-- /.filter -->
</div>


<?php echo '<script'; ?>
>

function resize(){

	if ($(window).width() > 1553) {
		$('.filter').show();
		$('#show').hide();
		$('#hide').hide();
	}

	if ($(window).width() < 1552) {
		$('.filter').hide();
		$('#show').show();
		$('#hide').hide();
		
	}

}


$('#show').click(function() {
	$('.filter').toggle(600);
	$('#show').hide();
	$('#hide').show();
});

$('#hide').click(function() {
	$('.filter').toggle(600);
	$('#show').show();
	$('#hide').hide();
});

resize();
$(window).resize(resize);


<?php echo '</script'; ?>
><?php }
}
