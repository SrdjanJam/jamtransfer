
<script type="text/x-handlebars-template" id="v4_PlaceTypesListTemplate">

	{{#each v4_PlaceTypes}}
		<div  onclick="one_v4_PlaceTypes({{PlaceTypeID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{PlaceTypeID}}">
		
					<div class="col-sm-3">
						<strong>{{PlaceTypeID}}</strong>
					</div>

					<div class="col-sm-2">
						<strong>{{PlaceTypeEN}}</strong>
					</div>

					<div class="col-sm-2">
					</div>

					<div class="col-sm-3">
					</div>
			</div>
		</div>
		<div id="v4_PlaceTypesWrapper{{PlaceTypeID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{PlaceTypeID}}" class="row">
				<div id="one_v4_PlaceTypes{{PlaceTypeID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
