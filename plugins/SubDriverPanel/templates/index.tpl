<strong>{$MESSAGE}:</strong>{$NoteToDriver}
{if $details|@count gt 0}
{section name=pom loop=$details}
	<div class="row">
		<u><h3>{$details[pom].SubPickupTime}</h3></u>
	</div>
	<div class="row">
		<strong {$details[pom].cancelstyle} >{$details[pom].OrderID}-{$details[pom].TNo}</strong> 
		<span class="{$details[pom].tbadge}">{$details[pom].tstatus}</span> 
		{if !empty($details[pom].returnTransfer)}<i class="fa fa-arrow-left"></i> {$details[pom].returnTransfer}{/if}
		{if $details[pom].TNo eq 2}
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#ftransfer">
				<i class="fa fa-arrow-right"></i> First Transfer
			</button>
			<div class="modal fade"  id="ftransfer">
				<div class="modal-dialog" style="width: fit-content;">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body" style="padding:10px">
							<div class="row">
								<div class="col-xs-6 right">Drivers :</div>
								<div class="col-xs-6">
									{if $details[pom].FSubDriver ne ""} {$details[pom].FSubDriver} {/if}
									{if $details[pom].FSubDriver2 ne ""}<br> {$details[pom].FSubDriver2} {/if}
									{if $details[pom].FSubDriver3 ne ""}<br> {$details[pom].FSubDriver3} {/if}
								</div>
							</div>		
							<div class="row">
								<div class="col-xs-6 right">Final Notes :</div>
								<div class="col-xs-6">{$details[pom].FFinalNote}<br>{$details[pom].FSubFinalNote}</div>
							</div>							
						</div>
					</div>
				</div>
			</div>				
		{/if}		
	</div>
	<div class="row">
		<button type="button" class="btn btn-lg btn-info" data-toggle="modal" data-target="#adress">
			{$details[pom].PickupName} &raquo; {$details[pom].DropName}
		</button>
	</div>	
	<div class="modal fade"  id="adress">
		<div class="modal-dialog" style="width: fit-content;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style="padding:10px">
					<div class="row">
						<div class="col-md-12">
							<a target="blank" href="{$details[pom].PickupAddressG}">{$details[pom].PickupName}, {$details[pom].PickupAddress}</a><br> 
							<a target="blank" href="{$details[pom].DropAddressG}">{$details[pom].DropName}, {$details[pom].DropAddress}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
	<div class="row">
		{$details[pom].PaxNo} pax &nbsp; <i class="fa fa-car {$details[pom].carColor} pad4px"></i> {$details[pom].vehicleType}
	</div>	
	<div class="row">
		{$details[pom].carName}
		{if $details[pom].moreCars gt 0} <strong>{$details[pom].moreCars} cars </strong>{/if}
	</div>	
	<div class="row">				
		<i class="fa fa-user"></i> {$details[pom].PaxName} <i class="fa fa-phone"></i> <a href="tel:{$details[pom].paxTel}">{$details[pom].paxTel}</a>
	</div>	
	{if $details[pom].oeServices|count gt 0}
	<div class="row">				
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#extras">
			<i class="fa fa-cubes"></i> {$EXTRAS}
		</button>
	</div>	
	<div class="modal fade"  id="extras">
		<div class="modal-dialog" style="width: fit-content;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">{$EXTRAS}</h4>
				</div>
				<div class="modal-body" style="padding:10px">
					<br>
					<div class="row">
						<div class="col-md-12">
							{section name=pom2 loop=$details[pom].oeServices}
								{$details[pom].oeServices[pom2].ServiceName} x {$details[pom].oeServices[pom2].Qty}
								<br>
							{/section}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
	{/if}
	<div class="row">		
		<i class="fa fa-plane"></i> <a target="_blank" href="{$details[pom].fs_link}">{$details[pom].FlightNo}</a> {$details[pom].FlightTime}										
	</div>
	<div class="row">
		{if $details[pom].PickupNotes ne ""}
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#pnotes">
			<i class="fa fa-envelope"></i> Pickup message
		</button>
		<div class="modal fade"  id="pnotes">
			<div class="modal-dialog" style="width: fit-content;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" style="padding:10px">
						{$details[pom].PickupNotes}
					</div>
				</div>
			</div>
		</div>	
		{/if}		
		{if $details[pom].SubDriverNote ne ""}
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#sdnotes">
			<i class="fa fa-envelope"></i> Subdriver message
		</button>
		<div class="modal fade"  id="sdnotes">
			<div class="modal-dialog" style="width: fit-content;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" style="padding:10px">
						{$details[pom].SubDriverNote}
					</div>
				</div>
			</div>
		</div>	
		{/if}
	</div>			
	
	{if $details[pom].SubDriver eq $smarty.session.AuthUserID and $details[pom].PayLater gt 0}
	<div class="row">
		<label>{$PAY_LATER}</label> <strong>{$details[pom].PayLater}</strong><br>
		<label>Amount Paid (EUR)</label>
		<input type="number" name="cash" class="cash" size="5" step="0.01" placeholder="" value="{$details[pom].CashIn}"
		data-detailid="{$details[pom].DetailsID}"/>
	</div>	
	{/if}	
	<div class="row">
		<a target="_blank" href="plugins/SubDriverPanel/sign.php?paxname={$details[pom].PaxName}&id={$details[pom].DetailsID}"
			class="btn btn-lg btn-info"><i class="fa fa-tablet"></i> Welcome Sign
		</a>
	</div>	
	<div class="row">
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#complete">
			{$FINISH_TRANSFER}
		</button>
		<div class="modal fade"  id="complete">
			<div class="modal-dialog" style="width: fit-content;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">{$FINISH_TRANSFER}</h4>
					</div>
					<div class="modal-body" style="padding:10px">	
						<button id='mac' class="btn btn-default" onclick="changeDriverConfStatus('{$details[pom].DetailsID}', '7');" >		 
							<i class="fa fa-check-circle l"></i> {$MARK_COMPLETED}
						</button>	

						<button class=" btn btn-default" onclick="$('#noShow').show('slow');">
							<i class="fa fa-minus-square l"></i> {$MARK_NOSHOW} / {$MARK_DRIVER_ERROR}
						</button>

						<div class="row ">
							<div id="noShow" class="col-md-12" style="display:none">
								<br>{$DETAIL_DESCRIPTION}:<br>
								<textarea name="SubFinalNote" id="SubFinalNote" rows="5">{$details[pom].SubFinalNote}</textarea>
								<button class="btn btn-primary" 
									onclick="changeDriverConfStatus('{$details[pom].DetailsID}', '5');$('#btnSave').click();">
									<i class="fa fa-minus-square l"></i> {$MARK_NOSHOW}
								</button>
								<button class="btn btn-danger" 
									onclick="changeDriverConfStatus('{$details[pom].DetailsID}', '6');$('#btnSave').click();">
									<i class="fa fa-taxi l"></i> {$MARK_DRIVER_ERROR}
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>	
	<br>
{/section}	
{else}			
	<h2>No transfers today.</h2>
{/if}	





