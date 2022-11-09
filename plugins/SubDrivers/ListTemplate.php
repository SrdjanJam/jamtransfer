<?
	$smarty->assign('selectactive',true);
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-3">
			<?=DRIVER_ID;?>
		</div>

		<div class="col-md-3">
			<?=DRIVER_NAME;?>
		</div>	

		<div class="col-md-3">
			<?=DRIVER_EMAIL;?>
		</div>

		<div class="col-md-3">
			<?=DRIVER_TEL;?>
		</div>
					
	</div>

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
	
