{literal}
<script type="text/javascript">
window.root = 'plugins/{/literal}{$base}{literal}/';
window.currenturl = '{/literal}{$currenturl}{literal}';
</script>
{/literal}
<script src="js/list.js"></script>

{if $isNew}
{literal}
<script type="text/javascript">
	$(document).ready(function(){
		new_Item(); 
	});	
</script>
{/literal}
<div id="ItemWrapperNew" class="editFrame container-fluid" style="display:none">
	<div id="inlineContentNew" class="row">
		<div id="new_Item"></div>
	</div>
</div>	
{else}
{literal}
<script type="text/javascript">
	$(document).ready(function(){
		allItems(); 
		oneItem({/literal}{$item}{literal});
	});	
</script>
{/literal}
<div class="">
	{if not $smarty.session.UseDriverID}<a class="btn btn-primary btn-xs" href="{$root_home}{$code}/new">{$NNEW}</a>{/if}
	<br><br>
	<input type="hidden"  id="whereCondition" name="whereCondition" 
	value=" WHERE {$ItemID} > 0">
	
	<div class="row pad1em">
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
		<div class="col-md-2">
			<i class="fa fa-eye"></i>
			<select id="length" class="w75" onchange="allItems();">
				<option value="5"> 5 </option>
				<option value="10" selected> 10 </option>
				<option value="20"> 20 </option>
				<option value="50"> 50 </option>
				<option value="100"> 100 </option>
			</select>
		</div>

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

	<div id="show_Items">{$THERE_ARE_NO_DATA}</div>
	<br>
	<div id="pageSelect" class="col-sm-12"></div>
	<br><br><br><br>
</div>
{/if}

