
<script type="text/x-handlebars-template" id="v4_RoutesListTemplate">

	{{#each v4_Routes}}
		<div  onclick="one_v4_Routes({{RouteID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{RouteID}}">
		
					<div class="col-md-3">
						<strong>{{RouteID}}</strong>
					</div>

					<div class="col-md-9">
						{{RouteName}}
					</div>
			</div>
		</div>
		<div id="v4_RoutesWrapper{{RouteID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{RouteID}}" class="row">
				<div id="one_v4_Routes{{RouteID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
