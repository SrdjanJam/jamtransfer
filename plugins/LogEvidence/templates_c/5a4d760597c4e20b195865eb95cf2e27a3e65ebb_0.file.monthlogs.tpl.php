<?php
/* Smarty version 3.1.32, created on 2024-07-22 07:12:39
  from '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/LogEvidence/templates/monthlogs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_669e0667c06c81_12678265',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a4d760597c4e20b195865eb95cf2e27a3e65ebb' => 
    array (
      0 => '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/LogEvidence/templates/monthlogs.tpl',
      1 => 1721632353,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_669e0667c06c81_12678265 (Smarty_Internal_Template $_smarty_tpl) {
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
$__section_pom_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['month_logs']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom_0_total = $__section_pom_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom'] = new Smarty_Variable(array());
if ($__section_pom_0_total !== 0) {
for ($__section_pom_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] = 0; $__section_pom_0_iteration <= $__section_pom_0_total; $__section_pom_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']++){
?>
		<?php if ($_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['dayofweek'] == '0') {?> 
					<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['dayofweek'] == '-1') {?> 
			 <div class="grid-item-2"></div>
			<?php } else { ?>
				 				<div class="grid-item-2" id="grid<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['nom'];?>
">
					<div class="days" id="day<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['nom'];?>
">
						<div class="cal_days l">
							<b><?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['nom'];?>
</b> 
							<?php if ($_SESSION['AuthLevelID'] == '31' || isset($_SESSION['UseDriverID'])) {?>
								<a target='_blank' href='<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
distribution/<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['date'];?>
'><?php echo $_smarty_tpl->tpl_vars['DISTRIBUTION']->value;?>
</a>
							<?php }?>	
						</div>
						<div class="show-data">
							<small class="small">
																<?php
$__section_pom2_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs']) ? count($_loop) : max(0, (int) $_loop));
$__section_pom2_1_total = $__section_pom2_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom2'] = new Smarty_Variable(array());
if ($__section_pom2_1_total !== 0) {
for ($__section_pom2_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] = 0; $__section_pom2_1_iteration <= $__section_pom2_1_total; $__section_pom2_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']++){
?>

									<small><a href=""
										title="<b><?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['User'];?>
</b>" 
										data-content="
											<br/>Time: <?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['Time'];
echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['TimeOff'];?>

											<br>Location: <?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['Place'];?>

										" 
										class="mytooltip">
											<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['User'];?>

									</a></small> <?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['Time'];
echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['TimeOff'];?>
<br>					
									
								<?php
}
}
?> 							</small>
						</div> 											
															<small class="small-mini" style="display:none;"><?php echo NO_OF;?>
 <br><?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['noOfLogs'];?>
</small>
						<?php if ($_REQUEST['level_id'] == 1) {?>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#owh<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['date'];?>
">
							Working Hours
						</button>
						<div class="modal fade"  id="owh<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['date'];?>
">
							<div class="modal-dialog" style="width: fit-content;">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title">Working Hours</h4>
									</div>
									<div class="modal-body" style="padding:10px">
									<?php
$__section_pom3_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['office_users']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom3_2_total = $__section_pom3_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom3'] = new Smarty_Variable(array());
if ($__section_pom3_2_total !== 0) {
for ($__section_pom3_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] = 0; $__section_pom3_2_iteration <= $__section_pom3_2_total; $__section_pom3_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']++){
?>
										<div class="row">
											<div class="col-md-4">
												<?php echo $_smarty_tpl->tpl_vars['office_users']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['name'];?>

											</div>											
											<div class="col-md-2">
												<?php echo $_smarty_tpl->tpl_vars['office_users']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['level'];?>

											</div>											
											<div class="col-md-2">
												<input class="timepicker timepicker-edit form-control" type='text' name='start' id='start' value=''/>
											</div>											
											<div class="col-md-2">
												<input class="timepicker timepicker-edit form-control"  type='text' name='end' id='end' value=''/>
											</div>											
											<div class="col-md-2">
												<select name="cars" id="cars">
													<option value="0">No shift</option>
													<option value="1">Shift 1</option>
													<option value="2">Shift 2</option>
													<option value="3">Shift 3</option>
												</select>
											</div>
										</div>	
									<?php
}
}
?>
									</div>
								</div>
							</div>
						</div>	
						<?php }?>		
					</div> 										<a class="close-gi" data-id ="<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['nom'];?>
" style="display:none;"><?php echo $_smarty_tpl->tpl_vars['CLOSE']->value;?>
</a>		
				</div>   				
				
				
		<?php }?> 		
		
		<?php if ($_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['dayofweek'] == '6') {?> 
								<?php }?>
		

	<?php
}
}
?> 	
</div> 




<?php echo '<script'; ?>
>

	$(".mytooltip").popover({trigger:'hover', html:true, placement:'bottom'});

	
<?php echo '</script'; ?>
>
<?php }
}
