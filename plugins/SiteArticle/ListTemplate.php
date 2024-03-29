
<script type="text/x-handlebars-template" id="ItemListTemplate">
		<div id="ItemWrapperNew" class="editFrame" style="display:none">
			<div id="inlineContentNew" class="row">
				<div id="new_Item" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	<!-- Labels: -->
	<div class="row row-edit">
		
		<div class="col-md-12">

			<div class="col-md-1">
				<?=ID;?>
			</div>

			<div class="col-md-1">
				<?=LANGUAGE;?>
			</div>	

			<div class="col-md-5">
				<?=TITLE;?>
			</div>

			<div class="col-md-3">
				<?=PAGE;?>
			</div>

			<div class="col-md-1">
				<?=POSITION;?>
			</div>

			<div class="col-md-1">
				<?=PUBLISHED;?>
			</div>

		</div>
	</div>

	<!-- Main Content: -->
	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
				<div class="col-md-12">
					<div class="col-md-1">
						<strong>{{ID}}</strong>
					</div>

					<div class="col-md-1">
						<strong>{{Language}}</strong>
					</div>

					<div class="col-md-5">
						<strong>{{Title}}</strong>
					</div>

					<div class="col-md-3">
						<strong>{{Page}}</strong>
					</div>

					<div class="col-md-1">
						<strong>{{Position}}</strong>
					</div>					

					<div class="col-md-1">
						{{#compare Published ">" 0}}
							<i class="fa fa-circle text-green"></i>
						{{else}}
							<i class="fa fa-circle text-red"></i>
						{{/compare}}					
					</div>
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
	
