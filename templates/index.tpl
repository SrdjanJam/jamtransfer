<!DOCTYPE html>
<html>
	<head>
		<base href="{$root_home}">
		
		<meta charset="UTF-8">
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

		<title>WIS {$title}</title>

		<!-- 
		
		NOTES:

		- Bootstrap and Jquery links are moved inside rows.
	
		-->


		<!-- LINKS TAGS: -->

		<!-- ======================================================================================== -->
		<!-- Bootstrap: -->
				<!-- bootstrap local 3.0.2 -->
				{* <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/> *}
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
		{* <link rel="stylesheet" href="js/pickadate/themes/default.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="js/pickadate/themes/default.date.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="js/pickadate/themes/default.time.css" type="text/css" media="screen"/> *}
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
		{* <link rel="stylesheet" type="text/css" href="css/JAMTimepicker.css"> *}
		<!-- ======================================================================================== -->
		

		{* ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// *}
		{* ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// *}

			<!-- SCRIPT AND LINK TAGS: -->

			<!-- SCRIPTS -->
			<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
			<![endif]-->

			<!-- ======================================================================================== -->
					<!-- jQuery: -->
					<script src="js/jQuery/2.0.2/jquery.min.js"></script>
					<!-- cdn: -->
					{* <script src="https://code.jquery.com/jquery-2.0.2.js"></script> *}
					{* <script src="https://code.jquery.com/jquery-3.6.0.js"></script> *}
			<!-- ======================================================================================== -->
			<!-- Mainly scripts: -->
			<script src="js/main.admin.js"></script>
			<!-- ======================================================================================== -->
					<!-- Datetimepicker new: -->
					<script src="js/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
			<!-- ======================================================================================== -->
					<!-- jQuery UI 1.10.3: -->
					<script src="js/jQuery/ui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
					{* cdn: *}
					{* <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> *}
			<!-- ======================================================================================== -->
					<!-- Bootstrap: -->
					{* <script src="js/bootstrap.js" type="text/javascript"></script> *}
					<!-- cdn: -->
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
			<!-- ======================================================================================== -->
					<!-- Jquery ui css: -->
					{* <link rel="stylesheet" href="css/jquery-ui-1.8.9.custom.css" type="text/css" /> *}
					<!-- cdn: -->
					{* <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> *}
					<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
					<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
			<!-- ======================================================================================== -->
			<!-- Morris.js charts: -->
			<script src="js/plugins/raphael/2.1.0/raphael-min.js"></script>
			<script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
			<!-- ======================================================================================== -->
			<!-- Sparkline: -->
			<script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
			<!-- ======================================================================================== -->
					<!-- jQuery Knob Chart: -->
					<script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
			<!-- ======================================================================================== -->
					<!-- Bootstrap WYSIHTML5: -->
					<script src="js/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
					<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
					<script src="js/plugins/bootstrap-slider/bootstrap-slider.js" type="text/javascript"></script>
			<!-- ======================================================================================== -->
			<!-- iCheck: -->
			<script xsrc="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
			<!-- ======================================================================================== -->
					<!-- Validation: -->
					<script src="js/jquery.validate.min.js"></script>
			<!-- ======================================================================================== -->
					<!-- Time Picker query-clock-timepicker: -->
					<script type="text/javascript" src="js/jquery-clock-timepicker/jquery-clock-timepicker.min.js"></script>

					<!-- Date Picker and time picker old /  -->
					{* <script src="js/pickadate/picker.time.js" type="text/javascript"></script>
					<script src="js/JAMTimepicker.js"></script> *}
					<!-- Pick date old -->
					{* <script src="js/pickadate/picker.js" type="text/javascript"></script>
					<script src="js/pickadate/picker.date.js" type="text/javascript"></script> *}
			<!-- ======================================================================================== -->
			<!-- select 2: -->
			<script src="js/select/js/select2.js"></script>
			<!-- ======================================================================================== -->
			<!-- Moment: -->
			<script src="js/moment.min.js" type="text/javascript"></script>
			<!-- ======================================================================================== -->
			<!-- App: -->
			<script src="js/theme/app.js" type="text/javascript"></script>
			<!-- ======================================================================================== -->
			<!-- Misc: -->
			<script src="js/handlebars-v1.3.0.js"></script>
					<script src="js/jquery.slugify.js"></script><!-- jquery local -->
			<script src="js/summernote/summernote.js"></script>
					<script src="js/jquery.toaster.js"></script><!-- jquery local -->
			<script src="lng/{$language}_init.js"></script>	
					<script src="js/cms.jquery.js"></script><!-- jquery local -->


		{* MIXED WITH PHP CODE: *}
		{if $pageList}

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

{* TPL INCLUDE: *}
{include file="{$root}/templates/default-style.tpl"}

{include file="{$root}/templates/add-style.tpl"}


{* BODY ============================================================================================= *}

	<body class="fixed-top" style="height:100%!important;font-size:16px">
		{* main wrapper class*}
		<div class="wrapper wrapper-edit">

{* SIDEBAR ====================================================================================================================================== *}
			
			{* Start with navbar *}
			<nav class="navbar-default navbar-default-edit navbar-static-side additional-class" role="navigation">
			<i class="lab la-accessible-icon"></i>
				{* sidebar-collapse *}
				<div class="sidebar-collapse">
					<ul class="nav metismenu" id="side-menu">

						{* PROFILE =================================================================== *}
						<!--nav-header-top-edit -->
						<li class="nav-header nav-header-top-edit">
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
						{* END OF PROFILE ======================================================================== *}

						{* SETTING DRIVER ======================================================================== *}
						{if $setasdriver}
							
							{if isset($smarty.session.UseDriverName)}
							<!-- nav-header nav-header-edit -->
								<li class="nav-header nav-header-edit">
									<h3 id="set-as">Seted as:</h3>
									<h3 class="cut-name">{$smarty.session.UseDriverName}</h3>
									<a href="setout.php" id="a-setout">Setout &nbsp;<i class="fas fa-sign-out-alt"></i></a>	
								</li>
							{else}
								{if isset ($smarty.cookies.UseDriverName)}	
									<!-- Set as with cookie -->
									<li class="nav-header nav-header-edit">
										<a href="satAsDriver/{$smarty.cookies.UseDriverID}" style="padding-left:5px;padding-right:0px;">
											<h3 id="set-us-2">Set as: <i class="fas fa-sign-in-alt"></i></h3>
											<h3 class="cut-name-2">{$smarty.cookies.UseDriverName}</h3>
										</a>
									</li>
								{/if}
							{/if}
							
						{/if}
						{* END OF SETTING DRIVER ====================================================================================== *}

						{* Items of sidebar *}
						{section name=index loop=$menu1}
							<li class="{$menu1[index].active}">
								<a href='{$menu1[index].link}' >
									<i class="fa {$menu1[index].icon} edit-fa"></i>
									<span class="nav-label nav-label-edit" title="{$menu1[index].description}">{$menu1[index].title} <span class='badge'>{$menu1[index].phasestatus}</span></span> 
									<span class="{$menu1[index].arrow}"></span>
								</a>

								
								{if $menu1[index].menu}
									{* collapse: ul: *}
									<ul class="nav nav-second-level collapse">

										{section name=index1 loop=$menu1[index].menu}	
											<li class="{$menu1[index].menu[index1].active}">
												<a href="{$menu1[index].menu[index1].link}"><span class="nav-label nav-label-edit" title="{$menu1[index].menu[index1].description}">{$menu1[index].menu[index1].title} <span class='badge'>{{$menu1[index].menu[index1].phasestatus}}</span></span></a>

													{if $menu1[index].menu[index1].title eq 'Orders'}
														<!-- collapse: ul second level: -->
													{*<ul class="nav nav-third-level collapse" >
														<li><a href="{$menu1[index].menu[index1].link}"><span class="nav-label">All</span></a></li>

														{section name=pom loop=$transfersFilters}
															<li {if $transfersFilters[pom].id eq $transfersFilter} class="active" {/if}>
																<a href="{$menu1[index].menu[index1].link}/{$transfersFilters[pom].id}"><span class="nav-label">{$transfersFilters[pom].name}</span></a>
															</li>
														{/section}

													</select>						
													</ul>*}
													{/if}
											</li>
										{/section}

									</ul>
								{/if}

							</li>
						{/section}

				   </ul> {* End of nav metismenu *}
				   
				   
				   <!-- developing status -->
				   <ul id="status" style="list-style-type:none;">
						<li>A - Active</li>
						<li>T - Test</li>
						<li>D - Development</li>
						<li>P - Plan</li>
				   </ul>

				</div> {* End of sidebar-collapse *}
				
			</nav> {* End of navbar-default navbar-static-side *}

						
{* HEADER ====================================================================================================================================== *}
			
			{* #page-wrapper *}
			<div id="page-wrapper" class="content gray-bg dashbard-1" style="height: 100%;
					display: flex;
					flex-direction: column;
					flex-wrap: nowrap;
					overflow: hidden;
					">

				<!-- ******************************************************************************** -->
				<!-- Header Top -->
				<div class="header row border-bottom">
					{* navbar *}	
					<nav class="navbar navbar-static-top navbar-static-top-edit" role="navigation" style="margin-bottom: 0">
						
						{* Minimalize *}
						<div class="navbar-header">
							<a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-primary-edit"><i class="fa fa-bars"></i> </a>
						</div>

						{* Refresh *}
						<div class="navbar-header">
							<button type="button" class="minimalize-styl-2 btn btn-primary btn-primary-edit" id="cashe"><i class="fas fa-redo-alt"></i></button>
						</div>
						<ul class="nav navbar-top-links navbar-right">
							<!-- Opener dialog button: -->
							<li><button type="button" id="opener-help" class="button-3">Help</button></li>
							<li><button type="button" id="opener-message" class="button-3">Message</button></li>

							<li>
								<h2><span class="m-r-sm text-muted">{$title} - {$smarty.session.log_title}</span></h2>
							</li>

							<li>
								<a href='logout.php'>
									<i class="fa fa-sign-out"></i>Logout
								</a>
							</li>

						</ul>
						
						<!-- Dialog printed results here: -->
						<div style="display:none;" class="dialog-help"></div>
						<div style="display:none;" class="dialog-message">
							<div id='prev_mess'></div>
							<textarea data-id="{$ModulID}" class="textarea-dalog" placeholder="Input new message" ></textarea>
						</div>
					</nav>
					
				</div> {* /.header row border-bottom *}
				<!-- ******************************************************************************** -->		
			
				{if not $isNew and $pageList}
					{* .header *}
					<div class="header header-edit">  
						{include file="pageListHeader.tpl"} 				   
					</div> {* /.header *}
				{/if}

				{if $pageName eq 'Price Rules'}	
					{* .header row *}
					<div class="header row"> 
						<div class="pull-left">
							<span>Rule: <strong>{$smarty.request.rulesType}</strong></span>
							{if $routeName}<span>Route:<strong>{$routeName}</strong></span>{/if}
							{if $vehicleName}<span>Vehicle:<strong>{$vehicleName}</strong></span>{/if}

						</div>

					</div> {* /.header row *}
				{/if}
				
{* MAIN CONTENT ================================================================================================================= *}
				<div class="body row white-bg white-bg-edit">

					{if isset($pageOLD)}
						NOT MODEL VIEW CONTROL
						{elseif isset($pageName) and $pageName ne ''}
							{include file="{$root}/plugins/{$base}/templates/{$includeFileTpl}"}
							MODEL VIEW CONTROL SMARTY		
						{elseif $pageList}
							{include file="pageList.tpl"} 
							MODEL VIEW CONTROL HANDLEBARS
						{else}
							{$page_render}
							SEMI MODEL VIEW CONTROL via OB_GET_CONTENTS
					{/if}

				</div> {* / .body row white-bg *}

{* FOOTER ======================================================================================================================== *}
				<div class="footer row footer-edit">

					{if not $isNew and $pageList}				
						<div id="pageSelect" class="pull-left pull-left-edit"></div>
					{/if}

					<div class="pull-right pull-right-edit">
						Powered by <strong>Jamtransfer</strong>
					</div>
					
					<div class="backdrop"><div class="spiner"></div></div>

				</div>{* /.footer row *}
				

			</div> {* End of page-wrapper *}

		</div> {* End of wrapper *}


		<input type='hidden' id='local' value='{$local}' name='local'>
		<input type='hidden' id='success' value='{$SUCCESS}' name='success'>
		<input type='hidden' id='delete' value='{$DELETE_ROW}' name='delete'>
		

	</body>
</html>


{* SCRIPTS =========================================================================================================================== *}

{literal}
	<script>
		document.addEventListener("keydown", function(event) {
			//event.preventDefault();
			if (event.which==121) window.open(window.location.href+'/help','_blank');
		})	
		$(document).ready(function() {
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
			$('.timepicker').clockTimePicker();
		});
		
		$.ajaxSetup({
			beforeSend: function (xhr,settings) {
				return settings;
			}
		});

	</script>
{/literal}


{literal}
<script>
	
	$(document).ready(function(){

		window.success = $("#success").val();
		window.delete = $("#delete").val();
		
		// toggleClass:
		$("a.navbar-minimalize").click(function(){
			$("nav.navbar-default").toggleClass("additional-class"); // Full navbar
			$("#status").toggle(100,function(){ }); // Hide and show status on toggle
		}); // End of click



		$( ".dialog-help" ).dialog({

			title: 'Help Dialog',
			autoOpen: false,
			resizable: false,
			draggable: false,
			modal: true,
			width: "60%",

			// Effects:
			show: {
				effect: "blind",
				duration: 500
			},
			hide: {
				effect: "explode",
				duration: 500
			},

		});
		

		$( ".dialog-message" ).dialog({

			title: 'Message Dialog',
			autoOpen: false,
			resizable: false,
			draggable: false,
			modal: true,
			width: "60%",
			
			// Effects:
			show: {
				effect: "blind",
				duration: 500
			},
			hide: {
				effect: "explode",
				duration: 500
			},
			
			buttons :  [{ 
     		text: "Save",
     		id: "saved-message",
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
    		var param = 'ModulID=' + {/literal}{$ModulID}{literal}
			console.log(link+'?'+param);
			

			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				async: false,
				success: function (data) {
					$( ".dialog-help" ).html(data).dialog( "open" );
				}
			});


		});
		
		// Ajax preparation for message:
		$( "#opener-message" ).on( "click", function() {
			var link = 'plugins/getMessage.php';
    		var param = 'ModulID=' + {/literal}{$ModulID}{literal}
			console.log(link+'?'+param);
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				async: false,
				success: function (data) {
					$( "#prev_mess" ).html(data);
					$( ".dialog-message" ).dialog( "open" );
				}
			});
		});

		// Button Save:
		$("#saved-message").on("click", function(){
			var base=window.location.origin;
			var link = 'plugins/Save.php';

			var messageID = $('.textarea-dalog').attr("data-id");
			var messageContent = $(".textarea-dalog").val();
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

		
		
	}); // End of document.ready


	



</script>

{/literal}
