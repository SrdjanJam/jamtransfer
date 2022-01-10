
<script type="text/x-handlebars-template" id="v4_PlacesListTemplate">

	{{#each v4_Places}}
		<div  onclick="one_v4_Places({{PlaceID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{PlaceID}}">
		
					<div class="col-md-3">
						<strong>{{PlaceID}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
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
	