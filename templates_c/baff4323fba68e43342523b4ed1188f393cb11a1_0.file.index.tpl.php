<?php
/* Smarty version 3.1.32, created on 2022-10-31 13:43:50
  from 'c:\wamp\www\jamtransfer\plugins\Dashboard\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_635fd116035189_57983168',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'baff4323fba68e43342523b4ed1188f393cb11a1' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\Dashboard\\templates\\index.tpl',
      1 => 1667220384,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:plugins/Dashboard/templates/smallBoxes.tpl' => 1,
    'file:plugins/Dashboard/templates/emptyRow.tpl' => 1,
    'file:plugins/Dashboard/templates/getOrder.tpl' => 1,
    'file:plugins/Dashboard/templates/getUnfinishedPayment.tpl' => 1,
    'file:plugins/Dashboard/templates/actualTransfers.tpl' => 1,
    'file:plugins/Dashboard/templates/todo.tpl' => 1,
    'file:plugins/Dashboard/templates/quickEmail.tpl' => 1,
  ),
),false)) {
function content_635fd116035189_57983168 (Smarty_Internal_Template $_smarty_tpl) {
?>
					<?php if ($_smarty_tpl->tpl_vars['smallBoxes']->value) {?> 
						<?php $_smarty_tpl->_subTemplateRender("file:plugins/Dashboard/templates/smallBoxes.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
					<?php }?>					
					<?php if ($_smarty_tpl->tpl_vars['translatorPanel']->value) {?> 
						<h2>Translator panel for <?php echo $_SESSION['UserRealName'];?>
</h2>
					<?php }?>
					<?php $_smarty_tpl->_subTemplateRender("file:plugins/Dashboard/templates/emptyRow.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> 			

					<div class="row">
						<?php if ($_smarty_tpl->tpl_vars['getOrder']->value) {?>
						<section class="col-lg-6 xconnectedSortable"> 
							<?php $_smarty_tpl->_subTemplateRender("file:plugins/Dashboard/templates/getOrder.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> 			
						</section><!-- /.Left col -->
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['getUnfinishedPayment']->value) {?>						
						<section class="col-lg-6 xconnectedSortable"> 
							<?php $_smarty_tpl->_subTemplateRender("file:plugins/Dashboard/templates/getUnfinishedPayment.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> 			
						</section>
						<?php }?>

						<?php if ($_smarty_tpl->tpl_vars['actualTransfers']->value) {?>
                        <section class="col-lg-6 xconnectedSortable"> 
							<?php $_smarty_tpl->_subTemplateRender("file:plugins/Dashboard/templates/actualTransfers.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> 			
                        </section>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['todo']->value) {?>
                        <section class="col-lg-6 xconnectedSortable">
							<?php $_smarty_tpl->_subTemplateRender("file:plugins/Dashboard/templates/todo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> 								
                        </section>
						<?php }?>

						<?php if ($_smarty_tpl->tpl_vars['quickEmail']->value) {?>
                        <section class="col-lg-6 xconnectedSortable"> 
							<?php $_smarty_tpl->_subTemplateRender("file:plugins/Dashboard/templates/quickEmail.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> 
                        </section>
						<?php }?>
                        <section class="col-lg-6 xconnectedSortable">
                        </section>
                    </div>	        
<?php }
}
