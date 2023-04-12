<?
$smarty->assign('selectapproved',true);


?>

<script type="text/x-handlebars-template" id="ItemListTemplate">


	<div class="row row-edit">

		<div class="col-md-1">
			<?=ID;?>
		</div>

		<div class="col-md-1">
			<?=DATUM;?>
		</div>

		<div class="col-md-2">
			<?=AUTH_USER_REAL_NAME;?>
		</div>

		<div class="col-md-2">
			<?=EXPANCE_TITLE;?>
		</div>

		<div class="col-md-2">
			<?=EXPANCE_AMOUNT;?>
		</div>

		<div class="col-md-2">
			<?=DISPLAYED_KM;?>
		</div>

		<div class="col-md-1">
			<?=NOTE;?>
		</div>
		
		<div class="col-md-1">
			<?=EXPANCE_APPROVED;?>
		</div>

	</div>

	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
			<div class="row {{color}} pad1em listTile"
			style="border-top:1px solid #ddd"
			id="t_{{ID}}">

					<div class="col-md-1">
						<strong>{{ID}}</strong>
					</div>

					<div class="col-md-1">
						{{Datum}}
					</div>

					<div class="col-md-2">
						{{AuthUserRealName}}
					</div>

					<div class="col-md-2">
						{{ExpanceTitle}}
					</div>

					<div class="col-md-2">
						{{Amount}}

                        {{#compare CurrencyID "==" 1}} EUR {{/compare}}
                        {{#compare CurrencyID "==" 2}} HRK {{/compare}}
                        {{#compare CurrencyID "==" 3}} CHF {{/compare}}

						{{#compare Card "==" 1}} Card
						{{else}} Cash
						{{/compare}}
					</div>

					<div class="col-md-2">
						{{Description}}
					</div>
					
					<div class="col-md-1">
						{{#if Note}}
							<i class="fa fa-envelope" aria-hidden="true"></i>
						{{/if}}
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