<script>
	geolocation();
	/*setTimeout(function(){		
		window.location.reload(1);	
		geolocation();
	}, 300000);*/
	

	$('.cash').change(function(){
		var detailsID=$(this).attr('data-detailid');
		var CashIn=$(this).val();
		var url = './plugins/Orders/changeCashIn.php'+
		"?DetailsID=" + detailsID +
		"&CashIn="+CashIn;
		console.log(url); 
		$.ajax({
			type: 'POST',
			url: url,
			async: true,
			success: function(data) {
				$.toaster('Amount Save', 'Done', 'success blue-2');
			}
		})		
	})	
	

function geolocation () {
	var WEBSITEURL = 'https://' + $(location).attr('host');
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(function(position) {
			var lat = position.coords.latitude;
			var lng = position.coords.longitude;
			var url= WEBSITEURL + '/plugins/SubDriverPanel/geoLocation.php?lat='+lat+'&lng='+lng;
			console.log(url);
			$.ajax({
				url: url,
				async: false,
				success: function(data){
				}
			});
		})		
	}
}

// changeDriverConfStatus
function changeDriverConfStatus(detailsid, newstatus) {
	var FinalNote=$("#FinalNote").val();
	var url = './plugins/Orders/changeDriverConfStatus.php'+
		"?DetailsID=" + detailsid +
		"&NewStatus="+newstatus +
		"&SubFinalNote="+SubFinalNote;
	console.log(url); 
	$.ajax({
		type: 'POST',
		url: url,
		async: true,
		success: function(data) {
			$.toaster('Status changed', 'Done', 'success blue-2');
			location.reload();
		}
	})
	return false;
}
</script> 