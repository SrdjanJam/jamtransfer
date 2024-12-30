<?
	foreach($StatusDescription as $nn => $id) {
		$arr_row['id']=$nn;
		$arr_row['name']=$id;
		$arr_all[]=$arr_row;
	}
	$smarty->assign('options',$arr_all);
	
	$excl=array(0,1,2,4);
	foreach($DriverConfStatus as $nn => $id) {
		if (!in_array($nn,$excl)) {
			$arr_row['id']=$nn;
			$arr_row['name']=$id;
			$arr_all3[]=$arr_row;
		}
	}
	$smarty->assign('options3',$arr_all3);	
	$smarty->assign('selecttype',true);	
	$smarty->assign('selecttype3',true);	
	$smarty->assign('date1',true);
	$smarty->assign('date2',true);	
?>




<!-- Script: -->

<!-- =================================================================== -->

<script type="text/x-handlebars-template" id="ItemListTemplate">

<div class="nav-tabs-custom nav-tabs-custom-edit">
	<div class="row row-edit">

		
		<div class="col-md-1">
			<?=ID;?>
		</div>					
		<div class="col-md-2">
			<?=SUBDRIVERS;?>
		</div>					
		<div class="col-md-1">
			<?=NUMBER_OF_DRIVERS;?>
		</div>	
		<div class="col-md-1">
			<?=FREE_DAYS;?>
		</div>					
		<div class="col-md-1">
			<?=TOTAL_VALUE;?>
		</div>					
		<div class="col-md-1">
			<?=PAY_LATER;?>
		</div>					
		<div class="col-md-1">
			<?=CASH_IN;?>
		</div>					
		<div class="col-md-1">
			<?=EXPENSES;?>
		</div>							
		<div class="col-md-1">
			<?=BALANCE;?>
		</div>							
		<div class="col-md-1">
			<?=SCHEDULE;?>
		</div>							

	</div>	
	{{#each Item}}
		<div>
		
			<div class="row {{color}} pad1em listTile orders-edit cursor-list sum-edit-2"
			id="t_{{DetailsID}}">
				<div class="col-md-1 add-direction">
					{{AuthUserID}}
				</div>
				<div class="col-md-2 add-direction">						
					{{SubDriverName}}
				</div>						
				<div class="col-md-1 add-direction">						
					{{NoT}} 
				</div>	
				<div class="col-md-1 add-direction">						
					{{FreeDays}} 
				</div>							
				<div class="col-md-1">						
					{{Value}} 
				</div>							
				<div class="col-md-1">						
					{{PayLater}} 
				</div>							
				<div class="col-md-1">						
					{{CashIn}} 
				</div>							
				<div class="col-md-1">						
					{{Expenses}} 
				</div>												
				<div class="col-md-1">						
					{{Balance}} 
				</div>						
				<div class="col-md-1">
					<span><a target='_blank' href='schedule/{{Date1}}/{{Date2}}/{{AuthUserID}}'><?=SCHEDULE;?></a></span>
				</div>						
			</div>

		</div>

		<div id="ItemWrapper{{DetailsID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{DetailsID}}" class="row">
				<div id="one_Item{{DetailsID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>
	{{/each}}
</div>	

	<script>

	// Change the icon and sorting:
	async function setSort(field,direction) {
		$('#sortField').val(field);
		$('#sortDirection').val(direction);
	}	
	function allSort(field,direction) {	
		setSort(field,direction).then(function() {allItems();});
	}	
</script>
</script>