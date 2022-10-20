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
<!-- <script>alert("Alert");</script> -->
<script type="text/x-handlebars-template" id="ItemListTemplate">
		<div class="row">
			<div class="col-md-3">
				Vehicle Type ID
			</div>

			<div class="col-md-3">
				Vehicle Type Name
			</div>	

			<div class="col-md-3">
				Max
			</div>	

			<div class="col-md-3">
				Description
			</div>
		</div>

	{{#each Item}}
	
			<div>

				<div class="row {{color}} pad1em listTile listTitleEdit"
				style="border-top:1px solid #ddd" 
				id="t_{{VehicleTypeID}}">
						<!-- RouteID: -->
						<div class="col-md-3">
							{{VehicleTypeID}}
						</div>
						<!-- RouteName: -->
						<div class="col-md-3">
							<i class="fa fa-user"></i>{{VehicleTypeName}}
						</div>
						<!-- Connected:  -->
						<div class="col-md-3">
							{{Max}}
						</div>
						<!-- Active: -->
						<div class="col-md-3">
							{{{Description}}}
						</div>
				</div>
				
			</div>

			

	{{/each}}

	<script>
		$('.show_hide').each(function(){
			if ($(this).parent().parent().find('.active1').attr('data-active')==0) $(this).hide();
		});		

		$('.route input').change(function(){
			var change=$(this).parent().parent().attr('data-change');	
			var routeid=$(this).parent().parent().attr('data-id');
			if (change==1) var driverroute=$(this).val();	
			if (change==2) var active=$(this).val();	
			var base=window.location.origin;
			if (window.location.host=='localhost') base=base+'/jamtransfer';
			if (change==1) var link = base+'/plugins/DriverVehicleTypes/Save.php';
			if (change==2) var link = base+'/plugins/DriverVehicleTypes/SaveActive.php';	
			if (change==1) var param = "RouteID="+routeid+"&DriverRoute="+driverroute;
			if (change==2) var param = "RouteID="+routeid+"&Active="+active;
			var $t = $(this);
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
					if (data==0) $t.parent().parent().parent().find('.show_hide').hide(500);
					if (data==1) $t.parent().parent().parent().find('.show_hide').show(500);						
				}				
			});
		})	
		$('.surcategory input').change(function(){
			var surcategory=$(this).val();
			var routeid=$(this).parent().parent().attr('data-id');
			var base=window.location.origin;
			if (window.location.host=='localhost') base=base+'/jamtransfer';		
			var link = base+'/plugins/DriverVehicleTypes/Update.php';
			var param = "RouteID="+routeid+"&SurCategory="+surcategory;
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
				}				
			});
		})	
	</script>

</script>
	
