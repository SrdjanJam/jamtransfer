
<script type="text/x-handlebars-template" id="v4_CountriesListTemplate">

	{{#each v4_Countries}}
		<div  onclick="one_v4_Countries({{CountryID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{CountryID}}">
					<div class="col-md-4">
						<strong>{{CountryNameEN}}</strong>
					</div>

					<div class="col-md-2">
						{{CountryNameRU}}
					</div>

					<div class="col-md-2">
						{{CountryNameFR}}
					</div>

					<div class="col-md-2">
						{{CountryNameDE}}
					</div>

					<div class="col-md-2">
						{{CountryNameIT}}
					</div>
			</div>
		</div>
		<div id="v4_CountriesWrapper{{CountryID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{CountryID}}" class="row">
				<div id="one_v4_Countries{{CountryID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
