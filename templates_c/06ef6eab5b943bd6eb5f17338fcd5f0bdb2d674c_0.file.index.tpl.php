<?php
/* Smarty version 3.1.32, created on 2022-12-13 06:51:15
  from 'c:\wamp\www\jamtransfer\plugins\Schedule\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_639820e3d013f1_98927759',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '06ef6eab5b943bd6eb5f17338fcd5f0bdb2d674c' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\Schedule\\templates\\index.tpl',
      1 => 1670850435,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639820e3d013f1_98927759 (Smarty_Internal_Template $_smarty_tpl) {
?><style>

/* .datepicker {
	width: 10em;
	text-align: center;
}
.picker__frame {
	top: 20% !important;
}
.btn-xs {
	border: 0;
}
hr {
	border-top: 1px solid #eee;
} */

/* .stupac {
	border: solid 1px #ccc;
}
.stupacWrapper {
	margin-top: 12px;
	padding: 0 2px;
}	 */

.blink {
	background-color:red;
	color:white;
	animation: blinker 1s infinite;
}
  
@keyframes blinker {
	from { opacity: 1.0; }
	50% { opacity: 0.5; }
	to { opacity: 1.0; }
}

/* new */
.row-header{
	background: rgb(205 216 243);
	padding: 10px;
}

.row-shedule{
    margin:15px 0 0 0;
	font-size:0.85em !important;
}
.row-shedule .row{
    margin:0;
}

.row-white{
	border:1px solid rgb(190, 190, 190);
	border-radius:5px;
}

.row .orange{
	color:#474542;
	padding:5px;
	font-size:18px;
}

.col-md-edit{
	padding:2px 5px;
}

.sub-card{
	background:#e0f1f8;
	margin:10px;
	padding:10px;
	border-radius:5px;
}

.col-md-3 input{
	font-weight:bold;
	text-align:center;
}

.col-md-5 select{
	width:100%;
	height:2em;
	margin-top:5px;
}

.red{
	color: white;
}

</style>

	<!-- HEADER: -->
	<div class="row row-header">
		<div class="col-sm-3">	
			<button class="btn" onclick="hideChecked()"><?php echo $_smarty_tpl->tpl_vars['DISPLAY_NOT_CHECKED']->value;?>
</button>
			<button class="btn" onclick="displayAll()"><?php echo $_smarty_tpl->tpl_vars['DISPLAY_ALL']->value;?>
</button>
		</div>

		<form  action="" method="post" onsubmit="return validate()">
			<div class="col-sm-3">
				From
				<input id="DateFrom" class="datepicker" name="DateFrom" value="<?php echo $_smarty_tpl->tpl_vars['DateFrom']->value;?>
">
			</div>
			<div class="col-sm-3">
				to
				<input id="DateTo" class="datepicker" name="DateTo" value="<?php echo $_smarty_tpl->tpl_vars['DateTo']->value;?>
">
			</div>	
			<div class="col-sm-3">
				with
				<select name="NoColumns">
					<option value="1" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 1) {?>selected<?php }?>>1</option>
					<option value="2" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 2) {?>selected<?php }?>>2</option>
					<option value="3" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 3) {?>selected<?php }?>>3</option>
					<option value="4" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 4) {?>selected<?php }?>>4</option>
					<option value="6" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 6) {?>selected<?php }?>>6</option>
					<option value="12" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 12) {?>selected<?php }?>>12</option>
				</select>
				columns
				<button type="submit" class="btn btn-primary">Go</button>
			</div>

		</form> <!-- /form -->
	</div> <!-- /.row -->

	<!-- MAIN CONTENT: -->
	<div class="row row-shedule">

		<?php
