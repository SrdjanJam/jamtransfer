<?php
/* Smarty version 3.1.32, created on 2024-07-16 05:35:47
  from '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/CalendarNS/templates/monthtransfers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_669606b395e4d6_06850009',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6097e9ea9253a3d87da68f15048a0f0fc0a36f89' => 
    array (
      0 => '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/CalendarNS/templates/monthtransfers.tpl',
      1 => 1721108145,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_669606b395e4d6_06850009 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>

function resize(){

	if ($(window).width() < 760) {

		$(".small").hide();
		$(".small-mini").show();
		$('.show-data').hide();

		$('.days').click(function(){
			
			var selector = '#' + $(this).attr('id')+' .show-data';
			
			var grid = '#' + $(this).parent().attr('id');
			var classes=($(grid).attr('class'));
			var x =classes.search("fullscreen");
			
			if(x == -1){
				$(grid).toggleClass('fullscreen');
				$(selector).show();
				$('.close-gi').show();
				$(".small").show();
				$(".small-mini").hide();

			}

		}); // </.days

		$('.close-gi').click(function(){
			var grid = '#' + $(this).parent().attr('id');
			$(grid).toggleClass('fullscreen');
			$('.show-data').hide();
			$('.close-gi').hide();
			$(".small").hide();
			$(".small-mini").show();
		});
			
	} // </if $(window).width() < 760
	else{
		$('.show-data').show();
		$(".small").show();
		$(".small-mini").hide();
		$('.close-gi').hide();
		$('.grid-item-2').removeClass('fullscreen');
	}

} // End of resize function


// Call the ready function:
$(document).ready(function(){
	resize();
	$(window).resize(resize);
});

		
<?php echo '</script'; ?>
>


<div class="grid-container">
	<div class="grid-item" style="background:#FDB5B5"><?php echo $_smarty_tpl->tpl_vars['dayNames']->value[0];?>
</div>
	<div class="grid-item" style="background:#f2f2f2"><?php echo $_smarty_tpl->tpl_vars['dayNames']->value[1];?>
</div>
	<div class="grid-item" style="background:#f2f2f2"><?php echo $_smarty_tpl->tpl_vars['dayNames']->value[2];?>
</div>  
	<div class="grid-item" style="background:#f2f2f2"><?php echo $_smarty_tpl->tpl_vars['dayNames']->value[3];?>
</div>
	<div class="grid-item" style="background:#f2f2f2"><?php echo $_smarty_tpl->tpl_vars['dayNames']->value[4];?>
</div>
	<div class="grid-item" style="background:#f2f2f2"><?php echo $_smarty_tpl->tpl_vars['dayNames']->value[5];?>
</div>  
	<div class="grid-item" style="background:#ABF1A6"><?php echo $_smarty_tpl->tpl_vars['dayNames']->value[6];?>
</div>
	<!-- grid-item-2: ================================================================================= -->
		<?php
$__section_pom_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['month_transfers']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom_0_total = $__section_pom_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom'] = new Smarty_Variable(array());
if ($__section_pom_0_total !== 0) {
for ($__section_pom_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] = 0; $__section_pom_0_iteration <= $__section_pom_0_total; $__section_pom_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']++){
?>
		<?php if ($_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['dayofweek'] == '0') {?> 
					<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['dayofweek'] == '-1') {?> 
			 <div class="grid-item-2"></div>
			<?php } else { ?>
				 				<div class="grid-item-2" id="grid<?php echo $_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['nom'];?>
">
					<div class="days" id="day<?php echo $_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['nom'];?>
">
													<div class="cal_days l">
								<b><?php echo $_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['nom'];?>
</b> 	
							</div>
									<div class="show-data">
																														<small class="small">
																						<?php
$__section_pom2_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['transfers']) ? count($_loop) : max(0, (int) $_loop));
$__section_pom2_1_total = $__section_pom2_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom2'] = new Smarty_Variable(array());
if ($__section_pom2_1_total !== 0) {
for ($__section_pom2_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] = 0; $__section_pom2_1_iteration <= $__section_pom2_1_total; $__section_pom2_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']++){
?>
												<div class="<?php echo $_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['transfers'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['color'];?>
">
													<small><strong><?php echo $_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['transfers'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['MOrderTime'];?>
</strong>
													<?php echo $_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['transfers'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupDate'];?>

													<?php echo $_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['transfers'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupTime'];?>
<br>
													<?php echo $_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['transfers'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PickupName'];?>
-
													<?php echo $_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['transfers'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DropName'];?>
<br> 
													<?php echo $_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['transfers'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['PaxNo'];?>
 pax.</small>
												</div><br>
											<?php
}
}
?> 										</small>
										
									</div> 											
																<small class="small"><?php echo $_smarty_tpl->tpl_vars['NO_OF_TRANSFERS']->value;?>
 <br><?php echo $_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['noOfTransfers'];?>
</small>
							<small class="small-mini" style="display:none;"><?php echo NO_OF;?>
 <br><?php echo $_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['noOfTransfers'];?>
</small>
							
					
					</div> 										<a class="close-gi" data-id ="<?php echo $_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['nom'];?>
" style="display:none;"><?php echo $_smarty_tpl->tpl_vars['CLOSE']->value;?>
</a>		
				</div>   				
				
				
		<?php }?> 		
		
		<?php if ($_smarty_tpl->tpl_vars['month_transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['dayofweek'] == '6') {?> 
								<?php }?>
		
	<?php
}
}
?> 	
</div> 

<div class="dashboard-legend">
	<?php echo $_smarty_tpl->tpl_vars['TRANSFER_STATUS_2']->value;?>

	<ul>
		<i class="fa fa-circle-o text-blue"></i> <?php echo $_smarty_tpl->tpl_vars['ACTIVE']->value;?>
 |
		<i class="fa fa-circle-o text-orange"></i> <?php echo $_smarty_tpl->tpl_vars['CHANGED']->value;?>
 |
		<i class="fa fa-question-circle text-orange"></i> <?php echo $_smarty_tpl->tpl_vars['TEMP']->value;?>
 |
		<i class="fa fa-times-circle" style="color:#c00"></i><?php echo $_smarty_tpl->tpl_vars['CANCELLED']->value;?>
  |
		<i class="fa fa-check-circle text-green"></i> <?php echo $_smarty_tpl->tpl_vars['COMPLETED']->value;?>
<br>
	</ul><br>
	<?php echo $_smarty_tpl->tpl_vars['DRIVER_CONFIRMATION_STATUS']->value;?>

	<ul>
		<i class="fa fa-car" style="color:#c00"></i> <?php echo $_smarty_tpl->tpl_vars['NO_DRIVER']->value;?>
 |
		<i class="fa fa-info-circle text-orange"></i> <?php echo $_smarty_tpl->tpl_vars['NOT_CONFIRMED']->value;?>
 |
		<i class="fa fa-thumbs-up text-blue"></i> <?php echo $_smarty_tpl->tpl_vars['CONFIRMED']->value;?>
 |
		<i class="fa fa-car text-blue"></i> <?php echo $_smarty_tpl->tpl_vars['READY']->value;?>
 |
		<i class="fa fa-thumbs-down" style="color:#c00"></i> <?php echo $_smarty_tpl->tpl_vars['DECLINED']->value;?>
 |
		<i class="fa fa-user-times" style="color:#c00"></i> <?php echo $_smarty_tpl->tpl_vars['NO_SHOW']->value;?>
 |
		<i class="fa fa-black-tie" style="color:#c00"></i> <?php echo $_smarty_tpl->tpl_vars['DRIVER_ERROR']->value;?>
 |
		<i class="fa fa-check-square text-green"></i> <?php echo $_smarty_tpl->tpl_vars['COMPLETED']->value;?>

	</ul>
</div>


<?php echo '<script'; ?>
>

	$(".mytooltip").popover({trigger:'hover', html:true, placement:'bottom'});
	
<?php echo '</script'; ?>
>
<?php }
}
