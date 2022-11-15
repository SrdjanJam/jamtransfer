
<script type="text/x-handlebars-template" id="ItemListTemplate">
	<!-- Labels: -->
	<div class="row row-edit">
		
		<div class="col-md-12">

			<div class="col-md-2">
				<?=ID;?>
			</div>

			<div class="col-md-10">
				<?=NAME;?>
			</div>	

		</div>
	</div>

	<!-- Main content: -->
	{{#each Item}}
		<div  onclick="oneItem({{ModulID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">

				<div class="col-md-12">
		
					<div class="col-sm-2">
						<strong>{{ModulID}}</strong>
					</div>

					<div class="col-sm-10">
						{{Name}}
					</div>

				</div>

			</div>
		</div>

		<!-- LOADING: -->
		<div id="ItemWrapper{{ModulID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{ModulID}}" class="row">
				<div id="one_Item{{ModulID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
