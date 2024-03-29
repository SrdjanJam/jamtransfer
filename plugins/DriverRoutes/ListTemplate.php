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
		<div class="col-sm-1">
			<?=ROUTEID;?>
		</div>							
		<div class="col-sm-2">
			<?=ROUTENAME;?>
		</div>	
		<div class="col-md-1">
			<?=CONNECTED;?>
		</div>				
		<div class="col-md-1">
			<?=ACTIVE;?>
		</div>
		<div class="col-md-1">
			<?=ONETOTWO;?>
		</div>	
		<div class="col-md-1">
			<?=TWOTOONE;?>
		</div>			
		<!-- SURCATEGORY: -->
		<div class="col-md-3">
			<?=SURCATEGORY;?>
		</div>
		<div class="col-md-1">
			<?=PRICE;?>
		</div>				
	</div>

	{{#each Item}}
				
			<div>		
				<div class="row {{color}} pad1em listTile listTitleEdit cursor-list" 
				style="border-top:1px solid #ddd" 
				id="t_{{RouteID}}">
						<!-- RouteID: -->
						<div class="col-sm-1">
							{{RouteID}}
						</div>
						<!-- RouteName: -->
						<div class="col-sm-2">
							<strong>{{RouteName}}</strong>
						</div>
						<!-- Connected:  -->
						<div class="col-md-1 route active1" data-id="{{RouteID}}" data-change="1" data-active="{{DriverRoute}}">
							<span>{{yesNoSliderEdit DriverRoute 'DriverRoute' }}</span>
						</div>
						<!-- Active: -->
						<div class="col-md-1 route active2" data-id="{{RouteID}}" data-change="2" data-active="{{Active}}">
							<span class="show_hide">{{yesNoSliderEdit Active 'Active' }}</span>
						</div>
						<div class="col-md-1 route" data-id="{{RouteID}}" data-change="3">
							<span class="show_hide">{{yesNoSliderEdit OneToTwo 'OneToTwo' }}</span>
						</div>
						<div class="col-md-1 route" data-id="{{RouteID}}" data-change="4">
							<span class="show_hide">{{yesNoSliderEdit TwoToOne 'TwoToOne' }}</span>
						</div>
						<!-- Subcategory: -->
						<div class="col-md-3 surcategory" data-status="{{PriceRules2}}" data-id="{{RouteID}}">
							<span class="show_hide">{{SurCategoryRB PriceRules 'SurCategory' '3' 'routes' RouteID}}</span>
						</div>
						<!-- Prices: -->
						<div class="col-md-1">
							<span class="show_hide"><a target='_blank' href='services/route/{{RouteID}}'><i class="fa fa-link" aria-hidden="true"></i></a></span>
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
			if (change==3) var onetotwo=$(this).val();	
			if (change==4) var twotoone=$(this).val();	
			var base=window.rootbase;
			if (window.location.host=='localhost') base=base+'/jamtransfer';
			if (change==1) var link = base+'/plugins/DriverRoutes/Save.php';
			if (change==2) var link = base+'/plugins/DriverRoutes/SaveActive.php';	
			if (change==3) var link = base+'/plugins/DriverRoutes/SaveOneToTwo.php';	
			if (change==4) var link = base+'/plugins/DriverRoutes/SaveTwoToOne.php';	
			if (change==1) var param = "RouteID="+routeid+"&DriverRoute="+driverroute;
			if (change==2) var param = "RouteID="+routeid+"&Active="+active;
			if (change==3) var param = "RouteID="+routeid+"&OneToTwo="+onetotwo;
			if (change==4) var param = "RouteID="+routeid+"&TwoToOne="+twotoone;
			var $t = $(this);
			console.log(link+'?'+param);
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
					if (data==0) $t.parent().parent().parent().find('.show_hide').hide(500);
					if (data==1) $t.parent().parent().parent().find('.show_hide').show(500);	
					toastr['success'](window.success);				
				}				
			});
		})	
		$('.surcategory input').change(function(){
			var surcategory=$(this).val();
			var routeid=$(this).parent().parent().parent().attr('data-id');
			var base=window.rootbase;
			if (window.location.host=='localhost') base=base+'/jamtransfer';		
			var link = base+'/plugins/DriverRoutes/Update.php';
			var param = "RouteID="+routeid+"&SurCategory="+surcategory;
	
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
	
