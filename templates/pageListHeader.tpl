{if not $smarty.session.UseDriverID and $title ne "Orders" and $title ne "Invoices"}
	<a class="btn btn-primary btn-xs" href="{$currenturl}/new">{$NNEW}</a><br>
{/if}
<input type="hidden"  id="whereCondition" name="whereCondition" 
value=" WHERE {$ItemID} > 0">



<input type="hidden"  id="orderid" name="orderid" value="{$orderid}">
<input type="hidden"  id="detailid" name="detailid" value="{$detailid}">
<input type="hidden"  id="transfersFilter" name="transfersFilter" value="{$transfersFilter}">

<div class="row itemsheader">
	<div class="col-md-2" id="infoShow"></div>
	{if isset($selecttype)}
	<div class="col-sm-2">
		<i class="fa fa-list-ul"></i>

		<select id="Type" class="w75" onchange="allItems();">
			<option value="0">{$ALL}</option>
			{section name=pom loop=$options}
				<option value="{$options[pom].id}">{$options[pom].name}</option>
			{/section}
		</select>

	</div>	
	{/if}

	{if not isset($pagelength)}{assign var="pagelength" value="10"}{/if}
	
	<div class="col-md-2">
		<i class="fa fa-eye"></i>

		<select id="length" class="w75" onchange="allItems();">
			<option value="5" {if $pagelength eq '5'} selected {/if}> 5 </option>
			<option value="10" {if $pagelength eq '10'} selected {/if}> 10 </option>
			<option value="20" {if $pagelength eq '20'} selected {/if}> 20 </option>
			<option value="50" {if $pagelength eq '50'} selected {/if}> 50 </option>
			<option value="100" {if $pagelength eq '100'} selected {/if}> 100 </option>
		</select>
		
	</div>

	{if $title ne "Orders"}
	<div class="col-md-2">
		<i class="fa fa-text-width"></i>
		<input type="text" id="Search" class=" w75" onchange="allItems();" placeholder="Text + Enter to Search">
	</div>
	<div class="col-md-2">
		<i class="fa fa-sort-amount-asc"></i> 
		<select name="sortOrder" id="sortOrder" onchange="allItems();">
			<option value="ASC" selected="selected"> {$ASCENDING} </option>
			<option value="DESC"> {$DESCENDING} </option>
		</select>			
	</div>
	{else}
		<strong>{$transfersFiltersName}</strong>
	{/if}
	
	{if isset($selectactive)}		
	<div class="col-sm-2">
		<i class="fa fa-filter"></i> 
		<select name="Active" id="Active" onchange="allItems();">
			<option value="99" selected="selected">{$ALL}</option>			
			<option value="1"> Active </option>
			<option value="0"> Not Active </option>
		</select>
		
	</div>
	{/if}
</div>
