
<script type="text/x-handlebars-template" id="v4_VehicleTypesListTemplate">

	{{#each v4_VehicleTypes}}
		<div  onclick="one_v4_VehicleTypes({{VehicleTypeID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{VehicleTypeID}}">
		
					<div class="col-md-3">
						<strong>{{VehicleTypeID}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
					</div>
			</div>
		</div>
		<div id="v4_VehicleTypesWrapper{{VehicleTypeID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{VehicleTypeID}}" class="row">
				<div id="one_v4_VehicleTypes{{VehicleTypeID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	