<?php
/* Smarty version 3.1.32, created on 2024-08-30 07:05:04
  from '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/LogEvidence/templates/monthlogs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_66d16f20709867_10646170',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a4d760597c4e20b195865eb95cf2e27a3e65ebb' => 
    array (
      0 => '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/LogEvidence/templates/monthlogs.tpl',
      1 => 1725001481,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66d16f20709867_10646170 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="grid-container">
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
											<br/>Time: <?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['Time'];?>
-<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['TimeOff'];?>

											<br>Location: <?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['Place'];?>

										" 
										class="mytooltip <?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['CMScolor'];?>
">
											<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['User'];?>

									</a></small> 
										<span class="<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['TimeColor'];?>
"><?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['Time'];?>
</span>-
										<span class="<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['TimeOffColor'];?>
"><?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['logs'][(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['TimeOff'];?>
</span><br>					
										<hr>
								<?php
}
}
?> 							</small>
						</div> 											
															<small class="small-mini" style="display:none;"><?php echo NO_OF;?>
 <br><?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['noOfLogs'];?>
</small>
						<?php if ($_REQUEST['level_id'] == 1 || isset($_SESSION['UseDriverID'])) {?>
						<button type="button" class="monthlogs btn btn-primary btn-primary-edit" data-toggle="modal" data-target="#owh<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['date'];?>
"
						data-date="<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['date'];?>
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
										<h4 class="modal-title">Working Hours <?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['date'];?>
</h4>
									</div>
									<div class="modal-body modal-body-edit" style="padding:10px">
									
									<?php
$__section_pom3_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['office_users']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom3_2_total = $__section_pom3_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom3'] = new Smarty_Variable(array());
if ($__section_pom3_2_total !== 0) {
for ($__section_pom3_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] = 0; $__section_pom3_2_iteration <= $__section_pom3_2_total; $__section_pom3_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']++){
?>
										<div class="row">
											<div class="col-md-3">
												<?php echo $_smarty_tpl->tpl_vars['office_users']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['name'];?>

											</div>											
											<div class="col-md-2">
												<?php echo $_smarty_tpl->tpl_vars['office_users']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['level'];?>

											</div>											
											<div class="col-md-2 col-md-2-timepicker">
												<input class="begin timepicker timepicker-edit form-control" type='text' name='begin' id='begin<?php echo $_smarty_tpl->tpl_vars['office_users']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['id'];
echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['date'];?>
' value=''/>
											</div>											
											<div class="col-md-2 col-md-2-timepicker">
												<input class="end timepicker timepicker-edit form-control"  type='text' name='end' id='end<?php echo $_smarty_tpl->tpl_vars['office_users']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['id'];
echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['date'];?>
' value=''/>
											</div>	
											<div>
												<input type='hidden' name='userid' class='userid' id='userid' value='<?php echo $_smarty_tpl->tpl_vars['office_users']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['id'];?>
'/>
												<input type='hidden' name='date' class='date' id='date' value='<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['date'];?>
'/>
											</div>
											<?php if (!isset($_SESSION['UseDriverID'])) {?>
											<div class="col-md-2">
												<select class="shift form-control" name="shift" id="shift">
													<option value="0"
														data-begin=""
														data-end=""
													>Shifts</option>
													<?php
$__section_pom4_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['office_shifts']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom4_3_total = $__section_pom4_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom4'] = new Smarty_Variable(array());
if ($__section_pom4_3_total !== 0) {
for ($__section_pom4_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom4']->value['index'] = 0; $__section_pom4_3_iteration <= $__section_pom4_3_total; $__section_pom4_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom4']->value['index']++){
?>
													<option 
														value="<?php echo $_smarty_tpl->tpl_vars['office_shifts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom4']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom4']->value['index'] : null)]['id'];?>
"
														data-begin="<?php echo $_smarty_tpl->tpl_vars['office_shifts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom4']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom4']->value['index'] : null)]['begin'];?>
"
														data-end="<?php echo $_smarty_tpl->tpl_vars['office_shifts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom4']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom4']->value['index'] : null)]['end'];?>
"
														data-date="<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['date'];?>
"
														data-userid="<?php echo $_smarty_tpl->tpl_vars['office_users']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['id'];?>
"
													><?php echo $_smarty_tpl->tpl_vars['office_shifts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom4']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom4']->value['index'] : null)]['name'];?>
</option>
													<?php
}
}
?>
												</select>
											</div>
											<?php }?>
											<div class="col-md-1">
												<i class="delete fa fa-trash" aria-hidden="true"
													data-date="<?php echo $_smarty_tpl->tpl_vars['month_logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['date'];?>
"
													data-userid="<?php echo $_smarty_tpl->tpl_vars['office_users']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom3']->value['index'] : null)]['id'];?>
"
												></i>
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

	// timepicker:
	$('.timepicker').click(function(){
		$(this).clockTimePicker();
	});
	//$('.timepicker').clockTimePicker();


<?php echo '</script'; ?>
>


<?php echo '<script'; ?>
>
function resize(){

	if ($(window).width() < 760) {

		// $(".btn.btn-primary-edit").replaceWith("<button class='.btn-primary-edit'>WH</button>");
		$(".monthlogs.btn.btn-primary-edit").text("WH");
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
		$(".monthlogs.btn.btn-primary-edit").text("Working Hours");
	}

} // End of resize function


// Call the ready function:
$(document).ready(function(){
	resize();
	$(window).resize(resize);
});

$(".shift").change(function(){
	var begin=$(this).find('option:selected').attr('data-begin');
	var end=$(this).find('option:selected').attr('data-end');
	var date=$(this).find('option:selected').attr('data-date');
	var userid=$(this).find('option:selected').attr('data-userid');
	var idbegin="#begin"+userid+date;
	$(idbegin).val(begin);
	var idend="#end"+userid+date;
	$(idend).val(end);
	var param="begin="+begin+"&end="+end+"&date="+date+"&userid="+userid;
	saveShift(param)
})

$(".timepicker").change(function(){	
	var begin=$(this).parent().parent().parent().find('.begin').val();
	var end=$(this).parent().parent().parent().find('.end').val();
	var userid=$(this).parent().parent().parent().find('.userid').val();
	var date=$(this).parent().parent().parent().find('.date').val();
	var param="begin="+begin+"&end="+end+"&date="+date+"&userid="+userid;
	saveShift(param);
})

$( ".monthlogs" ).on('click', function(){
	var date=$(this).attr("data-date");
	var link = './plugins/LogEvidence/getShift.php';
	var url=link+'?date='+date;	
	console.log(url);
	$.ajax({
		type: 'GET',
		url: url,
	    async: false,
	    contentType: "application/json",
		success: function(data) {
			 $.each(JSON.parse(data), function(i, item) {
				id='#begin'+item.userid+date;
				$(id).val(item.begin);				
				id='#end'+item.userid+date;
				$(id).val(item.end);
			 });
		}
	});

})

$( ".delete" ).on('click', function(){
	id='#begin'+$(this).attr('data-userid')+$(this).attr('data-date');
	$(id).val("");	
	id='#end'+$(this).attr('data-userid')+$(this).attr('data-date');
	$(id).val("");	
	var param="begin=&end=&date="+$(this).attr('data-date')+"&userid="+$(this).attr('data-userid');
	saveShift(param);
})
function saveShift(param) {
	var link = './plugins/LogEvidence/saveShift.php';
	var url=link+'?'+param;
	console.log(link+'?'+param);
	$.ajax({
		type: 'GET',
		url: (url),
		data: param,
		success: function(data) {
			toastr['success'](window.success);	
		}				
	});

}

<?php echo '</script'; ?>
><?php }
}
