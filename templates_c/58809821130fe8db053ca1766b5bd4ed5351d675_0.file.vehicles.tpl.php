<?php
/* Smarty version 3.1.32, created on 2022-09-23 09:28:19
  from 'c:\wamp\www\jamtransfer\plugins\Distribution\templates\vehicles.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_632d7c33aa25e4_34353869',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '58809821130fe8db053ca1766b5bd4ed5351d675' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\Distribution\\templates\\vehicles.tpl',
      1 => 1663925296,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632d7c33aa25e4_34353869 (Smarty_Internal_Template $_smarty_tpl) {
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

        <div class="row vehicles"> 
		
			<div class="col-md-8">
				<?php
$__section_pom1_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['vehicles']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom1_0_total = $__section_pom1_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom1'] = new Smarty_Variable(array());
if ($__section_pom1_0_total !== 0) {
for ($__section_pom1_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] = 0; $__section_pom1_0_iteration <= $__section_pom1_0_total; $__section_pom1_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']++){
?>
				<div class="col-md-3 dropzoneN driver-style" data-id="<?php echo $_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['DriverID'];?>
">
					<?php echo $_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['DriverName'];?>
 <i class="fa fa-eye-slash driver_hide"></i>
					<?php if ($_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['SubVehicleID'] > 0) {?>
					<div class="dropelement"  data-id="<?php echo $_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['SubVehicleID'];?>
">
						<?php echo $_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['SubVehicleDescription'];?>
  / <i class="fa fa-user"></i><?php echo $_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['SubVehicleCapacity'];?>

					</div>
					<?php }?>
				</div>
				<?php
}
}
?>
				
			</div>

			<!-- For drop: -->
			<div class="col-md-4 sort" data-id='0'>
				<?php
$__section_pom1_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['vehicles']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom1_1_total = $__section_pom1_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom1'] = new Smarty_Variable(array());
if ($__section_pom1_1_total !== 0) {
for ($__section_pom1_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] = 0; $__section_pom1_1_iteration <= $__section_pom1_1_total; $__section_pom1_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']++){
?>
					<?php if ($_smarty_tpl->tpl_vars['vehicles']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['SubDriver'] == 0) {?>
						<div class="col-md-6 dropzoneN">
							<div class=" dropelement" data-sort="<?php echo $_smarty_tpl->tpl_vars['vehicles']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['VehicleCapacity'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['vehicles']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['VehicleID'];?>
">
								<?php echo $_smarty_tpl->tpl_vars['vehicles']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['VehicleDescription'];?>
 / <i class="fa fa-user"></i><?php echo $_smarty_tpl->tpl_vars['vehicles']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom1']->value['index'] : null)]['VehicleCapacity'];?>

							</div>
						</div>
					<?php }?>
				<?php
}
}
?>	
			</div>
			
	
		</div>
		

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
			function changeOrder(vehicleid,driverid) {
				var link = '<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
plugins/Distribution/updateVehicles.php';
				var param = "SubVehicleID="+vehicleid+"&SubDriverID="+driverid;
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
					changeOrder(window.id,driverid)
					$(".vehicles").find("[data-id='" + window.id + "']").appendTo(this);	
					$(".vehicles").find("[data-id='" + window.id + "']").removeAttr('style');

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

		
		<?php echo '</script'; ?>
>	
    
    </body>
<?php }
}
