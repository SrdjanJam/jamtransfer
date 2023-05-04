<input type="hidden"  id="whereCondition" name="whereCondition" 
value=" WHERE {$ItemID} > 0">

<input type="hidden"  id="orderid" name="orderid" value="{$orderid}">
<input type="hidden"  id="detailid" name="detailid" value="{$detailid}">
<input type="hidden"  id="transfersFilter" name="transfersFilter" value="{$transfersFilter}">
<input type="hidden"  id="Search">


<div class="row itemsheader itemsheader-edit">
	<div class="row" style="text-align:center">
		Sort by:
		<select id='sortField' name='sortField' onchange="allItems();">
			<option value="OrderDate">Order Date</option>	
			<option value="PickupDate">Pickup Date</option>		
		</select>				
		<select id='sortDirection' name='sortDirection' onchange="allItems();">
			<option value="ASC">ASC</option>	
			<option value="DESC">DESC</option>		
		</select>
	</div>	
	<div class="row">
		<!-- Order: -->
		<div class="col-md-2">
			<small class="badge blue text-black badge-edit">Order</small><br>
			<input id='order' class="input-one" name='order'  placeholder="Order ID" onchange="allItems();"/><br>				
			<select id='yearsOrder' class="select-top-edit" name='yearsOrder' value='0' onchange="allItems();">
				<option value='0'>All years</option>
			</select>
			<input id='orderFromDate' class="datepicker" name='orderFromDate'  placeholder="From Date" size='6' onchange="allItems();"/><br>
			<div class="form-group group-edit">
				<select id="Type" class="w75 form-control control-edit" onchange="allItems();">
					<option value="0">{$ALL} {$STATUS}</option>
					{section name=pom loop=$options}
						<option value="{$options[pom].id}">{$options[pom].name}</option>
					{/section}
				</select>
			</div>	
		</div>
		<!-- Payment: -->
		<div class="col-md-2"> 
			<small class="badge blue text-black badge-edit">Payment</small><br>
			<select id="PaymentMethod" class="w75 form-control control-edit" onchange="allItems();">		
				<option value="0">{$ALL} {$PAYMENT}</option>
				{section name=pom loop=$options3}
					<option value="{$options3[pom].id}">{$options3[pom].name}</option>
				{/section}
			</select>	
			<input id='paymentNumber' class="input-one" name='paymentNumber'  placeholder="Payment / Invoice No" onchange="allItems();"/>					
		</div>
		<!-- Transfer: -->
		<div class="col-md-2"> 
			<small class="badge blue text-black badge-edit">Transfer</small><br>
			<input id='pickupFromDate' class="datepicker" name='pickupFromDate'  placeholder="From Date" size='6' onchange="allItems();"/>
			<!--<select id='yearsPickup' class="select-top-edit" name='yearsPickup' value='0' onchange="allItems();">
				<option value='0'>All years</option>
			</select>!-->
			<i class="fa fa-cubes" style="color:#900"></i><input type="checkbox" id="listExtras" name="listExtras"  value="" onchange="allItems();" />
			</br>

			<input id='locationName' class="input-one" name='locationName'  placeholder="Location Name" onchange="allItems();"/>					
		</div>
		<!-- Driver: -->
		<div class="col-md-2">
			<small class="badge blue text-black badge-edit">Partner</small><br>
			<input id='driverName' class="input-one" name='driverName'  placeholder="Name/ID" onchange="allItems();"/><br>
			<select id="DriverConfStatusChoose" class="w75 form-control control-edit" onchange="allItems();">		
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
			<div class="form-group group-edit">
				<select id="Type2" class="w75 form-control control-edit" onchange="allItems();">
					<option value="0">{$ALL} {$USERS}</option>
					{section name=pom2 loop=$options2}
						<option value="{$options2[pom2].id}">{$options2[pom2].name}</option>
					{/section}
				</select>
			</div>		
		</div>
		<!-- Passenger: -->
		<div class="col-md-2">
			<small class="badge blue text-black badge-edit">Passenger</small><br>
			<input id='passengerData' class="input-one" name='passengerData'  placeholder="Passenger Data" onchange="allItems();"/>					
		</div>			
	</div>
</div>

