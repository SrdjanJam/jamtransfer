<style>

	[class*="col-"] > *{ /* Target all child elements in the parent */
		margin-top:3px;
	}

	[class*="col-"] > *:first-child{
		margin-top:0px;
	}

	.select-top-edit.addon{
		/* width:48%; */
		display: inline;
	}

	.input-one{
		width: 100%;
	}


	.datepicker-edit{ width:49%; }

	.datepicker-edit,.datepicker-edit-2{
		color: rgb(2, 140, 226) !important;
		padding:2px;
		border-radius: 5px !important;
		margin-bottom: 2px;
		/* box-shadow: 2px 2px 4px #3f50a1; old */
		box-shadow: rgb(63, 80, 161) 2px 2px 4px 0px;
		outline:none;
		border: none;
	}

	#wrapp-button{
		float:left;
		background: #479de929;
		border-radius: 5px;
		padding-right: 5px;
		box-shadow: 3px 3px 4px 0px #3b75b9;
	}

	#filterToggle{
		cursor:pointer; font-weight:bold; color: #0584f1; text-shadow: #0584f1 0px 0px 1px;
	}
	#filterToggle:hover,.fa-bars-edit:hover{
		cursor:pointer; font-weight:bold; color: #0b70c9;
	}

	.fa-bars-edit{
		font-size: 20px;margin: 5px;color: #0584f1;
	}

	.filter .col-sm-3{
		width: auto;
	}

	.col-sm-3 .b-asd{
		color:#157bff;
		font-family: 'Times New Roman', Times, serif;
		font-size: 17px;
	}

	.below-select{ width:100%; }

	.row-filter-edit{
		padding-top: 5px;
	}

</style>

<input type="hidden"  id="whereCondition" name="whereCondition" 
value=" WHERE {$ItemID} > 0">

<input type="hidden"  id="orderid" name="orderid" value="{$orderid}">
<input type="hidden"  id="detailid" name="detailid" value="{$detailid}">
<input type="hidden"  id="lid" name="lid" value="0">
<input type="hidden"  id="transfersFilter" name="transfersFilter" value="{$transfersFilter}">
<input type="hidden"  id="Search">


