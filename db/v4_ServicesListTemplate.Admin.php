
<script type="text/x-handlebars-template" id="v4_ServicesListTemplate">

	{{#each v4_Services}}
		<div  onclick="one_v4_Services({{ServiceID}});">
		
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
		<div id="v4_ServicesWrapper{{ServiceID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{ServiceID}}" class="row">
				<div id="one_v4_Services{{ServiceID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	