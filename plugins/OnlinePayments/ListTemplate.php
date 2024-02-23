<?
	$smarty->assign('selectsolved',true);
	$smarty->assign('date1',true);
	$smarty->assign('date2',true);
?>

<script type="text/x-handlebars-template" id="ItemListTemplate">

<!-- Labels 1: -->
	<div class="row row-edit">
		
		<div class="col-md-1">
			<?=ID;?>
		</div>

		<div class="col-md-1">
			<?=ORDER_NUMBER;?>
		</div>
		
		<div class="col-md-1">
			<?=AVANS;?>/<?=EU;?>
		</div>

		<div class="col-md-1">
			<?=AMOUNT;?>
		</div>

		<div class="col-md-1">
			<?=BUYER;?>
		</div>

		<div class="col-md-1">
			<?=CARD;?>
		</div>	
		
		<div class="col-md-1">
			<?=DRIVERS;?>
		</div>

		<div class="col-md-1">
			<?=DRIVERS_PRICE;?>
		</div>

		<div class="col-md-1">
			<?=DATETIME_1;?>
		</div>

		<div class="col-md-1">
			<?=DATETIME_3;?>
		</div>		
		
		<div class="col-md-1">
			<?=STATUS;?>
		</div>
		
		<div class="col-md-1">
			<?=FISCALBILL;?><br>
			<a href="plugins/OnlinePayments/Payments.csv"><i class="fa fa-download" aria-hidden="true"></i> Download</a>
		</div>
				
	</div>
<!-- Labels 2: -->
	<div class="row row-edit">




				
	</div>

<!-- --------------------------------- -->
<!-- Data from database 1: -->
	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile cursor-list" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-1">
							<a target="_blank" href="
								{{#compare TNo "==" "0"}}
									/orders/order/{{OrderID}}
								{{else}}
									/orders/detail/{{DetailsID}}
								{{/compare}}
							">
								{{OrderID}}{{#compare TNo "!==" "0"}}-{{TNo}}{{/compare}}
							</a><br>
							<a target="_blank" href="https://ipg.monri.com/transactions/{{MonriID}}">{{MonriID}}</a>
						</div>

						<div class="col-md-1">
							<small>{{OrderNumber}}<br>
							{{paymentMethodText PaymentMethod}}</small>
							
						</div>
						
						<div class="col-md-1">
							{{Avans}}/{{EU}}
						</div>

						<div class="col-md-1">
							{{Amount}}
						</div>

						<div class="col-md-1">
							{{Buyer}}
						</div>

						<div class="col-md-1">
							{{Card}}/{{Currency}}
						</div>
						
						<div class="col-md-1">
							<small>{{DriversName1}}
							{{#compare DriversName1 "!==" DriversName2}}
								<br>{{DriversName2}}
							{{/compare}}
							</small>
						</div>

						<div class="col-md-1">
							{{DriverPrice}}
						</div>

						<div class="col-md-1">
							{{datetime1}}
						</div>

						<div class="col-md-1">
							{{datetime3}}
						</div>						
						
						<div class="col-md-1">
							<small>
								{{displayTransferStatusText TransferStatus}}
								<br>{{driverConfText DriverConfStatus}}
							</small>
						</div>

						<div class="col-md-1">
							<input data-id="{{ID}}" type="text" name="FiscalBill" id="FiscalBill" class="w100 form-control" value="{{FiscalBill}}">
						</div>

					</div>
				</div>
<!-- Data from database 2: -->
				<div class="row">
					<div class="col-md-12">

					</div>
				</div>

			</div>

		</div>

	{{/each}}

	<script>

		$('#FiscalBill').change(function(){
			var base=window.rootbase;
			// Doesn't work:
			//if (window.location.host=='localhost') base=base+'/jamtransfer';

			var link = base+'plugins/OnlinePayments/Save.php';
			var id = $(this).attr('data-id');

			var param = 'id='+id+'&'+ $(this).attr('name')+'='+$(this).val();

			console.log(link+'?'+param)

			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
					$('#t_ .VehicleID').val(data);					
					//$('#Vehicle').val(data);
					toastr['success'](window.success);
				}				
			});
			
		})

	</script>



</script>
	

