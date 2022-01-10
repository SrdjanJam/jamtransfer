
<script type="text/x-handlebars-template" id="v4_AuthUsersListTemplate">

	{{#each v4_AuthUsers}}
		<div  onclick="one_v4_AuthUsers({{AuthUserID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{AuthUserID}}">
		
					<div class="col-md-3">
						<strong>{{AuthUserID}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
					</div>
			</div>
		</div>
		<div id="v4_AuthUsersWrapper{{AuthUserID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{AuthUserID}}" class="row">
				<div id="one_v4_AuthUsers{{AuthUserID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	