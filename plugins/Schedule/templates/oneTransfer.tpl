
<!-- Sub card: -->
{assign var="ID" value="{$ordersArray[pom2].DetailsID}"}


<div class="sub-card">
	<div class="bgColor" style="background:{$ordersArray[pom2].bgColor};padding:10px;">
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
				<a href="orders/detail/{$ordersArray[pom2].DetailsID}" target="_blank">
					{$ordersArray[pom2].MOrderKey}-{$ordersArray[pom2].OrderID}-{$ordersArray[pom2].TNo}
				</a>
			</strong>
			<strong>
				<input style='float:right;' class='check' onchange="saveTransfer({$ordersArray[pom2].DetailsID},1)" id="checkdata_{$ordersArray[pom2].DetailsID}" type="checkbox" name="checkeddata"
				{if $ordersArray[pom2].DriverConfStatus gt 2}checked disabled{/if}>
				<input type="hidden" id="DriverConfStatus_{$ordersArray[pom2].DetailsID}" name="DriverConfStatus" value="{$ordersArray[pom2].DriverConfStatus}">	
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
				<input type="text" class="timepicker w100 form-control {$ordersArray[pom2].color}" id="SubPickupTime_{$ordersArray[pom2].DetailsID}"
					name="SubPickupTime_{$ordersArray[pom2].DetailsID}"
					value="{$ordersArray[pom2].SubPickupTime}" onchange="saveTransfer({$ordersArray[pom2].DetailsID},0)">
			</div>
		
			<div class="col-md-3">
				<input type="text" class="w100 form-control {$ordersArray[pom2].color2}"  id="PickupTimeX_{$ordersArray[pom2].DetailsID}"
					name="PickupTimeX_{$ordersArray[pom2].DetailsID}"
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
					<input type="text" name="TransferDuration_{$ordersArray[pom2].DetailsID}" 
					id="TransferDuration_{$ordersArray[pom2].DetailsID}" class="form-control" size="2" value="{$ordersArray[pom2].TransferDuration}" 
					title="Transfer duration"  onchange="saveTransfer({$ordersArray[pom2].DetailsID},0)">
				</div>	
				<div>
					{if $ordersArray[pom2].extras ne ''}<i class="fa fa-cubes red-text"></i>{/if}
				</div>
			</div>

		</div> 

		{* row forth *}
		<div class="row" style="line-height:140%">
			<div class="col-md-10">
				<select class="subdriver1" data-id="{$ordersArray[pom2].DetailsID}"
				id="SubDriver_{$ordersArray[pom2].DetailsID}" name="SubDriver_{$ordersArray[pom2].DetailsID}" onchange="saveTransfer({$ordersArray[pom2].DetailsID},0)">
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
				<a href="#" class="btn btn-default" onclick="return ShowSubdriver2('{$ordersArray[pom2].DetailsID}');">
					<i class="fa fa-plus"></i>
				</a>
			</div>		
		</div>
		
		{* Hidden or not: *}
		<div id="subDriver2{$ordersArray[pom2].DetailsID}" class="row {if  $ordersArray[pom2].SubDriver2 eq 0}hidden{/if}" style="line-height:140%">
			<div class="col-md-10">
				<select class="subdriver1" data-id="{$ordersArray[pom2].DetailsID}"
				id="SubDriver_{$ordersArray[pom2].DetailsID}" name="SubDriver_{$ordersArray[pom2].DetailsID}" onchange="saveTransfer({$ordersArray[pom2].DetailsID},0)">
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
				<a href="#" class="btn btn-default" onclick="return ShowSubdriver3('{$ordersArray[pom2].DetailsID}');">
					<i class="fa fa-plus"></i>
				</a>
			</div>			
		</div>

		{* Hidden or not: *}
		<div id="subDriver3{$ordersArray[pom2].DetailsID}"  class="row {if  $ordersArray[pom2].SubDriver3 eq 0}hidden{/if}" style="line-height:140%">
			<div class="col-md-10">
				<select class="subdriver1" data-id="{$ordersArray[pom2].DetailsID}"
				id="SubDriver_{$ordersArray[pom2].DetailsID}" name="SubDriver_{$ordersArray[pom2].DetailsID}" onchange="saveTransfer({$ordersArray[pom2].DetailsID},0)">
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
			<button class="btn-xs btn-primary btn-block" onclick="ShowShow({$ordersArray[pom2].DetailsID});toggleChevron(this);">
				<i class="fa fa-chevron-down"></i>
			</button>
		</div> 

		<!-- hiddenInfo -->
		<div class="row lighten-4 pad1em shadow add-hiddenInfo" id="show{$ordersArray[pom2].DetailsID}" style="display:none;margin:0">
			Detalji transfera
			<div class="row">
				<div class="row-one">

					{if !empty($ordersArray[pom2].MConfirmFile)}
						<br>
						Ref.No:  <b>{$ordersArray[pom2].MConfirmFile} </b>
						<br>    
						Emergency: <b> {$ordersArray[pom2].EmergencyPhone} </b>
					{/if}

					<br>
					{* {$SingleReturn} fix it *}
					
					PAX: {$ordersArray[pom2].PaxNo}
					<br>
						{$ordersArray[pom2].PickupDate} {$ordersArray[pom2].PickupTime}
					<br>
					{$ordersArray[pom2].PaxName} 
					{$ordersArray[pom2].MPaxTel}
				</div>

				<div class="row-two">
					{$ordersArray[pom2].PickupName} - {$ordersArray[pom2].DropName}
					<br> 
						{$ordersArray[pom2].PickupAddress}
						<br>
						{$ordersArray[pom2].PickupNotes}
						<br>
						{$ordersArray[pom2].DropAddress}

				</div>

				<div class="row-third">
					{$ordersArray[pom2].PayNow}
					{$ordersArray[pom2].PayLater}
					EUR:
					{if $ordersArray[pom2].PayNow > 0 and $ordersArray[pom2].PayLater > 0}<b style='color:red'>IZDATI RAČUN !</b>{/if}
					<br>
					{* {$otherTransfer = getOtherTransferIDArray($ordersArray[pom2].DetailsID,$details)}
					*}

					{* {$ordersArray[pom2].otherTransfer}
					{if $otherTransfer != null}
					
					{/if} *}

					{if !empty($returnTransfer)} {$returnTransfer} {/if}
					
				</div>

				<div class="row-forth">
					{FLIGHT_NO} {$ordersArray[pom2].FlightNo}
					{FLIGHT_TIME} {$ordersArray[pom2].FlightTime}
				</div>


			</div> {* /.row *}


			<hr style="border-color:gray">

			<div class="row">

				<div class="row-one">
					<small class="bold">{FLIGHT_NO} / {TIME}</small><br>
					<input type="text" name="SubFlightNo_{$ordersArray[pom2].DetailsID}" id="SubFlightNo_{$ordersArray[pom2].DetailsID}"
					value="{if $ordersArray[pom2].SubFlightNo != null} {$ordersArray[pom2].SubFlightNo} 
					{else} {$ordersArray[pom2].FlightNo} {/if}" >
						
					<input type="text" name="SubFlightNo_{$ordersArray[pom2].DetailsID}" class="timepicker" id="SubFlightNo_{$ordersArray[pom2].DetailsID}"
					value="{if $ordersArray[pom2].SubFlightNo != null} {$ordersArray[pom2].SubFlightNo} 
					{else} {$ordersArray[pom2].FlightNo} {/if}" >
				</div>
				
				<div class="row-two">
					<small class="bold">{STAFF_NOTE}</small></br>
					<textarea name="StaffNote_{$ordersArray[pom2].DetailsID}" id="StaffNote_{$ordersArray[pom2].DetailsID}"
					rows="4">{$ordersArray[pom2].StaffNote|stripslashes}</textarea>
				</div>

				<div class="row-third">
					<small class="bold">{NOTES_TO_DRIVER}</small><br>
					<textarea style="border: 1px solid #ddd;" name="SubDriverNote_{$ordersArray[pom2].DetailsID}" 
					id="SubDriverNote_{$ordersArray[pom2].DetailsID}" class="span3" rows="4">
					{$ordersArray[pom2].SubDriverNote|stripslashes}</textarea>
				</div>

				<div class="row-forth">
					<small class="bold">{FINAL_NOTE}</small><br>
					{$ordersArray[pom2].SubFinalNote}<br>
					{$ordersArray[pom2].FinalNote} {* privremeno *}
				</div>

				<div class="row-fifth">
					<small class="bold">{RAZDUZENO_CASH} € </small><br>
					<input type="text" name="CashIn_{$ordersArray[pom2].DetailsID}" id="CashIn_{$ordersArray[pom2].DetailsID}" value="{$ordersArray[pom2].CashIn}"><br>
					<div style="display:inline-block;color:#900;" id="upd{$ordersArray[pom2].DetailsID}"></div>
				</div>
			
			</div> {* ./row *}


			<hr style="border-color:gray">

			<!-- PDF Receipt -->
			{if $inter}

				<div class="col-md-6">

					{if $ordersArray[pom2].PDFFile}
						<div id="existingPDF{$ordersArray[pom2].DetailsID}" style="display: inline">
							<a href="https://www.jamtransfer.com/cms/raspored/PDF/{$ordersArray[pom2].PDFFile}" target="_blank"
							class="btn btn-small btn-primary">
								{DOWNLOAD_RECEIPT} {$ordersArray[pom2].PDFFile}
							</a>&nbsp;&nbsp;
							<button onclick="return deletePDF('{$ordersArray[pom2].PDFFile}','{$ordersArray[pom2].DetailsID}','{$ordersArray[pom2].DetailsID}');" 
							class="btn btn-small btn-danger" >
								{DELETE_RECEIPT} {$ordersArray[pom2].PDFFile}
							</button>&nbsp;&nbsp; 
						</div>
					{/if}

					<form name="form" action="" method="POST" enctype="multipart/form-data" style="display:inline">
						<input type="file" name="PDFFile_{$ordersArray[pom2].DetailsID}" id="PDFFile_{$ordersArray[pom2].DetailsID}" 
						onchange="return ajaxFileUpload('{$ordersArray[pom2].DetailsID}');" style="display:none">
						<input type="hidden" name="ID_{$ordersArray[pom2].DetailsID}" id="ID_{$ordersArray[pom2].DetailsID}" value="{$ordersArray[pom2].DetailsID}">
						<button id="imgUpload" class="btn btn-small btn-default" 
							onclick="$('#PDFFile_{$ordersArray[pom2].DetailsID}').click();return false;">
							{UPLOAD_PDF_RECEIPT}
						</button>
					</form>

					<div style="display:inline-block;color:#900;" id="PDFUploaded_{$ordersArray[pom2].DetailsID}"></div>
				</div>
			
			{/if}

			<div class="col-md-6">
				<button class="btn btn-primary btn-block" onclick="saveTransfer({$ordersArray[pom2].DetailsID},1)">
					<i class="fa fa-save"></i> Save
				</button>
			</div>
			



		</div> {* ./add-hiddenInfo *}
	</div> {* ./bgColor *}
</div> {* ./sub-card *}




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