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
					<!-- <script src="js/bootstrap.js" type="text/javascript"></script> -->
					<!-- cdn: -->
					{* <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> *}
			<!-- ======================================================================================== -->
					<!-- Jquery ui css: -->
					<!-- <link rel="stylesheet" href="css/jquery-ui-1.8.9.custom.css" type="text/css" /> -->
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

					<!-- Date Picker and time picker old: /  -->
					{* <script src="js/pickadate/picker.time.js" type="text/javascript"></script>
					<script src="js/JAMTimepicker.js"></script> *}
					<!-- Pick date old: -->
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
					<script src="js/jquery.slugify.js"></script>
			<script src="js/summernote/summernote.js"></script>
					<script src="js/jquery.toaster.js"></script>
			<script src="lng/{$language}_init.js"></script>	
					<script src="js/cms.jquery.js"></script>

		{* MIXED WITH PHP CODE: *}
		{if $pageList}

			<script src="js/list.js"></script>

			{literal}		
				<script type="text/javascript">
					window.root = 'plugins/{/literal}{$base}{literal}/';
					window.currenturl = '{/literal}{$currenturl}{literal}';
					window.rootbase='{/literal}{$root_home}{literal}';
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

	{* BODY ================================================================================================================================== *}
	<body class="fixed-top body-edit">
		{* WRAPPER: ==================================================================================================================*}
		<div class="wrapper wrapper-edit">

			{* NAVBAR: ==================================================================================================== *}
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
										<img src="api/showProfileImage.php?UserID={$smarty.session.AuthUserID}" class="img-circle" alt="User Image" style="height:2em;padding:-.5em;margin:-.5em" />
										<strong class="font-bold" style="margin:0 0 0 10px;">{$smarty.session.UserRealName}</strong>
									</a>
								</span>

								<!-- Logout link: -->
								<div style="margin-top:12px;text-decoration:underline;text-align:center;"><a href='logout.php'>{$LOGOUT} <i class="fa fa-sign-out"></i></a></div>

								<ul class="dropdown-menu animated fadeInRight m-t-xs">
									<li><a href="profile" data-param="">{$PROFILE}</a></li>
									<li class="divider"></li>
									<li><a href='logout.php'>{$LOGOUT}</a></li>
								</ul>

							</div>
						</li>
						<!-- End of PROFILE -------------------------------------------------------------------------- -->

						<!-- SETTING DRIVER: -------------------------------------------------------------------------- -->
						{if $setasdriver}
							
							{if isset($smarty.session.UseDriverName)}
								<!-- Header in navbar - nav-header nav-header-edit -->
								<li class="nav-header nav-header-edit">
									<h3 id="set-as">{$SET_AS}:</h3>
									<h3 class="cut-name">{$smarty.session.UseDriverName}</h3>
									<a href="setout.php" id="a-setout">{$SETOUT} &nbsp;<i class="fas fa-sign-out-alt"></i></a>	
								</li>
							{else}
								{if isset ($smarty.cookies.UseDriverName)}
									<!--Header in navbar - Set as with cookie -->
									<li class="nav-header nav-header-edit nav-header-edit-2">
										<a href="satAsDriver/{$smarty.cookies.UseDriverID}" style="padding-left:5px;padding-right:0px;">
											<h3 id="set-us-2">{$READY_FOR_SET_AS}: <i class="fas fa-sign-in-alt"></i></h3>
											<h3 class="cut-name-2">{$smarty.cookies.UseDriverName}</h3>
										</a>
									</li>
								{/if}
							{/if}
							
						{/if}
						<!-- End of SETTING DRIVER ------------------------------------------------------------------------ -->

						<!-- Items of sidebar -->
						{section name=index loop=$menu1}
							<li class="{$menu1[index].active}">
								<a href='{$menu1[index].link}' >
									<i class="fa {$menu1[index].icon} edit-fa"></i>
									<span class="nav-label nav-label-edit" title="{$menu1[index].description}">{$menu1[index].title} <span class='badge'>{$menu1[index].phasestatus}</span></span> 
									<span class="{$menu1[index].arrow}"></span>
								</a>

								
								{if $menu1[index].menu}
									<!-- collapse sidebar: -->
									<ul class="nav nav-second-level collapse">
										{section name=index1 loop=$menu1[index].menu}
											<li class="{$menu1[index].menu[index1].active}">
												<a href="{$menu1[index].menu[index1].link}"><span class="nav-label nav-label-edit-2" title="{$menu1[index].menu[index1].description}">{$menu1[index].menu[index1].title} <span class='badge'>{{$menu1[index].menu[index1].phasestatus}}</span></span></a>
											</li>
										{/section}
									</ul> <!-- End of collapse: ul -->
								{/if}

							</li>
						{/section}

				   </ul> <!-- End of nav metismenu -->
				   
				   
				   <!-- Developing status: -->
				   <ul id="status" style="list-style-type:none;">
						<li>{$A_ACTIVE}</li>
						<li>{$T_TEST}</li>
						<li>{$D_DEVELOPMENT}</li>
						<li>{$P_PLAN}</li>
				   </ul>

				</div> <!-- End of sidebar-collapse -->
				
			</nav> <!-- End of navbar-default navbar-static-side -->
			
			{* PAGE WRAPPER ================================================================================================================== *}
			<div id="page-wrapper" class="content gray-bg dashbard-1 page-wrapper-edit">

				{* HEADER ============================================================================================================= *}
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
							<h2 style="display:inline-block;margin: 15px 0 0 12px;vertical-align: super;font-size: 20px;">
								<span class="m-r-sm text-muted">{$title} - {$smarty.session.log_title}</span>
								{if $fieldsSettings eq 1}<span class="m-r-sm text-muted"> / Fields Settings</span>{/if}
							</h2>

						</div>

						<ul class="nav navbar-top-links navbar-right">
							<!-- Opener dialog button: -->
							<li><button type="button" id="opener-help" class="button-3">{$HELP}</button></li>
							<li><button type="button" id="opener-message" class="button-3">{$MESSAGE}</button></li>

							<!-- Prev version: -->
							<!-- <li> <h2><span class="m-r-sm text-muted">{$title} - {$smarty.session.log_title}</span></h2> </li> -->

							<!-- Logout: -->
							<li><a href='logout.php'><i class="fa fa-sign-out"></i>{$LOGOUT}</a></li>

						</ul>
						
						<!-- Dialog printed results here: -->
						<div style="display:none;" class="dialog-help"></div>
						<div style="display:none;" class="dialog-message">
							<textarea data-id="{$ModulID}" class="textarea-dialog"></textarea>						
							<div class="previous-messages"></div>
						</div>
					
					</nav>
				</div> <!-- /.header row border-bottom -->
				<!-- END OF HEADER ========================================================================================== -->		
			
				{if not $isNew and $pageList} 							
					<!-- .header -->
					<div class="header header-edit 
						{if $orderid gt 0}hidden{/if}
					">  
						{if $pageList ne $ORDERS}
							{include file="pageListHeader.tpl"} <!-- Second header -->		
						{else}
							{include file="pageListHeader2.tpl"} 
						{/if}						
					</div> {* /.header *}
				{/if}

				{if $pageName eq 'Price Rules'}	
					<!-- .header row -->
					<div class="header row">
						<div class="pull-left">
							<span>{$RULE}: <strong>{$smarty.request.rulesType}</strong></span>
							{if $routeName}<span>{$ROUTE}:<strong>{$routeName}</strong></span>{/if}
							{if $vehicleName}<span>{$VEHICLE}:<strong>{$vehicleName}</strong></span>{/if}

						</div>

					</div> <!-- /.header row -->
				{/if}

				{* MAIN CONTENT ========================================================================================================== *}
				<div class="body row white-bg white-bg-edit">
					
					{if isset($pageOLD)}
						{NOT_MODEL_VIEW_CONTROL}
						{elseif isset($pageName) and $pageName ne ''}
							{include file="{$root}/plugins/{$base}/templates/{$includeFileTpl}"}
						{elseif $pageList}
								{include file="pageList.tpl"} 
							{if $orderid gt 0}
								{include file="plugins/Dashboard/templates/getOrder.tpl"} 			
							{/if}
						{else}
							{$page_render}
					{/if}

				</div> <!-- / .body row white-bg -->

				{* FOOTER ===============================================================================================================*}
				<div class="footer row footer-edit">

					<!-- Show and Hide Filters buttons: -->
					<div id="footer-filters">
						<div id="filter-show" class="button-toggle"><i class="fa fa-bars fa-bars-edit"></i></div>

					</div>

					<!-- Filter -->
					<div class="filter-wrapper">

						{if not $isNew and $pageList}

							<div class="col-md-2 col-md-2-infoShow" id="infoShow"></div>

								<div id="pageSelect" class=" pull-left pull-left-edit col-md-3"></div>
							
								{if not isset($pagelength)}{assign var="pagelength" value="10"}{/if}
							
								<div class="col-md-3" style="padding-bottom: 5px;">
									<i class="fa fa-eye edit-fa"></i>
									<div class="form-group group-edit">
										<select id="length" class="w75 form-control control-edit" onchange="allItems();">
											<option value="5" {if $pagelength eq '5'} selected {/if}> 5 </option>
											<option value="10" {if $pagelength eq '10'} selected {/if}> 10 </option>
											<option value="20" {if $pagelength eq '20'} selected {/if}> 20 </option>
											<option value="50" {if $pagelength eq '50'} selected {/if}> 50 </option>
											<option value="100" {if $pagelength eq '100'} selected {/if}> 100 </option>
										</select>
									</div>
								</div>
							
							{if $existNew}
								<div class="col-md-1"><a class="btn btn-primary btn-xs btn-xs-edit" href="{$currenturl}/new"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
							{/if}		

						{/if}
						<div class="pull-right pull-right-edit col-md-2">
							{$POWERED_BY} <strong><a href="https://taxicms.com/" target="_blank">{$TAXI_CMS}</a></strong>
						</div>
						
						

					</div> <!-- /.filter-wrapper --> 

					<div class="backdrop"><div class="spiner"></div></div>

				</div><!-- /.footer row -->
				<!-- END OF FOOTER ================================================================================= -->

			</div> <!-- End of page-wrapper -->

		</div> <!-- End of wrapper -->
		<!-- END OF WRAPPER ================================================================================================== -->

		<input type="hidden" id="fieldsSettings" name="fieldsSettings" value="{$fieldsSettings}">
		<input type="hidden" id="fieldsDescription" name="fieldsDescription" value="{$fieldsDescription}">
		<input type="hidden" id="levelID" name="levelID" value="{$levelID}">
		<input type='hidden' id='ModuleID' value='{$ModulID}' name='ModuleID'>
		<input type='hidden' id='local' value='{$local}' name='local'>
		<input type='hidden' id='success' value='{$SUCCESS}' name='success'>
		<input type='hidden' id='unsuccess' value='{$UNSUCCESS}' name='unsuccess'>
		<input type='hidden' id='delete' value='{$DELETE_ROW}' name='delete'>
		
		<div style="display:none;" id="fsBlock" data-attr="">
			<span><label>{$REQUIRED}</label> <input type="checkbox" class="" name="required" value="" data-attr=""/></span>
			<span><label>{$DISABLED}</label> <input type="checkbox" class="" name="disabled" value="" data-attr=""/></span>
			<span><label>{$HIDDEN}</label> <input type="checkbox" class="" name="hidden" value="" data-attr=""/></span>
		</div>		
		<div style="display:none;" id="fdBlock" data-attr="">
			<textarea class="" name="field_description" value="" data-attr=""/></textarea>
		</div>

	</body>
