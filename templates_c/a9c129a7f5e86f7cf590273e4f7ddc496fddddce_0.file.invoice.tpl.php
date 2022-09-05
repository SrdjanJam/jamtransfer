<?php
/* Smarty version 3.1.32, created on 2022-09-01 12:17:13
  from 'c:\wamp\www\jamtransfer\plugins\AgentsTransfers\templates\invoice.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6310a2c9c55726_80463175',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9c129a7f5e86f7cf590273e4f7ddc496fddddce' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\AgentsTransfers\\templates\\invoice.tpl',
      1 => 1662034366,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6310a2c9c55726_80463175 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['u']->value['CountryName'] == 'Serbia') {?>
        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['root']->value)."/plugins/".((string)$_smarty_tpl->tpl_vars['base']->value)."/templates/invoiceSerbian.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    <?php } else { ?>
        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['root']->value)."/plugins/".((string)$_smarty_tpl->tpl_vars['base']->value)."/templates/invoiceForeign.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
}
