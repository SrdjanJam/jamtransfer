<?php
/* Smarty version 3.1.32, created on 2022-04-26 12:08:27
  from 'c:\wamp\www\jamtransfer\plugins\Menu\templates\page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6267e0bb8133b9_73801592',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2908fd7d02c41fde975b49dab8c63076032974ac' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\Menu\\templates\\page.tpl',
      1 => 1650974870,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6267e0bb8133b9_73801592 (Smarty_Internal_Template $_smarty_tpl) {
?>
      <div id="wrapper">
         <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
               <ul class="nav metismenu" id="side-menu">
                  <li class="nav-header">
                     <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"><a href="plg_profile" data-param=""><strong class="font-bold">Korisnik</strong></a></span>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                           <li><a href="plg_profile" data-param="">Profile</a></li>
                           <li class="divider"></li>
                           <li><a href='logout'>Logout</a></li>
                        </ul>
                     </div>
					</li>
					<li class="active"><a href="plg_dashboard" data-param=""><i class='fa fa-th-large'></i><span>Dashboard</span></a></li>
					<li class="">
						<a>
							<i class="fa fa-newspaper-o"></i> 
							<span class="nav-label">Menu1</span> 
							<span class="fa arrow"></span>
						</a>
						<ul class="nav nav-second-level collapse">
							<li>
								<a href="link1"><span class="nav-label">Menu11</span></a>
							</li>
							<li>
								<a href="link2"><span class="nav-label">Menu12</span></a>
							</li>
							<li>
								<a href="link3"><span class="nav-label">Menu13</span></a>
							</li>
						</ul>
					</li>


               </ul>

            </div>
         </nav>
         <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
               <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                  <div class="navbar-header">
                     <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                  </div>
                  <div class="navbar-header">
                     <button type="button" class="minimalize-styl-2 btn btn-primary " id="cashe"><i class="fa fa-refresh"></i></button>
                  </div>

                  <ul class="nav navbar-top-links navbar-right">
                     <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome</span>
                     </li>
                     <li>
                        <a href='logout'>
                        <i class="fa fa-sign-out"></i>Logout
                        </a>
                     </li>
                  </ul>
               </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
               <div class="col-lg-10">
                  <h2 id='title'>Dashboard</h2>
                  <ol class="breadcrumb">
                     <li class="active">
                        <strong id='title2'>Dashboard</strong>
                     </li>
                  </ol>
               </div>
            </div>
            <div class="footer">
               <div class="pull-right">
               </div>
               <div>
                  Powered by <strong>Jamtransfer</strong>
               </div>
               <div class="backdrop"><div class="spiner"></div></div>
			   <div class="backdropP"><div class="spiner"></div></div>
            </div>
         </div>
      </div>


<?php }
}
