<style>

	[class*="col-"] > *{ /* Target all child elements in the parent */
		margin-top:3px;
	}
	[class*="col-"] > *:first-child{
		margin-top:0px;
	}

	.select-top-edit.addon{
		width:50% !important;
		display: inline;
	}

	.input-one{
		width: 100%;
	}


	.datepicker-edit{ width:48%; }

	.datepicker-edit,.datepicker-edit-2{
		color: rgb(1 114 255) !important;
		padding:2px;
		border-radius: 5px !important;
		margin-bottom: 2px;
		box-shadow: 2px 2px 4px #3f50a1;
		outline:none;
		border:2px solid rgb(135, 147, 218);
		font-weight: bold;
	}


	@media screen and (max-width: 1200px) {
		/* For mobile phones: */
		#show, #show-2{
			display: inline-block;
		}

		.select-top-edit.addon{
			width:100% !important;
		}
		.datepicker-edit{
			width:100% !important;
		}
		
	}

</style>

{* Scripts: *}
<script>

	function resize(){

		if ($(window).width() > 1203) {
			$('.filter').show();
			$('#show').hide();
			$('#show-2').hide();
		}

		if ($(window).width() < 1202) {
			$('.filter').hide();
			$('#show').show();
		}

	}
	
	$(document).ready(function(){

		$('#show').click(function() {
			$('.filter').toggle(400);
			$('#show').hide();
			$('#show-2').show();
    	});

		$('#show-2').click(function() {
			$('.filter').toggle(400);
			$('#show').show();
			$('#show-2').hide();
		});

		resize();
		$(window).resize(resize);

	});

</script>


<input type="hidden"  id="whereCondition" name="whereCondition" 
value=" WHERE {$ItemID} > 0">

<input type="hidden"  id="orderid" name="orderid" value="{$orderid}">
<input type="hidden"  id="detailid" name="detailid" value="{$detailid}">
<input type="hidden"  id="transfersFilter" name="transfersFilter" value="{$transfersFilter}">
<input type="hidden"  id="Search">

<!-- Show and Hide Filters buttons: -->
<div style="text-align: center">
	<div id="show" style="cursor:pointer;font-weight:bold;display:none;"><i class="fa-solid fa-bars" style="font-size: 30px;margin: 5px;color: #0ac3ed;"></i>Show Filters</div>
	<div id="show-2" style="cursor:pointer;font-weight:bold;display:none;"><i class="fa-solid fa-bars" style="font-size: 30px;margin: 5px;color: #0ac3ed;"></i>Hide Filters</div>
</div>


<div class="row itemsheader itemsheader-edit filter">
	<div class="row" style="text-align:center;padding:5px;">
		<b style="color:blue;">Sort by:</b>
		<select id='sortField' class="select-top-edit" name='sortField' onchange="allItems();">
			<option value="OrderDate">Order Date</option>	
			<option value="PickupDate">Pickup Date</option>		
		</select>				
		<select id='sortDirection' class="select-top-edit" name='sortDirection' onchange="allItems();">
			<option value="ASC">ASC</option>	
			<option value="DESC">DESC</option>		
		</select>
	</div>	
	<div class="row">
		<!-- Order: -->
		<div class="col-md-2">
			<small class="badge blue text-black badge-edit">Order</small><br>
			<input id='order' class="input-one" name='order'  placeholder="Order ID" onchange="allItems();"/><br>
						
			<select id='yearsOrder' class="form-control select-top-edit addon" name='yearsOrder' value='0' onchange="allItems();">
				<option value='0'>All years</option>
			</select>
			
			<input id='orderFromDate' class="datepicker datepicker-edit" name='orderFromDate'  placeholder="From Date" onchange="allItems();" /><br>
			
				<select id="Type" class="w75 form-control select-top-edit" onchange="allItems();">
					<option value="0">{$ALL} {$STATUS}</option>
					{section name=pom loop=$options}
						<option value="{$options[pom].id}">{$options[pom].name}</option>
					{/section}
				</select>
			
		</div>
		<!-- Payment: -->
		<div class="col-md-2"> 
			<small class="badge blue text-black badge-edit">Payment</small><br>
			<input id='paymentNumber' class="input-one" name='paymentNumber'  placeholder="Payment / Invoice No" onchange="allItems();"/>	
			
				<select id="PaymentMethod" class="w75 form-control select-top-edit" onchange="allItems();">		
					<option value="0">{$ALL} {$PAYMENT}</option>
					{section name=pom loop=$options3}
						<option value="{$options3[pom].id}">{$options3[pom].name}</option>
					{/section}
				</select>
			
							
		</div>
		<!-- Transfer: -->
		<div class="col-md-2"> 
			<small class="badge blue text-black badge-edit">Transfer</small><br>
			<input id='locationName' class="input-one" name='locationName'  placeholder="Location Name" onchange="allItems();"/>
			
				<input id='pickupFromDate' class="datepicker datepicker-edit-2" name='pickupFromDate'  placeholder="From Date" onchange="allItems();" style="width:80%;"/>
				<!--<select id='yearsPickup' class="select-top-edit" name='yearsPickup' value='0' onchange="allItems();">
					<option value='0'>All years</option>
				</select>!-->
				<i class="fa fa-cubes" style="color:#900"></i><input type="checkbox" id="listExtras" name="listExtras"  value="" onchange="allItems();" />
				</br>
			
								
		</div>
		<!-- Driver: -->
		<div class="col-md-2">
			<small class="badge blue text-black badge-edit">Partner</small><br>
			<input id='driverName' class="input-one" name='driverName'  placeholder="Name/ID" onchange="allItems();"/><br>
			
				<select id="DriverConfStatusChoose" class="w75 form-control select-top-edit" onchange="allItems();">		
					<option value="0">{$ALL} {$STATUS}</option>
					{section name=pom loop=$options4}
						<option value="{$options4[pom].id}">{$options4[pom].name}</option>
					{/section}
				</select>
			
		</div>
		<!-- Client/Agent: -->
		<div class="col-md-2">
			<small class="badge blue text-black badge-edit">Purchaser</small><br>
			<input id='agentName' class="input-one" name='agentName'  placeholder="Name/ID" onchange="allItems();"/><br>				
			<input id='agentOrder' class="input-one" name='agentOrder'  placeholder="Order Key / Agent Order" onchange="allItems();"/><br>				
			
				<select id="Type2" class="w75 form-control select-top-edit" onchange="allItems();">
					<option value="0">{$ALL} {$USERS}</option>
					{section name=pom2 loop=$options2}
						<option value="{$options2[pom2].id}">{$options2[pom2].name}</option>
					{/section}
				</select>
			
		</div>
		<!-- Passenger: -->
		<div class="col-md-2">
			<small class="badge blue text-black badge-edit">Passenger</small><br>
			<input id='passengerData' class="input-one" name='passengerData'  placeholder="Passenger Data" onchange="allItems();"/>					
		</div>			
	</div>
</div>
