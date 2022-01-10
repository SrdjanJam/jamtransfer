{literal}
<script type="text/javascript">
	$(document).ready(function(){
		{/literal}{$function_all}{literal}; 
	});	
</script>
{/literal}
<div class=" container">
	<h1>{$page}</h1>
	<a class="btn btn-primary btn-xs" href="new_v4_Countries">{$NNEW}</a>
	<br><br>
	<input type="hidden"  id="whereCondition" name="whereCondition" 
	value=" WHERE CountryID > 0">
	
	<div class="row pad1em">
		<div class="col-md-3" id="infoShow"></div>
		<div class="col-md-3">
			<i class="fa fa-eye"></i>
			<select id="length" class="w75" onchange="{$function_all};">
				<option value="5"> 5 </option>
				<option value="10" selected> 10 </option>
				<option value="20"> 20 </option>
				<option value="50"> 50 </option>
				<option value="100"> 100 </option>
			</select>
		</div>

		<div class="col-md-3">
			<i class="fa fa-text-width"></i>
			<input type="text" id="Search" class=" w75" onchange="{$function_all};" placeholder="Text + Enter to Search">
		</div>

		<div class="col-md-3">
			<i class="fa fa-sort-amount-asc"></i> 
			<select name="sortOrder" id="sortOrder" onchange="{$function_all};">
				<option value="ASC" selected="selected"> {$ASCENDING} </option>
				<option value="DESC"> {$DESCENDING} </option>
			</select>			
		</div>
	</div>

	<div id="show_v4_Countries">{$THERE_ARE_NO_DATA}</div>
	<br>
	<div id="pageSelect" class="col-sm-12"></div>
	<br><br><br><br>
</div>