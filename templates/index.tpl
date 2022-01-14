<!DOCTYPE html>
<html>
	<head>
		<base href="{$root_home}">	
		
		<meta charset="UTF-8">
		<title>CMS {$title}</title>

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
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->


		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-2.0.2.js"></script>
		<!-- <script src="cms/js/jquery/2.0.2/jquery.min.js"></script> -->
		<!-- jQuery UI 1.10.3 -->
		<script src="js/jquery/ui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>

		<!-- Bootstrap -->
		<!-- <script src="js/bootstrap.js" type="text/javascript"></script>-->
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>        

		<!-- Morris.js charts -->
		<script src="js/plugins/raphael/2.1.0/raphael-min.js"></script>
		<script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>

		<!-- Sparkline -->
		<script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>

		<!-- jQuery Knob Chart -->
		<script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>

		<!-- Bootstrap WYSIHTML5 -->
		<script src="js/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
		<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
		<script src="js/plugins/bootstrap-slider/bootstrap-slider.js" type="text/javascript"></script>

		<!-- iCheck -->
		<script xsrc="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

		<!-- Validation -->
		<script src="js/jquery.validate.min.js"></script>

		<!-- Date / Time Picker -->
		<script src="js/pickadate/picker.js" type="text/javascript"></script>
		<script src="js/pickadate/picker.date.js" type="text/javascript"></script>
		<script src="js/pickadate/picker.time.js" type="text/javascript"></script>
		<script src="js/JAMTimepicker.js"></script>
		<script src="js/select/js/select2.js"></script>

		<!-- Moment -->
		<script src="js/moment.min.js" type="text/javascript"></script>

		<!-- App -->
		<script src="js/theme/app.js" type="text/javascript"></script>

		<!-- Misc -->
		<script src="js/handlebars-v1.3.0.js"></script>
		<script src="js/jquery.slugify.js"></script>
		<script src="js/summernote/summernote.js"></script>
		<script src="js/jquery.toaster.js"></script>
		<script src="lng/{$language}_init.js"></script>	
		<script src="js/cms.jquery.js"></script>
		
	</head>
	<body class="fixed-top" style="height:100%!important;font-size:16px">
		<div class="wrapper">
			{$menu_render}

			<div class="container-fluid side-collapse-container"
			style="padding:0px!important">
				{if isset($page)}
					<h1>{$page}</h1>
					{include file="page.tpl"} 
				{else}{$page_render}
				{/if}
			</div>
		</div>
		<input type='hidden' id='local' value='{$local}' name='local'>
	</body>
</html>
	{literal}
	<script>
		document.addEventListener("keydown", function(event) {
		  //event.preventDefault();
		  if (event.which==121) window.open(window.location.href+'/help','_blank');
		})	
		$(document).ready(function() {
			$(".datepicker").pickadate({format{/literal}:{literal} 'yyyy-mm-dd'});
			$(".timepicker").JAMTimepicker();
		});
		
		$.ajaxSetup({
			beforeSend: function (xhr,settings) {
			   return settings;
			}
		});
	</script>
	{/literal}
<?	