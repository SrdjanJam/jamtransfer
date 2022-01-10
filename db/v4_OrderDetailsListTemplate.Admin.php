
<script type="text/x-handlebars-template" id="v4_OrderDetailsListTemplate">

	{{#each v4_OrderDetails}}
		<div  onclick="one_v4_OrderDetails({{DetailsID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{DetailsID}}">
		
					<div class="col-md-3">
						<strong>{{DetailsID}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
					</div>
			</div>
		</div>
		<div id="v4_OrderDetailsWrapper{{DetailsID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{DetailsID}}" class="row">
				<div id="one_v4_OrderDetails{{DetailsID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	