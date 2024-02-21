<style>

/* OLD: */

/* .datepicker {
	width: 10em;
	text-align: center;
}
.picker__frame {
	top: 20% !important;
}
.btn-xs {
	border: 0;
}
hr {
	border-top: 1px solid #eee;
} */

/* .stupac {
	border: solid 1px #ccc;
}
.stupacWrapper {
	margin-top: 12px;
	padding: 0 2px;
}

.blink {
	background-color:red;
	color:white;
	animation: blinker 1s infinite;
}
  
@keyframes blinker {
	from { opacity: 1.0; }
	50% { opacity: 0.5; }
	to { opacity: 1.0; }
}

======================================================================================
*/

/* NEW: */

.row-header{
	/* background: rgb(205 216 243);  */ /* Old */
	/* background-image: linear-gradient(#a8beef, #96a0a99e); old */
	background-image: linear-gradient(#007aff4d,#98b3ce59);
	box-shadow: 5px 5px 8px #525a5e;
	/* box-shadow: 5px 5px 8px #6c9bb6; old */
	padding: 10px;
	position: sticky;
	top: 0;
    z-index: 5;
    /* margin-left: 0px; 
    margin-right: 0px; */
	border-radius: 5px;
}
.row-header input{
	margin-bottom: 5px;
}

.row-shedule{
    margin:15px 0 0 0;
	font-size:0.85em !important;
}
.row-shedule .row{
    margin:0;
}

.row .white{
	/* border:1px solid rgb(223 223 223); Old */
	/* border: 2px solid rgb(136 177 217); off */
	border-radius:5px;
	/* box-shadow: 0px 0px 8px 0px #6d7fba; old */
	box-shadow: 0px 0px 8px 0px #020202;
}

.row .orange{
	background-image: linear-gradient(#c8d7e9, #d0dff1);
	/* background-image: linear-gradient(#88b7ed, #d0dff1); old */
	color: #06a1fc;
	/* color:#474542; old */
	padding:5px;
	font-size:18px;
	font-family:Georgia, 'Times New Roman', Times, serif;
	text-shadow: #949492 0 0 1px;
}

.col-md-edit{
	padding:2px 5px;
}

.sub-card{
	/* background:#e8eef1; old */
	/* background-image: linear-gradient(#d6e6e7, #e6e7e0); old */
	background: #7370de45;
	/* background:#d6e6e7; old */
	margin:5px;
	padding:2px;
	border-radius:5px;
	/* box-shadow: 3px 1px 3px 0px #5d5959; old */
	box-shadow: 0px 0px 4px 0px #a2c8fb;
}
.sub-card .row{
	font-family: Tahoma, Verdana, Geneva, sans-serif;
	padding-top:5px;
}

.col-md-3 input{
	font-weight:bold;
	text-align:center;
}

.col-md-5 select{
	width:100%;
	height:2em;
	margin-top:5px;
}

.red{
	color: white;
}

.blink {
	background-color:red;
	color:white;
	animation: blinker 2s ease 0s infinite normal forwards;
}

@keyframes blinker {
	0% {
		opacity: 1;
	}

	50% {
		opacity: 0.2;
	}

	100% {
		opacity: 1;
	}
}

.fa-user{
	color:#2a2a2a;
}

.add-hiddenInfo{
	/* background: #eef8f4; old */
	background: #f4f5f6;
	padding:10px;
	border-radius: 3px;
}

.sub-card textarea{
	width:100%;
}
.sub-card .row button{
	border-radius: 5px;
}

.filter .input-edit{
	/* box-shadow: 3px 2px 4px 1px #6a6e76; old */
	box-shadow: 2px 1px 4px 1px #6a6e76;
}

.btn-primary-edit{
	/* box-shadow: 2px 1px 5px 1px #3e7ed9; old */
	box-shadow: 2px 1px 5px 1px #3e7ed9;
    border-radius: 5px;
}

.datepicker{
	background: #ddf3ff;
	/* background: #e9f2f7; old */
	color: #0082ff;
	font-weight: bold;
}

/* Filters: */
#schedule-filters{
	float:left;
	background: #479de929;
	border-radius: 5px;
	padding-right: 5px;
	box-shadow: 3px 3px 4px 0px #3b75b9;
	margin-bottom: 10px;
}

.button-toggle{
	cursor:pointer; font-weight:bold; color: #0584f1; text-shadow: #0584f1 0px 0px 1px;
}

.fa-bars-edit{
	font-size: 20px;margin: 5px;color: #0584f1;
}

.button-toggle:hover,.fa-bars-edit:hover{
	cursor:pointer; font-weight:bold; color: #0b70c9;
}

.filter{
	overflow: hidden;
}
/* ------------------------------------------------------ */

</style>

<!-- HEADER: -->
	<div class="row row-header">

	<!-- Show and Hide Filters buttons: -->
	<div id="schedule-filters">
		<div id="show-hide" class="button-toggle"><i class="fa fa-bars fa-bars-edit"></i></div>
	</div>


		<div class="filter">

			<form  action="" method="post" onsubmit="return validate()">
				<div class="col-sm-2">
					<input id="DateFrom" class="datepicker form-control input-edit" name="DateFrom" value="{$DateFrom}">
				</div>
				<div class="col-sm-2">
					<input id="DateTo" class="datepicker form-control input-edit" name="DateTo" value="{$DateTo}">
				</div>	
				<div class="col-sm-2">
					<select name="NoColumns" class="form-control input-edit">
						<option value="1" {if $NoColumns eq 1}selected{/if}>1 {$COLUMN}</option>
						<option value="2" {if $NoColumns eq 2}selected{/if}>2 {$COLUMN}</option>
						<option value="3" {if $NoColumns eq 3}selected{/if}>3 {$COLUMN}</option>
						<option value="4" {if $NoColumns eq 4}selected{/if}>4 {$COLUMN}</option>
						<option value="6" {if $NoColumns eq 6}selected{/if}>6 {$COLUMN}</option>
						<option value="12" {if $NoColumns eq 12}selected{/if}>12 {$COLUMN}</option>
					</select>		
				</div>			
				<div class="col-sm-2">
					<select name="DriverStatus" class="form-control input-edit">
						<option value="0" {if $DriverStatus eq 0}selected{/if}>{$DISPLAY_ALL}</option>
						<option value="1" {if $DriverStatus eq 1}selected{/if}>{$NOT_READY}</option>
						<option value="2" {if $DriverStatus eq 2}selected{/if}>{$READY_FINISHED}</option>
					</select>		
				</div>
				<div class="col-sm-2">
					<button type="submit" class="btn btn-primary btn-primary-edit">{$SHOW_SCHEDULE}</button>
				</div>
			</form> <!-- /form -->

		</div> <!-- /.filter -->
	</div> <!-- /.row -->

<!-- MAIN CONTENT: -->
	<div class="row row-shedule">
		{assign var=counter value=1}

		{if count((array)$sdArray) eq 0}
			<h1 style="color: chocolate;">{$NO_TRANSFERS_FOR_THIS_PERIOD}</h1>
		{/if}
		{section name=pom loop=$sdArray}
			{if $counter eq 1}
			<div class="row">	
			{/if}
			
			
			<!-- Column one: -->
			<div class="col-md-{$BsColumnWidth} col-md-edit">				
				<!-- One card: -->
				<div class="row white shadow border">
					<div class="row orange white-text">
						<strong>{$sdArray[pom].DriverName}</strong>	
						<a href="tel:{$sdArray[pom].Mob}">{$sdArray[pom].Mob}</a>
							<input id="rt{$sdArray[pom].DriverID}" type="text" class="timepicker readytime" name="readytime" value="{$sdArray[pom].TimeToSend}" placeholder="ready time"
							data-sdid="{$sdArray[pom].DriverID}" data-nid="{$sdArray[pom].NotificationID}"/>
						<div class='{$todayshow}'>
							<i class="{$sdArray[pom].IconPositon}" aria-hidden="true"></i> <small>{$sdArray[pom].Device} {$sdArray[pom].Location}</small>
						</div>
					</div>
 
					{if count($sdArray[pom].Transfers)}
						{section name=pom2 loop=$sdArray[pom].Transfers}
							{include file='plugins/Schedule/templates/oneTransfer.tpl'}						
						{/section}

					{else}
							{$NO_CHOOSEN_SCHEDULE}

					{/if}

				</div>	<!-- /.row white shadow border (One card) -->
					
			</div> {* col-md-{$BsColumnWidth} *}

			{if $counter eq $NoColumns}
				{assign var=counter value=0}
			</div>
			{/if}
			<span style="display:none;">{$counter++}</span>

		
		{/section}
		{if $counter lt $NoColumnsADD and $counter ne 1} 
			</div>
		{/if}
		

	</div> <!-- /.row row-shedule -->


{* Scripts: *}
<script>

// Toggle effects for button:
$('#show-hide').hide();
$('#show-hide').click(function(){
	var link = $(this);
	$('.filter').slideToggle('slow', function() {
		if ($(this).is(":visible")) {
			link.html('<i class="fa fa-bars fa-bars-edit"></i>Hide filters');
		} else{
			link.html('<i class="fa fa-bars fa-bars-edit"></i>Show filters');
		}        
	});
});
// Resize effect for footer:
function resizeContent(){
	var filter = $('.filter');
	var sirina = $(window).width();
	if(sirina > 1551 && filter.is(':visible')){
		filter.removeAttr('style');
		$('#show-hide').hide();
	}if(sirina < 1551 && filter.is(':hidden')){
		$('#show-hide').show();
		$('#show-hide').html('<i class="fa fa-bars fa-bars-edit"></i>Show filters');
		filter.show();
		filter.removeAttr('style');
	}
}

// Call the resize function:
resizeContent();
$(window).resize(resizeContent);

$('.readytime').change(function(){
	var ReadyTime = $(this).val();
	var ReadyDate = $("#DateFrom").val();
	var sdid = $(this).attr('data-sdid');
	var nid = $(this).attr('data-nid');
	var url = "plugins/Schedule/readyTime.php";
	var param = "TimeToSend="+ReadyTime+"&DateToSend="+ReadyDate+"&SubDriverID="+sdid+"&NotificationID="+nid;
	console.log(url+'?'+param);
	$.ajax({
		url: url,
		type: "POST",
		data: param,
		success: function (data) {
			toastr['success'](window.success);	
			$('#rt'+sdid).attr('data-nid',data);
		}
	})	
})

</script>