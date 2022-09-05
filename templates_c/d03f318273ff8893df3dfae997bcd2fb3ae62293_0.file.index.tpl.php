<?php
/* Smarty version 3.1.32, created on 2022-09-01 06:55:53
  from 'c:\wamp\www\jamtransfer\plugins\ExchangeRate\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_63105779d4df73_19580801',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd03f318273ff8893df3dfae997bcd2fb3ae62293' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\ExchangeRate\\templates\\index.tpl',
      1 => 1662014574,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63105779d4df73_19580801 (Smarty_Internal_Template $_smarty_tpl) {
?><form name="exchangeRate" method="post" action="">
    <div class="container">
        <div class="box box-info pad1em shadowLight">

            <div class="row">
                <div class="col-md-3"><?php echo $_smarty_tpl->tpl_vars['EUR_TO_RSD']->value;?>
</div>
                <div class="col-md-3">
                    <input type="text" name="exchangeRate" value="<?php echo $_smarty_tpl->tpl_vars['tecaj']->value;?>
"> RSD
                </div>		
                <div class="col-md-6">
                    <button name="setRate" type="submit" class="btn btn-primary " value="1"><?php echo $_smarty_tpl->tpl_vars['SET_NEW_RATE']->value;?>
</button>
                </div>	
            </div>
            
            <?php echo $_smarty_tpl->tpl_vars['message']->value;?>


        </div>
    </div>
</form>
<?php }
}
