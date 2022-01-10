
<script type="text/x-handlebars-template" id="v4_ServicesCopyListTemplate">

	{{#each v4_ServicesCopy}}
		<div  onclick="one_v4_ServicesCopy({{ServiceID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ServiceID}}">
		
					<div class="col-md-3">
						<strong>{{ServiceID}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
					</div>
			</div>
		</div>
		<div id="v4_ServicesCopyWrapper{{ServiceID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{ServiceID}}" class="row">
				<div id="one_v4_ServicesCopy{{ServiceID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	