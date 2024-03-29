<?
	$arr_row['id']=1;
	$arr_row['name']='Agents';
	$arr_all[]=$arr_row;
	$arr_row['id']=2;
	$arr_row['name']='Drivers';
	$arr_all[]=$arr_row;
	$smarty->assign('options',$arr_all);
	$smarty->assign('selecttype',true);
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-3">
			<?=NAME;?>
		</div>

		<div class="col-md-4">
			<?=AUTHUSERCOMPANY;?>
		</div>	

		<div class="col-md-2">
			<?=DATE;?>
		</div>

		<div class="col-md-2">
			<?=PRICE;?>
		</div>

		<div class="col-md-1">
			<?=CONNECTED;?>
		</div>
					
	</div>

	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
					<div class="col-md-3">
						<strong># {{InvoiceNumber}}</strong><br>
						{{#compare Type "==" 1}}
							<small>Agent</small>
						{{else}}
							<small>Driver</small>
						{{/compare}} 						
					</div>

					<div class="col-md-4">
						<strong>{{userName UserID "AuthUserCompany"}}</strong>
						<br>
						{{formatDate StartDate "short"}} - {{formatDate EndDate "short"}}
					</div>

					<div class="col-md-2">
						{{formatDate InvoiceDate "short"}}
					</div>

					<div class="col-md-2">
						{{GrandTotal}} Eur
					</div>


					<div class="col-md-1">
						{{#compare Status "==" 99}}
							<i class="fa fa-check text-green" title="<?= PAID ?>"></i>
						{{else}}
							<i class="fa fa-close text-red" title="<?= NOT_PAID ?>"></i>
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
	
