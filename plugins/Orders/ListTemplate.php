<?
	foreach($StatusDescription as $nn => $id) {
		$arr_row['id']=$nn;
		$arr_row['name']=$id;
		$arr_all[]=$arr_row;
	}
	$smarty->assign('options',$arr_all);
	$smarty->assign('selecttype',true);
	
	require_once ROOT.'/db/v4_AuthLevels.class.php';
	$al = new v4_AuthLevels();
	$where = " WHERE AuthLevelID in (2,3,4,5,6,12,41,91)";
	$authLevels = $al->getKeysBy('AuthLevelName', 'asc', $where);
	foreach($authLevels as $nn => $id) {
		$al->getRow($id);
		$arr_row['id']=$al->getAuthLevelID();
		$arr_row['name']=$al->getAuthLevelName();
		$arr_all2[]=$arr_row;
	}
	$smarty->assign('options2',$arr_all2);
	$smarty->assign('selecttype2',true);
	
?>

<style>
	.right-edit{
		border-bottom: 1px solid #1b8aab;
		font-size: 22px;
		background: #c8dff3;
		padding: 1px 5px;
		border-radius: 5px;
		box-shadow: 2px 1px 3px 0px #6ba4e3;
		/* box-shadow: 2px 1px 3px 0px #4a4848; old */
		text-shadow: #4ba7e1 1px 0 2px;
	}

	.right-edit a{
		color: #1186e0;
		/* Old:
		color: #0c81e5;
		background: #dbdbdb; 
		*/
	}

	.right-edit a:hover{
		color: #009efb;
	}

	.inner-edit{
		border-style: none !important;
	}

	.icon h4{
		color: cornflowerblue;
	}

	.grey{
		background-color: #6cd7f3 !important;
	}

	@media only screen and (max-width: 1650px) {
		/* For mobile phones: */
		[class*="col-"] {
			width: 100% !important;
			
		}
		
	}

	@media only screen and (max-width: 1250px) {
		/* For mobile phones: */
		.pad1em{
			flex-direction: column;
		}
		
	}

</style>


<!-- Script: -->


<!-- =================================================================== -->

