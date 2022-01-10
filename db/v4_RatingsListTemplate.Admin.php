
<script type="text/x-handlebars-template" id="v4_RatingsListTemplate">

	{{#each v4_Ratings}}
		<div  onclick="one_v4_Ratings({{OwnerID}});">
		
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
		<div id="v4_RatingsWrapper{{OwnerID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{OwnerID}}" class="row">
				<div id="one_v4_Ratings{{OwnerID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	