<?
	foreach($StatusDescription as $nn => $id) {
		$arr_row['id']=$nn;
		$arr_row['name']=$id;
		$arr_all[]=$arr_row;
	}
	$smarty->assign('options',$arr_all);
	$smarty->assign('selecttype',true);
?>

<script type="text/x-handlebars-template" id="ItemListTemplate">
	<input type='hidden' id='sortField' name='sortField'/>
	<input type='hidden' id='sortDirection' name='sortDirection'/>
	
	<div class="row">
		<div class="col-md-2 xorange">
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
		<div class="col-md-2 amber"> 
			{{paymentMethodSelect PaymentMethod}}<br>
			<input id='paymentNumber' name='paymentNumber'  placeholder="Payment / Invoice No" onchange="allItems();"/>					
		</div>
		<div class="col-md-2 yellow">
			<select id='yearsPickup' name='yearsPickup' value='0' onchange="allItems();">
				<option value='0'>All years</option>
			</select>		
			<button onclick="allSort('PickupDate','ASC')"><i class="fa fa-sort-asc"></i></button>
			<button onclick="allSort('PickupDate','DESC')"><i class="fa fa-sort-desc"></i></button>			
			</br>
			<input id='locationName' name='locationName'  placeholder="Location Name" onchange="allItems();"/>					
		</div>		
		<div class="col-md-2 lime">
			<input id='driverName' name='driverName'  placeholder="Driver Name/ID" onchange="allItems();"/><br>				
			{{driverConfStatusSelect DriverConfStatus}}
		</div>			
		<div class="col-md-2 xgreen">
			<input id='agentName' name='agentName'  placeholder="Agent Name/ID" onchange="allItems();"/><br>				
			<input id='agentOrder' name='agentOrder'  placeholder="Order Key / Agent Order" onchange="allItems();"/><br>				
		</div>			
		<div class="col-md-2 grey">
			<input id='passengerData' name='passengerData'  placeholder="Passenger Data" onchange="allItems();"/>					
		</div>			
	</div>
	{{#each Item}}
		<div><!--- onclick="oneItem({{DetailsID}});" !-->
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #eee;border-bottom:0px solid #eee" 
			id="t_{{DetailsID}}">

					<div class="col-md-2 xorange">
						<small>{{OrderDate}} {{MOrderTime}}</small></br>
						<strong>{{DetailsID}} {{MOrderID}} - {{TNo}}</strong><br>
						<small>{{displayTransferStatusText TransferStatus}}</small>
					</div>
					<div class="col-md-2 amber">
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
					
					<div class="col-md-2 yellow">
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
					<div class="col-md-2 lime">
						{{!-- userName DriverID "AuthUserCompany" --}}
						{{#if DriverName}}
							<strong><small>{{DriverName}}</small></strong>
						{{/if}}	
						<br>
						{{DriversPrice}} €<br>
						<small class="{{driverConfStyle DriverConfStatus}}">{{driverConfText DriverConfStatus}}</small>
					</div>
					<div class="col-md-2 xgreen">
						{{MOrderKey}}<br>
						{{MConfirmFile}}<br>						
						<strong>{{ userName UserID "AuthUserRealName" }}</strong>
					</div>					
					<div class="col-md-2 grey">
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
