<?php
/* Smarty version 3.1.32, created on 2023-09-11 09:12:19
  from 'C:\wamp\www\jamtransfer\plugins\Dashboard\templates\smallBoxes.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64febdd33483a4_74572958',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4654540dfd4cead6b4a20fd239d5de01b485ff42' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\plugins\\Dashboard\\templates\\smallBoxes.tpl',
      1 => 1690963085,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64febdd33483a4_74572958 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
                                  
    @media screen and (min-width:1398px) and (max-width: 1880px) {
        .target {
            font-weight: bold;
            color: #fbfbfb;
            animation-name: rightToLeft;
            animation-duration: 4.5s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
            /* animation: rightToLeft 4.5s linear infinite; */
            white-space: nowrap;
            }

            @keyframes rightToLeft {
                0% {
                    transform: translateX(200px);
                }
                100% {
                    transform: translateX(-160px);
                }
            }

    }

    @media screen and (max-width: 550px){
        .target {
            font-weight: bold;
            color: #fbfbfb;
            animation-name: rightToLeft;
            animation-duration: 4.5s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
            /* animation: rightToLeft 4.5s linear infinite; */
            white-space: nowrap;
            }

            @keyframes rightToLeft {
                0% {
                    transform: translateX(200px);
                }
                100% {
                    transform: translateX(-160px);
                }
            }
    }

</style>

                    <!-- Small boxes (Stat box) -->
                    <div class="row">

                        <div class="col-lg-2 col-xs-6">
                            <!-- small box -->
                            <a href="orders/newTransfers">
                                <div class="small-box xblue xwhite-text">
                                    <div class="inner">
                                        <h3>
                                            <?php echo $_smarty_tpl->tpl_vars['todayBooking']->value;?>

                                        </h3>
                                        <p>
                                            <?php echo $_smarty_tpl->tpl_vars['FROM']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['YESTERDAY']->value;?>

                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-cloud-download"></i>
                                    </div>
                                    
                                        <span  class="small-box-footer">
                                            <?php echo $_smarty_tpl->tpl_vars['MORE_INFO']->value;?>
 <i class="fa fa-arrow-circle-right"></i>
                                        </span>
                                    
                                </div>
                            </a>
                        </div><!-- ./col -->

                        
                        <div class="col-lg-2 col-xs-6">
                            <!-- small box -->
                            <a href="orders/notConfirmed">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>
                                            <?php echo $_smarty_tpl->tpl_vars['notConfirmedOrders']->value;?>

                                        </h3>
                                        <p>
                                            <?php echo $_smarty_tpl->tpl_vars['NOT_CONFIRMED']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['ALL']->value;?>

                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios7-alarm"></i>
                                    </div>
                                     <span class="small-box-footer">
                                        <?php echo $_smarty_tpl->tpl_vars['MORE_INFO']->value;?>
 <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div><!-- ./col -->      

						<div class="col-lg-2 col-xs-6">
                            <!-- small box -->
                            <a href="orders/notConfirmedToday">
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3>
                                            <?php echo $_smarty_tpl->tpl_vars['notConfirmedOrdersToday']->value;?>

                                        </h3>
                                        <div style="overflow-x: hidden;overflow-y: hidden;">
                                            <p class="target">
                                                <?php echo $_smarty_tpl->tpl_vars['TODAY_UNCONFIRMED_DECLINED']->value;?>
 
                                            </p>
                                        </div>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios7-alarm"></i>
                                    </div>
                                     <span class="small-box-footer">
                                        <?php echo $_smarty_tpl->tpl_vars['MORE_INFO']->value;?>
 <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div><!-- ./col -->	

						<div class="col-lg-2 col-xs-6">
                            <!-- small box -->
                            <a href="orders/notConfirmedTomorrow">
                                <div class="small-box bg-orange">
                                    <div class="inner">
                                        <h3>
                                            <?php echo $_smarty_tpl->tpl_vars['notConfirmedOrdersTomorrow']->value;?>

                                        </h3>
                                        <div style="overflow-x: hidden;overflow-y: hidden;">
                                            <p class="target">
                                                <?php echo $_smarty_tpl->tpl_vars['TOMORROW_UNCORFIRMED_DECLINED']->value;?>
 
                                            </p>
                                        </div>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios7-alarm"></i>
                                    </div>
                                     <span class="small-box-footer">
                                        <?php echo $_smarty_tpl->tpl_vars['MORE_INFO']->value;?>
 <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div><!-- ./col -->

                        <div class="col-lg-2 col-xs-6">
                            <!-- small box -->
                            <a href="orders/declined">
                                <div class="small-box red darken-2 xwhite-text">
                                    <div class="inner">
                                        <h3>
                                            <?php echo $_smarty_tpl->tpl_vars['declined']->value;?>

                                        </h3>
                                        <p>
                                            <?php echo $_smarty_tpl->tpl_vars['DECLINED']->value;?>

                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-nuclear"></i>
                                    </div>
                                     <span class="small-box-footer">
                                        <?php echo $_smarty_tpl->tpl_vars['MORE_INFO']->value;?>
 <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div><!-- ./col -->

                        <div class="col-lg-2 col-xs-6">
                            <!-- small box -->
                            <a href="orders/tomorrow">
                                <div class="small-box teal darken-2 xwhite-text">
                                    <div class="inner">
                                        <h3>
                                            <?php echo $_smarty_tpl->tpl_vars['tomorrowTransfers']->value;?>

                                        </h3>
                                        <p>
                                            <?php echo $_smarty_tpl->tpl_vars['TOMORROW']->value;?>

                                        </p>
                                    </div>
                                    <div class="icon ">
                                        <i class="fa fa-car"></i>
                                    </div>
                                     <span class="small-box-footer">
                                        <?php echo $_smarty_tpl->tpl_vars['MORE_INFO']->value;?>
 <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div><!-- ./col -->

                    </div><!-- /.row -->
<?php }
}
