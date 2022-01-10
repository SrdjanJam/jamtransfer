
<script type="text/x-handlebars-template" id="v4_WorksheetListTemplate">

	{{#each v4_Worksheet}}
		<div  onclick="one_v4_Worksheet({{WSID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{WSID}}">
		
					<div class="col-md-3">
						<strong>{{WSID}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
					</div>
			</div>
		</div>
		<div id="v4_WorksheetWrapper{{WSID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{WSID}}" class="row">
				<div id="one_v4_Worksheet{{WSID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	