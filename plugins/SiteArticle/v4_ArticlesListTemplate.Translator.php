
<script type="text/x-handlebars-template" id="v4_ArticlesListTemplate">
		<div id="v4_ArticlesWrapperNew" class="editFrame" style="display:none">
			<div id="inlineContentNew" class="row">
				<div id="new_v4_Articles" >
					<?= LOADING ?>
				</div>
			</div>
		</div>
	{{#each v4_Articles}}
		<div  onclick="one_v4_Articles({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
					<div class="col-md-1">
						<strong>{{ID}}</strong>
					</div>

					<div class="col-md-6">
						<strong>{{Title}}</strong>
					</div>
					<div class="col-md-2">
						<strong>{{Page}}</strong>
					</div>
					<div class="col-md-1">
						<strong>{{Language}}</strong>
					</div>					

					<div class="col-md-1">
						{{#compare Published ">" 0}}
							<i class="fa fa-circle text-green"></i>
						{{else}}
							<i class="fa fa-circle text-red"></i>
						{{/compare}}					
					</div>
			</div>
		</div>
		<div id="v4_ArticlesWrapper{{ID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{ID}}" class="row">
				<div id="one_v4_Articles{{ID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
