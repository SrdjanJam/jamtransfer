
<script type="text/x-handlebars-template" id="v4_AuthLevelsListTemplate">

	{{#each v4_AuthLevels}}
		<div  onclick="one_v4_AuthLevels({{AuthLevelID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{AuthLevelID}}">
		
					<div class="col-md-3">
						<strong>{{AuthLevelID}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
					</div>
			</div>
		</div>
		<div id="v4_AuthLevelsWrapper{{AuthLevelID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{AuthLevelID}}" class="row">
				<div id="one_v4_AuthLevels{{AuthLevelID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	