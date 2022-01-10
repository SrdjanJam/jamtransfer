
<script type="text/x-handlebars-template" id="v4_yes_noListTemplate">

	{{#each v4_yes_no}}
		<div  onclick="one_v4_yes_no({{dn_broj}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{dn_broj}}">
		
					<div class="col-md-3">
						<strong>{{dn_broj}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
					</div>
			</div>
		</div>
		<div id="v4_yes_noWrapper{{dn_broj}}" class="editFrame" style="display:none">
			<div id="inlineContent{{dn_broj}}" class="row">
				<div id="one_v4_yes_no{{dn_broj}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	