<?
$smarty->assign('selectapproved',true);
$smarty->assign('date1',true);
$smarty->assign('date2',true);
?>

<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- LABEL: -->
	<div class="row row-edit">

		<div class="col-md-1">
			<?=ID;?>
		</div>

		<div class="col-md-2">
			<?=TASK_DATE;?>
		</div>

		<div class="col-md-2">
			<?=AUTH_USER_REAL_NAME;?>
		</div>

		<div class="col-md-2">
			<?=VEHICLEDESCRIPTION;?>
		</div>

		<div class="col-md-2">
			<?=DESCRIPTION;?>
		</div>

		<div class="col-md-2">
			<?=DATE;?>
		</div>

		<div class="col-md-1">
			<?=APPROVED;?>
		</div>

	</div>

	<!-- listTile: -->
	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
				<div class="col-md-1">
					<strong>{{ID}}</strong>
				</div>

				<div class="col-md-2">
					{{Datum}}
				</div>

				<div class="col-md-2">
					{{AuthUserRealName}}
				</div>

				<div class="col-md-2">
					{{ExpanceTitle}}
						{{VehicleDescription}}
				</div>					
				
				<div class="col-md-2">
					{{Description}}
				</div>
				
				<div class="col-md-2">
					{{Vreme}}
				</div>


				<div class="col-md-1">
					{{#compare Approved "==" 1}} <i class="fa fa-circle xgreen-text"></i>
					{{else}} <i class="fa fa-circle red-text"></i>
					{{/compare}}
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