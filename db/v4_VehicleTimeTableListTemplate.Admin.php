
<script type="text/x-handlebars-template" id="v4_VehicleTimeTableListTemplate">

	{{#each v4_VehicleTimeTable}}
		<div  onclick="one_v4_VehicleTimeTable({{TaskID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{TaskID}}">
		
					<div class="col-md-3">
						<strong>{{TaskID}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
					</div>
			</div>
		</div>
		<div id="v4_VehicleTimeTableWrapper{{TaskID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{TaskID}}" class="row">
				<div id="one_v4_VehicleTimeTable{{TaskID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	