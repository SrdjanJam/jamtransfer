
<script type="text/x-handlebars-template" id="ItemListTemplate">

	{{#each Item}}
		<div  onclick="oneItem({{ModulID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
					<div class="col-sm-3">
						<strong>{{ModulID}}</strong>
					</div>

					<div class="col-sm-2">
						{{Name}}
					</div>

					<div class="col-sm-2">
					</div>

					<div class="col-sm-3">
					</div>
			</div>
		</div>
		<div id="ItemWrapper{{ModulID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{ModulID}}" class="row">
				<div id="one_Item{{ModulID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
