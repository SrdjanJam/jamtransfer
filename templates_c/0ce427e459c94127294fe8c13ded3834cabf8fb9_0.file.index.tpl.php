<?php
/* Smarty version 3.1.32, created on 2022-09-12 12:38:58
  from 'c:\wamp\www\jamtransfer\plugins\Distribution\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_631f28625a6957_25659052',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0ce427e459c94127294fe8c13ded3834cabf8fb9' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\Distribution\\templates\\index.tpl',
      1 => 1662986334,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_631f28625a6957_25659052 (Smarty_Internal_Template $_smarty_tpl) {
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
		}		
		.dropzoneN{
		}
	</style>

    <body>

    	
        <div class="row transfers"> 
		
			<div class="col-md-9">
				<?php
$__section_pom1_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['drivers']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom1_0_total = $__section_pom1_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom1'] = new Smarty_Variable(array());
if ($__section_pom1_0_total !== 0) {
for ($__section_pom1_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] = 0; $__section_pom1_0_iteration <= $__section_pom1_0_total; $__section_pom1_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']++){
?>
				<div class="col-md-3 dropzoneN driver-style" data-id="<?php echo $_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['DriverID'];?>
"><?php echo $_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['DriverName'];?>
</div>
				<?php
}
}
?>
				
			</div>

			<!-- For drop: -->
			<div class="col-md-3 dropzoneN transfers-style" data-id='0'>
				<?php
$__section_pom1_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['transfers']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom1_1_total = $__section_pom1_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom1'] = new Smarty_Variable(array());
if ($__section_pom1_1_total !== 0) {
for ($__section_pom1_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] = 0; $__section_pom1_1_iteration <= $__section_pom1_1_total; $__section_pom1_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']++){
?>
					<div class="dropelement" data-id="<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['DetailsID'];?>
">
						<div>
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
					</div>
				<?php
}
}
?>	
			</div>
			
	
		</div><!-- End of .row transfers -->
		

		<?php echo '<script'; ?>
>

			$(".dropelement").draggable({

				containment: 'document',
				cursor: 'move',

				drag: function(event, ui) {	
					window.id=$(this).attr('data-id');
			   	
			   	} 
				
			});

			$(".dropzoneN").droppable({
				drop: function(event, ui) {

					var driverid=$(this).attr('data-id');

					alert (window.id + ' connected with ' + driverid);

					$(".transfers").find("[data-id='" + window.id + "']").removeAttr('style');

					if (driverid == 0){
						$(".transfers").find("[data-id='" + window.id + "']").css('position','relative');
						$(".transfers").find("[data-id='" + window.id + "']").css('font-size','100%');
					}else {
						$(".transfers").find("[data-id='" + window.id + "']").css('position','relative');
						$(".transfers").find("[data-id='" + window.id + "']").css('font-size','80%');
						$(".transfers").find("[data-id='" + window.id + "']").css('margin','0 0 0 20px');
					} 
					
					$(".transfers").find("[data-id='" + window.id + "']").appendTo(this);
					
				}
			
			});


		<?php echo '</script'; ?>
>	
    
    </body>
<?php }
}
