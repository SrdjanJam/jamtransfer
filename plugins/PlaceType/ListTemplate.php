<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-3">
			<?=SERVICE_ID;?>
		</div>

		<div class="col-md-9">
			<?=PLACENAMEEN;?>
		</div>	

	</div>

	{{#each Item}}
		<div  onclick="oneItem({{PlaceTypeID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{PlaceTypeID}}">
		
					<div class="col-sm-3">
						<strong>{{PlaceTypeID}}</strong>
					</div>

					<div class="col-sm-9">
						<strong>{{PlaceTypeEN}}</strong>
					</div>
					
			</div>
		</div>
		<div id="ItemWrapper{{PlaceTypeID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{PlaceTypeID}}" class="row">
				<div id="one_Item{{PlaceTypeID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>
	{{/each}}
</script>
	
