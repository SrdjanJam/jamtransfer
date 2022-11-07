<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-2">
			<?=OFF_DUTY_ID;?>
		</div>

		<div class="col-md-10">
			<?=STARTDATE;?> - <?=ENDDATE;?>
		</div>	

	</div>

	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
				<div class="col-md-2">
					<strong>{{ID}}</strong>
				</div>

				<div class="col-md-10">
					{{StartDate}} - {{EndDate}}
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
	
