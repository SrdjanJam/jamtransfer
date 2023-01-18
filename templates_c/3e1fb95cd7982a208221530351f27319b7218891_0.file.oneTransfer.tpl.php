<?php
/* Smarty version 3.1.32, created on 2023-01-17 13:11:07
  from 'C:\wamp\www\jamtransfer\plugins\Schedule\templates\oneTransfer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_63c69e6bb57794_22137856',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e1fb95cd7982a208221530351f27319b7218891' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\plugins\\Schedule\\templates\\oneTransfer.tpl',
      1 => 1673961054,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63c69e6bb57794_22137856 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Sub card: -->
<?php $_smarty_tpl->_assignInScope('ID', ((string)$_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID']));?>


<div class="sub-card">
	<div class="bgColor" style="background:<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['bgColor'];?>
;padding:10px;">
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
				<a href="orders/detail/<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>
" target="_blank">
					<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['MOrderKey'];?>
-<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['OrderID'];?>
-<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['TNo'];?>

				</a>
			</strong>
			<strong>
				<input style='float:right;' class='check' onchange="saveTransfer(<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable2 = ob_get_clean();
echo $_prefixVariable2;?>
,1)" id="checkdata_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable3 = ob_get_clean();
echo $_prefixVariable3;?>
" type="checkbox" name="checkeddata"
				<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DriverConfStatus'] > 2) {?>checked disabled<?php }?>>
				<input type="hidden" id="DriverConfStatus_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable4 = ob_get_clean();
echo $_prefixVariable4;?>
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
" id="SubPickupTime_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable5 = ob_get_clean();
echo $_prefixVariable5;?>
"
					name="SubPickupTime_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable6 = ob_get_clean();
echo $_prefixVariable6;?>
"
					value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubPickupTime'];?>
" onchange="saveTransfer(<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable7 = ob_get_clean();
echo $_prefixVariable7;?>
,0)">
			</div>
		
			<div class="col-md-3">
				<input type="text" class="w100 form-control <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['color2'];?>
"  id="PickupTimeX_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable8 = ob_get_clean();
echo $_prefixVariable8;?>
"
					name="PickupTimeX_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable9 = ob_get_clean();
echo $_prefixVariable9;?>
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
					<input type="text" name="TransferDuration_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable10 = ob_get_clean();
echo $_prefixVariable10;?>
" 
					id="TransferDuration_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable11 = ob_get_clean();
echo $_prefixVariable11;?>
" class="form-control" size="2" value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['TransferDuration'];?>
" 
					title="Transfer duration"  onchange="saveTransfer(<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable12 = ob_get_clean();
echo $_prefixVariable12;?>
,0)">
				</div>	
				<div>
					<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['extras'] != '') {?><i class="fa fa-cubes red-text"></i><?php }?>
				</div>
			</div>

		</div> 

				<div class="row" style="line-height:140%">
			<div class="col-md-10">
				<select class="subdriver1" data-id="<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable13 = ob_get_clean();
echo $_prefixVariable13;?>
"
				id="SubDriver_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable14 = ob_get_clean();
echo $_prefixVariable14;?>
" name="SubDriver_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable15 = ob_get_clean();
echo $_prefixVariable15;?>
" onchange="saveTransfer(<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable16 = ob_get_clean();
echo $_prefixVariable16;?>
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
				<a href="#" class="btn btn-default" onclick="return ShowSubdriver2('<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable17 = ob_get_clean();
echo $_prefixVariable17;?>
');">
					<i class="fa fa-plus"></i>
				</a>
			</div>		
		</div>
		
				<div id="subDriver2<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable18 = ob_get_clean();
echo $_prefixVariable18;?>
" class="row <?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver2'] == 0) {?>hidden<?php }?>" style="line-height:140%">
			<div class="col-md-10">
				<select class="subdriver1" data-id="<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable19 = ob_get_clean();
echo $_prefixVariable19;?>
"
				id="SubDriver_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable20 = ob_get_clean();
echo $_prefixVariable20;?>
" name="SubDriver_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable21 = ob_get_clean();
echo $_prefixVariable21;?>
" onchange="saveTransfer(<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable22 = ob_get_clean();
echo $_prefixVariable22;?>
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
				<a href="#" class="btn btn-default" onclick="return ShowSubdriver3('<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable23 = ob_get_clean();
echo $_prefixVariable23;?>
');">
					<i class="fa fa-plus"></i>
				</a>
			</div>			
		</div>

				<div id="subDriver3<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable24 = ob_get_clean();
echo $_prefixVariable24;?>
"  class="row <?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver3'] == 0) {?>hidden<?php }?>" style="line-height:140%">
			<div class="col-md-10">
				<select class="subdriver1" data-id="<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable25 = ob_get_clean();
echo $_prefixVariable25;?>
"
				id="SubDriver_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable26 = ob_get_clean();
echo $_prefixVariable26;?>
" name="SubDriver_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable27 = ob_get_clean();
echo $_prefixVariable27;?>
" onchange="saveTransfer(<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable28 = ob_get_clean();
echo $_prefixVariable28;?>
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
			<button class="btn-xs btn-primary btn-block" onclick="ShowShow(<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable29 = ob_get_clean();
echo $_prefixVariable29;?>
);toggleChevron(this);">
				<i class="fa fa-chevron-down"></i>
			</button>
		</div> 

		<!-- hiddenInfo -->
		<div class="row lighten-4 pad1em shadow add-hiddenInfo" id="show<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable30 = ob_get_clean();
echo $_prefixVariable30;?>
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
					<input type="text" name="SubFlightNo_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable31 = ob_get_clean();
echo $_prefixVariable31;?>
" id="SubFlightNo_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable32 = ob_get_clean();
echo $_prefixVariable32;?>
"
					value="<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubFlightNo'] != null) {?> <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubFlightNo'];?>
 
					<?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['FlightNo'];?>
 <?php }?>" >
						
					<input type="text" name="SubFlightNo_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable33 = ob_get_clean();
echo $_prefixVariable33;?>
" class="timepicker" id="SubFlightNo_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable34 = ob_get_clean();
echo $_prefixVariable34;?>
"
					value="<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubFlightNo'] != null) {?> <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubFlightNo'];?>
 
					<?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['FlightNo'];?>
 <?php }?>" >
				</div>
				
				<div class="row-two">
					<small class="bold"><?php echo STAFF_NOTE;?>
</small></br>
					<textarea name="StaffNote_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable35 = ob_get_clean();
echo $_prefixVariable35;?>
" id="StaffNote_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable36 = ob_get_clean();
echo $_prefixVariable36;?>
"
					rows="4"><?php echo stripslashes($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['StaffNote']);?>
</textarea>
				</div>

				<div class="row-third">
					<small class="bold"><?php echo NOTES_TO_DRIVER;?>
</small><br>
					<textarea style="border: 1px solid #ddd;" name="SubDriverNote_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable37 = ob_get_clean();
echo $_prefixVariable37;?>
" 
					id="SubDriverNote_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable38 = ob_get_clean();
echo $_prefixVariable38;?>
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
					<input type="text" name="CashIn_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable39 = ob_get_clean();
echo $_prefixVariable39;?>
" id="CashIn_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable40 = ob_get_clean();
echo $_prefixVariable40;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['CashIn'];?>
"><br>
					<div style="display:inline-block;color:#900;" id="upd<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable41 = ob_get_clean();
echo $_prefixVariable41;?>
"></div>
				</div>
			
			</div> 

			<hr style="border-color:gray">

			<!-- PDF Receipt -->
			<?php if ($_smarty_tpl->tpl_vars['inter']->value) {?>

				<div class="col-md-6">

					<?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PDFFile']) {?>
						<div id="existingPDF<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable42 = ob_get_clean();
echo $_prefixVariable42;?>
" style="display: inline">
							<a href="https://www.jamtransfer.com/cms/raspored/PDF/<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PDFFile'];?>
" target="_blank"
							class="btn btn-small btn-primary">
								<?php echo DOWNLOAD_RECEIPT;?>
 <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PDFFile'];?>

							</a>&nbsp;&nbsp;
							<button onclick="return deletePDF('<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PDFFile'];?>
','<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable43 = ob_get_clean();
echo $_prefixVariable43;?>
','<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable44 = ob_get_clean();
echo $_prefixVariable44;?>
');" 
							class="btn btn-small btn-danger" >
								<?php echo DELETE_RECEIPT;?>
 <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PDFFile'];?>

							</button>&nbsp;&nbsp; 
						</div>
					<?php }?>

					<form name="form" action="" method="POST" enctype="multipart/form-data" style="display:inline">
						<input type="file" name="PDFFile_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable45 = ob_get_clean();
echo $_prefixVariable45;?>
" id="PDFFile_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable46 = ob_get_clean();
echo $_prefixVariable46;?>
" 
						onchange="return ajaxFileUpload('<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable47 = ob_get_clean();
echo $_prefixVariable47;?>
');" style="display:none">
						<input type="hidden" name="ID_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable48 = ob_get_clean();
echo $_prefixVariable48;?>
" id="ID_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable49 = ob_get_clean();
echo $_prefixVariable49;?>
" value="<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable50 = ob_get_clean();
echo $_prefixVariable50;?>
">
						<button id="imgUpload" class="btn btn-small btn-default" 
							onclick="$('#PDFFile_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable51 = ob_get_clean();
echo $_prefixVariable51;?>
').click();return false;">
							<?php echo UPLOAD_PDF_RECEIPT;?>

						</button>
					</form>

					<div style="display:inline-block;color:#900;" id="PDFUploaded_<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable52 = ob_get_clean();
echo $_prefixVariable52;?>
"></div>
				</div>
			
			<?php }?>

			<div class="col-md-6">
				<button class="btn btn-primary btn-block" onclick="saveTransfer(<?php ob_start();
echo $_smarty_tpl->tpl_vars['ID']->value;
$_prefixVariable53 = ob_get_clean();
echo $_prefixVariable53;?>
,1)">
					<i class="fa fa-save"></i> Save
				</button>
			</div>
			



		</div> 	</div> </div> 



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
