<!-- Sub card: -->
{assign var="ID" value="{$ordersArray[pom2].DetailsID}"}

<div class="sub-card" style="background:{$ordersArray[pom2].bgColor}">
	{* row first *}
	<div class="row"> <!-- TRANSFER -->
		<span>
			{if $ordersArray[pom2].UserLevelID eq '2'}
				<i class='fa fa-user-secret'></i>
					{if $ordersArray[pom2].Image ne ""}
						<img src='i/agents/{$ordersArray[pom2].Image}'>	 
						<b>{$ordersArray[pom2].AuthUserRealName}</b>
					{/if}
			{/if}
		</span>					
		<strong>
			<a href="orders/detail/{$ID}" target="_blank">
				{$ordersArray[pom2].MOrderKey}-{$ordersArray[pom2].OrderID}-{$ordersArray[pom2].TNo}
			</a>
		</strong>
		<strong>
			<input style='float:right;' class='check' onchange="saveTransfer({$ID},1)" id="checkdata_{$ID}" type="checkbox" name="checkeddata"
			{if $ordersArray[pom2].DriverConfStatus gt 2}checked disabled{/if}>
			<input type="hidden" id="DriverConfStatus_{$ID}" name="DriverConfStatus" value="{$ordersArray[pom2].DriverConfStatus}">	
			<label style='float:right;' for="checkeddata">{$READY} </label>	
		</strong>	
	</div>

	{* row second *}

	<div class="row">
		<h4>{$ordersArray[pom2].PickupName} - {$ordersArray[pom2].DropName}</h4>

		{if $ordersArray[pom2].flightTimeConflict}
			<span class='blink'>{$FLIGHT_TIME_CONFLICT}</span>
			{$ordersArray[pom2].FlightTime}
		{/if}

		{$ordersArray[pom2].changedIcon}
		
	</div>

	{* row third *}	
	<div class="row">

		<div class="col-md-3">
			<input type="text" class="timepicker w100 form-control {$ordersArray[pom2].color}" id="SubPickupTime_{$ID}"
				name="SubPickupTime_{$ID}"
				value="{$ordersArray[pom2].SubPickupTime}" onchange="saveTransfer({$ID},0)">
		</div>
	
		<div class="col-md-3">
			<input type="text" class="w100 form-control {$ordersArray[pom2].color2}"  id="PickupTimeX_{$ID}"
				name="PickupTimeX_{$ID}"
				value="{$ordersArray[pom2].PickupTime}" />
		</div>
		<!-- info icons -->
		<div class="col-md-3 small align-middle">
			<div>
				<i class="fa fa-user"></i>&nbsp;&nbsp;{$ordersArray[pom2].PaxNo}
			</div>
			<div>
				<i class="fa fa-car {$ordersArray[pom2].carColor} pad4px"></i> 
				{$ordersArray[pom2].VehicleTypeName}
				{if $ordersArray[pom2].VehiclesNo gt 1} x {$ordersArray[pom2].VehiclesNo} {/if}
				<br>
			</div>
		</div>

		<div class="col-md-3">
			<div>
				<i class="fa fa-clock-o"></i>
				<input type="text" name="TransferDuration_{$ID}" 
				id="TransferDuration_{$ID}" class="form-control" size="2" value="{$ordersArray[pom2].TransferDuration}" 
				title="Transfer duration"  onchange="saveTransfer({$ID},0)">
			</div>	
			<div>
				{if $ordersArray[pom2].extras ne ''}<i class="fa fa-cubes red-text"></i>{/if}
			</div>
		</div>

	</div> 

	{* row forth *}
	<div class="row" style="line-height:140%">
		<div class="col-md-10">
			<select class="subdriver1" data-id="{$ID}"
			id="SubDriver_{$ID}" name="SubDriver_{$ID}" onchange="saveTransfer({$ID},0)">
				<option value='0'> --- </option>
				{section name=pom3 loop=$sddArray}
					<option value="{$sddArray[pom3].DriverID}" data-mob="{$sddArray[pom3].Mob}";
					{if $sddArray[pom3].DriverID eq $ordersArray[pom2].SubDriver}
						selected
					{/if}	
					>{$sddArray[pom3].DriverName} - {$sddArray[pom3].DriverCar}</option>';
				{/section}	
			</select>
		</div>
		<div class="col-md-2">
			<a href="#" class="btn btn-default" onclick="return ShowSubdriver2('{$ID}');">
				<i class="fa fa-plus"></i>
			</a>
		</div>		
	</div>
	
	{* Hidden or not: *}
	<div id="subDriver2{$ID}" class="row {if  $ordersArray[pom2].SubDriver2 eq 0}hidden{/if}" style="line-height:140%">
		<div class="col-md-10">
			<select class="subdriver1" data-id="{$ID}"
			id="SubDriver_{$ID}" name="SubDriver_{$ID}" onchange="saveTransfer({$ID},0)">
				<option value='0'> --- </option>
				{section name=pom3 loop=$sddArray}
					<option value="{$sddArray[pom3].DriverID}" data-mob="{$sddArray[pom3].Mob}";
					{if $sddArray[pom3].DriverID eq $ordersArray[pom2].SubDriver2}
						selected
					{/if}	
					>{$sddArray[pom3].DriverName} - {$sddArray[pom3].DriverCar}</option>';
				{/section}	
			</select>
		</div>
		<div class="col-md-2">
			<a href="#" class="btn btn-default" onclick="return ShowSubdriver3('{$ID}');">
				<i class="fa fa-plus"></i>
			</a>
		</div>			
	</div>

	{* Hidden or not: *}
	<div id="subDriver3{$ID}"  class="row {if  $ordersArray[pom2].SubDriver3 eq 0}hidden{/if}" style="line-height:140%">
		<div class="col-md-10">
			<select class="subdriver1" data-id="{$ID}"
			id="SubDriver_{$ID}" name="SubDriver_{$ID}" onchange="saveTransfer({$ID},0)">
				<option value='0'> --- </option>
				{section name=pom3 loop=$sddArray}
					<option value="{$sddArray[pom3].DriverID}" data-mob="{$sddArray[pom3].Mob}";
					{if $sddArray[pom3].DriverID eq $ordersArray[pom2].SubDriver3}
						selected
					{/if}	
					>{$sddArray[pom3].DriverName} - {$sddArray[pom3].DriverCar}</option>';
				{/section}	
			</select>
		</div>
	</div>

	<div class="row">
		<button class="btn-xs btn-primary btn-block" onclick="ShowShow({$ID});toggleChevron(this);">
			<i class="fa fa-chevron-down"></i>
		</button>
	</div> 

	<!-- hiddenInfo -->
	<div class="row grey lighten-4 pad1em shadow" id="show{$ID}" style="display:none;margin:0">
		Detalji transfera
	</div>

</div> 






<script>

	function saveTransfer (i,mail) {
		alert (i);
	}
	
	function ShowShow(i) {
		$("#show"+i).toggle('slow');
	}
	
	function toggleChevron (button) {
		if (button.innerHTML == '<i class="fa fa-chevron-up"></i>')
			button.innerHTML = '<i class="fa fa-chevron-down"></i>';
		else button.innerHTML = '<i class="fa fa-chevron-up"></i>';
	}
	
	function ShowSubdriver2(i)
	{
	    $("#subDriver2"+i).toggle('slow');
	    return false;
	}

	function ShowSubdriver3(i)
	{
	    $("#subDriver3"+i).toggle('slow');
	    return false;
	}
</script>	