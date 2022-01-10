
<script type="text/x-handlebars-template" id="v4_OrderStatusesListTemplate">

	{{#each v4_OrderStatuses}}
		<div  onclick="one_v4_OrderStatuses({{OrderStatusID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{OrderStatusID}}">
		
					<div class="col-md-3">
						<strong>{{OrderStatusID}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
					</div>
			</div>
		</div>
		<div id="v4_OrderStatusesWrapper{{OrderStatusID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{OrderStatusID}}" class="row">
				<div id="one_v4_OrderStatuses{{OrderStatusID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	