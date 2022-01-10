
<script type="text/x-handlebars-template" id="v4_ActionsListTemplate">

	{{#each v4_Actions}}
		<div  onclick="one_v4_Actions({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
					<div class="col-md-1">
						<strong>{{ID}}</strong>
					</div>

					<div class="col-md-4">
						{{Title}}
					</div>

			</div>
		</div>
		<div id="v4_ActionsWrapper{{ID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{ID}}" class="row">
				<div id="one_v4_Actions{{ID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
