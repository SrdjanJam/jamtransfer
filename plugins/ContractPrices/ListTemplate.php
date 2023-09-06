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
			<?=NAME;?>
		</div>

		<div class="col-md-2">
			<?=ROUTE;?>
		</div>	
		
		<div class="col-md-2">
			<?=VEHICLE_TYPE;?>
		</div>		
				
	</div>
	<!-- --------------------------------- -->

	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
					<div class="col-md-2">
						<strong>{{AgentName}}</strong>
					</div>

					<div class="col-md-2">
						{{RouteName}}
					</div>

					<div class="col-md-2">
						{{VehicleTypeName}}
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
	

