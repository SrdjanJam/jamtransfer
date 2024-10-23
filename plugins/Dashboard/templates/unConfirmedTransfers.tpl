{if $noOfTransfers gt 0}
<div class="box yellow">
	<div class="inner">
		<h3 class="box-title">{$UNCONFIRMED_TRANSFERS}</h3><br>
		{section name=pom loop=$details}
			<div class='row'>
				<div class="col-sm-2">
					<small>{$details[pom].OrderID}-{$details[pom].TNo}</small> 
				</div>	
				<div class="col-sm-2">			
					<strong>{$details[pom].PickupDate} {$details[pom].PickupTime}</strong>
				</div>			
				<div class="col-sm-6">			
					<strong>{$details[pom].PickupName} - {$details[pom].DropName}</strong>
				</div>	
				{*<div class="col-sm-2">			
					<strong>{$details[pom].DriversPrice} EUR</strong>
				</div>*}		
				<div class="col-sm-2">	
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirm{$details[pom].DetailsID}">
						{$CONFIRM} / {$DECLINE}
					</button>
					<div class="modal fade"  id="confirm{$details[pom].DetailsID}">
						<div class="modal-dialog" style="width: fit-content;">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									{*<h4 class="modal-title">{$CONFIRM} / {$DECLINE}</h4>*}
									<div class='row'>
										<div class="col-sm-4">	
											<label>{$ORDER}</label> {$details[pom].OrderID}-{$details[pom].TNo}<br>
											<label>{$PICKUP_DATE}</label> {$details[pom].PickupDate}<br>
											<label>{$PICKUP_TIME}</label> {$details[pom].PickupTime}<br>
											<label>{$ROUTE}</label> <small>{$details[pom].PickupName} - {$details[pom].DropName}</small><br>
											<label>{$PICKUP_ADDRESS}</label> {$details[pom].PickupAddress}<br>
											<label>{$DROPOFF_ADDRESS}</label> {$details[pom].DropAddress}
										</div>										
										<div class="col-sm-4">	
											<label>{$FLIGHT_NO}</label> {$details[pom].FlightNo}<br>
											<label>{FLIGHT_TIME}</label> {$details[pom].FlightTime}<br>
											<label>{$VEHICLE}</label> {$details[pom].VehicleTypeName} * {$details[pom].VehiclesNo}<br>
											<label>{$PAX}</label> {$details[pom].PaxNo}<br>
											{if $details[pom].ExtraCharge gt 0}
												{if $details[pom].oeServices}
													<label>{$EXTRAS}</label> 
													<div class="row">
														<div class="col-md-12">
															{section name=pom1 loop=$details[pom].oeServices}
																{$details[pom].oeServices[pom1].ServiceName} x {$details[pom].oeServices[pom1].Qty}
																<br>
															{/section}
														</div>
													</div>
												{/if}										
											{/if}
										</div>										
										<div class="col-sm-4">		
											<label>{$PRICE}</label> {$details[pom].DriversPrice} EUR<br>
											<label>{$PAX} {$PAYMENT_METHOD}</label> {$details[pom].PaymentMethod}<br>
											{if $details[pom].Payment eq 1}
												<strong>{$PASSENGER_PAID_SERVICE}</strong><br>
												<strong>{$DRIVER_ISSUE_INVOICE}</strong><br>
												{$INVOICE_VALUE} {$details[pom].PaymentValue} EUR<br>
											{else}
												<strong>{$CHARGE_TO_PASSENGER}</strong><br>
												{$PASSENGER_PAYMENT} {$details[pom].PayLater} EUR<br>
												{if $details[pom].Payment eq 2}
													<strong>{$DRIVER_RECIVE_INVOICE}</strong><br>
													{$INVOICE_VALUE} {$details[pom].PaymentValue} EUR<br>
												{/if}
											{/if} 
										</div>	
									</div>

									
								</div>
								<div class="modal-body" style="padding:10px">
									<div class="row" id="confirmDecline{$details[pom].DetailsID}">
										<div class="col-md-12">
											<br>
											<small>{$CONFIRM_DECLINE_INSTRUCTIONS}</small>
											<br><br>
										</div>
										<div class="col-md-12">
											<form action="" method="post" enctype="multipart/form-data" 
											onsubmit="return false;">
												{$THIS_INFO_WILL_BE_SENT_TO_CUSTOMER}
												<br><br>
												{*<div class="row">
													<div class="col-md-2"><label>{$DRIVER_NAME}</label></div>
													<div class="col-md-8">
														<input class="form-control" type="text" 
														id="SubDriverName" placeholder="Please put DRIVERS NAME or OPERATOR (do not put YOUR COMPANY name)" value="" onfocus="if (this.value=='Please put DRIVERS NAME or OPERATOR (do not put YOUR COMPANY name)') this.value='';">
													</div>
												</div>*}
												<div class="row">
													<div class="col-md-2"><label>Dispach phone</label></div>
													<div class="col-md-8">
														<input class="form-control" type="text" 
														id="SubDriverTel" placeholder='International format (e.g +33...)' value="" onfocus="if (this.value=='Please put phone number in international format (e.g +33...)') this.value='';">
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-2"><label>{$PICKUP_POINT}</label></div>
													<div class="col-md-8">
														<textarea class="form-control" cols="40" 
														rows="5" name="PickupPoint"
														id="PickupPoint"></textarea>
													</div>
												</div>											
												<div id="drr" class="row" style="display:none">
													<div class="col-md-2"><label>Decline reason</label></div>
													<div class="col-md-8">
														<select name="DeclineReason" id="DeclineReason">
															<option value="cr">Choose reason</option>													
															<option value="Price">Price incorect</option>	
															<option value="Availability">No availability</option>														
															<option value="Wrong">Wrong reservation details</option>													
															<option value="Other">Other</option>
														</select>			
													</div>
												</div>											
												<div id="dm" class="row" style="display:none">
													<div class="col-md-2"><label>Decline message</label></div>
													<div class="col-md-8">
														<textarea id= 'dmta' class="form-control" cols="40" 
														rows="5" name="DeclineMessage"
														id="DeclineMessage"></textarea>
													</div>
												</div>												
												<div class="row">
													<div class="col-md-12">
													<span>&nbsp Please, CHECK this transfer details before confirming transfer request!</span> 
													<span>&nbsp Assign this transfer to your driver and vehicle after confirming transfer request!</span> 
													<br>
													<br>
													<button class="btn btn-success" type="submit"
													onclick="confirmTransfer('{$details[pom].DetailsID}','{$details[pom].DriverID}','{$details[pom].MOrderKey}')">
														<i class="fa fa-check l"></i> {$CONFIRM}
													</button>
													<!-- novi blok !-->
													<button id='decline1' class="btn btn-danger" type="submit" 
													onclick="declineTransfer1()">
														<i class="fa fa-remove l"></i> {$DECLINE}
													</button>
													
													<button id='decline2' class="btn btn-danger" type="submit" style="display:none; "
													onclick="declineTransfer2('{$details[pom].DetailsID}','{$details[pom].DriverID}','{$details[pom].MOrderKey}')" >
														<i class="fa fa-remove l"></i> {$DECLINE}
													</button>											
													<!-- kraj bloka !-->
													</div>		

												</div>			
											</form>
										</div>
									</div>										
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
		{/section}	
		<br><small style="font-size:14px">No of transfers: {$noOfTransfers}</small>
	</div>
