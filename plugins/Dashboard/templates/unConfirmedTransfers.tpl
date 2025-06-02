{if $noOfTransfers gt 0}
<div class="box yellow">
	<div class="inner">
		<h3 id="unconfirmed" class="box-title">{$UNCONFIRMED_TRANSFERS} <a href="dashboard#top"><i class="fa fa-arrow-circle-up"></i></a></h3><br>
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
											<label>{$ROUTE}</label> <small>{$details[pom].PickupName} - {$details[pom].DropName}
												<a target='_blank' href='plugins/getRouteMap.php?DetailsID={$details[pom].DetailsID}'>
													<i class="fa fa-map" aria-hidden="true"></i>MAP
												</a>
											</small><br>
											<label>{$PICKUP_ADDRESS}</label> {$details[pom].PickupAddress}<br>
											<label>{$DROPOFF_ADDRESS}</label> {$details[pom].DropAddress}<br>
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
														id="DriverName" placeholder="Please put DRIVERS NAME or OPERATOR (do not put YOUR COMPANY name)" value="" onfocus="if (this.value=='Please put DRIVERS NAME or OPERATOR (do not put YOUR COMPANY name)') this.value='';">
													</div>
												</div>*}
												<div class="row">
													<div class="col-md-2"><label>{$DRIVER}/{$DISPATCHER} {$PHONE}</label></div>
													<div class="col-md-8">
														<input class="form-control" type="text" 
														id="DriverTel{$details[pom].DetailsID}" placeholder='International format (e.g +33...)' value="{$details[pom].DriverTel}" title="{$ENTER_PHONE_FORMAT}" data-et="{$ENTER_PHONE}">
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-2"><label>{$PICKUP_POINT}</label></div>
													<div class="col-md-8">
														<textarea class="form-control" cols="40" 
														rows="5" name="PickupPoint"
														id="PickupPoint{$details[pom].DetailsID}"></textarea>
													</div>
												</div>											
												<div id="drr{$details[pom].DetailsID}" class="row" style="display:none">
													<div class="col-md-2"><label>{$DECLINE_REASON}</label></div>
													<div class="col-md-8">
														<select name="DeclineReason" data-id="{$details[pom].DetailsID}" class="DeclineReason" id="DeclineReason{$details[pom].DetailsID}">
															<option value="cr">{$CHOSE_REASON}</option>													
															<option value="Price">{$PRICE_INCORECT}</option>	
															<option value="Availability">{$NO_AVAILABILITY}</option>														
															<option value="Wrong">{$WRONG_RESERVATION}</option>													
															<option value="Other">{$OTHER}</option>
														</select>			
													</div>
												</div>											
												<div id="dm{$details[pom].DetailsID}" class="row" style="display:none">
													<div class="col-md-2"><label>{$DECLINE_MESSAGE}</label></div>
													<div class="col-md-8">
														<textarea class='dmta' id='dmta{$details[pom].DetailsID}' class="form-control" cols="40" 
														rows="5" name="DeclineMessage"
														id="DeclineMessage"></textarea>
													</div>
												</div>												
												<div class="row">
													<div class="col-md-12">
													<span>&nbsp {$CHECK_TRANSFER_DETAILS}</span> <BR>
													<span>&nbsp {$ASSIGN_TRANSFER}</span> 
													<br>
													<br>
													<button class="btn btn-success" type="submit"
													onclick="confirmTransfer('{$details[pom].DetailsID}','{$details[pom].DriverID}','{$details[pom].MOrderKey}')">
														<i class="fa fa-check l"></i> {$CONFIRM}
													</button>
													<!-- novi blok !-->
													<button id="decline1{$details[pom].DetailsID}" class="btn btn-danger" type="submit" 
													onclick="declineTransfer1('{$details[pom].DetailsID}','{$details[pom].DriverID}','{$details[pom].MOrderKey}')">
														<i class="fa fa-remove l"></i> {$DECLINE}
													</button>
													
													<button id="decline2{$details[pom].DetailsID}" class="btn btn-danger" type="submit" style="display:none; "
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
					<div class="modal fade" id="map">
					</div>
				</div>	
			</div>
		{/section}	
		<br><small style="font-size:14px">{NO_OF} {$noOfTransfers}</small>
	</div>
</div>
<br>
<script>
{literal}
	function confirmTransfer(detailsid, driverid, orderkey) {
		
		// mesto + u telefonu
		id1="#DriverTel"+detailsid;
		id2="#PickupPoint"+detailsid;
		var tel = $(id1).val() ;
		var pp = $(id2).val() ;
		var n = tel.indexOf('+');
		if($(id1).val() == '') {
			alert ($(id1).attr('data-et'));
			return false;
		}
		// da li je ispravan format?
		if (n != 0) {
			alert ($(id1).attr('title'));
			return false;
		}	
		var url = './plugins/Orders/confirmDecline.Driver.php'+
			"?code=" + detailsid +
			"&control="+orderkey +
			"&id="+ driverid +
			"&DriverTel="+ tel +
			"&PickupPoint="+ pp +
			"&Confirm=Confirmed";
		console.log(url);

		$.ajax({
			type: 'POST',
			url: url,
			async: true,
			success: function(data) {
				$.toaster(data, 'Done', 'success blue-2');
				location.reload();
			}
		});
		
		return false;				
		
	}
	
	// prosirivanje forme sa decline poljima
	function declineTransfer1(detailsid, driverid, orderkey) {
		var id1="#decline1"+detailsid;
		var id2="#decline2"+detailsid;
		var id3="#drr"+detailsid;
		$(id1).hide();
		$(id2).show();
		$(id3).show(500);		
	}	
	$('.dmta').attr("placeholder","Your reason is:");	// privremeno, posle izbrisati
	$('.DeclineReason').change(function(){ 
		var rn = $(this).val(); 
		var detailsid=$(this).attr('data-id');
		var id4="#dmta"+detailsid;
		var id5="#dm"+detailsid;
		if (rn=='Price') $(id4).attr("placeholder","{/literal}{$YOUR_PRICE}{literal}");
		if (rn=='Availability') $(id4).attr("placeholder","{/literal}{$YOUR_TIME}{literal}");
		if (rn=='Wrong') $(id4).attr("placeholder","{/literal}{$WRONG_DETAILS}{literal}");
		if (rn=='Other') $(id4).attr("placeholder","{/literal}{$YOUR_REASON}{literal}");	

		$(id5).show(500);			
	}); 
	
	// decline
	function declineTransfer2(detailsid, driverid, orderkey) {
		var id4="#dmta"+detailsid;
		var dmta = $(id4).val();
		dmta = dmta.trim();
		if(dmta == '') {
			alert('Enter Decline reason and message!');
			return false;
		}
		var id6="#DeclineReason"+detailsid;  
		var declinereason = $(id6).val();
		var declinemessage = $(id4).val();
		var url = './plugins/Orders/confirmDecline.Driver.php'+
			"?code=" + detailsid +
			"&control="+orderkey +
			"&id="+ driverid +
			"&DeclineReason="+ declinereason +				
			"&DeclineMessage="+ declinemessage +		
			"&Confirm=Declined";
		console.log (url);
		$.ajax({
			type: 'POST',
			url: url,
			async: true,
			success: function(data) {
				$.toaster(data, 'Done', 'success red');
				location.reload();
			}
		})
		return false;
	}
{/literal}
</script>	
{/if}	