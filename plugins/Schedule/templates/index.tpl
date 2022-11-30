<style>

.datepicker {
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
}

.stupac {
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
</style>

	<div class="row" >
		<div class="col-sm-3">	
			<button class="btn" onclick="hideChecked()">{$DISPLAY_NOT_CHECKED}</button>
			<button class="btn" onclick="displayAll()">{$DISPLAY_ALL}</button>
		</div>		
		<form  action="" method="post" onsubmit="return validate()">
			<div class="col-sm-3">
				From
				<input id="DateFrom" class="datepicker" name="DateFrom" value="{$DateFrom}">
			</div>
			<div class="col-sm-3">
				to
				<input id="DateTo" class="datepicker" name="DateTo" value="{$DateTo}">
			</div>	
			<div class="col-sm-3">
				with
				<select name="NoColumns">
					<option value="1" {if $NoColumns eq 1}selected{/if}>1</option>
					<option value="2" {if $NoColumns eq 2}selected{/if}>2</option>
					<option value="3" {if $NoColumns eq 3}selected{/if}>3</option>
					<option value="4" {if $NoColumns eq 4}selected{/if}>4</option>
					<option value="6" {if $NoColumns eq 6}selected{/if}>6</option>
					<option value="12" {if $NoColumns eq 12}selected{/if}>12</option>
				</select>
				columns
				<button type="submit" class="btn btn-primary">Go</button>
			</div>	
			</form>
	<div class="row" style="font-size:0.85em !important">
		{section name=pom loop=$sdArray}
			<div class="col-md-{$BsColumnWidth}">
				<div class="row orange white-text">
					<strong>{$sdArray[pom].DriverName}</strong>	
				</div>	
				<div class="row white shadow" style="cursor:default; padding:8px !important;background:;">
					{section name=pom2 loop=$ordersArray}
					{if ($sdArray[pom].DriverID eq $ordersArray[pom2].SubDriver) or
					($sdArray[pom].DriverID eq $ordersArray[pom2].SubDriver2) or
					($sdArray[pom].DriverID eq $ordersArray[pom2].SubDriver3)}
					<div class="row"> <!-- TRANSFER -->
						{$ordersArray[pom2].DetailsID}
					</div>
					{/if}
					{/section}
				</div>	
					
			</div>
		
		{/section}
	</div>
