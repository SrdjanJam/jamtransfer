<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- Labels: -->
	<div class="row row-edit">
		
		<div class="col-md-1">
			<?=OFF_DUTY_ID;?>
		</div>

		<div class="col-md-2">
			<?=VEHICLEID;?>
		</div>

		<div class="col-md-2">
			<?=STARTDATE;?>
		</div>

		<div class="col-md-2">
			<?=STARTTIME;?>
		</div>

		<div class="col-md-2">
			<?=ENDDATE;?>
		</div>

		<div class="col-md-1">
			<?=ENDTIME;?>
		</div>

		<div class="col-md-2">
			<?=REASON;?>
		</div>
				
	</div>

	<!-- Main content: -->
	{{#each Item}}
		
		<div class="row {{color}} pad1em listTile listTitleEdit" 
		style="border-top:1px solid #ddd" 
		id="t_{{ID}}">
	
			<!-- ID -->
			<div class="col-md-1">
				<strong>{{ID}}</strong>
			</div>

			<!-- VEHICLEID -->
			<div class="col-md-2">
				<input type="text" name="VehicleID" id="VehicleID" class="w100" value="{{VehicleID}}">
			</div>

			<!-- STARTDATE -->
			<div class="col-md-2">
				<input type="text" name="StartDate" id="StartDate" 
				class="w25 datepicker" value="{{StartDate}}">
			</div>

			<!-- STARTTIME	-->
			<div class="col-md-2">
				<input type="text" name="StartTime" id="StartTime" 
				class="w25 timepicker" value="{{StartTime}}">
			</div>

			<!-- ENDDATE -->
			<div class="col-md-2">
				<input type="text" name="EndDate" id="EndDate" 
				class="w25 datepicker" value="{{EndDate}}">
			</div>

			<!-- ENDTIME -->
			<div class="col-md-1">
				<input type="text" name="EndTime" id="EndTime" 
				class="w25 timepicker" value="{{EndTime}}" style="width:120px;">
			</div>

			<!-- REASON -->
			<div class="col-md-2">
				<input type="text" name="Reason" id="Reason" class="w100" value="{{Reason}}">
			</div>
				
		</div>

	{{/each}}

</script>
	
