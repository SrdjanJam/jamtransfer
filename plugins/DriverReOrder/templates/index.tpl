<style>
	h4{ color:black; }
	.edit-div{
		background: #c0c0c047;
		border-radius: 5px;
		padding: 15px;
	}
	.edit-div2{
		border-bottom: 1px dashed #c1c1c1;
		padding: 5px;
	}
	.edit-div2:last-of-type{
		border-bottom: none;
	}
	.edit-h{
		font-size: 20px;
	}
</style>

<input type='hidden' name="OrderID" id="OrderID" value=" {$smarty.request.OrderID}">
<input type='hidden' name="TNo" id="TNo" value="{$smarty.request.TNo}">
<input type='hidden' name="returnTransfer" id="returnTransfer" value="{$returnTransfer}">

<body  style="">
	<div class="">
		<div class="container-fluid side-collapse-container center" >
			<div class="row xpad1em white-text">
				<div class="row z-depth-2 white lighten-5">			
					<h2>{$ORDER}: {$smarty.request.OrderID}{if $returnTransfer eq 0}-{$smarty.request.TNo}{/if} Route: {$route}
					{if $returnTransfer eq 1} RETURN{/if}
					</h2>
				</div>
				<hr>
			</div>

			<h3 class="edit-h">Driver:</h3>
			<div class="row xpad1em white-text edit-div">
				<div class="row z-depth-2 white lighten-5">			
					<div class="col-md-3">
						<h4>{$BOOKED_DRIVER}</h4>							 					
						<h3><b style='color: #0170ff;'>{$driverName}</b></h3>
					</div>				
					<div class="col-md-3"> 
						<h4>{$BOOKED_PRICE}: {$DetailPrice}</h4>							 						
						<h4>{$DRIVERS_PRICE}: {$DriversPrice}</h4>
					</div>						
					<div class="col-md-3">						
						<h4>{$BOOKED_VEHICLE}</h4>							 										
						<img class="" src="{$ROOT_HOME}{$vehicleImage}" style="max-height:20%; max-width:20%;" alt="car">
						<span style="text-transform:uppercase; font-weight:100 !important">{$VehicleTypeName}</span>
					</div>							
					<div class="col-md-3"> 
						<h4>{$VEHICLES}</h4>							 
						<h3>{$VehiclesNo}</h3>							 						
					</div>							
				</div>
				
			</div>
			<br>
			
			<!-- Part 2: -----------------------------------------  -->
			<h3 class="edit-h">Other drivers:</h3>
			<div class="row z-depth-2 white lighten-5 center">
				<div class="col-md-3 white">
					<h4>Other drivers for this route</h4>						
				</div>	
				<div class="col-md-2 white">
					<h4>Terminals</h4>						
				</div>				
				<div class="col-md-3 white">
					<h4>Vehicle type</h4>						
				</div>					
							
				<div class="col-md-2 request">
					<h4 >First confirm Request</h4>											
				</div>				
				<div class="col-md-2 request">
					<h4 >Low offer Request</h4>											
				</div>				
			</div>	

			{section name=pom loop=$drivers}
				<div class="row white lighten-5 edit-div2">
					<div class="col-md-3 white">
						<b style='color: #0170ff;'>{$drivers[pom].id} {$drivers[pom].name.name}</b><br>
						{$drivers[pom].name.mail}<br>
						<i class="fa-solid fa-phone"></i>{$drivers[pom].name.tel}<br>
						<i class="fa-solid fa-mobile"></i>{$drivers[pom].name.mob}
					</div>
					<div class="col-md-2">
						{$drivers[pom].terminals}
					</div>				
					<div class="col-md-3">
						{$drivers[pom].vehicles}
					</div>								

					<div class="col-md-2 fc">
						{if $drivers[pom].request1 eq 1}
							{if $drivers[pom].confirm_decline1 eq 1}
								Confirm / 
							{/if}
							{if $drivers[pom].confirm_decline1 eq 2}
								Decline / 
							{/if}							
							{if $drivers[pom].confirm_decline1 eq 0}
								Sent / 
							{/if}
							{if $drivers[pom].confirm_decline1 eq 0}
								{$drivers[pom].request1date} {$drivers[pom].request1time}
							{else}	
								{$drivers[pom].response1date} {$drivers[pom].response1time}
							{/if}
						{else}	
							<button type='button' class='form-control request' data-driverid='{$drivers[pom].id}' data-rt='1' name='request_fc' id='request_fc'>Send</button>
						{/if}	
					</div>
					<div class="col-md-2 lo">
						{if $drivers[pom].request2 eq 1}
							{if $drivers[pom].confirm_decline2 eq 1}
								Offered price {$drivers[pom].price} / 
							{/if}
							{if $drivers[pom].confirm_decline2 eq 2}
								Decline / 
							{/if}							
							{if $drivers[pom].confirm_decline2 eq 0}
								Sent / 
							{/if}
							{if $drivers[pom].confirm_decline2 eq 0}
								{$drivers[pom].request2date} {$drivers[pom].request2time}
							{else}	
								{$drivers[pom].response2date} {$drivers[pom].response2time}
							{/if}
						{else}	
							<button type='button' class='form-control request' data-driverid='{$drivers[pom].id}' data-rt='2' name='request_fc' id='request_fc'>Send</button>
						{/if}
					</div>			
				</div>
				<hr>
			{/section}
			
		</div>
	</div>	
</body>	


<script>
	setTimeout(function(){
	  window.location.reload(1);
	}, 100000);
	
	$('.request').click(function(){
		var driverid = $(this).attr('data-driverid');
		var rt = $(this).attr('data-rt');
		var OrderID=$('#OrderID').val();
		var TNo=$('#TNo').val();
		var returnTransfer=$('#returnTransfer').val();
		var param = 'DriverID='+driverid+'&requestType='+rt+'&OrderID='+OrderID+'&TNo='+TNo+'&returnTransfer='+returnTransfer;
		var url = '/plugins/DriverReOrder/requestOrder.php?'+param;
		console.log (url);
		$.ajax({
			type: 'POST',
			url: url,
			async: false,

			success: function(data) {
				var result = JSON.parse(data);				
				var DriverID=result['DriverID'];
				var requestType=result['requestType'];
				$('.request').each(function(){
					if ($(this).attr('data-driverid')==DriverID && $(this).attr('data-rt')==requestType) {
						$(this).prop("disabled",true);
					}
				});
				
			},
		});
	})	
</script>