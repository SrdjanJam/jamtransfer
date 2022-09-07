<?
	$smarty->assign('selectactive',true);
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

	{{#each Item}}
		<div  onclick="oneItem({{DriverID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{DriverID}}">
	
				<div class="col-md-3">
					<strong>{{DriverID}}</strong>
				</div>

				<div class="col-md-3">
					{{DriverName}}
				</div>

				<div class="col-md-3">
					{{DriverEmail}}
				</div>

				<div class="col-md-3">
					{{DriverTel}}
				</div>
			</div>
		</div>
		<div id="ItemWrapper{{DriverID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{DriverID}}" class="row">
				<div id="one_Item{{DriverID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