</html>


{* SCRIPTS ================================================================================================================== *}

{literal}
	<script>
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

	</script>
{/literal}


{literal}
<script>

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
    		var param = 'ModulID=' + {/literal}{$ModulID}{literal}

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
    		var param = 'ModulID=' + {/literal}{$ModulID}{literal}

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

		// Toggle effects for button:
		$('#filter-show').click(function(){
			var link = $(this);
			$('.filter-wrapper').slideToggle('slow', function() {
				if ($(this).is(":visible")) {
					link.html('<i class="fa fa-bars fa-bars-edit"></i>Hide footer');
				} else{
					link.html('<i class="fa fa-bars fa-bars-edit"></i>Show footer');
				}        
			});
		});
		// Resize effect for footer:
		function resizeContent(){
			$('#filter-show').html('<i class="fa fa-bars fa-bars-edit"></i>Show footer');
			var filter = $('.filter-wrapper');
			var sirina = $(window).width();
			if(sirina > 1551 && filter.is(':hidden')){
				filter.show();
			}if(sirina < 1551 && filter.is(':visible')){
				$('#filter-show').html('<i class="fa fa-bars fa-bars-edit"></i>Hide footer');
				// filter.hide();
			}
		}
		// Call the resize function:
		resizeContent();
		$(window).resize(resizeContent);
		

		
	}); // End of document.ready




</script>

{/literal}
