<!DOCTYPE html>
<html>
	<head>
		<base href="{$root_home}">
		
		<meta charset="UTF-8">

		<title>WIS {$title}</title>

		
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

		<!-- STYLES -->
		<!-- bootstrap 3.0.2 -->
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>
	
		<!-- Latest compiled and minified CSS -->
		{* <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> *}

		{* ============================================================================================================================ *}
		<!-- ICONS: -->

		<!-- Older: -->
		<!-- font Awesome -->
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<!-- Ionicons -->
		{* <link href="css/ionicons.min.css" rel="stylesheet" type="text/css"/> *}

		{* <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css"> *}

		<!-- New: -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		{* ============================================================================================================================ *}

		<!-- Morris chart -->
		<link href="css/morris/morris.css" rel="stylesheet" type="text/css"/>

		{* ============================================================================================================================ *}
		<!-- bootstrap wysihtml5 - text editor -->
		<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="css/bootstrap-slider/slider.css" rel="stylesheet" type="text/css"/>
		<link href="js/summernote/summernote.css" rel="stylesheet" type="text/css" media="screen"/>
		{* ============================================================================================================================ *}

		<!-- Theme style WORKING !!!-->
		<link href="css/theme.css" rel="stylesheet" type="text/css" media="screen"/>
		<!-- Preuzeto za novu administraciju -->
		<link href="css/admin.css" rel="stylesheet">

		<!-- MISC -->

		{* ============================================================================================================================ *}
		<!-- Jquery ui css: -->
		<link rel="stylesheet" href="css/jquery-ui-1.8.9.custom.css" type="text/css" />

		<link rel="stylesheet" href="js/pickadate/themes/default.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="js/pickadate/themes/default.date.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="js/pickadate/themes/default.time.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="css/colors.css" media="all">
		{* ============================================================================================================================ *}
		<!--<link rel="stylesheet" href="css/simplegrid.css" media="all">!-->
		<link rel="stylesheet" type="text/css" href="css/JAMTimepicker.css">
		<link rel="stylesheet" type="text/css" href="js/select/css/select2.css">		

		
		<!-- SCRIPTS -->
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->

		{* ============================================================================================================================ *}
		<!-- jQuery -->
		<script src="js/jQuery/2.0.2/jquery.min.js"></script> 
		<!-- jQuery UI 1.10.3 -->
		<script src="js/jQuery/ui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
		{* ============================================================================================================================ *}

		<!-- Mainly scripts -->
		<script src="js/main.admin.js"></script>

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

		{if isset($pageList)}
			<script src="js/list.js"></script>


			{literal}		
				<script type="text/javascript">
					window.root = 'plugins/{/literal}{$base}{literal}/';
					window.currenturl = '{/literal}{$currenturl}{literal}';
				</script>
			{/literal}

			{if $isNew}
			<script type="text/javascript">
				$(document).ready(function(){
					new_Item(); 
				});	
			</script>
			{else}

			{literal}
			<script type="text/javascript">
				$(document).ready(function(){
					allItems(); 
					oneItem({/literal}{$item}{literal});
				});	
			</script>
			{/literal}

			{/if}

		{/if}

		
	</head>	

	{* INCLUDE TPL: *}
	{include file="{$root}/templates/add-style.tpl"}

	<body class="fixed-top" style="height:100%!important;font-size:16px">
		<div class="wrapper wrapper-edit">
		
			{* Navbar *}
			<nav class="navbar-default navbar-static-side additional-class" role="navigation">
			<i class="lab la-accessible-icon"></i>

				<div class="sidebar-collapse">

					<ul class="nav metismenu" id="side-menu">
						<li class="nav-header">
							<div class="dropdown profile-element">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear"> 
								<span class="block m-t-xs">
									<a href="profile" >
										<img src="api/showProfileImage.php?UserID={$smarty.session.AuthUserID}" class="img-circle" alt="User Image" style="height:2em;padding:-.5em;margin:-.5em" />
										<strong class="font-bold" style="margin:0 0 0 10px;">{$smarty.session.UserRealName}</strong>
									</a>
								</span>
								<ul class="dropdown-menu animated fadeInRight m-t-xs">
									<li><a href="profile" data-param="">Profile</a></li>
									<li class="divider"></li>
									<li><a href='logout.php'>Logout</a></li>
								</ul>
							</div>
						</li>
						
						{if isset($smarty.session.UseDriverName)}
			{* nav-header nav-header-edit *}
							<li class="nav-header nav-header-edit">
								<h3 style="color:#777777;font-size:21px;">Set as:</h3>
								<strong>{$smarty.session.UseDriverName}</strong>
								<a href="setout.php" id="a-setout">Setout	<i class="fas fa-sign-out-alt"></i></a>	
							</li>
						{/if}

						{section name=index loop=$menu1}
							<li class="{$menu1[index].active}">
								<a href='{$menu1[index].link}' >
									<i class="fa {$menu1[index].icon}"></i>
									<span class="nav-label" title="{$menu1[index].description}">{$menu1[index].title} <span class='badge'>{$menu1[index].activestatus}</span></span> 
									<span class="{$menu1[index].arrow}"></span>
								</a>

								
								{if $menu1[index].menu}
									{* collapse: ul: *}
									<ul class="nav nav-second-level collapse">

										{section name=index1 loop=$menu1[index].menu}	
											<li class="{$menu1[index].menu[index1].active}">
												<a href="{$menu1[index].menu[index1].link}"><span class="nav-label" title="{$menu1[index].menu[index1].description}">{$menu1[index].menu[index1].title} <span class='badge'>{{$menu1[index].menu[index1].activestatus}}</span></span></a>

													{if $menu1[index].menu[index1].title eq 'Orders'}
														{* collapse: ul second level: *}
													<ul class="nav nav-third-level collapse" >
														<li><a href="{$menu1[index].menu[index1].link}"><span class="nav-label">All</span></a></li>

														{section name=pom loop=$transfersFilters}
															<li {if $transfersFilters[pom].id eq $transfersFilter} class="active" {/if}>
																<a href="{$menu1[index].menu[index1].link}/{$transfersFilters[pom].id}"><span class="nav-label">{$transfersFilters[pom].name}</span></a>
															</li>
														{/section}

													</select>						
													</ul>
													{/if}
											</li>
										{/section}	
									</ul>
								{/if}

							</li>
						{/section}

				   </ul> {* End of nav metismenu *}
				   
				   
				   {* For developing status *}
				   <ul id="status" style="list-style-type:none;">
						<li>A - Active</li>
						<li>T - Test</li>
						<li>D - Development</li>
						<li>P - Plan</li>
				   </ul>

				</div> {* End of sidebar-collapse *}
				
			</nav> {* End of navbar-default navbar-static-side *}
			
			{* #page-wrapper *}
			<div id="page-wrapper" class="content gray-bg dashbard-1" style="height: 100%;
					display: flex;
					flex-direction: column;
					flex-wrap: nowrap;
					overflow: hidden;
					">

				{* .header row border-bottom *}
				<div class="header row border-bottom">
				   <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
					  <div class="navbar-header">

						{* target***** *}
						 <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-primary-edit"><i class="fa fa-bars"></i> </a>

					  </div>
					  <div class="navbar-header">
						 <button type="button" class="minimalize-styl-2 btn btn-primary btn-primary-edit" id="cashe"><i class="fas fa-redo-alt"></i></button>
					  </div>					  					  						
					  <ul class="nav navbar-top-links navbar-right">
						 <li>
							<h2><span class="m-r-sm text-muted">{$title}</span></h2>
						 </li>
						 <li>
							<a href='logout.php'>
							<i class="fa fa-sign-out"></i>Logout
							</a>
						 </li>
					  </ul>
				   </nav>
				</div> {* /.header row border-bottom *}
			
				{if not $isNew and isset($pageList)}
					{* .header *}
					<div class="header">  
						{include file="pageListHeader.tpl"} 				   
					</div> {* /.header *}
				{/if}

				{if $page eq 'Price Rules'}	
					{* .header row *}
					<div class="header row"> 
						<div class="pull-left">
							<span>Rule: <strong>{$smarty.request.rulesType}</strong></span>
							{if $routeName}<span>Route:<strong>{$routeName}</strong></span>{/if}
							{if $vehicleName}<span>Vehicle:<strong>{$vehicleName}</strong></span>{/if}

						</div>

					</div> {* /.header row *}
				{/if}
					
				{* .body row white-bg *}
				<div class="body row white-bg white-bg-edit">
					{if isset($pageOLD)}
						NOT MODEL VIEW CONTROL
						{elseif isset($page)}
							{include file="{$root}/plugins/{$base}/templates/{$includeFileTpl}"}
							MODEL VIEW CONTROL SMARTY		
						{elseif isset($pageList)}
							{include file="pageList.tpl"} 
							MODEL VIEW CONTROL HANDLEBARS
						{else}
							{$page_render}
							SEMI MODEL VIEW CONTROL via OB_GET_CONTENTS
					{/if}				  
				</div> {* / .body row white-bg *}

				{* .footer row *}
				<div class="footer row">

					{if not $isNew and isset($pageList)}				
						<div id="pageSelect" class="pull-left"></div>
					{/if}

					<div class="pull-right">
						Powered by <strong>Jamtransfer</strong>
					</div>
					<div class="backdrop"><div class="spiner"></div></div>
				</div>{* /.footer row *}

			</div> {* End of page-wrapper *}

		</div> {* End of wrapper *}

		<input type='hidden' id='local' value='{$local}' name='local'>
		<input type='hidden' id='success' value='{$SUCCESS}' name='success'>

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


<script>
	// toggleClass:
	$(document).ready(function(){
		window.success = $("#success").val();
		$("a.navbar-minimalize").click(function(){
			// Full navbar:
			$("nav.navbar-default").toggleClass("additional-class");
			// Hide and show status on toggle:
			$("#status").toggle(100,function(){ });
		}); // End of click
	}); // End of document.ready
</script>