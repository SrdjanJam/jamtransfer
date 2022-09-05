<?php
/* Smarty version 3.1.32, created on 2022-09-02 09:05:02
  from 'c:\wamp\www\jamtransfer\plugins\AgentsTransfers\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6311c73e110384_73833390',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '31313388af91ff3f96be675408c6770e3aa7b4db' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\AgentsTransfers\\templates\\index.tpl',
      1 => 1662107136,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6311c73e110384_73833390 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['root']->value)."/templates/add-style.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<div class="container white">

    <?php if (isset($_REQUEST['NoShow'])) {?>

        <h2>Select Agent</h2> 
        <?php echo $_REQUEST[$_smarty_tpl->tpl_vars['StartDate']->value];
echo $_REQUEST[$_smarty_tpl->tpl_vars['EndDate']->value];?>
<br>
        <?php if ($_REQUEST['NoShow'] == 1) {?><i class="fa fa-plus"></i> No-show<?php }?>
        <?php if ($_REQUEST['DrErr'] == 1) {?><i class="fa fa-plus"></i> Driver Error<?php }?>
        <?php if ($_REQUEST['CompletedTransfers'] == 1) {?><i class="fa fa-plus"></i> Completed Transfers Only<?php }?>
        <?php if ($_REQUEST['Sistem'] == 1) {?><i class="fa fa-plus"></i> Sistem<?php }?>
        <br><br>

        <div class="row" style="font-weight:bold">

            <div class="col-md-1 text-right">
                ID
            </div>
            <div class="col-md-9">
                Agent
            </div>

        </div>
	
        <?php
$__section_index_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_index_0_total = $__section_index_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_index'] = new Smarty_Variable(array());
if ($__section_index_0_total !== 0) {
for ($__section_index_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] = 0; $__section_index_0_iteration <= $__section_index_0_total; $__section_index_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']++){
?>
                        <div class="row row_e" style="border-bottom: 1px solid #ccc">    
                <div class="col-md-1 text-right"><?php echo $_smarty_tpl->tpl_vars['user']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['AuthUserID'];?>
</div>
                <a href="<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
agentsTransfers/agentsBalance/<?php echo $_smarty_tpl->tpl_vars['user']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['AuthUserID'];?>
/<?php echo $_REQUEST['StartDate'];?>
/<?php echo $_REQUEST['EndDate'];?>
/<?php echo $_REQUEST['Sistem'];?>
/<?php echo $_REQUEST['NoShow'];?>
/<?php echo $_REQUEST['DrErr'];?>
/<?php echo $_REQUEST['CompletedTransfers'];?>
">
                    <div class="col-md-9 col_e"><?php echo $_smarty_tpl->tpl_vars['user']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['AuthUserCompany'];?>
 <?php echo $_smarty_tpl->tpl_vars['connectedUserNamePlus']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)];?>
</div>
                </a>
                
            </div>
            
        <?php
}
}
?>
		
        <?php } else { ?>

            <form action="" method="post">

                <div class="row">
                    <div class="col-md-2">
                        <label>Start Date</label>
                    </div>
                    <div class="col-md-4 col-md-4_e">
                        <input type="text" name="StartDate" class="form-control datepicker">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        <label>End Date</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="EndDate" class="form-control datepicker">
                    </div>
                </div>

                <div class="row"><div class="col-md-12"><hr/></div></div>

                <div class="row">
                    <div class="col-md-2">
                        <label><b>Sistemi</b></label>
                    </div>
                    <div class="col-md-4">
                        Sistem <input type="checkbox" name="Sistem" class="form-control" value="1">
                    </div>
                </div>

                <div class="row"><div class="col-md-12"><hr/></div></div>

                <div class="row">
                    <div class="col-md-2">
                        <label><b>Include</b></label>
                    </div>
                    <div class="col-md-3">
                        No-show <input type="checkbox" name="NoShow" class="form-control" value="1">
                    </div>
                    <div class="col-md-3">
                        Driver error <input type="checkbox" name="DrErr" class="form-control" value="1">
                    </div>
                    <div class="col-md-4">
                        Completed transfers only <input type="checkbox" name="CompletedTransfers" class="form-control" value="1">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <br>
                        <button class="btn btn-primary" type="submit" name="Submit" value="1">Go</button>
                        <br><br>
                    </div>
                </div>

            </form>

    <?php }?>


</div>


<?php }
}
