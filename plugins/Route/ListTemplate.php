<script type="text/x-handlebars-template" id="ItemListTemplate">

	{{#each Item}}
	<div class="row">
		{{#compare check ">" -1}}	
			<div class="col-sm-1">		
				<input type="checkbox" id="cb_{{RouteID}}" name="checkbox{{RouteID}}"
				{{#compare check ">" 0}}checked{{/compare}}
				>
			</div>
			<div class="col-sm-1">	
				<a target='_blank' href='{{driverlink}}'>
					{{#compare check ">" 0}}<i class="fa fa-pencil"></i>
					{{else}}<i class="fa fa-link"></i>
					{{/compare}}
				</a>
			</div>			
		{{/compare}}

		<div class="col-sm-10">		
			<div  onclick="oneItem({{RouteID}});">		
				<div class="row {{color}} pad1em listTile" 
				style="border-top:1px solid #ddd" 
				id="t_{{RouteID}}">
						
						<div class="col-sm-5">
							{{RouteName}}
						</div>					
						
						<div class="col-sm-3">
							{{driver}}
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
		</div>
	</div>	
	{{/each}}


</script>
	
