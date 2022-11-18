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

<script type="text/x-handlebars-template" id="ItemListTemplate">
	<input type='hidden' id='sortField' name='sortField'/>
	<input type='hidden' id='sortDirection' name='sortDirection'/>
	
	<div class="row">
		<span class="right">
			<i class="fa fa-filter"></i>
			<i id='filtersDown' class="fa fa-angle-down" onclick="filtersDown()"></i>
			<i id='filtersUP' class="fa fa-angle-up" onclick="filtersUP()"></i>	
		</span>
	</div>	
	<div class="row itemsheader">

		<div class="col-md-2 grey">
			<small class="badge blue text-black">Order</small><br>
			<select id='yearsOrder' name='yearsOrder' value='0' onchange="allItems();">
				<option value='0'>All years</option>
			</select>
			<button onclick="allSort('OrderDate','ASC')"><i class="fa fa-sort-asc"></i></button>
			<button onclick="allSort('OrderDate','DESC')"><i class="fa fa-sort-desc"></i></button>
			</br>
			<input id='orderFromID' name='orderFromID'  placeholder="From ID" size='6' onchange="allItems();"/>
			<button onclick="allSort('OrderID','ASC')"><i class="fa fa-sort-asc"></i></button>
			<button onclick="allSort('OrderID','DESC')"><i class="fa fa-sort-desc"></i></button>
		</div>		
		<div class="col-md-2"> 
			<small class="badge blue text-black">Payment</small><br>
			{{paymentMethodSelect PaymentMethod}}<br>
			<input id='paymentNumber' name='paymentNumber'  placeholder="Payment / Invoice No" onchange="allItems();"/>					
		</div>
		<div class="col-md-2 grey"> 
			<small class="badge blue text-black">Transfer</small><br>		
			<select id='yearsPickup' name='yearsPickup' value='0' onchange="allItems();">
				<option value='0'>All years</option>
			</select>		
			<button onclick="allSort('PickupDate','ASC')"><i class="fa fa-sort-asc"></i></button>
			<button onclick="allSort('PickupDate','DESC')"><i class="fa fa-sort-desc"></i></button>			
			</br>
			<input id='locationName' name='locationName'  placeholder="Location Name" onchange="allItems();"/>					
		</div>		
		<div class="col-md-2">
			<small class="badge blue text-black">Driver</small><br>
			<input id='driverName' name='driverName'  placeholder="Driver Name/ID" onchange="allItems();"/><br>				
			{{driverConfStatusSelect DriverConfStatus}}
		</div>			
		<div class="col-md-2 grey">
			<small class="badge blue text-black">Client/Agent</small><br>
			<input id='agentName' name='agentName'  placeholder="Agent Name/ID" onchange="allItems();"/><br>				
			<input id='agentOrder' name='agentOrder'  placeholder="Order Key / Agent Order" onchange="allItems();"/><br>				
		</div>			
		<div class="col-md-2">
			<small class="badge blue text-black">Passenger</small><br>
			<input id='passengerData' name='passengerData'  placeholder="Passenger Data" onchange="allItems();"/>					
		</div>			
	</div>
	{{#each Item}}
		<div>
		
			<div class="row {{color}} pad1em listTile" 
			id="t_{{DetailsID}}">

					<div class="col-md-2 order"  onclick="oneItem({{DetailsID}},'order');">	
						<small>{{OrderDate}} {{MOrderTime}}</small></br>
						<strong>{{MOrderID}} - {{TNo}}</strong><br>
						<small>{{displayTransferStatusText TransferStatus}}</small>
					</div>
					<div class="col-md-2 payment" onclick="oneItem({{DetailsID}},'payment');">
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
					
					<div class="col-md-2 transfer" onclick="oneItem({{DetailsID}},'transfer');">
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
					<div class="col-md-2 pdriver" onclick="oneItem({{DetailsID}},'pdriver');">
						{{!-- userName DriverID "AuthUserCompany" --}}
						{{#if DriverName}}
							<strong><small>{{DriverName}}</small></strong>
						{{/if}}	
						<br>
						{{DriversPrice}} €<br>
						<small class="{{driverConfStyle DriverConfStatus}}">{{driverConfText DriverConfStatus}}</small>
					</div>
					<div class="col-md-2 agent" onclick="oneItem({{DetailsID}},'agent');">
						{{MOrderKey}}<br>
						{{MConfirmFile}}<br>						
						<strong>{{ userName UserID "AuthUserRealName" }}</strong>
					</div>					
					<div class="col-md-2 passenger" onclick="oneItem({{DetailsID}},'passenger');">
						<i class="fa fa-user"></i> <strong>{{PaxName}}</strong><br>
						<small>
							<i class="fa fa-envelope-o"></i> {{MPaxEmail}}
							<br>
							<i class="fa fa-phone"></i> {{MPaxTel}}
						</small>						
					</div>
					{{#if StaffNote}}<small style="color:red">STAFF NOTE</small>{{/if}}				
					{{#if FinalNote}}<small style="color:red">{{FinalNote}}</small>{{/if}}	
					
	
			</div>

		</div>
		<div id="ItemWrapper{{DetailsID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{DetailsID}}" class="row">
				<div id="one_Item{{DetailsID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>
	<hr></hr>
	{{/each}}


</script>
<script>
	async function setSort(field,direction) {
		$('#sortField').val(field);
		$('#sortDirection').val(direction);
	}	
	function allSort(field,direction) {
		setSort(field,direction).then(function() {allItems();});
	}	
</script>	
