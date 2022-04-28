<?php
/* Smarty version 3.1.32, created on 2022-04-26 08:37:06
  from 'C:\wamp\www\jamtransfer\templates\menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6267af32e26047_83090317',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6de87eba5c3cf55681dd030b768a422483ab5c50' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\menu.tpl',
      1 => 1650962017,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6267af32e26047_83090317 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
   <head>
      <title>Administration - CMS Studio</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv='cache-control' content='no-cache'>
		<meta http-equiv='expires' content='0'>
		<meta http-equiv='pragma' content='no-cache'>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="css/admin.css" rel="stylesheet">

   </head>
   <body>
      <div id="wrapper">
         <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
               <ul class="nav metismenu" id="side-menu">
                  <li class="nav-header">
                     <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"><a data-folder="plg_profile" data-param=""><strong class="font-bold">Korisnik</strong></a></span>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                           <li><a data-folder="plg_profile" data-param="">Profile</a></li>
                           <li class="divider"></li>
                           <li><a href='index.php?action=logout'>Logout</a></li>
                        </ul>
                     </div>
					</li>
					<li class="active"><a data-folder="plg_dashboard" data-param=""><i class='fa fa-th-large'></i><span>Dashboard</span></a></li>

                  <?php echo $_smarty_tpl->tpl_vars['admin_tree']->value;?>



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
                        <a href='index.php?action=logout'>
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

	  

      <!-- Mainly scripts -->
      <?php echo '<script'; ?>
 src="js/main.min.js"><?php echo '</script'; ?>
>


   </body>
<?php }
}
