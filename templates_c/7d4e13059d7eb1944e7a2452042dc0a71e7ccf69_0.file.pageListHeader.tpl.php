<?php
/* Smarty version 3.1.32, created on 2022-09-06 09:33:00
  from 'C:\wamp\www\jamtransfer\templates\pageListHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_631713cc7e5ef3_83876267',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d4e13059d7eb1944e7a2452042dc0a71e7ccf69' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\pageListHeader.tpl',
      1 => 1662456775,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_631713cc7e5ef3_83876267 (Smarty_Internal_Template $_smarty_tpl) {
if ((!$_SESSION['UseDriverID'] && $_smarty_tpl->tpl_vars['title']->value != "Orders" && $_smarty_tpl->tpl_vars['title']->value != "Invoices") || $_SESSION['UseDriverID'] && ($_smarty_tpl->tpl_vars['title']->value == "Drivers" || $_smarty_tpl->tpl_vars['title']->value == "Vehicles")) {?>
	<a class="btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['currenturl']->value;?>
/new"><?php echo $_smarty_tpl->tpl_vars['NNEW']->value;?>
</a>
<?php }
if ($_smarty_tpl->tpl_vars['title']->value == "Drivers") {?>
	<a target="_blank" class="btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
plugins/SubDrivers/getRaptorDrivers.php">Raptor</a>	
<?php }
if ($_smarty_tpl->tpl_vars['title']->value == "Vehicles") {?>
	<a target="_blank" class="btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
plugins/SubVehicles/getRaptorVehicles.php">Raptor</a>	
<?php }?>

<input type="hidden"  id="whereCondition" name="whereCondition" 
value=" WHERE <?php echo $_smarty_tpl->tpl_vars['ItemID']->value;?>
 > 0">



<input type="hidden"  id="orderid" name="orderid" value="<?php echo $_smarty_tpl->tpl_vars['orderid']->value;?>
">
<input type="hidden"  id="detailid" name="detailid" value="<?php echo $_smarty_tpl->tpl_vars['detailid']->value;?>
">
<input type="hidden"  id="transfersFilter" name="transfersFilter" value="<?php echo $_smarty_tpl->tpl_vars['transfersFilter']->value;?>
">

<div class="row itemsheader">
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
	<?php if ($_smarty_tpl->tpl_vars['title']->value != "Orders") {?>
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
	<?php } else { ?>
		<strong><?php echo $_smarty_tpl->tpl_vars['transfersFiltersName']->value;?>
</strong>
	<?php }?>
	
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
<?php }
}