<div class="row itemsheader itemsheader-edit">
	<div class="row"> 
		<div class="col-md-2 col-lg-2" id="wrapp-button">
			<!-- Show-hide button: -->
			<div id="filterToggle"><i class="fa fa-bars fa-bars-edit"></i></div>
		</div>
		<div class="col-md-10 col-lg-10 filter addedit">
			<div class="row">
				<div class="col-xs-12 col-md-1 col-lg-1">
					<b class="b-asd">{$SORT_BY}:</b>
				</div>	
				<div class="col-xs-12 col-md-2 col-lg-1">
					<select id='sortField' class="select-top-edit" name='sortField' onchange="allItems();">
						<option value="OrderDate">{$ORDER_DATE}</option>	
						<option value="PickupDate">{$PICKUP_DATE}</option>		
					</select>	
				</div>	
				<div class="col-xs-12 col-md-2 col-lg-1">					
					<select id='sortDirection' class="select-top-edit" name='sortDirection' onchange="allItems();">
						<option value="ASC">{$ASC}</option>	
						<option value="DESC">{$DESC}</option>		
					</select>
				</div>
				
				{if not $PARTNERLOG}
				<!-- Report By: -->
				<div class="col-md-1 col-lg-2">
					<b class="b-asd">{$REPORT_BY}:</b>
				</div>	
				<div class="col-md-3 col-lg-2">
					<select id='reportBy' class="select-top-edit" name='reportBy' onchange="allItems();">
						{foreach from=$ReportBy item=label key=key}
							<option value="{$key}" {if $data.key == $key} selected="selected" {/if}>{$label}</option>
						{/foreach}	
					</select>
				</div>
				<!-- Filter By: -->	
				<div class="col-md-1 col-lg-2">	
					<b class="b-asd">{$FILTER_BY}:</b>
				</div>	
				<div class="col-md-2 col-lg-2">					
					<select id='action' class="select-top-edit" name='action' onchange="allItems();">
						{foreach from=$Action item=label key=key}
							<option value="{$key}" {if $data.key == $key} selected="selected" {/if}>{$label}</option>
						{/foreach}	
					</select>
				</div>
				{/if}
			</div>
		</div>
	</div>	
	<div class="row filter row-filter-edit">
		<!-- Client/Agent purchaser: -->
		<div class="col-xs-6 col-md-2 col-md-2-edit col-lg-2">
			<small class="badge blue text-black badge-edit">{$PURCHASER}</small><br>
			{if $PARTNERLOG}
				<input id='order' class="form-control input-one" name='order'  placeholder="{$ORDERID}" onchange="allItems();"/><br>
			{/if}			
			{if not $PARTNERLOG}
				<input id='agentName' class="form-control input-one" name='agentName'  placeholder="{$NAME_ID}" onchange="allItems();"/><br>				
				<input id='agentOrder' class="form-control input-one" name='agentOrder'  placeholder="{$ORDER_KEY_AGENT_ORDER}" onchange="allItems();"/><br>				
				<select id="Type2" class="w75 form-control select-top-edit below-select" onchange="allItems();">
					<option value="0">{$ALL} {$USERS}</option>
					{section name=pom2 loop=$options2}
						<option value="{$options2[pom2].id}">{$options2[pom2].name}</option>
					{/section}
				</select>
			{/if}
		</div>

		<!-- Transfer: -->
		<div class="col-xs-6 col-md-2 col-md-2-edit col-lg-2"> 
			<small class="badge blue text-black badge-edit">{$TRANSFER}</small><br>
			<input id='locationName' class="form-control input-one" name='locationName'  placeholder="{$LOCATION_NAME}" onchange="allItems();"/>
			<div class="row">
				<div class="col-md-6 col-lg-6">
					<input id='pickupFromDate' class="form-control datepicker datepicker-edit-2 datepicker-edit-2-small" name='pickupFromDate'  placeholder="{$TRANSFERFROMDATE}" onchange="allItems();" style="width:100%;"/>
				</div>	
				<div class="col-md-6 col-lg-6">
					<input id='pickupToDate' class="form-control datepicker datepicker-edit-2 datepicker-edit-2-small" name='pickupToDate'  placeholder="{$TRANSFERTODATE}" onchange="allItems();" style="width:100%;"/>				
				</div>	
			</div>	
			<!--<select id='yearsPickup' class="select-top-edit" name='yearsPickup' value='0' onchange="allItems();">
				<option value='0'>All years</option>
			</select>!-->
		</div>

		<!-- Driver: -->
		<div class="col-xs-6 col-md-2 col-md-2-edit col-lg-2">
			<small class="badge blue text-black badge-edit">{$PARTNER}</small><br>
			{if not $PARTNERLOG}
			<input id='driverName' class="form-control input-one" name='driverName'  placeholder="{$NAME_ID}" onchange="allItems();"/><br>
			{/if}
			<select id="DriverConfStatusChoose" class="w75 form-control select-top-edit below-select" onchange="allItems();">		
				<option value="-1">{$ALL} {$STATUS}</option>
				{section name=pom loop=$options4}
					<option value="{$options4[pom].id}">{$options4[pom].name}</option>
				{/section}
			</select>
			{if not $PARTNERLOG}
			<div class="row">
				<div class="col-md-6 col-lg-6">			
					<input type="checkbox"  id="longTerm" name="longTerm"  value="" onchange="allItems();" /> Long term	
				</div>	
				<div class="col-md-6 col-lg-6">						
					<input type="checkbox"  id="preOrder" name="preOrder"  value="" onchange="allItems();" /> Pre Order	
				</div>	
			</div>	
			{/if}
		</div>

		<!-- Passenger: -->
		<div class="col-xs-6 col-md-2 col-md-2-edit col-lg-2">
			<small class="badge blue text-black badge-edit">{$PASSENGER}</small><br>
			<input id='passengerData' class="input-one" name='passengerData'  placeholder="{$PASSENGER_DATA}" onchange="allItems();"/>					
			{if not $PARTNERLOG}
			<div class="row">
				<div class="col-md-6 col-lg-6">				
					<i class="fa fa-plane" style="color:#900"></i><input type="checkbox" id="flightTimeChecker" name="flightTimeChecker"  value="" onchange="allItems();" /> {$FLIGHT_TIME_CHECKER}
				</div>	
				<div class="col-md-6 col-lg-6">				
					<i class="fa fa-cubes" style="color:#900"></i><input type="checkbox" id="listExtras" name="listExtras"  value="" onchange="allItems();" />
				</div>	
			</div>	
			{/if}
		</div>	

		<!-- Payment: -->
		<div class="col-xs-6 col-md-2 col-md-2-edit col-lg-2"> 
			<small class="badge blue text-black badge-edit">{$PAYMENT}</small><br>
			{if not $PARTNERLOG}
			<input id='paymentNumber' class="input-one" name='paymentNumber'  placeholder="{$PAYMENT_INVOICE_NO}" onchange="allItems();"/>	
			{/if}
			<select id="PaymentMethod" class="w75 form-control select-top-edit below-select" onchange="allItems();">		
				<option value="-1">{$ALL} {$PAYMENT}</option>
				{section name=pom loop=$options3}
					<option value="{$options3[pom].id}">{$options3[pom].name}</option>
				{/section}
			</select>
			{if not $PARTNERLOG}
				<i class="fa fa-money" style="color:#900"></i><input type="checkbox" id="paymentChecker" name="paymentChecker"  value="" onchange="allItems();" />{$CHECKER}
			{/if}	
		</div>
		
		<!-- Order: -->
		<div class="col-xs-6 col-md-2 col-md-2-edit order-edit col-lg-2">
			<div class="row">
				<div class="col-md-6 col-lg-6">		
					<small class="badge blue text-black badge-edit">{$ORDER}</small>
				</div>	
				<div class="col-md-6 col-lg-6">	
				<input id='order' class="form-control input-one" name='order'  placeholder="{$ORDERID}" onchange="allItems();"/><br>			
				</div>	
			</div>	

			{if not $PARTNERLOG}
			<div class="row">
				<div class="col-md-6 col-lg-6">
					<select id="Type" class="form-control select-top-edit addon" name="Type" value='0' onchange="allItems();">
						<option value="0">{$ALL} {$STATUS}</option>
						{if not $PARTNERLOG}
						{section name=pom loop=$options}
							<option value="{$options[pom].id}">{$options[pom].name}</option>
						{/section}
						{/if}
					</select>				
				</div>
				<div class="col-md-6 col-lg-6">
					<select id='yearsOrder' class="form-control select-top-edit addon" name='yearsOrder' onchange="allItems();">
						<option value='0'>{$ALL_YEARS}</option>
					</select>	
				</div>
			</div>
			{/if}
			<div class="row">
				<div class="col-md-6 col-lg-6">
					<input id='orderFromDate' class="form-control datepicker datepicker-edit-2 datepicker-edit-2-small" name='orderFromDate'  placeholder="{$FROM_DATE}" onchange="allItems();" /><br>			
				</div>
				<div class="col-md-6 col-lg-6">
					<input id='orderToDate' class="form-control datepicker datepicker-edit-2 datepicker-edit-2-small" name='orderToDate'  placeholder="{$TRANSFERTODATE}" onchange="allItems();" /><br>
				</div>	
			</div>	
		</div>		
	</div>
</div> <!-- End of .filter -->

{* SCRIPT: *}
<script>

	// Toggle effects:
	$('#filterToggle').click(function(){
		var link = $(this);
		$('.filter').slideToggle('slow', function() {
			if ($(this).is(":visible")) {
				link.html('<i class="fa fa-bars fa-bars-edit"></i>Hide filters');
			} else{
				link.html('<i class="fa fa-bars fa-bars-edit"></i>Show filters');
			}        
		});
	});
	// Resize effect:
	function resize(){
		var filter = $('.filter');
		var sirina = $(window).width();
		if(sirina > 1365 && filter.is(':visible')){
			filter.removeAttr('style');
			$('#filterToggle').html('<i class="fa fa-bars fa-bars-edit"></i>Hide filters');
		}
		if(sirina < 1364 && filter.is(':hidden')){
			$('#filterToggle').html('<i class="fa fa-bars fa-bars-edit"></i>Show filters');
		}
	}
	// Call the resize function:
	resize();
	$(window).resize(resize);
	
</script>