</div>
<br>
<script>
	function confirmTransfer(detailsid, driverid, orderkey) {
		
		// mesto + u telefonu
		var tel = $("#SubDriverTel").val() ;
		var n = tel.indexOf('+');
		if($("#SubDriverTel").val() == '') {
			alert('Enter Telephone number!');
			return false;
		}
		// da li je ispravan format?
		if (n != 0) {
			alert ('Enter Phone number in right format starting with country code (+___)');
			return false;
		}	
		var url = './plugins/Orders/confirmDecline.Driver.php'+
			"?code=" + detailsid +
			"&control="+orderkey +
			"&id="+ driverid +
			"&SubDriverTel="+ $("#SubDriverTel").val() +
			"&PickupPoint="+ $("#PickupPoint").val() +
			"&Confirm=Confirmed";
		console.log(url);

		$.ajax({
			type: 'POST',
			url: url,
			async: true,
			success: function(data) {
				$.toaster('Transfer Confirmed', 'Done', 'success blue-2');
				location.reload();
			}
		});
		
		return false;				
		
	}
	
	// prosirivanje forme sa decline poljima
	function declineTransfer1(detailsid, driverid, orderkey) {
		
		$("#decline1").hide();
		$("#decline2").show();
		$("#drr").show(500);		
	}	
	$('#dmta').attr("placeholder","Your reason is:");	// privremeno, posle izbrisati
	$('#DeclineReason').change(function(){ 
		var rn = $('#DeclineReason').val(); 
		if (rn=='Price') $('#dmta').attr("placeholder","Your price is:");
		if (rn=='Availability') $('#dmta').attr("placeholder","Your time is:");
		if (rn=='Wrong') $('#dmta').attr("placeholder","Wrong details is:");
		if (rn=='Other') $('#dmta').attr("placeholder","Your reason is:");			
		$("#dm").show(500);			
	}); 
	
	// decline
	function declineTransfer2(detailsid, driverid, orderkey) {
		var dmta = $("#dmta").val();
		dmta = dmta.trim();
		if(dmta == '') {
			alert('Enter Decline reason and message!');
			return false;
		}
		  
		var declinereason = $('#DeclineReason').val();
		var declinemessage = $('#dmta').val();
		var url = './plugins/Orders/confirmDecline.Driver.php'+
			"?code=" + detailsid +
			"&control="+orderkey +
			"&id="+ driverid +
			"&DeclineReason="+ declinereason +				
			"&DeclineMessage="+ declinemessage +		
			"&Confirm=Declined";
		$.ajax({
			type: 'POST',
			url: url,
			async: true,
			success: function(data) {
				$.toaster('Transfer Declined', 'Done', 'success red');
				location.reload();
			}
		})
		return false;
	}
</script>	
{/if}	