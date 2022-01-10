
<script type="text/x-handlebars-template" id="v4_CustomersListTemplate">

	{{#each v4_Customers}}
		<div  onclick="one_v4_Customers({{CustID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{CustID}}">
		
					<div class="col-md-3">
						<strong>{{CustID}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
					</div>
			</div>
		</div>
		<div id="v4_CustomersWrapper{{CustID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{CustID}}" class="row">
				<div id="one_v4_Customers{{CustID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	