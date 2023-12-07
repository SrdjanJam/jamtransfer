<?
	$arr_row['id']=1;
	$arr_row['name']="Connected";
	$arr_all[]=$arr_row;	
	$arr_row['id']=2;
	$arr_row['name']="Not Connected";
	$arr_all[]=$arr_row;	
	$smarty->assign('options',$arr_all);
	$smarty->assign('selecttype',true);
?>

<script type="text/x-handlebars-template" id="ItemListTemplate">

		<div class="row row-edit">
			<div class="col-md-1">
				<?=VEHICLETYPEID;?>
			</div>							
			<div class="col-md-2">
				<?=VEHICLE_TYPE;?>
			</div>	
			<div class="col-md-1">
				<?=CONNECTED;?>
			</div>				
			<!-- SURCATEGORY: -->
			<div class="col-md-3">
				<?=SURCATEGORY;?>
			</div>
			<div class="col-md-1">
				<?=RETURNDISCOUNT;?>
			</div>				
			<div class="col-md-1">
				<?=PRICE;?>/km
			</div>			
			<div class="col-md-1">
				<?=PRICE;?>
			</div>				
			<div class="col-md-1">
				<?=OFF_DUTY;?>
			</div>				
			<div class="col-md-1">
				<?=VEHICLES;?>
			</div>				

		</div>

	{{#each Item}}

			<div>		
				<div class="row {{color}} pad1em cursor-list" 
				style="border-top:1px solid #ddd" 
				id="t_{{VehicleTypeID}}">
						<!-- VehicleTypeID: -->
						<div class="col-md-1">
							{{VehicleTypeID}}
						</div>
						<!-- VehicleTypeName: -->
						<div class="col-md-2">
							<strong>{{VehicleTypeName}}</strong>
						</div>
						<!-- Connected:  -->
						<div class="col-md-1 vehicle active1" data-id="{{VehicleTypeID}}" data-change="1" data-active="{{DriverVehicle}}">
							<span>{{yesNoSliderEdit DriverVehicle 'DriverVehicle' }}</span>
						</div>
						<!-- Subcategory: -->
						<div class="col-md-3 surcategory" data-status="{{PriceRules2}}" data-id="{{VehicleID}}">
							<span class="show_hide">{{SurCategoryRB PriceRules 'SurCategory' '2' 'vehicles' VehicleID}}</span>
						</div>
						<!-- Return Discount -->
						<div class="col-md-1 return" data-id="{{VehicleTypeID}}" data-name="{{ReturnDiscount}}">
							<input type="text" name="ReturnDiscount" id="ReturnDiscount"  class="w10 show_hide" value="{{ReturnDiscount}}" style="width:100%;" >
						</div>							
						<!-- Price per KM -->
						<div class="col-md-1 pricekm" data-id="{{VehicleTypeID}}" data-name="{{PriceKm}}">
							<input type="text" name="PriceKm" id="PriceKm"  class="w10 show_hide" value="{{PriceKm}}" style="width:100%;" >
						</div>				
						<!-- Prices: -->
						<div class="col-md-1">
							<span class="show_hide"><a target='_blank' href='services/vehicleType/{{VehicleTypeID}}'><i class="fa fa-link" aria-hidden="true"></i></a></span>
						</div>
						<!-- Dates: -->
						<div class="col-md-1">
							<span class="show_hide"><a target='_blank' href='offDuty/{{VehicleID}}'><i class="fa fa-link" aria-hidden="true"></i></a></span>
						</div>						
						<!-- Vehicles: -->
						<div class="col-md-1">
							<span class="show_hide"><a target='_blank' href='subVehicles/{{VehicleTypeID}}'><i class="fa fa-link" aria-hidden="true"></i></a></span>
						</div>
				</div>
			</div>

	{{/each}}
	<script>
		$('.show_hide').each(function(){
			if ($(this).parent().parent().find('.active1').attr('data-active')==0) $(this).hide();
		});		

		$('.vehicle input').change(function(){
			var change=$(this).parent().parent().attr('data-change');	
			var vehicleid=$(this).parent().parent().attr('data-id');
			if (change==1) var drivervehicle=$(this).val();	
			var base=window.rootbase;
			if (window.location.host=='localhost') base=base+'/jamtransfer';
			if (change==1) var link = base+'/plugins/DriverVehicleTypes/Save.php';
			if (change==1) var param = "VehicleTypeID="+vehicleid+"&DriverVehicle="+drivervehicle;
			var $t = $(this);
			console.log(link+'?'+param);
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
					if (data==0) $t.parent().parent().parent().find('.show_hide').hide(500);
					if (data>0) $t.parent().parent().parent().find('.show_hide').show(500);
					toastr['success'](window.success);							
				}				
			});
		})	
		$('.surcategory input').change(function(){
			var surcategory=$(this).val();
			var vehicleid=$(this).parent().parent().parent().attr('data-id');
			var base=window.rootbase;
			if (window.location.host=='localhost') base=base+'/jamtransfer';		
			var link = base+'/plugins/DriverVehicleTypes/Update.php';
			var param = "VehicleTypeID="+vehicleid+"&SurCategory="+surcategory;
			console.log(link+'?'+param);
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
        			toastr['success'](window.success);				
    			}			
			});
		})			
		$('.return input').change(function(){
			var returndiscount=$(this).val();
			var vehicleid=$(this).parent().attr('data-id');
			var base=window.rootbase;
			if (window.location.host=='localhost') base=base+'/jamtransfer';		
			var link = base+'/plugins/DriverVehicleTypes/Update.php';
			var param = "VehicleTypeID="+vehicleid+"&ReturnDiscount="+returndiscount;
			console.log(link+'?'+param);
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
        			toastr['success'](window.success);				
    			}			
			});
		})			
		$('.pricekm input').change(function(){
			var pricekm=$(this).val();
			var vehicleid=$(this).parent().attr('data-id');
			var base=window.rootbase;
			if (window.location.host=='localhost') base=base+'/jamtransfer';		
			var link = base+'/plugins/DriverVehicleTypes/Update.php';
			var param = "VehicleTypeID="+vehicleid+"&PriceKm="+pricekm;
			console.log(link+'?'+param);
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
        			toastr['success'](window.success);				
    			}			
			});
		})	
	</script>

</script>
	
