
<script type="text/x-handlebars-template" id="v4_RequestListTemplate">

	{{#each v4_Request}}
		<div  onclick="one_v4_Request({{ID}});">
		
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
		<div id="v4_RequestWrapper{{ID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{ID}}" class="row">
				<div id="one_v4_Request{{ID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
