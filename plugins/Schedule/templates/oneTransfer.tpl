

{assign var="ID" value="{$ordersArray[pom2].DetailsID}"}

<!-- Sub card: -->
<div class="sub-card">
	<div class="bgColor" style="background:{$ordersArray[pom2].bgColor};padding:10px;">
		<!-- row first -->
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

		<!-- row second -->
		<div class="row">
			<h4>{$ordersArray[pom2].PickupName} - {$ordersArray[pom2].DropName}</h4>

			{if $ordersArray[pom2].flightTimeConflict}
				<span class='blink'>{$FLIGHT_TIME_CONFLICT}</span>
				{$ordersArray[pom2].FlightTime}
			{/if}

			{$ordersArray[pom2].changedIcon}
			
		</div>

		<style>
			
			.form-group.form-group-edit{
				display: inline;
			}


			@media screen and (max-width:1000px){
				.form-group.form-group-edit{
					display: block;
				}

				.row-third-edit .col-md-3{
					margin-top: 10px;
				}
				.row-third-edit .form-control{
					width:100%;
				}

				.clock-timepicker{
					width:100% !important;
				}
				
				select{
					width:100%;
					margin-bottom: 5px;
				}
				
			}
		</style>

		<!-- row third -->
		<div class="row row-third-edit">

			<div class="col-md-3">
				<input type="text" class="timepicker w100 form-control {$ordersArray[pom2].color} timepicker-edit" id="SubPickupTime_{$ordersArray[pom2].DetailsID}"
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
				<i class="fa fa-user"></i>&nbsp;&nbsp;{$ordersArray[pom2].PaxNo}
				<div class="form-group">
					<i class="fa fa-car {$ordersArray[pom2].carColor} pad4px"></i> 
					{$ordersArray[pom2].VehicleTypeName}
					{if $ordersArray[pom2].VehiclesNo gt 1} x {$ordersArray[pom2].VehiclesNo} {/if}
					<br>
				</div>
			</div>

			<div class="col-md-3">
			<i class="fa fa-clock-o"></i>		
				<div class="form-group form-group-edit">
				
					<input type="text" name="TransferDuration_{$ordersArray[pom2].DetailsID}" 
					id="TransferDuration_{$ordersArray[pom2].DetailsID}" class="form-control" size="2" value="{$ordersArray[pom2].TransferDuration}" 
					title="Transfer duration"  onchange="saveTransfer({$ordersArray[pom2].DetailsID},0)">
				</div>	
				<div>
					{if $ordersArray[pom2].extras ne ''}<i class="fa fa-cubes red-text"></i>{/if}
				</div>
			</div>

		</div> 

		<!-- row forth -->
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
		
		<!-- Hidden or not: -->
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

		<!-- Hidden or not: -->
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
			{* Detalji transfera *}
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

			<input type="hidden" name="OrderID_{$ordersArray[pom2].DetailsID}" id="OrderID_{$ordersArray[pom2].DetailsID}" value="{$ordersArray[pom2].OrderID}">
			
			<div class="col-md-6">
				<button class="btn btn-primary btn-block" onclick="saveTransfer({$ordersArray[pom2].DetailsID},1)">
					<i class="fa fa-save"></i> Save
				</button>
			</div>
			



		</div> {* ./add-hiddenInfo *}
	</div> {* ./bgColor *}
</div> {* ./sub-card *}




<script>

	function displayMob() {
		$( ".subdriver1" ).each(function() {
			var id = $(this).attr('data-id');
			var mob = $('option:selected',this).attr('data-mob');
			var mobid='#'+'mob'+id;
			$(mobid).text(mob);
			$(mobid).attr('href',('tel:'+mob));
		});	
	}
	function saveTransfer (i,mail) {
		//displayMob();
		//var id	= $("#ID_" + i).val();
		var oid	= $("#OrderID_" + i).val();
		var checked = $('#checkdata_'+i).prop('checked');
		if (checked) {
			checked=1;
			$('#checkdata'+i).prop('checked',true);
			$('#checkdata'+i).prop('disabled',true);

			var driverconfirmationstatus=3;
			if (mail == 1) console.log('Sending message to client');
		}	
		else {
			checked=0;
			var driverconfirmationstatus=$("#DriverConfStatus_" + i).val();			
			$('#checkdata'+i).prop('checked',false);
			$('#checkdata'+i).prop('disabled',false);
			mail=0;
		}
		var fn	= $("#SubFlightNo_" + i).val();
		var ft	= $("#SubFlightTime_" + i).val();
		var pt	= $("#SubPickupTime_" + i).val();
		var sd	= $("select#SubDriver_" + i).val();
		var sd2	= $("select#SubDriver2_" + i).val();
		var sd3	= $("select#SubDriver3_" + i).val();
		var c	= $("select#Car_" + i).val();
		var c2	= $("select#Car2_" + i).val();
		var c3	= $("select#Car3_" + i).val();
		var sn	= $("#StaffNote_" + i).val();
		var n	= $("#SubDriverNote_" + i).val();
		var g	= $("#CashIn_" + i).val();
		var td	= $("#TransferDuration_" + i).val();
		var msg = $("#save-button-msg-" + i);

		msg.innerHTML = "Saving...";
		var url= "plugins/Schedule/ajax_updateNotes.php";
		var param = 'ID='+i+'&OrderID='+oid+'&DriverConfStatus='+driverconfirmationstatus+'&CustomerID='+checked+'&SubFlightNo='+fn+'&SubFlightTime='+ft+'&SubPickupTime='+pt+'&SubDriver='+sd+'&SubDriver2='+sd2+'&SubDriver3='+sd3+'&Car='+c+'&Car2='+c2+'&Car3='+c3+'&StaffNote='+ sn+'&Notes='+n+'&CashIn='+g+'&TransferDuration='+ td+'&Mail='+ mail;
		console.log(url+'?'+param);
		$.ajax({
			url: url,
			type: "POST",
			data: {
				ID: i,
				OrderID: oid,
				DriverConfStatus: driverconfirmationstatus,
				CustomerID: checked,								
				SubFlightNo: fn,
				SubFlightTime: ft,
				SubPickupTime: pt,
				SubDriver: sd,
				SubDriver2: sd2,
				SubDriver3: sd3,
				Car: c,
				Car2: c2,
				Car3: c3,
				StaffNote: sn,
				Notes: n,
				CashIn: g,
				TransferDuration: td,
				Mail: mail
			},
			success: function (result) {
				msg.innerHTML = "Saved";

				$("#upd"+i).html(result);
				var res = $.trim(result);
				
				if(res != '<small>Saved.</small>') {
					$.toaster(result, 'Oops', 'success red-2');
				}
				if ((sd == '0') || (c == '0')) {
					$("#indicator_"+i).css("borderLeftColor","red");
				}
				else {
					$("#indicator_"+i).css("borderLeftColor","green");
				}
			},
			error: function (e) {
				msg.innerHTML = "Error";
				// console.log("Error:");
				// console.log(e);
			}
		});
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