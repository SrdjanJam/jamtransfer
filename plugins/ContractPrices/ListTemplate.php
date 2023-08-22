<script type="text/x-handlebars-template" id="ItemListTemplate">
		<div id="ItemWrapperNew" class="editFrame" style="display:none">
			<div id="inlineContentNew" class="row">
				<div id="new_Item" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	<!-- Labels: -->
	<div class="row row-edit">
		
		<div class="col-md-2">
			<?=AGENT_ID;?>
		</div>

		<div class="col-md-2">
			<?=ROUTE_ID;?>
		</div>	
		
		<div class="col-md-2">
			<?=VEHICLE_TYPE_ID;?>
		</div>		
				
	</div>
	<!-- --------------------------------- -->

	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
					<div class="col-md-2">
						<strong>{{AgentID}}</strong>
					</div>

					<div class="col-md-2">
						{{RouteID}}
					</div>

					<div class="col-md-2">
						{{VehicleTypeID}}
					</div>				
					
			</div>
		</div>
		<div id="ItemWrapper{{ID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{ID}}" class="row">
				<div id="one_Item{{ID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}



</script>
	

