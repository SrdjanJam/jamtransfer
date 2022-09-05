<?php
/* Smarty version 3.1.32, created on 2022-09-01 06:56:12
  from 'c:\wamp\www\jamtransfer\plugins\vatRate\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6310578c7b8dc5_87170100',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b366c6914cb99e5af601213c4aa1170cf01def0' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\vatRate\\templates\\index.tpl',
      1 => 1662014575,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6310578c7b8dc5_87170100 (Smarty_Internal_Template $_smarty_tpl) {
?><form name="exchangeRate" method="post" action="">
	<div class="container">
		<div class="box box-info pad1em shadowLight">

			<div class="row">
				<div class="col-md-3">VAT rate</div>
				<div class="col-md-3">
					<input type="text" name="vatRate" value="<?php echo $_smarty_tpl->tpl_vars['vat']->value;?>
"> %
				</div>		
				<div class="col-md-6">
					<button name="setRate" type="submit" class="btn btn-primary " value="1"><?php echo $_smarty_tpl->tpl_vars['SET_NEW_RATE']->value;?>
</button>
				</div>	
			</div>
			
			<?php echo $_smarty_tpl->tpl_vars['message']->value;?>


		</div>
	</div>
</form><?php }
}
