<?php
/* Smarty version 3.1.32, created on 2023-09-11 09:12:17
  from 'C:\wamp\www\jamtransfer\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64febdd10f7fa4_11081931',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a1818a92b5a2f041fd91a227dabc592dea38fac2' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\index.tpl',
      1 => 1693199492,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:pageListHeader.tpl' => 1,
    'file:pageListHeader2.tpl' => 1,
    'file:pageList.tpl' => 1,
    'file:plugins/Dashboard/templates/getOrder.tpl' => 1,
  ),
),false)) {
function content_64febdd10f7fa4_11081931 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
">
		
		<meta charset="UTF-8">
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

		<title>WIS <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>


		<!-- 
		
		NOTES:

		- Bootstrap and Jquery links are moved inside rows.
	
		-->


		<!-- LINKS TAGS: -->

		<!-- ======================================================================================== -->
		<!-- Bootstrap: -->
				<!-- bootstrap local 3.0.2 -->
								<!-- Bootstrpa 3.3.2 cdn: -->
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<!-- ======================================================================================== -->
		<!-- font-awesome cdn: -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!-- font Awesome Older local: -->
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<!-- ======================================================================================== -->
		<!-- Ionicons: -->
		<link href="css/ionicons.min.css" rel="stylesheet" type="text/css"/>
		<!-- ======================================================================================== -->
		<!-- Morris chart: -->
		<link href="css/morris/morris.css" rel="stylesheet" type="text/css"/>
		<!-- ======================================================================================== -->
				<!-- bootstrap wysihtml5 - text editor -->
				<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" media="screen"/>
				<link href="css/bootstrap-slider/slider.css" rel="stylesheet" type="text/css"/>
		<!-- ======================================================================================== -->
		<!-- summernote: -->	
		<link href="js/summernote/summernote.css" rel="stylesheet" type="text/css" media="screen"/>
		<!-- ======================================================================================== -->
		<!-- Theme style WORKING !!!-->
		<link href="css/theme.css" rel="stylesheet" type="text/css" media="screen"/>
		<!-- Preuzeto za novu administraciju: -->
		<link href="css/admin.css" rel="stylesheet">
		<!-- ======================================================================================== -->
		<!-- pickadate old: -->
				<!-- ======================================================================================== -->
		<!-- colors.css: -->
		<link rel="stylesheet" href="css/colors.css" media="all">
		<!-- ======================================================================================== -->
		<!-- Select 2: -->
		<link rel="stylesheet" type="text/css" href="js/select/css/select2.css">
		<!-- ======================================================================================== -->
		<!-- simplegrid -->
		<!-- <link rel="stylesheet" href="css/simplegrid.css" media="all"> -->
		<!-- ======================================================================================== -->
		<!-- JAMTimepicker old -->
				<!-- ======================================================================================== -->
		

				
			<!-- SCRIPT AND LINK TAGS: -->

			<!-- SCRIPTS -->
			<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!--[if lt IE 9]>
			<?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"><?php echo '</script'; ?>
>
			<![endif]-->

			<!-- ======================================================================================== -->
					<!-- jQuery: -->
					<?php echo '<script'; ?>
 src="js/jQuery/2.0.2/jquery.min.js"><?php echo '</script'; ?>
>
					<!-- cdn: -->
													<!-- ======================================================================================== -->
			<!-- Mainly scripts: -->
			<?php echo '<script'; ?>
 src="js/main.admin.js"><?php echo '</script'; ?>
>
			<!-- ======================================================================================== -->
					<!-- Datetimepicker new: -->
					<?php echo '<script'; ?>
 src="js/datetimepicker/build/jquery.datetimepicker.full.min.js"><?php echo '</script'; ?>
>
			<!-- ======================================================================================== -->
					<!-- jQuery UI 1.10.3: -->
					<?php echo '<script'; ?>
 src="js/jQuery/ui/1.10.3/jquery-ui.min.js" type="text/javascript"><?php echo '</script'; ?>
>
													<!-- ======================================================================================== -->
					<!-- Bootstrap: -->
					<!-- <?php echo '<script'; ?>
 src="js/bootstrap.js" type="text/javascript"><?php echo '</script'; ?>
> -->
					<!-- cdn: -->
								<!-- ======================================================================================== -->
					<!-- Jquery ui css: -->
					<!-- <link rel="stylesheet" href="css/jquery-ui-1.8.9.custom.css" type="text/css" /> -->
					<!-- cdn: -->
										<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
					<?php echo '<script'; ?>
 src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"><?php echo '</script'; ?>
>
			<!-- ======================================================================================== -->
			<!-- Morris.js charts: -->
			<?php echo '<script'; ?>
 src="js/plugins/raphael/2.1.0/raphael-min.js"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="js/plugins/morris/morris.min.js" type="text/javascript"><?php echo '</script'; ?>
>
			<!-- ======================================================================================== -->
			<!-- Sparkline: -->
			<?php echo '<script'; ?>
 src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"><?php echo '</script'; ?>
>
			<!-- ======================================================================================== -->
					<!-- jQuery Knob Chart: -->
					<?php echo '<script'; ?>
 src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"><?php echo '</script'; ?>
>
			<!-- ======================================================================================== -->
					<!-- Bootstrap WYSIHTML5: -->
					<?php echo '<script'; ?>
 src="js/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"><?php echo '</script'; ?>
>
					<?php echo '<script'; ?>
 src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"><?php echo '</script'; ?>
>
					<?php echo '<script'; ?>
 src="js/plugins/bootstrap-slider/bootstrap-slider.js" type="text/javascript"><?php echo '</script'; ?>
>
			<!-- ======================================================================================== -->
			<!-- iCheck: -->
			<?php echo '<script'; ?>
 xsrc="js/plugins/iCheck/icheck.min.js" type="text/javascript"><?php echo '</script'; ?>
>
			<!-- ======================================================================================== -->
					<!-- Validation: -->
					<?php echo '<script'; ?>
 src="js/jquery.validate.min.js"><?php echo '</script'; ?>
>
			<!-- ======================================================================================== -->
					<!-- Time Picker query-clock-timepicker: -->
					<?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-clock-timepicker/jquery-clock-timepicker.min.js"><?php echo '</script'; ?>
>

					<!-- Date Picker and time picker old: /  -->
										<!-- Pick date old: -->
								<!-- ======================================================================================== -->
			<!-- select 2: -->
			<?php echo '<script'; ?>
 src="js/select/js/select2.js"><?php echo '</script'; ?>
>
			<!-- ======================================================================================== -->
			<!-- Moment: -->
			<?php echo '<script'; ?>
 src="js/moment.min.js" type="text/javascript"><?php echo '</script'; ?>
>
			<!-- ======================================================================================== -->
			<!-- App: -->
			<?php echo '<script'; ?>
 src="js/theme/app.js" type="text/javascript"><?php echo '</script'; ?>
>
			<!-- ======================================================================================== -->
			<!-- Misc: -->
			<?php echo '<script'; ?>
 src="js/handlebars-v1.3.0.js"><?php echo '</script'; ?>
>
					<?php echo '<script'; ?>
 src="js/jquery.slugify.js"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="js/summernote/summernote.js"><?php echo '</script'; ?>
>
					<?php echo '<script'; ?>
 src="js/jquery.toaster.js"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="lng/<?php echo $_smarty_tpl->tpl_vars['language']->value;?>
_init.js"><?php echo '</script'; ?>
>	
					<?php echo '<script'; ?>
 src="js/cms.jquery.js"><?php echo '</script'; ?>
>

				<?php if ($_smarty_tpl->tpl_vars['pageList']->value) {?>

			<?php echo '<script'; ?>
 src="js/list.js"><?php echo '</script'; ?>
>

					
				<?php echo '<script'; ?>
 type="text/javascript">
					window.root = 'plugins/<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/';
					window.currenturl = '<?php echo $_smarty_tpl->tpl_vars['currenturl']->value;?>
';
					window.rootbase='<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
';
				<?php echo '</script'; ?>
>
			

			<?php if ($_smarty_tpl->tpl_vars['isNew']->value) {?>
			<?php echo '<script'; ?>
 type="text/javascript">
				$(document).ready(function(){
					new_Item(); 
				});	
			<?php echo '</script'; ?>
>
			<?php } else { ?>

			
			<?php echo '<script'; ?>
 type="text/javascript">
				$(document).ready(function(){
					allItems(); 
					oneItem(<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
);
				});	
			<?php echo '</script'; ?>
>
			

			<?php }?>

		<?php }?>
		
	</head>

	
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['root']->value)."/templates/default-style.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['root']->value)."/templates/add-style.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>


		<body class="fixed-top body-edit">
				<div class="wrapper wrapper-edit">

						<nav class="navbar-default navbar-default-edit navbar-static-side additional-class" role="navigation">
				<i class="lab la-accessible-icon"></i>

				<!-- SIDEBAR COLLAPSE: -->
				<div class="sidebar-collapse">
					<ul class="nav metismenu" id="side-menu">
						<!-- PROFILE: -------------------------------------------------------------------------------- -->
						<!-- Header in navbar - nav-header-top-edit -->
						<li class="nav-header nav-header-top-edit">
							<div class="dropdown profile-element" style="text-align:center;">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear"> 
								<span class="block m-t-xs">
									<a href="profile" >
										<img src="api/showProfileImage.php?UserID=<?php echo $_SESSION['AuthUserID'];?>
" class="img-circle" alt="User Image" style="height:2em;padding:-.5em;margin:-.5em" />
										<strong class="font-bold" style="margin:0 0 0 10px;"><?php echo $_SESSION['UserRealName'];?>
</strong>
									</a>
								</span>

								<!-- Logout link: -->
								<div style="margin-top:12px;text-decoration:underline;text-align:center;"><a href='logout.php'><?php echo $_smarty_tpl->tpl_vars['LOGOUT']->value;?>
 <i class="fa fa-sign-out"></i></a></div>

								<ul class="dropdown-menu animated fadeInRight m-t-xs">
									<li><a href="profile" data-param=""><?php echo $_smarty_tpl->tpl_vars['PROFILE']->value;?>
</a></li>
									<li class="divider"></li>
									<li><a href='logout.php'><?php echo $_smarty_tpl->tpl_vars['LOGOUT']->value;?>
</a></li>
								</ul>

							</div>
						</li>
						<!-- End of PROFILE -------------------------------------------------------------------------- -->

						<!-- SETTING DRIVER: -------------------------------------------------------------------------- -->
						<?php if ($_smarty_tpl->tpl_vars['setasdriver']->value) {?>
							
							<?php if (isset($_SESSION['UseDriverName'])) {?>
								<!-- Header in navbar - nav-header nav-header-edit -->
								<li class="nav-header nav-header-edit">
									<h3 id="set-as"><?php echo $_smarty_tpl->tpl_vars['SET_AS']->value;?>
:</h3>
									<h3 class="cut-name"><?php echo $_SESSION['UseDriverName'];?>
</h3>
									<a href="setout.php" id="a-setout"><?php echo $_smarty_tpl->tpl_vars['SETOUT']->value;?>
 &nbsp;<i class="fas fa-sign-out-alt"></i></a>	
								</li>
							<?php } else { ?>
								<?php if (isset($_COOKIE['UseDriverName'])) {?>
									<!--Header in navbar - Set as with cookie -->
									<li class="nav-header nav-header-edit nav-header-edit-2">
										<a href="satAsDriver/<?php echo $_COOKIE['UseDriverID'];?>
" style="padding-left:5px;padding-right:0px;">
											<h3 id="set-us-2"><?php echo $_smarty_tpl->tpl_vars['READY_FOR_SET_AS']->value;?>
: <i class="fas fa-sign-in-alt"></i></h3>
											<h3 class="cut-name-2"><?php echo $_COOKIE['UseDriverName'];?>
</h3>
										</a>
									</li>
								<?php }?>
							<?php }?>
							
						<?php }?>
						<!-- End of SETTING DRIVER ------------------------------------------------------------------------ -->

						<!-- Items of sidebar -->
						<?php
$__section_index_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['menu1']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_index_0_total = $__section_index_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_index'] = new Smarty_Variable(array());
if ($__section_index_0_total !== 0) {
for ($__section_index_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] = 0; $__section_index_0_iteration <= $__section_index_0_total; $__section_index_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']++){
?>
							<li class="<?php echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['active'];?>
">
								<a href='<?php echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['link'];?>
' >
									<i class="fa <?php echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['icon'];?>
 edit-fa"></i>
									<span class="nav-label nav-label-edit" title="<?php echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['description'];?>
"><?php echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['title'];?>
 <span class='badge'><?php echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['phasestatus'];?>
</span></span> 
									<span class="<?php echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['arrow'];?>
"></span>
								</a>

								
								<?php if ($_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['menu']) {?>
									<!-- collapse sidebar: -->
									<ul class="nav nav-second-level collapse">
										<?php
$__section_index1_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['menu']) ? count($_loop) : max(0, (int) $_loop));
$__section_index1_1_total = $__section_index1_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_index1'] = new Smarty_Variable(array());
if ($__section_index1_1_total !== 0) {
for ($__section_index1_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_index1']->value['index'] = 0; $__section_index1_1_iteration <= $__section_index1_1_total; $__section_index1_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_index1']->value['index']++){
?>
											<li class="<?php echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['menu'][(isset($_smarty_tpl->tpl_vars['__smarty_section_index1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index1']->value['index'] : null)]['active'];?>
">
												<a href="<?php echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['menu'][(isset($_smarty_tpl->tpl_vars['__smarty_section_index1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index1']->value['index'] : null)]['link'];?>
"><span class="nav-label nav-label-edit-2" title="<?php echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['menu'][(isset($_smarty_tpl->tpl_vars['__smarty_section_index1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index1']->value['index'] : null)]['description'];?>
"><?php echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['menu'][(isset($_smarty_tpl->tpl_vars['__smarty_section_index1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index1']->value['index'] : null)]['title'];?>
 <span class='badge'><?php ob_start();
echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['menu'][(isset($_smarty_tpl->tpl_vars['__smarty_section_index1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index1']->value['index'] : null)]['phasestatus'];
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>
</span></span></a>
											</li>
										<?php
}
}
?>
									</ul> <!-- End of collapse: ul -->
								<?php }?>

							</li>
						<?php
}
}
?>

				   </ul> <!-- End of nav metismenu -->
				   
				   
				   <!-- Developing status: -->
				   <ul id="status" style="list-style-type:none;">
						<li><?php echo $_smarty_tpl->tpl_vars['A_ACTIVE']->value;?>
</li>
						<li><?php echo $_smarty_tpl->tpl_vars['T_TEST']->value;?>
</li>
						<li><?php echo $_smarty_tpl->tpl_vars['D_DEVELOPMENT']->value;?>
</li>
						<li><?php echo $_smarty_tpl->tpl_vars['P_PLAN']->value;?>
</li>
				   </ul>

				</div> <!-- End of sidebar-collapse -->
				
			</nav> <!-- End of navbar-default navbar-static-side -->
			
						<div id="page-wrapper" class="content gray-bg dashbard-1 page-wrapper-edit">

								<!-- Main header - border-bottom-edit: -->
				<div class="header row border-bottom border-bottom-edit">
					<!-- navbar -->	
					<nav class="navbar navbar-static-top navbar-static-top-edit" role="navigation" style="margin-bottom: 0">
						
						<div class="navbar-left-add" style="display:inline-block;">
							<!-- Minimalize -->
							<div class="navbar-header">
								<a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-primary-edit"><i class="fa fa-bars"></i> </a>
							</div>

							<!-- Refresh -->
							<div class="navbar-header">
								<button type="button" class="minimalize-styl-2 btn btn-primary btn-primary-edit" id="cashe"><i class="fas fa-redo-alt"></i></button>
							</div>

							<!-- Page title and database: -->
							<h2 style="display:inline-block;margin: 15px 0 0 55px;vertical-align: super;">
								<span class="m-r-sm text-muted"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 - <?php echo $_SESSION['log_title'];?>
</span>
								<?php if ($_smarty_tpl->tpl_vars['fieldsSettings']->value == 1) {?><span class="m-r-sm text-muted"> / Fields Settings</span><?php }?>
								</h2>

						</div>

						<ul class="nav navbar-top-links navbar-right">
							<!-- Opener dialog button: -->
							<li><button type="button" id="opener-help" class="button-3"><?php echo $_smarty_tpl->tpl_vars['HELP']->value;?>
</button></li>
							<li><button type="button" id="opener-message" class="button-3"><?php echo $_smarty_tpl->tpl_vars['MESSAGE']->value;?>
</button></li>

							<!-- Prev version: -->
							<!-- <li> <h2><span class="m-r-sm text-muted"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 - <?php echo $_SESSION['log_title'];?>
</span></h2> </li> -->

							<!-- Logout: -->
							<li><a href='logout.php'><i class="fa fa-sign-out"></i><?php echo $_smarty_tpl->tpl_vars['LOGOUT']->value;?>
</a></li>

						</ul>
						
						<!-- Dialog printed results here: -->
						<div style="display:none;" class="dialog-help"></div>
						<div style="display:none;" class="dialog-message">
							<textarea data-id="<?php echo $_smarty_tpl->tpl_vars['ModulID']->value;?>
" class="textarea-dialog"></textarea>						
							<div class="previous-messages"></div>
						</div>
					
					</nav>
				</div> <!-- /.header row border-bottom -->
				<!-- END OF HEADER ========================================================================================== -->		
			
				<?php if (!$_smarty_tpl->tpl_vars['isNew']->value && $_smarty_tpl->tpl_vars['pageList']->value) {?> 							
					<!-- .header -->
					<div class="header header-edit 
						<?php if ($_smarty_tpl->tpl_vars['orderid']->value > 0) {?>hidden<?php }?>
					">  
						<?php if ($_smarty_tpl->tpl_vars['pageList']->value != $_smarty_tpl->tpl_vars['ORDERS']->value) {?>
							<?php $_smarty_tpl->_subTemplateRender("file:pageListHeader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> <!-- Second header -->		
						<?php } else { ?>
							<?php $_smarty_tpl->_subTemplateRender("file:pageListHeader2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> 
						<?php }?>						
					</div> 				<?php }?>

				<?php if ($_smarty_tpl->tpl_vars['pageName']->value == 'Price Rules') {?>	
					<!-- .header row -->
					<div class="header row"> 
						<div class="pull-left">
							<span><?php echo $_smarty_tpl->tpl_vars['RULE']->value;?>
: <strong><?php echo $_REQUEST['rulesType'];?>
</strong></span>
							<?php if ($_smarty_tpl->tpl_vars['routeName']->value) {?><span><?php echo $_smarty_tpl->tpl_vars['ROUTE']->value;?>
:<strong><?php echo $_smarty_tpl->tpl_vars['routeName']->value;?>
</strong></span><?php }?>
							<?php if ($_smarty_tpl->tpl_vars['vehicleName']->value) {?><span><?php echo $_smarty_tpl->tpl_vars['VEHICLE']->value;?>
:<strong><?php echo $_smarty_tpl->tpl_vars['vehicleName']->value;?>
</strong></span><?php }?>

						</div>

					</div> <!-- /.header row -->
				<?php }?>

								<div class="body row white-bg white-bg-edit">
					
					<?php if (isset($_smarty_tpl->tpl_vars['pageOLD']->value)) {?>
						<?php echo NOT_MODEL_VIEW_CONTROL;?>

						<?php } elseif (isset($_smarty_tpl->tpl_vars['pageName']->value) && $_smarty_tpl->tpl_vars['pageName']->value != '') {?>
							<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['root']->value)."/plugins/".((string)$_smarty_tpl->tpl_vars['base']->value)."/templates/".((string)$_smarty_tpl->tpl_vars['includeFileTpl']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
						<?php } elseif ($_smarty_tpl->tpl_vars['pageList']->value) {?>
								<?php $_smarty_tpl->_subTemplateRender("file:pageList.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> 
							<?php if ($_smarty_tpl->tpl_vars['orderid']->value > 0) {?>
								<?php $_smarty_tpl->_subTemplateRender("file:plugins/Dashboard/templates/getOrder.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> 			
							<?php }?>
						<?php } else { ?>
							<?php echo $_smarty_tpl->tpl_vars['page_render']->value;?>

					<?php }?>

				</div> <!-- / .body row white-bg -->

								<div class="footer row footer-edit">

					<!-- Show and Hide Filters buttons: -->
					<div id="footer-filters">
						<div id="filter-show" class="button-toggle"><i class="fa-solid fa-bars fa-bars-edit"></i><?php echo $_smarty_tpl->tpl_vars['SHOW_FOOTER']->value;?>
</div>
						<div id="filter-hide" class="button-toggle"><i class="fa-solid fa-bars fa-bars-edit"></i><?php echo $_smarty_tpl->tpl_vars['HIDE_FOOTER']->value;?>
</div>
					</div>

					<!-- Filter -->
					<div class="filter-wrapper">

						<?php if (!$_smarty_tpl->tpl_vars['isNew']->value && $_smarty_tpl->tpl_vars['pageList']->value) {?>

							<div class="col-md-2 col-md-2-infoShow" id="infoShow"></div>

								<div id="pageSelect" class=" pull-left pull-left-edit col-md-3"></div>
							
								<?php if (!isset($_smarty_tpl->tpl_vars['pagelength']->value)) {
$_smarty_tpl->_assignInScope('pagelength', "10");
}?>
							
								<div class="col-md-3">
									<i class="fa fa-eye edit-fa"></i>
									<div class="form-group group-edit">
										<select id="length" class="w75 form-control control-edit" onchange="allItems();">
											<option value="5" <?php if ($_smarty_tpl->tpl_vars['pagelength']->value == '5') {?> selected <?php }?>> 5 </option>
											<option value="10" <?php if ($_smarty_tpl->tpl_vars['pagelength']->value == '10') {?> selected <?php }?>> 10 </option>
											<option value="20" <?php if ($_smarty_tpl->tpl_vars['pagelength']->value == '20') {?> selected <?php }?>> 20 </option>
											<option value="50" <?php if ($_smarty_tpl->tpl_vars['pagelength']->value == '50') {?> selected <?php }?>> 50 </option>
											<option value="100" <?php if ($_smarty_tpl->tpl_vars['pagelength']->value == '100') {?> selected <?php }?>> 100 </option>
										</select>
									</div>
								</div>
							
							<?php if ($_smarty_tpl->tpl_vars['existNew']->value) {?>
								<div class="col-md-1"><a class="btn btn-primary btn-xs btn-xs-edit" href="<?php echo $_smarty_tpl->tpl_vars['currenturl']->value;?>
/new"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
							<?php }?>		

						<?php }?>
						<div class="pull-right pull-right-edit col-md-2">
							<?php echo $_smarty_tpl->tpl_vars['POWERED_BY']->value;?>
 <strong><a href="https://taxicms.com/" target="_blank"><?php echo $_smarty_tpl->tpl_vars['TAXI_CMS']->value;?>
</a></strong>
						</div>
						
						

					</div> <!-- /.filter-wrapper --> 

					<div class="backdrop"><div class="spiner"></div></div>

				</div><!-- /.footer row -->
				<!-- END OF FOOTER ================================================================================= -->

			</div> <!-- End of page-wrapper -->

		</div> <!-- End of wrapper -->
		<!-- END OF WRAPPER ================================================================================================== -->

		<input type="hidden" id="fieldsSettings" name="fieldsSettings" value="<?php echo $_smarty_tpl->tpl_vars['fieldsSettings']->value;?>
">
		<input type="hidden" id="levelID" name="levelID" value="<?php echo $_smarty_tpl->tpl_vars['levelID']->value;?>
">
		<input type='hidden' id='ModuleID' value='<?php echo $_smarty_tpl->tpl_vars['ModulID']->value;?>
' name='ModuleID'>
		<input type='hidden' id='local' value='<?php echo $_smarty_tpl->tpl_vars['local']->value;?>
' name='local'>
		<input type='hidden' id='success' value='<?php echo $_smarty_tpl->tpl_vars['SUCCESS']->value;?>
' name='success'>
		<input type='hidden' id='unsuccess' value='<?php echo $_smarty_tpl->tpl_vars['UNSUCCESS']->value;?>
' name='unsuccess'>
		<input type='hidden' id='delete' value='<?php echo $_smarty_tpl->tpl_vars['DELETE_ROW']->value;?>
' name='delete'>
		
		<div style="display:none;" id="fsBlock" data-attr="">
			<span><label><?php echo $_smarty_tpl->tpl_vars['REQUIRED']->value;?>
</label> <input type="checkbox" class="" name="required" value="" data-attr=""/></span>
			<span><label><?php echo $_smarty_tpl->tpl_vars['DISABLED']->value;?>
</label> <input type="checkbox" class="" name="disabled" value="" data-attr=""/></span>
			<span><label><?php echo $_smarty_tpl->tpl_vars['HIDDEN']->value;?>
</label> <input type="checkbox" class="" name="hidden" value="" data-attr=""/></span>
		</div>

	</body>
</html>




	<?php echo '<script'; ?>
>
		document.addEventListener("keydown", function(event) {
			//event.preventDefault();
			if (event.which==121) window.open(window.location.href+'/help','_blank');
		})
		$(document).ready(function() {
			// datepicker:
			$('.datepicker').datetimepicker({
				// yearOffset:2,
				lang:'en',
				timepicker:false,
				format:'Y-m-d',
				formatDate:'Y-m-d',
				closeOnDateSelect:true
				// minDate:'-1970/01/02', // yesterday is minimum date
				// maxDate:'+1970/01/02' // and tommorow is maximum date calendar
			});
			// timepicker:
			$('.timepicker').clockTimePicker();
		});
		$.ajaxSetup({
			beforeSend: function (xhr,settings) {
				return settings;
			}
		});

	<?php echo '</script'; ?>
>




<?php echo '<script'; ?>
>

	$(document).ready(function(){

		window.success = $("#success").val();
		window.unsuccess = $("#unsuccess").val();
		window.delete = $("#delete").val();
		
		// toggleClass:
		$("a.navbar-minimalize").click(function(){
			$("nav.navbar-default").toggleClass("additional-class"); // Full navbar
			$("#status").toggle(100,function(){ }); // Hide and show status on toggle
		}); // End of click


		// Dialog Help:
		$( ".dialog-help" ).dialog({

			title: 'Help Dialog',
			autoOpen: false,
			resizable: false,
			draggable: false,
			modal: true,
			fluid: true,
			width: "60%",

			// Effects:
			show: {
				effect: "blind",
				duration: 500
			},
			hide: {
				effect: "clip",
				duration: 500
			},

		});


		// Dialog message:
		$( ".dialog-message" ).dialog({

			title: 'Message Dialog',
			autoOpen: false,
			resizable: false,
			draggable: false,
			modal: true,
			fluid: true,
			width: "60%",
			
			// Effects:
			show: {
				effect: "blind",
				duration: 500
			},
			hide: {
				effect: "clip",
				duration: 500
			},
			
			buttons :  [{ 
     		text: "Save",
			class: "saved-button",
     		id: "saved-message", // Using
				click: function(){
					$(this).dialog("close");
				}
   			}],

			// Testing:
			//    open: function() {
			// 	var markup = data;
			// 	$(this).html(markup);
			// },

		});

		// Ajax preparation for help:
		$( "#opener-help" ).on( "click", function() {
			var link = 'plugins/getHelp.php';
    		var param = 'ModulID=' + <?php echo $_smarty_tpl->tpl_vars['ModulID']->value;?>


			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				async: false,
				success: function (data) {
					$( ".dialog-help" ).html(data).dialog( "open" );
					$( ".dialog-help" ).dialog( {dialogClass:'dialog_help_style'} );
				}
			});


		});
		
		// Ajax preparation for message:
		$( "#opener-message" ).on( "click", function() {

			var link = 'plugins/getMessage.php';
    		var param = 'ModulID=' + <?php echo $_smarty_tpl->tpl_vars['ModulID']->value;?>


			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				async: false,
				success: function (data) {
					$( ".dialog-message" ).dialog( "open" );
					$( ".previous-messages" ).html(data);
					$( ".dialog-message" ).dialog( {dialogClass:'dialog_message_style'} );
				}
			});


		});

		// Button Save:
		$("#saved-message").on("click", function(){
			var link = 'plugins/Save.php';
			var messageID = $('.textarea-dialog').attr("data-id");
			var messageContent = $(".textarea-dialog").val();

			var textarea = $(".textarea-dialog").html(messageContent);

			// Testing:
			// alert($(".dialog-message").text());
			// alert(messageContent);

			var param='ModulID='+messageID+'&Message='+messageContent;

			// Testing:
			console.log(link+'?'+param);
			
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
				}

			});	


		});

		// on window resize run function
		$(window).resize(function () {
			fluidDialog();

		});

		// catch dialog if opened within a viewport smaller than the dialog width
		$(document).on("dialogopen", ".ui-dialog", function (event, ui) {
			fluidDialog();
		});

		function fluidDialog() {
			var $visible = $(".ui-dialog:visible");
			// each open dialog
			$visible.each(function () {
				var $this = $(this);
				var dialog = $this.find(".ui-dialog-content").data("ui-dialog");
				// if fluid option == true
				if (dialog.options.fluid) {
					var wWidth = $(window).width();
					// check window width against dialog width
					if (wWidth < (parseInt(dialog.options.maxWidth) + 50))  {
						// keep dialog from filling entire screen
						$this.css("max-width", "90%");
					} else {
						// fix maxWidth bug
						$this.css("max-width", dialog.options.maxWidth + "px");
					}
					//reposition dialog
					dialog.option("position", dialog.options.position);
				}
			});

		}

		// Resize for footer:
		function resizeContent(){

			if ($(window).width() > 1550) {
				$('.filter-wrapper').show();
				$('#filter-show').hide();
				$('#filter-hide').hide();
			}

			if ($(window).width() < 1499) {
				$('.filter-wrapper').hide();
				$('#filter-show').show();
				$('#filter-hide').hide();
				
			}

		}


		$('#filter-show').click(function() {
			$('.filter-wrapper').toggle(600);
			$('#filter-show').hide();
			$('#filter-hide').show();
		});

		$('#filter-hide').click(function() {
			$('.filter-wrapper').toggle(600);
			$('#filter-show').show();
			$('#filter-hide').hide();
		});

		resizeContent();
		$(window).resize(resizeContent);
		

		
	}); // End of document.ready




<?php echo '</script'; ?>
>


<?php }
}
