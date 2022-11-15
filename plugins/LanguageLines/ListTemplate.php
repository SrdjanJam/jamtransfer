<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-2">
			<?=ID;?>
		</div>

		<div class="col-md-8">
			<?=NAME;?>
		</div>	
		
		<div class="col-md-2">
			<a target='_tab' href="https://api.jamtransfer.com/api/delete-translations-cache?hash=d06161457d4c4b45e57d764c98051d86" style="color:blue;"><i class="fas fa-external-link"></i>&nbsp;<u>Delete Cache</u></a>
		</div>		
					
	</div>

	{{#each Item}}
		<div  onclick="oneItem({{id}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{id}}">
				<div class="col-md-2">
					<strong>{{id}}</strong>
				</div>

				<div class="col-md-10">
					<strong>{{key}}</strong>
				</div>
			</div>
		</div>
		<div id="ItemWrapper{{id}}" class="editFrame" style="display:none">
			<div id="inlineContent{{id}}" class="row">
				<div id="one_Item{{id}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}
</script>