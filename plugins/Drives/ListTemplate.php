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
	<ul class="nav nav-tabs dorder">
		<li class="active"><a href="#tab_1" data-toggle="tab"><?=LIST_ORDER;?></a></li>
		<li><a href="#tab_2" data-toggle="tab"><?=REPORTER;?></a></li>
	</ul>
	<div class="tab-content tab-content-edit">	
		<div class="tab-pane active" id="tab_1">
			<div class="row row-edit">

				<div class="col-md-1">
					<?=ORDERID;?>
				</div>					
				<div class="col-md-1">
					<?=PICKUP_DATE;?>
				</div>				
				<div class="col-md-1">
					<?=PICKUP_TIME;?>
				</div>					
				<div class="col-md-2">
					<?=SUBDRIVERS;?>
				</div>					
				<div class="col-md-2">
					<?=VEHICLES;?>
				</div>							
				<div class="col-md-2">
					<?=ROUTES;?>
				</div>					
				<div class="col-md-1">
					<?=STATUS;?>
				</div>					
				<div class="col-md-1">
					<?=CASH;?>
				</div>	
			</div>	
			{{#each Item}}
				<div>
				
					<div class="row {{color}} pad1em listTile listTile-edit orders-edit" 
					id="t_{{DetailsID}}">
						<div class="col-md-1">
							<a href="orders/detail/{{DetailsID}}" target="_blank">{{OrderID}}-{{TNo}}</a>
						</div>
						<div class="col-md-1">						
							{{SubPickupDate}} 
						</div>						
						<div class="col-md-1">						
							{{SubPickupTime}} 
						</div>						
						<div class="col-md-2">						
							{{SubDriverName}}
						</div>						
						<div class="col-md-2">						
							{{Vehicle}} {{#compare VehicleNo ">" 1}}{{VehicleNo}} <i class="fa fa-car" aria-hidden="true"></i>{{/compare}}
						</div>						
						<div class="col-md-2">						
							{{PickupName}}-{{DropName}}
						</div>						
						<div class="col-md-1">						
							{{displayDriverConfStatusText DriverConfStatus}}
						</div>							
						{{#compare PayLater ">" 0}}
						<div class="col-md-1">
							{{PayLater}}/{{CashIn}}
						</div>		
						{{/compare}}
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

		<!-- Reporter: -->
		<div class="tab-pane" id="tab_2">
			<div id="sum" class="sum-edit sum-edit-labels">


			</div> <!-- End of #sum -->
		
			{{#each Item2}}
				<div id="sum" class="sum-edit sum-edit-2">
					{{sdid}} {{not}}
				</div> <!-- End of #sum -->
			{{/each}}
		</div>	

	</div>
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