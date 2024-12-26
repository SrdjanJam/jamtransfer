<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>WIS <? echo $_REQUEST['p']?></title>

		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

		<!-- font Awesome -->
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

		<!-- Theme style WORKING !!!-->
		<link href="//<?=$_SERVER['HTTP_HOST']?>/css/theme.css" rel="stylesheet" type="text/css" media="screen"/>

		<!-- Misc -->
		<link rel="stylesheet" href="//<?=$_SERVER['HTTP_HOST']?>/css/jquery-ui-1.8.9.custom.css" type="text/css" />
		<link rel="stylesheet" href="//<?=$_SERVER['HTTP_HOST']?>/js/pickadate/themes/default.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="//<?=$_SERVER['HTTP_HOST']?>/js/pickadate/themes/default.date.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="//<?=$_SERVER['HTTP_HOST']?>/js/pickadate/themes/default.time.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="icomoon/style.css">
		<link rel="stylesheet" href="//<?=$_SERVER['HTTP_HOST']?>/css/colors.css" media="all">
		<link rel="stylesheet" href="//<?=$_SERVER['HTTP_HOST']?>/css/simplegrid.css" media="all">

		<link rel="stylesheet" type="text/css" href="//<?=$_SERVER['HTTP_HOST']?>/css/JAMTimepicker.css">
		<link rel="stylesheet" type="text/css" href="../js/select/css/select2.css">

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
			@media(max-width:1024px){
			  header .navbar-collapse {
				display: none;
			  }
			}
			@media(min-width:1025px){
			  header .navbar-toggle {
				display: none;   
			  }
			}			
		</style>



		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-2.0.2.js"></script>
	</head>

