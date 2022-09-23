<?php
/* Smarty version 3.1.32, created on 2022-09-23 09:56:41
  from 'c:\wamp\www\jamtransfer\plugins\Distribution\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_632d82d9201201_64916972',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0ce427e459c94127294fe8c13ded3834cabf8fb9' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\Distribution\\templates\\index.tpl',
      1 => 1663926996,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632d82d9201201_64916972 (Smarty_Internal_Template $_smarty_tpl) {
?>	<style>
        body{
			font-size: 32px;
			overflow-x: hidden;
		}
		.driver-style{
			background: #c4b7a6;
			border-color: gray;
			min-height: 8%;
			border-style: solid;	
		}
		.transfers-style{
			height:100vh;
		}	
		.dropelement{
			border-color: green;
			border-style: solid;	
			font-size: 80%; 
			position: relative; 
			margin-left: 10px;			
		}		
		.dropzoneN{
		}		
		.marked{
			font-size: 150%; 
			color: green;
		}
		a{
			color: gray;
		}
	</style>

    <body>
		<div style="text-align: center;">
			<a class='marked' href='<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
calendar'>Calendar</a>	
			&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;			
			<a href='<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
distribution/<?php echo $_smarty_tpl->tpl_vars['days']->value[2];?>
'>
				<i class="fa fa-arrow-left" aria-hidden="true"></i>		
			</a>		
			<?php
$__section_pom_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['days']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom_0_total = $__section_pom_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom'] = new Smarty_Variable(array());
if ($__section_pom_0_total !== 0) {
for ($__section_pom_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] = 0; $__section_pom_0_iteration <= $__section_pom_0_total; $__section_pom_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']++){
?>
				<a <?php if ($_smarty_tpl->tpl_vars['days']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)] == $_REQUEST['Date']) {?>class='marked'<?php }?> href='<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
distribution/<?php echo $_smarty_tpl->tpl_vars['days']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)];?>
'>
					<?php echo $_smarty_tpl->tpl_vars['days']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)];?>

				</a>
			<?php
}
}
?>
			<a href='<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
distribution/<?php echo $_smarty_tpl->tpl_vars['days']->value[4];?>
'>
				<i class="fa fa-arrow-right" aria-hidden="true"></i>		
			</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a class='marked' href='<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
distribution/vehicles'>Vehicles</a>
		</div>
        <div class="row transfers"> 
		
			<div class="col-md-10">
				<?php
$__section_pom1_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['drivers']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom1_1_total = $__section_pom1_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom1'] = new Smarty_Variable(array());
if ($__section_pom1_1_total !== 0) {
for ($__section_pom1_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] = 0; $__section_pom1_1_iteration <= $__section_pom1_1_total; $__section_pom1_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']++){
?>
				<div class="col-md-3 dropzoneN driver-style" data-svid="<?php echo $_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['SubVehicleID'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['DriverID'];?>
">
					<div><?php echo $_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['DriverName'];?>
</div> 
					<div>
						<?php if ($_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['SubVehicleID']) {?>	
						<small>
							<?php echo $_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['SubVehicleDescription'];?>
 / <i class="fa fa-user"></i><?php echo $_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['SubVehicleCapacity'];?>

						</small>
						<?php }?>
						<i class="fa fa-eye-slash driver_hide"></i>
					</div>	
					<div class='sort'>
					<?php
$__section_pom2_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['transfers']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom2_2_total = $__section_pom2_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom2'] = new Smarty_Variable(array());
if ($__section_pom2_2_total !== 0) {
for ($__section_pom2_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] = 0; $__section_pom2_2_iteration <= $__section_pom2_2_total; $__section_pom2_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']++){
?>
						<?php if ($_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver']) {?>
							<div data-sort="<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupTime'];?>
" class="dropelement"  data-id="<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
">
								<a target="_blank" href="orders/detail/<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>
"
									title="<b><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['OrderID'];?>
-<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['TNo'];?>
 - <?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PaxName'];?>
 </b>" 
									data-content="
										<br/><?php echo $_smarty_tpl->tpl_vars['FLIGHT_NO']->value;?>
: <?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['FlightNo'];?>

										<br><?php echo $_smarty_tpl->tpl_vars['FLIGHT_TIME']->value;?>
: <?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['FlightTime'];?>

									" 
									class="mytooltip">						
									<div>
											<strong><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupTime'];?>
</strong>
											<i class="fa fa-car"></i><span><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['VehicleType'];?>
</span>							
											<strong><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['OrderID'];?>
-<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['TNo'];?>
</strong> 
											<i class="fa fa-user"></i><span><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PaxNo'];?>
</span>
									</div>
									<div><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupName'];?>
-<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DropName'];?>
</div>
									<div>
										<?php if (!isset($_REQUEST['Date'])) {
echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupDate'];
}?> 
										<strong><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupTime'];?>
</strong>
										<i class="fa fa-car"></i><span><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['VehicleType'];?>
</span>							
									</div>
								</a>
							</div>						
						<?php }?>
					<?php
}
}
?>	
					</div>
				</div>
				<?php
}
}
?>
				
			</div>

			<!-- For drop: -->
			<div class="col-md-2 dropzoneN transfers-style" data-id='0'>
				<div class="sort">
				<?php
$__section_pom1_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['transfers']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom1_3_total = $__section_pom1_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom1'] = new Smarty_Variable(array());
if ($__section_pom1_3_total !== 0) {
for ($__section_pom1_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] = 0; $__section_pom1_3_iteration <= $__section_pom1_3_total; $__section_pom1_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']++){
?>
					<?php if ($_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['SubDriver'] == 0) {?>				
						<div data-sort="<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['PickupTime'];?>
" class="dropelement"  data-id="<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['DetailsID'];?>
">
							<a target="_blank" href="orders/detail/<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['DetailsID'];?>
"
								title="<b><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['OrderID'];?>
-<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['TNo'];?>
 - <?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['PaxName'];?>
 </b>" 
								data-content="
									<br/><?php echo $_smarty_tpl->tpl_vars['FLIGHT_NO']->value;?>
: <?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['FlightNo'];?>

									<br><?php echo $_smarty_tpl->tpl_vars['FLIGHT_TIME']->value;?>
: <?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['FlightTime'];?>

								" 
								class="mytooltip">						
								<div>
										<strong><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['PickupTime'];?>
</strong>
										<i class="fa fa-car"></i><span><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['VehicleType'];?>
</span>							
										<strong><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['OrderID'];?>
-<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['TNo'];?>
</strong> 
										<i class="fa fa-user"></i><span><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['PaxNo'];?>
</span>
								</div>
								<div><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['PickupName'];?>
-<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['DropName'];?>
</div>
								<div>
									<?php if (!isset($_REQUEST['Date'])) {
echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['PickupDate'];
}?> 
									<strong><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['PickupTime'];?>
</strong>
									<i class="fa fa-car"></i><span><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['VehicleType'];?>
</span>							
								</div>
							</a>
						</div>
					<?php }?>
				<?php
}
}
?>	
				</div>
			</div>
			
	
		</div><!-- End of .row transfers -->
		

		<?php echo '<script'; ?>
>
		
			function elementdragg() {
				$(".dropelement").draggable({

					containment: "#container",
					connectToSortable: "#sorting",
					cursor: 'move',

					drag: function(event, ui) {	
						window.id=$(this).attr('data-id');
					} 
					
				});
			}
			function changeOrder(detailid,driverid,subvehicleid) {
				var link = '<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
plugins/Distribution/update.php';
				var param = "DetailsID="+detailid+"&SubDriverID="+driverid+"&SubVehicleID="+subvehicleid;
				alert (link+'?'+param);
				$.ajax({
					type: 'POST',
					url: link,
					data: param,
				});
			}			
			elementdragg();
			$(".dropzoneN").droppable({
				drop: function(event, ui) {
					var driverid=$(this).attr('data-id');
					var subvehicleid=$(this).attr('data-svid');
					changeOrder(window.id,driverid,subvehicleid)
					$(".transfers").find("[data-id='" + window.id + "']").appendTo(this);	
					$(".transfers").find("[data-id='" + window.id + "']").removeAttr('style');

					var result = $(this).find('.dropelement').sort(function (a, b) {
						var contentA =parseInt( $(a).data('sort'));
						var contentB =parseInt( $(b).data('sort'));
						return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
					});
					$(this).find('.sort').html(result);	
					elementdragg();	
				}	
			});
			$(".driver_hide").click(function(){
				$(this).parent().hide(300);
			})
			$(".mytooltip").popover({trigger:'hover', html:true, placement:'bottom'});

		
		<?php echo '</script'; ?>
>	
    
    </body>
<?php }
}
