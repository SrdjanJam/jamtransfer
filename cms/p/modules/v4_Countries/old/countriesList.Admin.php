<script type="text/x-handlebars-template" id="countriesListTemplate">

	{{#each countries}}
		<div  onclick="showOneCountry({{CountryID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{CountryID}}">
		

					<div class="col-sm-12 col-xs-12">
						<strong>{{CountryName}}</strong>
					</div>
			</div>
		</div>
		<div id="countriesWrapper{{CountryID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{CountryID}}" class="row">
				<div id="oneCountry{{CountryID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
