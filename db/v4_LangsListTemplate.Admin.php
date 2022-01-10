
<script type="text/x-handlebars-template" id="v4_LangsListTemplate">

	{{#each v4_Langs}}
		<div  onclick="one_v4_Langs({{lang_short}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{lang_short}}">
		
					<div class="col-md-3">
						<strong>{{lang_short}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
					</div>
			</div>
		</div>
		<div id="v4_LangsWrapper{{lang_short}}" class="editFrame" style="display:none">
			<div id="inlineContent{{lang_short}}" class="row">
				<div id="one_v4_Langs{{lang_short}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	