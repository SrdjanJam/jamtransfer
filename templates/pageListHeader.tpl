<style>
/* Filters: */
#pageListHeader-filters{
	float:left;
	background: #479de929;
	border-radius: 5px;
	padding-right: 5px;
	box-shadow: 3px 3px 4px 0px #3b75b9;
}

.button-toggle{
	cursor:pointer; font-weight:bold; color: #0584f1; text-shadow: #0584f1 0px 0px 1px;
}

.fa-bars-edit{
	font-size: 20px;margin: 5px;color: #0584f1;
}

.button-toggle:hover,.fa-bars-edit:hover{
	cursor:pointer; font-weight:bold; color: #0b70c9;
}

/* ------------------------------------------------------ */
</style>

<input type="hidden"  id="whereCondition" name="whereCondition" 
value=" WHERE {$ItemID} > 0">

<input type="hidden"  id="isNew" name="IsNew value="{$IsNew}">
<input type="hidden"  id="customerID" name="customerID" value="{$CustomerID}">
<input type="hidden"  id="userID" name="userID" value="{$UserID}">
<input type="hidden"  id="routeID" name="routeID" value="{$RouteID}">
<input type="hidden"  id="vehicleTypeID" name="vehicleTypeID" value="{$VehicleTypeID}">
<input type="hidden"  id="vehicleID" name="vehicleID" value="{$VehicleID}">
<input type="hidden"  id="terminalID" name="terminalID" value="{$TerminalID}">
<input type="hidden"  id="CAU" name="CAU" value="{$CAU}">

<div class="row itemsheader itemsheader-edit">

<!-- Show and Hide Filters buttons: -->
<div id="pageListHeader-filters">
	{* old: *}
	{* <div id="show" class="button-toggle"><i class="fa-solid fa-bars fa-bars-edit"></i>{$SHOW_FILTERS}</div>
	<div id="hide" class="button-toggle"><i class="fa-solid fa-bars fa-bars-edit"></i>{$HIDE_FILTERS}</div> *}

	<div id="show-hide" class="button-toggle"><i class="fa fa-bars fa-bars-edit"></i></div>
