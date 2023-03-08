<?
	
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-2">
			<?=TOP_ROUTE_ID;?>
		</div>

		<div class="col-md-4">
			<?=ROUTENAMEEN; ?>
		</div>

		<div class="col-md-2">
			<?=DESCRIPTION;?>
		</div>

		<div class="col-md-4">
			<?=MAIN;?>
		</div>
		
					
	</div>

	{{#each Item}}
		<div  onclick="oneItem({{TopRouteID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{TopRouteID}}">
		
				<div class="col-sm-2">
					{{TopRouteID}}
				</div>

				<div class="col-sm-4">
					{{RouteNameEN}}
				</div>

				<div class="col-md-2">
					{{#if Description}}
						Yes
						{{else}}
							No
					{{/if}}
				</div>

				<div class="col-sm-4">
					{{#compare Main ">" 0}}
						<i class="fa fa-circle text-green"></i>
					{{else}}
						<i class="fa fa-circle text-red"></i>
					{{/compare}}
				</div>


			</div>
		</div>
		<div id="ItemWrapper{{TopRouteID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{TopRouteID}}" class="row">
				<div id="one_Item{{TopRouteID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
