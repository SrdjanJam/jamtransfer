<?php
/* Smarty version 3.1.32, created on 2022-12-30 12:20:12
  from 'C:\wamp\www\jamtransfer\plugins\Schedule\templates\oneTransfer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_63aed77c193d00_47127266',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e1fb95cd7982a208221530351f27319b7218891' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\plugins\\Schedule\\templates\\oneTransfer.tpl',
      1 => 1672402801,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63aed77c193d00_47127266 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- Sub card: -->
<?php $_smarty_tpl->_assignInScope('ID', ((string)$_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID']));?>

<div class="sub-card" style="background:<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['bgColor'];?>
">
		<div class="row"> <!-- TRANSFER -->
		<span>
			<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['UserLevelID'] == '2') {?>
				<i class='fa fa-user-secret'></i>
					<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['Image'] != '') {?>
						<img src='i/agents/<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['Image'];?>
'>	 
						<b><?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['AuthUserRealName'];?>
</b>
					<?php }?>
			<?php }?>
		</span>					
		<strong>
			<a href="orders/detail/<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" target="_blank">
				<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['MOrderKey'];?>
-<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['OrderID'];?>
-<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['TNo'];?>

			</a>
		</strong>
		<strong>
			<input style='float:right;' class='check' onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
,1)" id="checkdata_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" type="checkbox" name="checkeddata"
			<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DriverConfStatus'] > 2) {?>checked disabled<?php }?>>
			<input type="hidden" id="DriverConfStatus_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" name="DriverConfStatus" value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DriverConfStatus'];?>
">	
			<label style='float:right;' for="checkeddata"><?php echo $_smarty_tpl->tpl_vars['READY']->value;?>
 </label>	
		</strong>	
	</div>

	
	<div class="row">
		<h4><?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupName'];?>
 - <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DropName'];?>
</h4>

		<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['flightTimeConflict']) {?>
			<span class='blink'><?php echo $_smarty_tpl->tpl_vars['FLIGHT_TIME_CONFLICT']->value;?>
</span>
			<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['FlightTime'];?>

		<?php }?>

		<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['changedIcon'];?>

		
	</div>

		
	<div class="row">

		<div class="col-md-3">
			<input type="text" class="timepicker w100 form-control <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['color'];?>
" id="SubPickupTime_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
"
				name="SubPickupTime_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
"
				value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubPickupTime'];?>
" onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
,0)">
		</div>
	
		<div class="col-md-3">
			<input type="text" class="w100 form-control <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['color2'];?>
"  id="PickupTimeX_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
"
				name="PickupTimeX_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
"
				value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupTime'];?>
" />
		</div>
		<!-- info icons -->
		<div class="col-md-3 small align-middle">
			<div>
				<i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PaxNo'];?>

			</div>
			<div>
				<i class="fa fa-car <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['carColor'];?>
 pad4px"></i> 
				<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['VehicleTypeName'];?>

				<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['VehiclesNo'] > 1) {?> x <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['VehiclesNo'];?>
 <?php }?>
				<br>
			</div>
		</div>

		<div class="col-md-3">
			<div>
				<i class="fa fa-clock-o"></i>
				<input type="text" name="TransferDuration_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" 
				id="TransferDuration_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" class="form-control" size="2" value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['TransferDuration'];?>
" 
				title="Transfer duration"  onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
,0)">
			</div>	
			<div>
				<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['extras'] != '') {?><i class="fa fa-cubes red-text"></i><?php }?>
			</div>
		</div>

	</div> 

		<div class="row" style="line-height:140%">
		<div class="col-md-10">
			<select class="subdriver1" data-id="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
"
			id="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" name="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
,0)">
				<option value='0'> --- </option>
				<?php
$__section_pom3_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['sddArray']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom3_0_total = $__section_pom3_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom3'] = new Smarty_Variable(array());
if ($__section_pom3_0_total !== 0) {
for ($__section_pom3_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] = 0; $__section_pom3_0_iteration <= $__section_pom3_0_total; $__section_pom3_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']++){
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverID'];?>
" data-mob="<?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['Mob'];?>
";
					<?php if ($_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver']) {?>
						selected
					<?php }?>	
					><?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverName'];?>
 - <?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverCar'];?>
</option>';
				<?php
}
}
?>	
			</select>
		</div>
		<div class="col-md-2">
			<a href="#" class="btn btn-default" onclick="return ShowSubdriver2('<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
');">
				<i class="fa fa-plus"></i>
			</a>
		</div>		
	</div>
	
		<div id="subDriver2<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" class="row <?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver2'] == 0) {?>hidden<?php }?>" style="line-height:140%">
		<div class="col-md-10">
			<select class="subdriver1" data-id="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
"
			id="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" name="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
,0)">
				<option value='0'> --- </option>
				<?php
$__section_pom3_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['sddArray']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom3_1_total = $__section_pom3_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom3'] = new Smarty_Variable(array());
if ($__section_pom3_1_total !== 0) {
for ($__section_pom3_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] = 0; $__section_pom3_1_iteration <= $__section_pom3_1_total; $__section_pom3_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']++){
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverID'];?>
" data-mob="<?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['Mob'];?>
";
					<?php if ($_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver2']) {?>
						selected
					<?php }?>	
					><?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverName'];?>
 - <?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverCar'];?>
</option>';
				<?php
}
}
?>	
			</select>
		</div>
		<div class="col-md-2">
			<a href="#" class="btn btn-default" onclick="return ShowSubdriver3('<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
');">
				<i class="fa fa-plus"></i>
			</a>
		</div>			
	</div>

		<div id="subDriver3<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
"  class="row <?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver3'] == 0) {?>hidden<?php }?>" style="line-height:140%">
		<div class="col-md-10">
			<select class="subdriver1" data-id="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
"
			id="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" name="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
,0)">
				<option value='0'> --- </option>
				<?php
$__section_pom3_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['sddArray']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom3_2_total = $__section_pom3_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom3'] = new Smarty_Variable(array());
if ($__section_pom3_2_total !== 0) {
for ($__section_pom3_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] = 0; $__section_pom3_2_iteration <= $__section_pom3_2_total; $__section_pom3_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']++){
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverID'];?>
" data-mob="<?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['Mob'];?>
";
					<?php if ($_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver3']) {?>
						selected
					<?php }?>	
					><?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverName'];?>
 - <?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverCar'];?>
</option>';
				<?php
}
}
?>	
			</select>
		</div>
	</div>

	<div class="row">
		<button class="btn-xs btn-primary btn-block" onclick="ShowShow(<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
);toggleChevron(this);">
			<i class="fa fa-chevron-down"></i>
		</button>
	</div> 

	<!-- hiddenInfo -->
	<div class="row grey lighten-4 pad1em shadow" id="show<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" style="display:none;margin:0">
		Detalji transfera
	</div>

</div> 






<?php echo '<script'; ?>
>

	function saveTransfer (i,mail) {
		alert (i);
	}
	
	function ShowShow(i) {
		$("#show"+i).toggle('slow');
	}
	
	function toggleChevron (button) {
		if (button.innerHTML == '<i class="fa fa-chevron-up"></i>')
			button.innerHTML = '<i class="fa fa-chevron-down"></i>';
		else button.innerHTML = '<i class="fa fa-chevron-up"></i>';
	}
	
	function ShowSubdriver2(i)
	{
	    $("#subDriver2"+i).toggle('slow');
	    return false;
	}

	function ShowSubdriver3(i)
	{
	    $("#subDriver3"+i).toggle('slow');
	    return false;
	}
<?php echo '</script'; ?>
>	<?php }
}
