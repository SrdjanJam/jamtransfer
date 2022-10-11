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
		<div class="row">
				<div class="col-sm-1">
					Route ID
				</div>							
				<div class="col-sm-3">
					Route Name
				</div>	
				<div class="col-md-1">
					Connected
				</div>				
				<div class="col-md-1">
					Active
				</div>
				<div class="col-md-3">
					<?=SURCATEGORY;?>
				</div>
				<div class="col-md-1">
					Prices
				</div>				
				<div class="col-sm-1">
					Approved						
				</div>
			</div>	
	{{#each Item}}
			<div>		
				<div class="row {{color}} pad1em listTile" 
				style="border-top:1px solid #ddd" 
				id="t_{{RouteID}}">
						
						<div class="col-sm-1">
							{{RouteID}}
						</div>							
						<div class="col-sm-3">
							<strong>{{RouteName}}</strong>
						</div>	
						<div class="col-md-1 route" data-id="{{RouteID}}" data-change="1">
							{{yesNoSlider DriverRoute 'DriverRoute' }}
						</div>						
						<div class="col-md-1 route" data-id="{{RouteID}}" data-change="2">
							{{yesNoSlider Active 'Active' }}
						</div>
						<div class="col-md-3 surcategory" data-status="{{PriceRules2}}" data-id="{{RouteID}}">
							{{SurCategoryRB PriceRules 'SurCategory' '3' 'routes' RouteID}}
						</div>
						<div class="col-md-1">
							<a target='_blank' href='services/route/{{RouteID}}'>Vehicles</a>
						</div>						
						<div class="col-sm-1">
						
							{{#compare Approved ">" 0}}
								<i class="fa fa-check text-green"></i>
							{{else}}
								<i class="fa fa-close text-red"></i>
							{{/compare}}											
						</div>
				</div>
			</div>
	{{/each}}
	<script>
		$('.surcategory').each(function(){
			if ($(this).attr('data-status')==0) $(this).hide();
		});		
		$('.route input').change(function(){
			var change=$(this).parent().parent().attr('data-change');			
			var routeid=$(this).parent().parent().attr('data-id');
			if (change==1) var driverroute=$(this).val();	
			if (change==2) var active=$(this).val();	
			var base=window.location.origin;
			if (window.location.host=='localhost') base=base+'/jamtransfer';
			if (change==1) var link = base+'/plugins/DriverRoutes/Save.php';
			if (change==2) var link = base+'/plugins/DriverRoutes/SaveActive.php';	
			if (change==1) var param = "RouteID="+routeid+"&DriverRoute="+driverroute;
			if (change==2) var param = "RouteID="+routeid+"&Active="+active;
			alert (link+'?'+param);
			var $t = $(this);
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
					if (data==0) $t.parent().parent().parent().find('.surcategory').hide(500);
					else $t.parent().parent().parent().find('.surcategory').show(500);						
				}				
			});
		})	
		$('.surcategory input').change(function(){
			var surcategory=$(this).val();
			var routeid=$(this).parent().parent().attr('data-id');
			var base=window.location.origin;
			if (window.location.host=='localhost') base=base+'/jamtransfer';		
			var link = base+'/plugins/DriverRoutes/Update.php';
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
	
