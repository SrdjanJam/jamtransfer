<script type="text/x-handlebars-template" id="ItemListTemplate">

<!-- Labels 1: -->
	<div class="row row-edit">
		
		<div class="col-md-1">
			<?=ID;?>
		</div>
		
		<div class="col-md-1">
			<?=ORDER_ID;?>
		</div>	

		<div class="col-md-2">
			<?=ORDER_NUMBER;?>
		</div>

		<div class="col-md-1">
			<?=MONRI_ID;?>
		</div>	
		
		<div class="col-md-1">
			<?=AVANS;?>
		</div>

		<div class="col-md-1">
			<?=EU;?>
		</div>
		
		<div class="col-md-1">
			<?=AMOUNT;?>
		</div>

		<div class="col-md-1">
			<?=BUYER;?>
		</div>

		<div class="col-md-1">
			<?=PICKUP_DATE;?>
		</div>

		<div class="col-md-1">
			<?=FISCALBILL;?>
		</div>
				
	</div>
<!-- Labels 2: -->
	<div class="row row-edit">

		<div class="col-md-1">
			<?=GATEWAY;?>
		</div>	
		
		<div class="col-md-1">
			<?=CUSTOMER_IP;?>
		</div>	

		<div class="col-md-1">
			<?=COUNTRY;?>
		</div>

		<div class="col-md-1">
			<?=CARD;?>
		</div>	
		
		<div class="col-md-1">
			<?=CURRENCY;?>
		</div>

		<div class="col-md-1">
			<?=TYPE;?>
		</div>

		<div class="col-md-1">
			<?=DATETIME_1;?>
		</div>

		<div class="col-md-1">
			<?=DATETIME_2;?>
		</div>

		<div class="col-md-1">
			<?=DATETIME_3;?>
		</div>

		<div class="col-md-1">
			<?=CREATED;?>
		</div>

		<div class="col-md-2">
			<?=UPDATED;?>
		</div>
				
	</div>

<!-- --------------------------------- -->
<!-- Data from database 1: -->
	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile cursor-list" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
				<div class="row">
					<div class="col-md-12" style="color:blue;">
						<div class="col-md-1">
							<strong>{{ID}}</strong>
						</div>

						<div class="col-md-1">
							{{OrderID}}
						</div>

						<div class="col-md-2">
							{{OrderNumber}}
						</div>

						<div class="col-md-1">
							{{MonriID}}
						</div>
						
						<div class="col-md-1">
							{{Avans}}
						</div>

						<div class="col-md-1">
							{{EU}}
						</div>

						<div class="col-md-1">
							{{Amount}}
						</div>

						<div class="col-md-1">
							{{Buyer}}
						</div>

						<div class="col-md-1">
							{{PickupDate}}
						</div>

						<div class="col-md-2">
							<input data-id="{{ID}}" type="text" name="FiscalBill" id="FiscalBill" class="w100 form-control" value="{{FiscalBill}}">
						</div>

					</div>
				</div>
<!-- Data from database 2: -->
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-1">
							<strong>{{gateway}}</strong>
						</div>

						<div class="col-md-1">
							<strong>{{CustomerIP}}</strong>
						</div>

						<div class="col-md-1">
							<strong>{{Country}}</strong>
						</div>

						<div class="col-md-1">
							<strong>{{Card}}</strong>
						</div>

						<div class="col-md-1">
							<strong>{{Currency}}</strong>
						</div>

						<div class="col-md-1">
							{{Type}}
						</div>	

						<div class="col-md-1">
							{{datetime1}}
						</div>

						<div class="col-md-1">
							{{datetime2}}
						</div>

						<div class="col-md-1">
							{{datetime3}}
						</div>

						<div class="col-md-1">
							{{created_at}}
						</div>

						<div class="col-md-2">
							{{updated_at}}
						</div>

					</div>
				</div>

			</div>

		</div>

	{{/each}}

	<script>

		$('input').change(function(){
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
	

