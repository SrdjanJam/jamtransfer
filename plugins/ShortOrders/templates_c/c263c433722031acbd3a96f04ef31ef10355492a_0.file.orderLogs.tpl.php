<?php
/* Smarty version 3.1.32, created on 2025-02-19 13:24:30
  from '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/ShortOrders/templates/orderLogs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_67b5db8e429062_91875524',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c263c433722031acbd3a96f04ef31ef10355492a' => 
    array (
      0 => '/home/jamtrans/laravel/public/wis.jamtransfer.com/plugins/ShortOrders/templates/orderLogs.tpl',
      1 => 1739971440,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67b5db8e429062_91875524 (Smarty_Internal_Template $_smarty_tpl) {
?><ul class="timeline">
	<?php
$__section_ind_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['logs']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_ind_0_total = $__section_ind_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_ind'] = new Smarty_Variable(array());
if ($__section_ind_0_total !== 0) {
for ($__section_ind_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_ind']->value['index'] = 0; $__section_ind_0_iteration <= $__section_ind_0_total; $__section_ind_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_ind']->value['index']++){
?>
		<li class="time-label">
			<span class="bg-light-blue">
				<?php echo $_smarty_tpl->tpl_vars['logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_ind']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_ind']->value['index'] : null)]['DateAdded'];?>

			</span>
		</li>
		<li>
			<i class="<?php echo $_smarty_tpl->tpl_vars['logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_ind']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_ind']->value['index'] : null)]['Icon'];?>
"></i>
			<div class="timeline-item">
				<span class="time">
					<i class="fa fa-clock-o"></i> <?php echo $_smarty_tpl->tpl_vars['logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_ind']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_ind']->value['index'] : null)]['TimeAdded'];?>

				</span>
				<span class="timeline-header">
					<?php echo $_smarty_tpl->tpl_vars['logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_ind']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_ind']->value['index'] : null)]['Title'];?>

				</span>

				<div class="timeline-body">
					<?php echo $_smarty_tpl->tpl_vars['logs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_ind']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_ind']->value['index'] : null)]['Description'];?>

				</div>
			</div>
		</li>
	<?php
}
}
?>
</ul>
<?php }
}
