
<script type="text/x-handlebars-template" id="ItemListTemplate">
	<!-- Labels: -->
	<div class="row row-edit">
		
		<div class="col-md-12">

			<div class="col-md-2">
				<?=ID;?>
			</div>

			<div class="col-md-2">
				<?=TYPE;?>
			</div>	

			<div class="col-md-2">
				<?=VALUE;?>
			</div>	

			<div class="col-md-2">
				<?=DESCRIPTION;?>
			</div>	

		</div>
	</div>

	<!-- Main content: -->
	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">

				<div class="col-md-12">
					<div class="col-sm-2">
						<strong>{{ID}}</strong>
					</div>

					<div class="col-sm-2">
						{{Type}}
					</div>

					<div class="col-sm-2">
						{{Value}}
					</div>

					<div class="col-sm-2">
						{{Description}}
					</div>
				</div>

			</div>
		</div>

		<!-- LOADING: -->
		<div id="ItemWrapper{{ID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{ID}}" class="row">
				<div id="one_Item{{ID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
