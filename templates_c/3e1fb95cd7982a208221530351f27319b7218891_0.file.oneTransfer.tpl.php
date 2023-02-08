<?php
/* Smarty version 3.1.32, created on 2023-02-07 09:11:00
  from 'C:\wamp\www\jamtransfer\plugins\Schedule\templates\oneTransfer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_63e215a496be77_00558563',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e1fb95cd7982a208221530351f27319b7218891' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\plugins\\Schedule\\templates\\oneTransfer.tpl',
      1 => 1675760877,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63e215a496be77_00558563 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php $_smarty_tpl->_assignInScope('ID', ((string)$_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID']));?>

<!-- Sub card: -->
<div class="sub-card">
	<div class="bgColor" style="background:<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['bgColor'];?>
;padding:10px;">
		<!-- row first -->
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
				<a href="orders/detail/<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" target="_blank">
					<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['MOrderKey'];?>
-<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['OrderID'];?>
-<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['TNo'];?>

				</a>
			</strong>
			<strong>
				<input style='float:right;' class='check' onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
,1)" id="checkdata_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" type="checkbox" name="checkeddata"
				<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DriverConfStatus'] > 2) {?>checked disabled<?php }?>>
				<input type="hidden" id="DriverConfStatus_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" name="DriverConfStatus" value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DriverConfStatus'];?>
">	
				<label style='float:right;' for="checkeddata"><?php echo $_smarty_tpl->tpl_vars['READY']->value;?>
 </label>	
			</strong>	
		</div>

		<!-- row second -->
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

		<style>
			
			.form-group.form-group-edit{
				display: inline;
			}


			@media screen and (max-width:1000px){
				.form-group.form-group-edit{
					display: block;
				}

				.row-third-edit .col-md-3{
					margin-top: 10px;
				}
				.row-third-edit .form-control{
					width:100%;
				}

				.clock-timepicker{
					width:100% !important;
				}
				
				select{
					width:100%;
					margin-bottom: 5px;
				}
				
			}
		</style>

		<!-- row third -->
		<div class="row row-third-edit">

			<div class="col-md-3">
				<input type="text" class="timepicker w100 form-control <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['color'];?>
 timepicker-edit" id="SubPickupTime_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
					name="SubPickupTime_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
					value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubPickupTime'];?>
" onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
,0)">
			</div>

			<div class="col-md-3">
				<input type="text" class="w100 form-control <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['color2'];?>
"  id="PickupTimeX_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
					name="PickupTimeX_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
					value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupTime'];?>
" />
			</div>
			<!-- info icons -->
			<div class="col-md-3 small align-middle">
				<i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PaxNo'];?>

				<div class="form-group">
					<i class="fa fa-car <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['carColor'];?>
 pad4px"></i> 
					<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['VehicleTypeName'];?>

					<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['VehiclesNo'] > 1) {?> x <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['VehiclesNo'];?>
 <?php }?>
					<br>
				</div>
			</div>

			<div class="col-md-3">
			<i class="fa fa-clock-o"></i>		
				<div class="form-group form-group-edit">
				
					<input type="text" name="TransferDuration_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" 
					id="TransferDuration_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" class="form-control" size="2" value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['TransferDuration'];?>
" 
					title="Transfer duration"  onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
,0)">
				</div>	
				<div>
					<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['extras'] != '') {?><i class="fa fa-cubes red-text"></i><?php }?>
				</div>
			</div>

		</div> 

		<!-- row forth -->
		<div class="row" style="line-height:140%">
			<div class="col-md-10">
				<select class="subdriver1" data-id="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
				id="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" name="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
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
				<a href="#" class="btn btn-default" onclick="return ShowSubdriver2('<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
');">
					<i class="fa fa-plus"></i>
				</a>
			</div>		
		</div>
		
		<!-- Hidden or not: -->
		<div id="subDriver2<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" class="row <?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver2'] == 0) {?>hidden<?php }?>" style="line-height:140%">
			<div class="col-md-10">
				<select class="subdriver1" data-id="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
				id="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" name="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
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
				<a href="#" class="btn btn-default" onclick="return ShowSubdriver3('<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
');">
					<i class="fa fa-plus"></i>
				</a>
			</div>			
		</div>

		<!-- Hidden or not: -->
		<div id="subDriver3<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"  class="row <?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver3'] == 0) {?>hidden<?php }?>" style="line-height:140%">
			<div class="col-md-10">
				<select class="subdriver1" data-id="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
				id="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" name="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
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
			<button class="btn-xs btn-primary btn-block" onclick="ShowShow(<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
);toggleChevron(this);">
				<i class="fa fa-chevron-down"></i>
			</button>
		</div> 

		<!-- hiddenInfo -->
		<div class="row lighten-4 pad1em shadow add-hiddenInfo" id="show<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" style="display:none;margin:0">
						<div class="row">
				<div class="row-one">

					<?php if (!empty($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['MConfirmFile'])) {?>
						<br>
						Ref.No:  <b><?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['MConfirmFile'];?>
 </b>
						<br>    
						Emergency: <b> <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['EmergencyPhone'];?>
 </b>
					<?php }?>

					<br>
										
					PAX: <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PaxNo'];?>

					<br>
						<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupDate'];?>
 <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupTime'];?>

					<br>
					<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PaxName'];?>
 
					<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['MPaxTel'];?>

				</div>

				<div class="row-two">
					<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupName'];?>
 - <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DropName'];?>

					<br> 
						<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupAddress'];?>

						<br>
						<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupNotes'];?>

						<br>
						<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DropAddress'];?>


				</div>

				<div class="row-third">
					<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PayNow'];?>

					<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PayLater'];?>

					EUR:
					<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PayNow'] > 0 && $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PayLater'] > 0) {?><b style='color:red'>IZDATI RAČUN !</b><?php }?>
					<br>
					
					
					<?php if (!empty($_smarty_tpl->tpl_vars['returnTransfer']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['returnTransfer']->value;?>
 <?php }?>
					
				</div>

				<div class="row-forth">
					<?php echo FLIGHT_NO;?>
 <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['FlightNo'];?>

					<?php echo FLIGHT_TIME;?>
 <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['FlightTime'];?>

				</div>


			</div> 

			<hr style="border-color:gray">

			<div class="row">

				<div class="row-one">
					<small class="bold"><?php echo FLIGHT_NO;?>
 / <?php echo TIME;?>
</small><br>
					<input type="text" name="SubFlightNo_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" id="SubFlightNo_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
					value="<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubFlightNo'] != null) {?> <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubFlightNo'];?>
 
					<?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['FlightNo'];?>
 <?php }?>" >
						
					<input type="text" name="SubFlightNo_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" class="timepicker" id="SubFlightNo_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
					value="<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubFlightNo'] != null) {?> <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubFlightNo'];?>
 
					<?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['FlightNo'];?>
 <?php }?>" >
				</div>
				
				<div class="row-two">
					<small class="bold"><?php echo STAFF_NOTE;?>
</small></br>
					<textarea name="StaffNote_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" id="StaffNote_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
					rows="4"><?php echo stripslashes($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['StaffNote']);?>
</textarea>
				</div>

				<div class="row-third">
					<small class="bold"><?php echo NOTES_TO_DRIVER;?>
</small><br>
					<textarea style="border: 1px solid #ddd;" name="SubDriverNote_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" 
					id="SubDriverNote_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" class="span3" rows="4">
					<?php echo stripslashes($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriverNote']);?>
</textarea>
				</div>

				<div class="row-forth">
					<small class="bold"><?php echo FINAL_NOTE;?>
</small><br>
					<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubFinalNote'];?>
<br>
					<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['FinalNote'];?>
 				</div>

				<div class="row-fifth">
					<small class="bold"><?php echo RAZDUZENO_CASH;?>
 € </small><br>
					<input type="text" name="CashIn_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" id="CashIn_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['CashIn'];?>
"><br>
					<div style="display:inline-block;color:#900;" id="upd<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"></div>
				</div>
			
			</div> 

			<hr style="border-color:gray">

			<input type="hidden" name="OrderID_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" id="OrderID_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['OrderID'];?>
">
			
			<div class="col-md-6">
				<button class="btn btn-primary btn-block" onclick="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
,1)">
					<i class="fa fa-save"></i> Save
				</button>
			</div>
			



		</div> 	</div> </div> 



<?php echo '<script'; ?>
>

	function displayMob() {
		$( ".subdriver1" ).each(function() {
			var id = $(this).attr('data-id');
			var mob = $('option:selected',this).attr('data-mob');
			var mobid='#'+'mob'+id;
			$(mobid).text(mob);
			$(mobid).attr('href',('tel:'+mob));
		});	
	}
	function saveTransfer (i,mail) {
		//displayMob();
		//var id	= $("#ID_" + i).val();
		var oid	= $("#OrderID_" + i).val();
		var checked = $('#checkdata_'+i).prop('checked');
		if (checked) {
			checked=1;
			$('#checkdata'+i).prop('checked',true);
			$('#checkdata'+i).prop('disabled',true);

			var driverconfirmationstatus=3;
			if (mail == 1) console.log('Sending message to client');
		}	
		else {
			checked=0;
			var driverconfirmationstatus=$("#DriverConfStatus_" + i).val();			
			$('#checkdata'+i).prop('checked',false);
			$('#checkdata'+i).prop('disabled',false);
			mail=0;
		}
		var fn	= $("#SubFlightNo_" + i).val();
		var ft	= $("#SubFlightTime_" + i).val();
		var pt	= $("#SubPickupTime_" + i).val();
		var sd	= $("select#SubDriver_" + i).val();
		var sd2	= $("select#SubDriver2_" + i).val();
		var sd3	= $("select#SubDriver3_" + i).val();
		var c	= $("select#Car_" + i).val();
		var c2	= $("select#Car2_" + i).val();
		var c3	= $("select#Car3_" + i).val();
		var sn	= $("#StaffNote_" + i).val();
		var n	= $("#SubDriverNote_" + i).val();
		var g	= $("#CashIn_" + i).val();
		var td	= $("#TransferDuration_" + i).val();
		var msg = $("#save-button-msg-" + i);

		msg.innerHTML = "Saving...";
		var url= "plugins/Schedule/ajax_updateNotes.php";
		var param = 'ID='+i+'&OrderID='+oid+'&DriverConfStatus='+driverconfirmationstatus+'&CustomerID='+checked+'&SubFlightNo='+fn+'&SubFlightTime='+ft+'&SubPickupTime='+pt+'&SubDriver='+sd+'&SubDriver2='+sd2+'&SubDriver3='+sd3+'&Car='+c+'&Car2='+c2+'&Car3='+c3+'&StaffNote='+ sn+'&Notes='+n+'&CashIn='+g+'&TransferDuration='+ td+'&Mail='+ mail;
		console.log(url+'?'+param);
		$.ajax({
			url: url,
			type: "POST",
			data: {
				ID: i,
				OrderID: oid,
				DriverConfStatus: driverconfirmationstatus,
				CustomerID: checked,								
				SubFlightNo: fn,
				SubFlightTime: ft,
				SubPickupTime: pt,
				SubDriver: sd,
				SubDriver2: sd2,
				SubDriver3: sd3,
				Car: c,
				Car2: c2,
				Car3: c3,
				StaffNote: sn,
				Notes: n,
				CashIn: g,
				TransferDuration: td,
				Mail: mail
			},
			success: function (result) {
				msg.innerHTML = "Saved";

				$("#upd"+i).html(result);
				var res = $.trim(result);
				
				if(res != '<small>Saved.</small>') {
					$.toaster(result, 'Oops', 'success red-2');
				}
				if ((sd == '0') || (c == '0')) {
					$("#indicator_"+i).css("borderLeftColor","red");
				}
				else {
					$("#indicator_"+i).css("borderLeftColor","green");
				}
			},
			error: function (e) {
				msg.innerHTML = "Error";
				// console.log("Error:");
				// console.log(e);
			}
		});
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
