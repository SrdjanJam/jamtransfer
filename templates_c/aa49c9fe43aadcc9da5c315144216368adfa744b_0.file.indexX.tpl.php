<?php
/* Smarty version 3.1.32, created on 2022-05-04 11:49:19
  from 'C:\wamp\www\jamtransfer\templates\indexX.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6272683f3bde21_18432074',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aa49c9fe43aadcc9da5c315144216368adfa744b' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\indexX.tpl',
      1 => 1651664957,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6272683f3bde21_18432074 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
">	
		
		<meta charset="UTF-8">
		<title>WIS <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>

		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

		<!-- font Awesome -->
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<!-- Preuzeto za novu administraciju -->
		<link href="css/admin.css" rel="stylesheet">

		<!-- Misc -->
		<link rel="stylesheet" href="css/jquery-ui-1.8.9.custom.css" type="text/css" />

		<link rel="stylesheet" href="css/colors.css" media="all">





		<!-- jQuery -->
		<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-2.0.2.js"><?php echo '</script'; ?>
>
		<!-- <?php echo '<script'; ?>
 src="cms/js/jquery/2.0.2/jquery.min.js"><?php echo '</script'; ?>
> -->
		<!-- jQuery UI 1.10.3 -->
		<?php echo '<script'; ?>
 src="js/jQuery/ui/1.10.3/jquery-ui.min.js" type="text/javascript"><?php echo '</script'; ?>
>


		<!-- Bootstrap -->
		<!-- <?php echo '<script'; ?>
 src="js/bootstrap.js" type="text/javascript"><?php echo '</script'; ?>
>-->
		<!-- Latest compiled and minified JavaScript -->
		<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"><?php echo '</script'; ?>
>        




	</head>
	<body class="fixed-top" style="height:100%!important;font-size:16px">
		<div class="wrapper">
			<nav class="navbar-default navbar-static-side" role="navigation">
				<div class="sidebar-collapse">
					<ul class="nav metismenu" id="side-menu">
						<li class="nav-header">
							<div class="dropdown profile-element">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear"> 
								<span class="block m-t-xs">
									<a href="profile" >
										<img src="api/showProfileImage.php?UserID=<?php echo $_SESSION['AuthUserID'];?>
" class="img-circle" alt="User Image" style="height:2em;padding:-.5em;margin:-.5em" />
										<strong class="font-bold"><?php echo $_SESSION['UserRealName'];?>
</strong>
									</a>
								</span>
								<ul class="dropdown-menu animated fadeInRight m-t-xs">
									<li><a href="profile" data-param="">Profile</a></li>
									<li class="divider"></li>
									<li><a href='logout'>Logout</a></li>
								</ul>
							</div>
						</li>
						<?php if (isset($_SESSION['UseDriverName'])) {?>
						<li class="nav-header">
							<strong class="font-bold"><?php echo $_SESSION['UseDriverName'];?>
</strong>
						</li>
						<?php }?>
						<li class=""><a href="dashboard"><i class='fa fa-th-large'></i><span>Dashboard</span></a></li>
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
"></i> 
								<span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['title'];?>
</span> 
								<span class="<?php echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['arrow'];?>
"></span>
							</a>
							<?php if ($_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['menu']) {?>
							<ul class="nav nav-second-level collapse" >
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
"><span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['menu1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['menu'][(isset($_smarty_tpl->tpl_vars['__smarty_section_index1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index1']->value['index'] : null)]['title'];?>
</span></a>
								</li>
								<?php
}
}
?>	
							</ul>
							<?php }?>
						</li>
						<?php
}
}
?>
				   </ul>
				</div>
			</nav>

			<style type="text/css" >
				.content {
					height: 100%;
					display: flex;
					flex-direction: column;
					flex-wrap: nowrap;
					overflow: hidden;

				}

				.header {
					flex-shrink: 0;
				}
				.body{
					flex-grow: 1;
					overflow: auto;
					min-height: 2em;
				}
				.footer{
					flex-shrink: 0;
				}		
			</style>			
			<div id="page-wrapper" class="content gray-bg dashbard-1" style="height: 100%;
					display: flex;
					flex-direction: column;
					flex-wrap: nowrap;
					overflow: hidden;">
				<div class="header row border-bottom">header

				</div>   
			

				<div class="body row wrapper border-bottom white-bg page-heading">

x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>	
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>	
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>	
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>	
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						
x<br>						

				</div>
				<div class="footer">

					<div class="pull-right">
					  Powered by <strong>Jamtransfer</strong>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

<?php echo '<?	';
}
}