$__section_pom_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['sdArray']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom_0_total = $__section_pom_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom'] = new Smarty_Variable(array());
if ($__section_pom_0_total !== 0) {
for ($__section_pom_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] = 0; $__section_pom_0_iteration <= $__section_pom_0_total; $__section_pom_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']++){
?>
			
			<!-- Column one: -->
			<div class="col-md-<?php echo $_smarty_tpl->tpl_vars['BsColumnWidth']->value;?>
 col-md-edit">

				<!-- One card: -->
				<div class="row-white shadow border">

					<div class="row orange white-text">
						<strong><?php echo $_smarty_tpl->tpl_vars['sdArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['DriverName'];?>
</strong>	
					</div>

					<?php
$__section_pom2_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['ordersArray']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom2_1_total = $__section_pom2_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom2'] = new Smarty_Variable(array());
if ($__section_pom2_1_total !== 0) {
for ($__section_pom2_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] = 0; $__section_pom2_1_iteration <= $__section_pom2_1_total; $__section_pom2_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']++){
?>

						<?php if (($_smarty_tpl->tpl_vars['sdArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver']) || ($_smarty_tpl->tpl_vars['sdArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver2']) || ($_smarty_tpl->tpl_vars['sdArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver3'])) {?>

							<!-- Sub card: -->
							<div class="sub-card">
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

								<!-- row third -->	
								<div class="row">

									<div class="col-md-3">
										 											<input type="text" class="timepicker w100 form-control <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['color'];?>
" id="SubPickupTime_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
											name="SubPickupTime_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
											value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubPickupTime'];?>
" onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
,0)"
												>
										
									</div>
								
									<div class="col-md-3">
										<input type="text" class="w100 form-control <?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['color2'];?>
"  id="PickupTimeX_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
											name="PickupTimeX_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
											value="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupTime'];?>
" 
											/>
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

								</div> <!-- /.row -->

								<!-- row forth -->					
								<div class="row" style="line-height:140%">
									<div class="col-md-5">
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
												<?php if ($_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver']) {?>
													selected
												<?php }?>	
												><?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverName'];?>
</option>';
											<?php
}
}
?>	
										</select>
									</div>
								</div>
								
																<div class="row <?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver2'] == 0) {?>hidden<?php }?>" style="line-height:140%">
									<div class="col-md-5">
										<select class="subdriver1" data-id="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
										id="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" name="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
,0)">
											<option value='0'> --- </option>
											<?php
$__section_pom3_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['sddArray']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom3_3_total = $__section_pom3_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom3'] = new Smarty_Variable(array());
if ($__section_pom3_3_total !== 0) {
for ($__section_pom3_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] = 0; $__section_pom3_3_iteration <= $__section_pom3_3_total; $__section_pom3_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']++){
?>
												<option value="<?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverID'];?>
" data-mob="<?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['Mob'];?>
";
												<?php if ($_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver2']) {?>
													selected
												<?php }?>	
												><?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverName'];?>
</option>';
											<?php
}
}
?>	
										</select>
									</div>
								</div>

																<div class="row <?php if ($_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver3'] == 0) {?>hidden<?php }?>" style="line-height:140%">
									<div class="col-md-5">
										<select class="subdriver1" data-id="<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
										id="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" name="SubDriver_<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
" onchange="saveTransfer(<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
,0)">
											<option value='0'> --- </option>
											<?php
$__section_pom3_4_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['sddArray']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom3_4_total = $__section_pom3_4_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom3'] = new Smarty_Variable(array());
if ($__section_pom3_4_total !== 0) {
for ($__section_pom3_4_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] = 0; $__section_pom3_4_iteration <= $__section_pom3_4_total; $__section_pom3_4_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']++){
?>
												<option value="<?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverID'];?>
" data-mob="<?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['Mob'];?>
";
												<?php if ($_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver3']) {?>
													selected
												<?php }?>	
												><?php echo $_smarty_tpl->tpl_vars['sddArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['DriverName'];?>
</option>';
											<?php
}
}
?>	
										</select>
									</div>
								</div>
							
							</div> <!-- /.sub-card -->

						<?php }?>
					
					<?php
}
}
?>

				</div>	<!-- /.row white shadow border (One card) -->
					
			</div> 
			
		
		<?php
}
}
?>

	</div> <!-- /.row row-shedule -->
<?php }
}
