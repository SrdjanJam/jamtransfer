<script type="text/x-handlebars-template" id="ItemListTemplate">

	{{#each Item}}
		<div  onclick="oneItem({{RouteID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{RouteID}}">
		
					<div class="col-sm-2">
						<strong>{{RouteID}}</strong>
					</div>

					<div class="col-sm-7">
						{{RouteName}}
					</div>

					<div class="col-sm-2">
						<strong><a href='https://jamtransfer.com/cms/indexN.php?p=routeprices&RouteID={{RouteID}}'>Prices</a></strong>
					</div>

					<div class="col-sm-1">
					
						{{#compare Approved ">" 0}}
							<i class="fa fa-check text-green"></i>
						{{else}}
							<i class="fa fa-close text-red"></i>
						{{/compare}}											
					</div>
			</div>
		</div>
		<div id="ItemWrapper{{RouteID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{RouteID}}" class="row">
				<div id="one_Item{{RouteID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
