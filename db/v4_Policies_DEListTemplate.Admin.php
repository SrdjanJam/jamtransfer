
<script type="text/x-handlebars-template" id="v4_Policies_DEListTemplate">

	{{#each v4_Policies_DE}}
		<div  onclick="one_v4_Policies_DE({{OwnerID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{OwnerID}}">
		
					<div class="col-md-3">
						<strong>{{OwnerID}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
					</div>
			</div>
		</div>
		<div id="v4_Policies_DEWrapper{{OwnerID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{OwnerID}}" class="row">
				<div id="one_v4_Policies_DE{{OwnerID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	