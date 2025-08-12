
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- Labels: -->
	<div class="row row-edit">
			
		<div class="col-md-12">

			<div class="col-md-3">
				<?=ID;?>
			</div>

			<div class="col-md-9">
				<?=TITLE;?>
			</div>	

		</div>
	</div>

	<!-- Main Content: -->
	{{#each Item}}
		<div  onclick="oneItem({{NewsID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">

				<div class="col-md-12">
		
					<div class="col-sm-3">
						<strong>{{NewsID}}</strong>
					</div>

					<div class="col-sm-9">
						{{Header}}
					</div>
				
				</div>
			</div>
		</div>

		<div id="ItemWrapper{{NewsID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{NewsID}}" class="row">
				<div id="one_Item{{NewsID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
