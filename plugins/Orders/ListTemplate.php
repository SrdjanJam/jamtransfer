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
	}

	.right-edit a{
		color: #0c81e5;
		background: #dbdbdb;
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


</style>


<!-- Script: -->


<!-- =================================================================== -->

<script type="text/x-handlebars-template" id="ItemListTemplate">

	<input type='hidden' id='sortField' name='sortField'/>
	<input type='hidden' id='sortDirection' name='sortDirection'/>
	
	<div class="row row-sticky filter1">
		<span class="right right-edit">
			<a class="right-a"> 
				<a id='filtersDown' onclick="filtersDown()">Hide Filters <i class="fa fa-angle-down"></i></a>
				<a id='filtersUP' onclick="filtersUP()">Show Filters <i class="fa fa-angle-up"></i></a>
			</a>
		</span>
	</div>

	<div class="row itemsheader2 itemsheader-edit filter2">
		<!-- Order: -->
		<div class="col-md-2">
			<small class="badge blue text-black badge-edit">Order</small><br>

			<select id='yearsOrder' class="select-top-edit" name='yearsOrder' value='0' onchange="allItems();">
				<option value='0'>All years</option>
			</select>
			<input id='orderFromDate' class="datepicker" name='orderFromDate'  placeholder="From Date" size='6' onchange="allItems();"/><br>
			<!-- <button id="OrderDateASC" onclick="allSort('OrderDate','ASC')" class="button-asc-edit"><i class="fa fa-sort-asc"></i></button>
			<button id="OrderDate-DESC" onclick="allSort('OrderDate','DESC')" class="button-desc-edit"><i class="fa fa-sort-desc"></i></button> -->


			<div id="myBtn">
			<!-- <a class="purple-head hover-black" id="myBtn"> -->
				<span id="asc"><i class="fa fa-angle-up"></i></span>
				<span style="display:none;" id="desc"><i class="fa fa-angle-down"></i></span>
			<!-- </a> -->
			</div>


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
			<button onclick="allSort('PickupDate','ASC')" class="button-asc-edit"><i class="fa fa-sort-asc"></i></button>
			<button onclick="allSort('PickupDate','DESC')" class="button-desc-edit"><i class="fa fa-sort-desc"></i></button>			
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
					<div class="col-md-2 agent" onclick="oneItem({{DetailsID}},'agent');">
						{{MOrderKey}}<br>
						{{MConfirmFile}}<br>						
						{{#compare AgentID '>' 0}}
							<img src='i/agents/{{Image}}'>	 
						{{/compare}}	
						<strong>{{UserName}}</strong>
					</div>					
					<div class="col-md-2 passenger" onclick="oneItem({{DetailsID}},'passenger');">
						<i class="fa fa-user"></i> <strong>{{PaxName}}</strong><br>
						<small>
							<i class="fa fa-envelope-o"></i> {{MPaxEmail}}
							<br>
							<i class="fa fa-phone"></i> {{MPaxTel}}
						</small>						
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
	$("#myBtn span").click(function(){
		if($(this).attr("id")=="asc"){
			$(this).parent().find("#asc").hide();
			$(this).parent().find("#desc").show();
			allSort('OrderDate','ASC');
		}else{
			$(this).parent().find("#asc").show();
			$(this).parent().find("#desc").hide();
			allSort('OrderDate','DESC');
		}
	});


	async function setSort(field,direction) {
		$('#sortField').val(field);
		$('#sortDirection').val(direction);
	}	
	function allSort(field,direction) {	
		setSort(field,direction).then(function() {allItems();});
	}	
</script>



</script>




