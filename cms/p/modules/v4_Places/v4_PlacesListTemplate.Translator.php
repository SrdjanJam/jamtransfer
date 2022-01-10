
<script type="text/x-handlebars-template" id="v4_PlacesListTemplate">

	{{#each v4_Places}}
		<div  onclick="one_v4_Places({{PlaceID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{PlaceID}}">
		
					<div class="col-md-4">
						<strong>{{PlaceNameEN}}</strong>
					</div>

					<div class="col-md-2">
						{{PlaceNameRU}}
					</div>

					<div class="col-md-2">
						{{PlaceNameFR}}
					</div>

					<div class="col-md-2">
						{{PlaceNameDE}}
					</div>

					<div class="col-md-2">
						{{PlaceNameIT}}
					</div>
			</div>
		</div>
		<div id="v4_PlacesWrapper{{PlaceID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{PlaceID}}" class="row">
				<div id="one_v4_Places{{PlaceID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
