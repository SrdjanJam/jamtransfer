
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-1">
			<?=CODE_ID;?>
		</div>

		<div class="col-md-2">
			<?=CODE;?>
		</div>	

		<div class="col-md-2">
			<?=DISCOUNT;?>
		</div>

		<div class="col-md-3">
			<?=VALIDFROM;?>
		</div>

		<div class="col-md-3">
			<?=VALIDTO;?>
		</div>

		<div class="col-md-1">
			<?=ACTIVE;?>
		</div>
					
	</div>

	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
					<div class="col-md-1">
						<strong>{{ID}}</strong>
					</div>

					<div class="col-md-2">
						{{Code}}
					</div>

					<div class="col-md-2">
						{{Discount}}
					</div>

					<div class="col-md-3">
						{{ValidFrom}}
					</div>

					<div class="col-md-3">
						{{ValidTo}}
					</div>

					<div class="col-md-1">
						{{#compare Active ">" 0}}
							<i class="fa fa-circle text-green"></i>
						{{else}}
							<i class="fa fa-circle text-red"></i>
						{{/compare}}
					</div>
			</div>
		</div>
		<div id="ItemWrapper{{ID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{ID}}" class="row">
				<div id="one_Item{{ID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
