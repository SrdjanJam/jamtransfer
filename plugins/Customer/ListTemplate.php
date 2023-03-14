<?
	$smarty->assign('selecttype',true);
	$smarty->assign('selectactive',true);
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

<!-- LIST: -->
	<div class="row row-edit">

		<div class="col-md-3">
			<?=CUSTOMER_ID;?>
		</div>

		<div class="col-md-3">
			<?=CUSTOMER_FIRST_NAME;?>
		</div>

		<div class="col-md-3">
			<?=CUSTOMER_LAST_NAME;?>
		</div>

		<div class="col-md-3">
			<?=CUSTOMER_EMAIL;?>
		</div>

					
	</div>

<!-- ONE ITEM: -->
	{{#each Item}}
		<div  onclick="oneItem({{CustID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{CustID}}">

				<div class="col-sm-3">
					{{CustID}}
				</div>
				<div class="col-sm-3">
					{{CustFirstName}}
				</div>
				<div class="col-sm-3">
					{{CustLastName}}
				</div>
				<div class="col-sm-3">
					{{CustEmail}}
				</div>

			</div>
		</div>
		<div id="ItemWrapper{{CustID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{CustID}}" class="row">
				<div id="one_Item{{CustID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
