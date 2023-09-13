<?php
/* Smarty version 3.1.32, created on 2023-09-11 09:12:19
  from 'C:\wamp\www\jamtransfer\plugins\Dashboard\templates\getOrder.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64febdd3d24930_40502093',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '319f7c229f57fe915b2e5930a405bc3b9df3c53c' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\plugins\\Dashboard\\templates\\getOrder.tpl',
      1 => 1691053427,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64febdd3d24930_40502093 (Smarty_Internal_Template $_smarty_tpl) {
?>    <!-- get transfer  widget -->
    <div class="box box-info">
        <div class="box-header">
            <i class="fa fa-car"></i>
            <h3 class="box-title"><?php echo $_smarty_tpl->tpl_vars['GET_TRANSFER_ORDER']->value;?>
</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                
                <button class="btn btn-info btn-sm" data-name="get-order"><i class="fa fa-plus"></i></button>
                
                <button class="btn btn-info btn-sm"  
                data-toggle="tooltip" data-widget='remove' title="Remove"><i class="fa fa-times"></i></button>

            </div><!-- /. tools -->
        </div>
        <div class="box-body get-order">
			<form action="orders/order" method="post"> 
				<div class="row">
					<div class="col-md-4"><?php echo $_smarty_tpl->tpl_vars['TRANSFER_ORDER_NUMBER']->value;?>
 </div>
					<div class="col-md-3">
						<input class="form-control" type="text" name="orderid" size="5"
						 id="orderid" value=""> 
					</div>
					<div class="col-md-3">
						<button class="pull-right btn btn-default" type="submit" name="Confirm">
							<i class="fa fa-check l"></i> <?php echo $_smarty_tpl->tpl_vars['VIEW']->value;?>

						</button>	
					</div>		
				</div>
			</form>
        </div>
    </div><?php }
}
