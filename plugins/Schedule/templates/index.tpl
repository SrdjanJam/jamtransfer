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
	background-image: linear-gradient(#6c93eb, #828d979e);
	/* background-image: linear-gradient(#a8beef, #96a0a99e); old */
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
	box-shadow: 0px 0px 8px 0px #6d7fba;
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
	box-shadow: 3px 1px 3px 0px #5d5959;
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
	/* background: #F5F5F5; */ /* Old */
	background: #eef8f4;
	padding:10px;
}

.sub-card textarea{
	width:100%;
}
.sub-card .row button{
	padding:5px;
	border-radius: 5px;
}

.input-edit{
	box-shadow: 3px 2px 4px 1px #6a6e76;
	/* box-shadow: 1px 1px 5px 2px #4f7ab4; old */
}

.btn-primary-edit{
	box-shadow: 2px 1px 5px 1px #3e7ed9;
	/* box-shadow: 1px 1px 4px 1px #4d5077; old */
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
		<div id="show" class="button-toggle"><i class="fa-solid fa-bars fa-bars-edit"></i>{$SHOW_FILTERS}</div>
		<div id="hide" class="button-toggle"><i class="fa-solid fa-bars fa-bars-edit"></i>{$HIDE_FILTERS}</div>
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
					<button type="submit" class="btn btn-primary btn-primary-edit">{$GO}</button>
				</div>
			</form> <!-- /form -->

		</div> <!-- /.filter -->
	</div> <!-- /.row -->

	<!-- MAIN CONTENT: -->
	<div class="row row-shedule">
		{assign var=counter value=1}
		{if $sdArray|count eq 0}
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
						<a href="tel:{$sdArray[pom].Mob}">{$sdArray[pom].Mob}</a><br>
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

function resize(){

	if ($(window).width() > 1553) {
		$('.filter').show();
		$('#show').hide();
		$('#hide').hide();
	}

	if ($(window).width() < 1552) {
		$('.filter').hide();
		$('#show').show();
		$('#hide').hide();
		
	}

}


$('#show').click(function() {
	$('.filter').toggle(600);
	$('#show').hide();
	$('#hide').show();
});

$('#hide').click(function() {
	$('.filter').toggle(600);
	$('#show').show();
	$('#hide').hide();
});

resize();
$(window).resize(resize);


</script>