<script type="text/x-handlebars-template" id="ItemListTemplate">

	
	
	<div class="row row-sticky filter1">
		<span class="right right-edit">
			<a class="right-a"> 
				<a id='filtersDown' onclick="filtersDown()">Hide Filters <i class="fa fa-angle-down"></i></a>
				<a id='filtersUP' onclick="filtersUP()">Show Filters <i class="fa fa-angle-up"></i></a>
			</a>
		</span>
	</div>

	<div class="row itemsheader2 itemsheader-edit filter2">
		<!-- Sorting Order Date and Pickup Date: -->
		<div style="display:block;margin:10px;">
			<select id='sortField' name='sortField' onchange="allItems();">
				<option value="OrderDate">Order Date</option>	
				<option value="PickupDate">Pickup Date</option>		
			</select>	
			<select id='sortDirection' name='sortDirection' onchange="allItems();">
				<option value="ASC">ASC</option>	
				<option value="DESC">DESC</option>		
			</select>
		</div>
		<!-- Order: -->
		<div class="col-md-2">
			<small class="badge blue text-black badge-edit">Order</small><br>

			<select id='yearsOrder' class="select-top-edit" name='yearsOrder' value='0' onchange="allItems();">
				<option value='0'>All years</option>
			</select>
			<input id='orderFromDate' class="datepicker" name='orderFromDate'  placeholder="From Date" size='6' onchange="allItems();"/><br>
		</div>


		<!-- Payment: -->
		<div class="col-md-2"> 
			<small class="badge blue text-black badge-edit">Payment</small><br>
			{{paymentMethodSelect PaymentMethod}}<br>
			<input id='paymentNumber' class="input-one" name='paymentNumber'  placeholder="Payment / Invoice No" onchange="allItems();"/>					
		</div>
		<!-- Transfer: -->
		<div class="col-md-2"> 
			<small class="badge blue text-black badge-edit">Transfer</small><br>
			<input id='pickupFromDate' class="datepicker" name='pickupFromDate'  placeholder="From Date" size='6' onchange="allItems();"/>
			<!--<select id='yearsPickup' class="select-top-edit" name='yearsPickup' value='0' onchange="allItems();">
				<option value='0'>All years</option>
			</select>!-->
			<i class="fa fa-cubes" style="color:#900"></i><input type="checkbox" id="listExtras" name="listExtras"  value="" onchange="allItems();" />
			</br>

			<input id='locationName' class="input-one" name='locationName'  placeholder="Location Name" onchange="allItems();"/>					
		</div>
		<!-- Driver: -->
		<div class="col-md-2">
			<small class="badge blue text-black badge-edit">Partner</small><br>
			<input id='driverName' class="input-one" name='driverName'  placeholder="Name/ID" onchange="allItems();"/><br>				
			{{driverConfStatusSelect "-1" "DriverConfStatusChoose"}}
		</div>
		<!-- Client/Agent: -->
		<div class="col-md-2">
			<small class="badge blue text-black badge-edit">Purchaser</small><br>
			<input id='agentName' class="input-one" name='agentName'  placeholder="Name/ID" onchange="allItems();"/><br>				
			<input id='agentOrder' class="input-one" name='agentOrder'  placeholder="Order Key / Agent Order" onchange="allItems();"/><br>				
		</div>
		<!-- Passenger: -->
		<div class="col-md-2">
			<small class="badge blue text-black badge-edit">Passenger</small><br>
			<input id='passengerData' class="input-one" name='passengerData'  placeholder="Passenger Data" onchange="allItems();"/>					
		</div>			
	</div>



	{{#each Item}}
		<div>
		
			<div class="row {{color}} pad1em listTile listTile-edit" 
			id="t_{{DetailsID}}">

					<div class="col-md-2 order"  onclick="oneItem({{DetailsID}},'order');">	
						<small>{{OrderDate}} {{MOrderTime}}</small></br>
						<strong>{{MOrderID}} - {{TNo}}</strong><br>
						<small>{{displayTransferStatusText TransferStatus}}</small>
						{{#if StaffNote}}<small style="color:red"><i class="fa-solid fa-message"></i></small>{{/if}}				
						{{#if FinalNote}}<small style="color:red"><i class="fa-solid fa-message"></i></small>{{/if}}	
					</div>
					<div class="col-md-2 small-box payment" onclick="oneItem({{DetailsID}},'payment');">
					    <div class="inner inner-edit">
							<strong>{{addNumbers DetailPrice ExtraCharge}} €</strong><br>
							{{paymentMethodText PaymentMethod}} <br>
							<small>
							{{#compare PaymentMethod "==" "1"}} {{MCardNumber}}	{{/compare}}
							{{#compare PaymentMethod "==" "3"}} {{MCardNumber}}	{{/compare}}						
							{{#compare PaymentMethod "==" "2"}} {{DriverInvoiceNumber}}	{{/compare}}
							{{#compare PaymentMethod "==" "4"}} {{InvoiceNumber}} {{/compare}}
							{{#compare PaymentMethod "==" "6"}} {{InvoiceNumber}}	{{/compare}}
							</small>	
						</div>	
						<div class="icon">
							<i class="fa fa-file-invoice" style="font-size:60px;"></i>
						</div>						
					</div>
					
					<div class="col-md-2 small-box transfer" onclick="oneItem({{DetailsID}},'transfer');">
					    <div class="inner inner-edit">
							{{#compare PickupDate ">=" "<?=date('Y')+1;?>-01-01"}}<span class="red-text">{{/compare}}
							{{PickupDate}}
							{{#compare PickupDate ">=" "<?=date('Y')+1;?>-01-01"}}</span>{{/compare}}
							<span>{{PickupTime}}</span>
							</br>
							<strong>{{PickupName}} - {{DropName}}</strong>
							<br>						
							<small><i class="fa fa-car"></i> {{VehicleTypeName}}*{{VehiclesNo}}</small>
							{{#compare ExtraCharge ">" 0}}
								<i class="fa fa-cubes" style="color:#900"></i>
							{{/compare}}
						</div>
						<div class="icon">
							<i class="fa fa-road" style="font-size:60px;"></i>
						</div>							
					</div>
					<div class="col-md-2 small-box pdriver" onclick="oneItem({{DetailsID}},'pdriver');">
					    <div class="inner inner-edit">
							{{#if DriverName}}
								<strong><small>{{DriverName}}</small></strong>
							{{/if}}	
							<br>
							{{DriversPrice}} €<br>
							<small class="{{driverConfStyle DriverConfStatus}}">{{driverConfText DriverConfStatus}}</small>
							{{#if DriverNotes}}<small style="color:red"><i class="fa-solid fa-message"></i></small>{{/if}}				
							{{#if SubFinalNote}}<small style="color:red"><i class="fa-solid fa-message"></i></small>{{/if}}				
						</div>	
						<div class="icon">
							<h4>Driver company</h4>
						</div>						
					</div>
					<div class="col-md-2 small-box agent" onclick="oneItem({{DetailsID}},'agent');">
					    <div class="inner inner-edit">
							{{MOrderKey}}<br>
							{{MConfirmFile}}<br>						
							{{#compare AgentID '>' 0}}
								<img src='i/agents/{{Image}}'>	 
							{{/compare}}	
							<strong>{{UserName}}</strong>
						</div>	
						<div class="icon">
							<h4>Purchaser</h4>
						</div>								
					</div>					
					<div class="col-md-2 small-box passenger" onclick="oneItem({{DetailsID}},'passenger');">
					    <div class="inner inner-edit">					
							<i class="fa fa-user"></i> <strong>{{PaxName}}</strong><br>
							<small>
								<i class="fa fa-envelope-o"></i> {{MPaxEmail}}
								<br>
								<i class="fa fa-phone"></i> {{MPaxTel}}
							</small>
						</div>	
						<div class="icon">
							<i class="fa fa-person" style="font-size:60px;"></i>
						</div>								
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