</div>

	<div class="filter filter-one-edit">

		{if isset($selecttype)}
		<div class="ol-xs-12 col-md-4 col-lg-2">
			<i class="fa fa-list-ul edit-fa"></i>
			<div class="form-group group-edit">
			
				<select id="Type" class="w75 form-control control-edit" onchange="allItems();">
					<option value="0">{$ALL} {$STATUS}</option>
					{section name=pom loop=$options}
						<option value="{$options[pom].id}">{$options[pom].name}</option>
					{/section}
				</select>
			</div>
		</div>
		{/if}	
		{if isset($selecttype2)}
		<div class="col-xs-12 col-md-4 col-lg-2">
			<i class="fa fa-list-ul edit-fa"></i>
			<div class="form-group group-edit">
			
				<select id="Type2" class="w75 form-control control-edit" onchange="allItems();">
					<option value="0">{$ALL} {$USERS}</option>
					{section name=pom2 loop=$options2}
						<option value="{$options2[pom2].id}">{$options2[pom2].name}</option>
					{/section}
				</select>
			</div>
		</div>
		{/if}		
		{if isset($selecttype3)}
		<div class="col-xs-12 col-md-4 col-lg-2">
			<i class="fa fa-list-ul edit-fa"></i>
			<div class="form-group group-edit">
			
				<select id="Type3" class="w75 form-control control-edit" onchange="allItems();">
					<option value="0">{$ALL} {$STATUS}</option>
					{section name=pom3 loop=$options3}
						<option value="{$options3[pom3].id}">{$options3[pom3].name}</option>
					{/section}
				</select>
			</div>
		</div>
		{/if}

		<div class="col-xs-12 col-md-4 col-lg-2">
			<i class="fa fa-text-width edit-fa"></i>
			<div class="form-group group-edit">
				<input type="text" id="Search" class=" w75 form-control control-edit" onchange="allItems();" placeholder="Text + Enter to Search">
			</div>
		</div>
		{if $pageList ne 'Orders'}
		<div class="col-xs-12 col-md-4 col-lg-2">
			<i class="fa fa-sort-amount-asc edit-fa"></i>
			<div class="form-group group-edit">
				<select name="sortOrder" id="sortOrder" onchange="allItems();" class="form-control control-edit">
					<option value="ASC"> {$ASCENDING} </option>
					<option value="DESC" {if $isDesc}SELECTED{/if}> {$DESCENDING} </option>
				</select>
			</div>	
		</div>	
		{/if}	
		{if isset($selectactive)}		
		<div class="col-xs-12 col-md-4 col-lg-2">
			<i class="fa fa-filter edit-fa"></i> 
			<div class="form-group group-edit">
				<select name="Active" id="Active" onchange="allItems();" class="form-control control-edit">
					<option value="99" selected="selected">{$ALL}</option>			
					<option value="1"> {$ACTIVE} </option>
					{if isset($selectactive2)}<option value="2"> {$SEMI_ACTIVE} </option>{/if}
					<option value="0"> {$NOT_ACTIVE} </option>
				</select>
			</div>
		</div>
		{/if}	
		
		{if isset($selectapproved)}		
		<div class="col-xs-12 col-md-4 col-lg-2">
			<i class="fa fa-filter edit-fa"></i> 
			<div class="form-group group-edit">
				<select name="Approved" id="Approved" onchange="allItems();" class="form-control control-edit">
					<option value="99" selected="selected">{$ALL}</option>			
					<option value="1"> {$APPROVED} </option>
					<option value="0"> {$NOT_APPROVED} </option>
				</select>
			</div>
		</div>
		{/if}
		
		{if isset($selectsolved)}		
		<div class="col-xs-12 col-md-4 col-lg-2">
			<i class="fa fa-filter edit-fa"></i> 
			<div class="form-group group-edit">
				<select name="Approved" id="Approved" onchange="allItems();" class="form-control control-edit">
					<option value="99" selected="selected">{$ALL}</option>			
					<option value="1"> {$SOLVED} </option>
					<option value="0"> {$NOT_SOLVED} </option>
				</select>
			</div>
		</div>
		{/if}		
		
		{if isset($selectsubdriver)}	
		<div class="col-xs-12 col-md-4 col-lg-2">
			<i class="fa fa-filter edit-fa"></i> 
			<div class="form-group group-edit">
				<select id="subdriverID" class="w75 form-control control-edit" onchange="allItems();">
					<option value="0">{$ALL} {$USERS}</option>
					{section name=pom2 loop=$subdrivers}
						<option value="{$subdrivers[pom2].id}" {if $subdrivers[pom2].id eq $SubDriverID}selected{/if}>{$subdrivers[pom2].name}</option>
					{/section}
				</select>
			</div>
		</div>
		{/if}
		
		{if isset($selectaction)}	
		<div class="col-xs-12 col-md-4 col-lg-2">
			<i class="fa fa-filter edit-fa"></i> 
			<div class="form-group group-edit">
				<select id="actionID" class="w75 form-control control-edit" onchange="allItems();">
					<option value="0">{$ALL} {$ACTIONS}</option>
					{section name=pom2 loop=$actions}
						<option value="{$actions[pom2].ID}" {if $actions[pom2].ID eq $ActionID}selected{/if}>{$actions[pom2].Title}</option>
					{/section}
				</select>
			</div>
		</div>
		{/if}

		{if isset($date1)}	
			<input id='orderFromDate' class="datepicker datepicker-edit" name='orderFromDate'  placeholder="From Date" onchange="allItems();" />		
		{/if}		
		{if isset($date2)}	
			<input id='orderToDate' class="datepicker datepicker-edit" name='orderToDate'  placeholder="To Date" onchange="allItems();" />
		{/if}
		
	</div> <!-- /.filter -->
</div>


{* Scripts: *}
<script>

// Toggle effects for button:
$('#show-hide').hide();
$('#show-hide').click(function(){
	var link = $(this);
	$('.filter').slideToggle('slow', function() {
		if ($(this).is(":visible")) {
			link.html('<i class="fa fa-bars fa-bars-edit"></i>Hide filters');
		} else{
			link.html('<i class="fa fa-bars fa-bars-edit"></i>Show filters');
		}        
	});
});
// Resize effect for footer:
function resizeContent(){
	var filter = $('.filter');
	var sirina = $(window).width();
	if(sirina > 1221 && filter.is(':visible')){
		filter.removeAttr('style');
		$('#show-hide').hide();
	}if(sirina < 1357 && filter.is(':hidden')){
		$('#show-hide').show();
		$('#show-hide').html('<i class="fa fa-bars fa-bars-edit"></i>Show filters');
		filter.show();
		filter.removeAttr('style');
	}
}

// Call the resize function:
resizeContent();
$(window).resize(resizeContent);


</script>