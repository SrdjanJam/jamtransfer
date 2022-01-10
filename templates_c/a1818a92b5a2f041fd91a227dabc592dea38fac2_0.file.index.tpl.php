<?php
/* Smarty version 3.1.32, created on 2022-01-10 08:09:33
  from 'C:\wamp\www\jamtransfer\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_61dbe9bd33bdd2_64203552',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a1818a92b5a2f041fd91a227dabc592dea38fac2' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\index.tpl',
      1 => 1641802169,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61dbe9bd33bdd2_64203552 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
">	
		
		<meta charset="UTF-8">
		<title>CMS <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</title>

		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

		<!-- STYLES -->
		<!-- bootstrap 3.0.2 -->
		<!-- <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>-->

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

		<!-- font Awesome -->
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

		<!-- Ionicons -->
		<link href="css/ionicons.min.css" rel="stylesheet" type="text/css"/>

		<!-- Morris chart -->
		<link href="css/morris/morris.css" rel="stylesheet" type="text/css"/>

		<!-- bootstrap wysihtml5 - text editor -->
		<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="css/bootstrap-slider/slider.css" rel="stylesheet" type="text/css"/>
		<link href="js/summernote/summernote.css" rel="stylesheet" type="text/css" media="screen"/>

		<!-- Theme style WORKING !!!-->
		<link href="css/theme.css" rel="stylesheet" type="text/css" media="screen"/>

		<!-- Misc -->
		<link rel="stylesheet" href="css/jquery-ui-1.8.9.custom.css" type="text/css" />
		<link rel="stylesheet" href="js/pickadate/themes/default.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="js/pickadate/themes/default.date.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="js/pickadate/themes/default.time.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="css/colors.css" media="all">
		<link rel="stylesheet" href="css/simplegrid.css" media="all">
		<link rel="stylesheet" type="text/css" href="css/JAMTimepicker.css">
		<link rel="stylesheet" type="text/css" href="js/select/css/select2.css">		

		<style type="text/css" media="print">
			body {
				font-family: 'Roboto', sans-serif;
				font-size: 10px !important;
			}
			.nav, .footer { display:none; }
			@page { margin: 0.5cm; }
			@media print {
				div [class*='col-'] { display: table-cell !important; }
				div [class*='row'] { display: table-row !important; width: 100%; }
				div [class*='grid'] { display: table-row !important; width: 100%; }
				div [class*='w25'] { display: inline-block !important; width: 30%; }
				div [class*='w75'] { display: inline-block !important; width: 69%; }
				div [class*='w100'] { display: inline-block !important; width: 99%; }
				button, .btn { display:none; }
			}
		</style>
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


		<!-- jQuery -->
		<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-2.0.2.js"><?php echo '</script'; ?>
>
		<!-- <?php echo '<script'; ?>
 src="cms/js/jquery/2.0.2/jquery.min.js"><?php echo '</script'; ?>
> -->
		<!-- jQuery UI 1.10.3 -->
		<?php echo '<script'; ?>
 src="js/jquery/ui/1.10.3/jquery-ui.min.js" type="text/javascript"><?php echo '</script'; ?>
>

		<!-- Bootstrap -->
		<!-- <?php echo '<script'; ?>
 src="js/bootstrap.js" type="text/javascript"><?php echo '</script'; ?>
>-->
		<!-- Latest compiled and minified JavaScript -->
		<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"><?php echo '</script'; ?>
>        

		<!-- Morris.js charts -->
		<?php echo '<script'; ?>
 src="js/plugins/raphael/2.1.0/raphael-min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="js/plugins/morris/morris.min.js" type="text/javascript"><?php echo '</script'; ?>
>

		<!-- Sparkline -->
		<?php echo '<script'; ?>
 src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"><?php echo '</script'; ?>
>

		<!-- jQuery Knob Chart -->
		<?php echo '<script'; ?>
 src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"><?php echo '</script'; ?>
>

		<!-- Bootstrap WYSIHTML5 -->
		<?php echo '<script'; ?>
 src="js/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="js/plugins/bootstrap-slider/bootstrap-slider.js" type="text/javascript"><?php echo '</script'; ?>
>

		<!-- iCheck -->
		<?php echo '<script'; ?>
 xsrc="js/plugins/iCheck/icheck.min.js" type="text/javascript"><?php echo '</script'; ?>
>

		<!-- Validation -->
		<?php echo '<script'; ?>
 src="js/jquery.validate.min.js"><?php echo '</script'; ?>
>

		<!-- Date / Time Picker -->
		<?php echo '<script'; ?>
 src="js/pickadate/picker.js" type="text/javascript"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="js/pickadate/picker.date.js" type="text/javascript"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="js/pickadate/picker.time.js" type="text/javascript"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="js/JAMTimepicker.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="js/select/js/select2.js"><?php echo '</script'; ?>
>

		<!-- Moment -->
		<?php echo '<script'; ?>
 src="js/moment.min.js" type="text/javascript"><?php echo '</script'; ?>
>

		<!-- App -->
		<?php echo '<script'; ?>
 src="js/theme/app.js" type="text/javascript"><?php echo '</script'; ?>
>

		<!-- Misc -->
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
		
	</head>
	<body class="fixed-top" style="height:100%!important;font-size:16px">
		<div class="wrapper">
			<?php echo $_smarty_tpl->tpl_vars['menu_render']->value;?>


			<div class="container-fluid side-collapse-container"
			style="padding:0px!important">
					 
					<?php echo $_smarty_tpl->tpl_vars['page_render']->value;?>

			</div>
		</div>
		<input type='text' id='local' value='<?php echo $_smarty_tpl->tpl_vars['local']->value;?>
' name='local'>
	</body>
</html>
	
	<?php echo '<script'; ?>
>
		document.addEventListener("keydown", function(event) {
		  //event.preventDefault();
		  if (event.which==121) window.open(window.location.href+'/help','_blank');
		})	
		$(document).ready(function() {
			$(".datepicker").pickadate({format: 'yyyy-mm-dd'});
			$(".timepicker").JAMTimepicker();
		});
		
		$.ajaxSetup({
			beforeSend: function (xhr,settings) {
			   return settings;
			}
		});
	<?php echo '</script'; ?>
>
	
<?php echo '<?	';
}
}
