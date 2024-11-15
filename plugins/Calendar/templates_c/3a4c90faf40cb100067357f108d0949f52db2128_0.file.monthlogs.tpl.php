<?php
/* Smarty version 3.1.32, created on 2024-04-29 12:55:00
  from '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/Calendar/templates/monthlogs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_662f98a4e1a7a4_55568039',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a4c90faf40cb100067357f108d0949f52db2128' => 
    array (
      0 => '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/Calendar/templates/monthlogs.tpl',
      1 => 1714395298,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_662f98a4e1a7a4_55568039 (Smarty_Internal_Template $_smarty_tpl) {
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
							</div>
									<div class="show-data">
										Here will be logs
									</div> 
							
					
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
