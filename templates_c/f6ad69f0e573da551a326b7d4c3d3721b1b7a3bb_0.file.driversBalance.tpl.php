<?php
/* Smarty version 3.1.32, created on 2022-09-01 07:32:22
  from 'c:\wamp\www\jamtransfer\plugins\DriversTransfers\templates\driversBalance.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6310600677ea27_64103196',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f6ad69f0e573da551a326b7d4c3d3721b1b7a3bb' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\DriversTransfers\\templates\\driversBalance.tpl',
      1 => 1662013926,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6310600677ea27_64103196 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp\\www\\jamtransfer\\common\\libs\\plugins\\function.counter.php','function'=>'smarty_function_counter',),));
?><div class="container white">
   	
<?php ob_start();
echo $_REQUEST['StartDate'];
$_prefixVariable1 = ob_get_clean();
ob_start();
echo $_REQUEST['EndDate'];
$_prefixVariable2 = ob_get_clean();
if (isset($_prefixVariable1) && isset($_prefixVariable2) && $_REQUEST['StartDate'] > 0 && $_REQUEST['EndDate'] > 0) {?>
	
	<table class="table table-striped" style="font-size:0.8em">
	
	<?php
$__section_index_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['transfers']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_index_0_total = $__section_index_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_index'] = new Smarty_Variable(array());
if ($__section_index_0_total !== 0) {
for ($__section_index_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] = 0; $__section_index_0_iteration <= $__section_index_0_total; $__section_index_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']++){
?>

		<tr>
			<td>
				<?php echo smarty_function_counter(array(),$_smarty_tpl);?>

			</td>

			<td style="vertical-align:top;white-space: nowrap;">
				<b><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['OrderID'];?>
 - <?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['TNo'];?>
</b>
        	</td>

			<td style="vertical-align:top;white-space: nowrap;">
				<b><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['PaxName'];?>
</b> <br/>
				Pax:<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['PaxNo'];?>

				VT:<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['VehicleType'];?>
<br>
				Date:<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['PickupDate'];?>

			</td>

			<td>
				<b><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['PickupName'];?>
<br><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['DropName'];?>
</b><br/>
				Driver: <?php echo $_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)];?>

			</td>

			<td style="vertical-align:top;white-space: nowrap;">
			
							
				Cash:<?php echo number_format($_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['PayLater'],2);?>
EUR<br/>
				Driver:<?php echo number_format($_smarty_tpl->tpl_vars['driverPrices']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)],2);?>
EUR<br/>
				Balance:<?php echo number_format($_smarty_tpl->tpl_vars['balanceShow']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)],2);?>
EUR

			</td>
		</tr>
		
	<?php
}
}
?>

	</table>

	<br/>Total transfers: $i
    Total Cash:<?php echo number_format($_smarty_tpl->tpl_vars['totCash']->value,2);?>
,
    Total Driver:<?php echo number_format($_smarty_tpl->tpl_vars['totNetto']->value,2);?>

    Total Balance: <strong><?php echo number_format($_smarty_tpl->tpl_vars['balance']->value,2);?>
 EUR </strong>
    <br><br><strong>* Important Note:</strong>
    <br> negative balance means that JamTransfer owes this amount to Driver
    <br> positive Balance means that Driver owes this amount to JamTransfer
	<div align="left" >
	
	<br/> 
	
	
	</div>
	
	<div align="left">
		<a href="<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
driversTransfers/<?php echo $_REQUEST['StartDate'];?>
/<?php echo $_REQUEST['EndDate'];?>
/<?php echo $_REQUEST['includePaymentMethod'];?>
" class="btn btn-primary">&larr; Back to Drivers List</a>
			<br/>
							
		<?php if ($_REQUEST['driverid'] > 0) {?>
			<a class="btn btn-danger l" style="color:white !important;float:right;" id="CreateInvoice" href="<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
driversTransfers/invoice/<?php echo $_REQUEST['driverid'];?>
/<?php echo $_REQUEST['StartDate'];?>
/<?php echo $_REQUEST['EndDate'];?>
/<?php echo $_REQUEST['includePaymentMethod'];?>
">
			<i class="fa fa-cogs"></i> Create Invoice</a> &nbsp;&nbsp;
			<br/><br/>
		<?php }?>

		<br/><br/>

	</div> 	
	<hr><h4>Exported to CSV!</h4>
	<small>
	<a href="DriverBalance" class="btn btn-default"><i class="fa fa-download"></i> Download CSV</a>
	 You can download CSV file here (or Right-Click->Save)
	 <b>File format:</b> UTF-8, semi-colon (;) delimited</small>	

	</div>		
	


	<?php }?>
</div>
	
<?php }
}
