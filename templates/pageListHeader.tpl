
<input type="hidden"  id="whereCondition" name="whereCondition" 
value=" WHERE {$ItemID} > 0">

<input type="hidden"  id="orderid" name="orderid" value="{$orderid}">
<input type="hidden"  id="detailid" name="detailid" value="{$detailid}">
<input type="hidden"  id="transfersFilter" name="transfersFilter" value="{$transfersFilter}">
<input type="hidden"  id="routeID" name="routeID" value="{$RouteID}">
<input type="hidden"  id="vehicleTypeID" name="vehicleTypeID" value="{$VehicleTypeID}">
<input type="hidden"  id="vehicleID" name="vehicleID" value="{$VehicleID}">

<div class="row itemsheader itemsheader-edit">
{if $existNew}
	<a class="btn btn-primary btn-xs btn-xs-edit" href="{$currenturl}/new">{$NNEW}</a><br>
{/if}
	<div class="col-md-2 col-md-2-infoShow" id="infoShow"></div>
	{if isset($selecttype)}
	<div class="col-md-2 asd">
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
	<div class="col-md-2 asd">
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

	{if not isset($pagelength)}{assign var="pagelength" value="10"}{/if}
	
	<div class="col-md-2 asd">
		<i class="fa fa-eye edit-fa"></i>
		<div class="form-group group-edit">
			<select id="length" class="w75 form-control control-edit" onchange="allItems();">
				<option value="5" {if $pagelength eq '5'} selected {/if}> 5 </option>
				<option value="10" {if $pagelength eq '10'} selected {/if}> 10 </option>
				<option value="20" {if $pagelength eq '20'} selected {/if}> 20 </option>
				<option value="50" {if $pagelength eq '50'} selected {/if}> 50 </option>
				<option value="100" {if $pagelength eq '100'} selected {/if}> 100 </option>
			</select>
		</div>
	</div>

	<div class="col-md-2 asd">
		<i class="fa fa-text-width edit-fa"></i>
		<div class="form-group group-edit">
			<input type="text" id="Search" class=" w75 form-control control-edit" onchange="allItems();" placeholder="Text + Enter to Search">
		</div>
	</div>
	<div class="col-md-2 asd">
		<i class="fa fa-sort-amount-asc edit-fa"></i>
		<div class="form-group group-edit">
			<select name="sortOrder" id="sortOrder" onchange="allItems();" class="form-control control-edit">
				<option value="ASC" selected="selected"> {$ASCENDING} </option>
				<option value="DESC"> {$DESCENDING} </option>
			</select>
		</div>		
	</div>

	
	{if isset($selectactive)}		
	<div class="col-md-2 asd">
		<i class="fa fa-filter edit-fa"></i> 
		<div class="form-group group-edit">
			<select name="Active" id="Active" onchange="allItems();" class="form-control control-edit">
				<option value="99" selected="selected">{$ALL}</option>			
				<option value="1"> Active </option>
				{if isset($selectactive2)}<option value="2"> Semi Active </option>{/if}
				<option value="0"> Not Active </option>
			</select>
		</div>
	</div>
	{/if}
</div>
