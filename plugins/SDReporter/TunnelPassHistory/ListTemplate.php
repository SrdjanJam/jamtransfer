<?
$smarty->assign('date1',true);
$smarty->assign('date2',true);
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">
	<!-- LABEL: -->
	<div class="row row-edit">
		<div class="col-md-1"> <?=ID;?> </div>
		<div class="col-md-2"> <?=TUNNEL_PASS_CODE;?> </div>
		<div class="col-md-2"> <?=ASSIGN_SDID;?> </div>
		<div class="col-md-2"> <?=PASS_TIME;?> </div>		
	</div>
	<!-- listTile: -->
	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
			<div class="row {{color}} pad1em listTile cursor-list"  
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
				<div class="col-md-1"> <strong>{{ID}}</strong> </div>
				<div class="col-md-2"> {{TunnelPassCode}} </div>				
				<div class="col-md-2"> {{SubDriver}} </div>				
				<div class="col-md-2"> {{PassTime}} </div>
			</div>
		</div>
	{{/each}}
</script>