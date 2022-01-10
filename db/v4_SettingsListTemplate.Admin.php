
<script type="text/x-handlebars-template" id="v4_SettingsListTemplate">

	{{#each v4_Settings}}
		<div  onclick="one_v4_Settings({{id}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{id}}">
		
					<div class="col-md-3">
						<strong>{{id}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
					</div>
			</div>
		</div>
		<div id="v4_SettingsWrapper{{id}}" class="editFrame" style="display:none">
			<div id="inlineContent{{id}}" class="row">
				<div id="one_v4_Settings{{id}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	