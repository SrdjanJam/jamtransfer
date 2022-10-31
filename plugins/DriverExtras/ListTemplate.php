<?
if (isset($_SESSION['UseDriverID']) && $_SESSION['UseDriverID']>0) {	
	$arr_row['id']=1;
	$arr_row['name']="Connected";
	$arr_all[]=$arr_row;	
	$arr_row['id']=2;
	$arr_row['name']="Not Connected";
	$arr_all[]=$arr_row;	
	$smarty->assign('options',$arr_all);
	$smarty->assign('selecttype',true);
}
?>

<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-1">
			ID
		</div>

		<div class="col-md-4">
			ServiceEN
		</div>	

		<div class="col-md-4">
			Connected
		</div>
					
	</div>

	{{#each Item}}
		
		
		<div class="row {{color}} pad1em listTile listTitleEdit" 
		style="border-top:1px solid #ddd" 
		id="t_{{ID}}">
	
			<div class="col-md-1">
				<strong>{{ID}}</strong>
			</div>

			<div class="col-md-4">
				{{ServiceEN}}
			</div>

			<div class="col-md-4 extras" data-id="{{ID}}" data-change="1" data-active="{{DriverExtras}}">
				{{yesNoSliderEdit DriverExtras 'DriverExtras' }}
			</div>

		</div>
		

	{{/each}}


	<script>

		$('.extras input').change(function(){
			
			var extrasid=$(this).parent().attr('data-id');
				
			var base=window.location.origin;
			if (window.location.host=='localhost') base=base+'/jamtransfer';
			var driverextras=$(this).val();	
			var link = base+'/plugins/DriverExtras/Save.php';
			var param = "ExtrasID="+extrasid+"&DriverExtras="+driverextras;
			var $t = $(this);
			console.log(link+'?'+param);
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

	</script>


</script>
	
