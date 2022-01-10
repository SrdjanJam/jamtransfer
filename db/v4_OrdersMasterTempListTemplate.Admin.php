
<script type="text/x-handlebars-template" id="v4_OrdersMasterTempListTemplate">

	{{#each v4_OrdersMasterTemp}}
		<div  onclick="one_v4_OrdersMasterTemp({{MOrderID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{MOrderID}}">
		
					<div class="col-md-3">
						<strong>{{MOrderID}}</strong>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-3">
					</div>
			</div>
		</div>
		<div id="v4_OrdersMasterTempWrapper{{MOrderID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{MOrderID}}" class="row">
				<div id="one_v4_OrdersMasterTemp{{MOrderID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	