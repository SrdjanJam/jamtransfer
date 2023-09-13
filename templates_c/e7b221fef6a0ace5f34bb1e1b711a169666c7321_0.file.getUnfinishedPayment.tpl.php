<?php
/* Smarty version 3.1.32, created on 2023-09-11 09:12:20
  from 'C:\wamp\www\jamtransfer\plugins\Dashboard\templates\getUnfinishedPayment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64febdd436e504_19991627',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7b221fef6a0ace5f34bb1e1b711a169666c7321' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\plugins\\Dashboard\\templates\\getUnfinishedPayment.tpl',
      1 => 1691053427,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64febdd436e504_19991627 (Smarty_Internal_Template $_smarty_tpl) {
?>	<style>
		.payment-label, .payment-content{
			display: flex;
		}
		.payment-label div, .payment-content div{
			flex: 1 1 0px; /* or flex:100%; */
			padding-left: 5px;
		}


		.payment-label{
			padding: 10px 5px;
			color:#179ae6;
			border-bottom: 1px solid #179ae6;
			font-weight: bold;
		}
		.payment-label div{
			border-right: 1px solid #179ae6;
		}
		.payment-label div:last-child {
  			border: none;
		}


		.payment-content{
			border-bottom: 1px solid #3d5766;
			padding: 5px;
		}
		.payment-content div{
			border-right: 1px solid #3d5766;
		}
		.payment-content div:last-child {
  			border: none;
		}


		.box-body .payment-content:last-child{
			border: none;
		}

	</style>


    <div class="box box-info">

        <div class="box-header">
            <i class="fa fa-credit-card"></i>
            <h3 class="box-title"><?php echo $_smarty_tpl->tpl_vars['UNFINISHED_ONLINE_PAYMENT']->value;?>
</h3>

			<div class="pull-right box-tools">

				<button class="btn btn-info btn-sm" data-name="unfinished-payment" data-name2="test"><i class="fa fa-plus"></i></button>
                
                <button class="btn btn-info btn-sm" data-widget='remove' 
                data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                
            </div><!-- /. tools -->

		</div>

		<div class="box-body unfinished-payment">

			<div class="payment-label">
				<div><?php echo $_smarty_tpl->tpl_vars['NUMBER_KEY']->value;?>
</div>
				<div><?php echo $_smarty_tpl->tpl_vars['NAME']->value;?>
</div>
				<div><?php echo $_smarty_tpl->tpl_vars['EMAIL']->value;?>
</div>
				<div><?php echo $_smarty_tpl->tpl_vars['TIME']->value;?>
</div>
				<div><?php echo $_smarty_tpl->tpl_vars['EUR']->value;?>
</div>
							</div>

			<?php if (count($_smarty_tpl->tpl_vars['payments']->value) > 0) {?>

			<?php
$__section_index_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['payments']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_index_2_total = $__section_index_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_index'] = new Smarty_Variable(array());
if ($__section_index_2_total !== 0) {
for ($__section_index_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] = 0; $__section_index_2_iteration <= $__section_index_2_total; $__section_index_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']++){
?>
				<div class="payment-content">
					<div> <?php echo $_smarty_tpl->tpl_vars['payments']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['MOrderKey'];?>
  </div>
					<div> <?php echo $_smarty_tpl->tpl_vars['payments']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['MPaxFirstName'];?>
 <?php echo $_smarty_tpl->tpl_vars['payments']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['MPaxLastName'];?>
 </div>
					<div> <?php echo $_smarty_tpl->tpl_vars['payments']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['MPaxEmail'];?>
 </div>
					<div> <?php echo $_smarty_tpl->tpl_vars['payments']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['MOrderDate'];?>
 <?php echo $_smarty_tpl->tpl_vars['payments']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['MOrderTime'];?>
 </div>
					<div> <?php echo $_smarty_tpl->tpl_vars['payments']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['MPayNow'];?>
 </div>
									</div>
			<?php
}
}
?>

			<?php } else { ?>
				<div class="payment-content">
					<div>No unfinished payment</div>
				</div>
			<?php }?>

		</div>
	</div>	<?php }
}
