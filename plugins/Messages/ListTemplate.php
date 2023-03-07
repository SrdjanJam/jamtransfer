<?
	
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

<!-- LIST: -->
	<div class="row row-edit">
		
		<div class="col-md-1">
			<?=MESSAGE_ID;?>
		</div>

		<div class="col-md-2">
			<?=FROM_NAME;?>
		</div>

		<div class="col-md-2">
			<?=MSG;?>
		</div>

		<div class="col-md-2">
			<?=USER_ID;?>
		</div>

		<div class="col-md-2">
			<?=DATE_TIME;?>
		</div>

		<div class="col-md-2">
			<?=USER_LEVEL;?>
		</div>

		<div class="col-md-1">
			<?=STATUS;?>
		</div>
					
	</div>

<!-- ONE ITEM: -->
	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">

			
				<div class="col-sm-1">
					{{ID}}
				</div>

				<div class="col-sm-2">
					{{FromName}}
				</div>

				<div class="col-sm-2">
					{{Msg}}
				</div>

				<div class="col-sm-2">
					{{UserID}}
				</div>

				<div class="col-sm-2">
					{{DateTime}}
				</div>

				<div class="col-sm-2">
					{{UserLevel}}
				</div>
				
				<div class="col-sm-1">
					{{Status}}
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
	
