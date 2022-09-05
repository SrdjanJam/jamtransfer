<?php
/* Smarty version 3.1.32, created on 2022-09-01 12:15:50
  from 'c:\wamp\www\jamtransfer\plugins\AgentsTransfers\templates\agentsBalance.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6310a27699f858_81860459',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '42e0046831333dc508b02deb15d18d659a4db908' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\AgentsTransfers\\templates\\agentsBalance.tpl',
      1 => 1662034366,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6310a27699f858_81860459 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp\\www\\jamtransfer\\common\\libs\\plugins\\function.counter.php','function'=>'smarty_function_counter',),));
?><div class="container white">

    <h2><?php echo $_smarty_tpl->tpl_vars['connectedAgent']->value;?>
</h2>

    <?php ob_start();
echo $_REQUEST['StartDate'];
$_prefixVariable1 = ob_get_clean();
ob_start();
echo $_REQUEST['EndDate'];
$_prefixVariable2 = ob_get_clean();
if (isset($_prefixVariable1) && isset($_prefixVariable2) && $_REQUEST['StartDate'] > 0 && $_REQUEST['EndDate'] > 0) {?>

        <?php if ($_REQUEST['NoShow'] == 1) {?><i class="fa fa-plus"></i> No-show<?php }?>
        <?php if ($_REQUEST['DrErr'] == 1) {?><i class="fa fa-plus"></i> Driver Error <br><br><?php }?>
        <?php if ($_REQUEST['CompletedTransfers'] == 1) {?><i class="fa fa-plus"></i> Completed Transfers Only<?php }?>
        <?php if ($_REQUEST['Sistem'] == 1) {?><i class="fa fa-plus"></i> Sistem<?php }?>

        <table class="table table-striped" style="white-space: nowrap">

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

                    <td style="vertical-align:top">
                        <b class="orderid"><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['OrderID'];?>
 - <?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['TNo'];?>
</b>
                        <br><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['PickupDate'];?>

                    </td>

                    <td>
                        <b><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['PaxName'];?>
</b> <br/>
                        Pax:<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['PaxNo'];?>

                        VT:<?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['VehicleType'];?>
pax
                    </td>

                    <td>
                        <b><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['PickupName'];?>
<br><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['DropName'];?>
</b><br/>
                        Driver: <br/><?php echo $_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['DriverID'];?>
 <?php echo $_smarty_tpl->tpl_vars['drivers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)];?>
<br/><br/>
                    </td>
                    
                    <td>
                        <?php echo number_format($_smarty_tpl->tpl_vars['transfers']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['InvoiceAmount'],2);?>
EUR<br/>

                                            </td>
                    
                    <td>
                        <button class='exclude'>Exclude</button>
                    </td>

                </tr>

            <?php
}
}
?>

        </table>

        <br/>Total transfers: <?php echo smarty_function_counter(array(),$_smarty_tpl);?>

        | Total Invoice: <?php echo number_format($_smarty_tpl->tpl_vars['totInv']->value,2);?>


        <div align="left">

            <?php if ($_REQUEST['pm'] == 4) {
$_smarty_tpl->_assignInScope('proc', 'agentsWTransfers');
}?>
            <?php if ($_REQUEST['pm'] == 6) {
$_smarty_tpl->_assignInScope('proc', 'agentsWTransfers2');
}?>


            <a href="<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
agentsTransfers/<?php echo $_REQUEST['StartDate'];?>
/<?php echo $_REQUEST['EndDate'];?>
/<?php echo $_REQUEST['NoShow'];?>
/<?php echo $_REQUEST['DrErr'];?>
/<?php echo $_REQUEST['CompletedTransfers'];?>
/<?php echo $_REQUEST['Sistem'];?>
"
            class="btn btn-primary">&larr; Back to Agents List</a>
            <br/>

                        
                <div class="right">
                    <a class="btn btn-danger l" style="color:white !important" id="CreateInvoice"
                    href="<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
agentsTransfers/invoice/<?php echo $_REQUEST['agentid'];?>
/<?php echo $_REQUEST['StartDate'];?>
/<?php echo $_REQUEST['EndDate'];?>
/<?php echo $_REQUEST['NoShow'];?>
/<?php echo $_REQUEST['DrErr'];?>
/<?php echo $_REQUEST['CompletedTransfers'];?>
/<?php echo $_REQUEST['Sistem'];?>
" target="_blank"><i class="fa fa-cogs"></i> Create Invoice</a> &nbsp;&nbsp;
                    <br/><br/>
                </div> 
        </div> 
        <hr><h4>Exported to CSV!</h4>

        <small>
            <a href="AgentBalance.csv" class="btn btn-default"><i class="fa fa-download"></i> Download CSV</a>
            You can download CSV file here (or Right-Click->Save).
            <b>File format:</b> UTF-8, semi-colon (;) delimited
        </small>

    <?php }?>

</div> <?php }
}
