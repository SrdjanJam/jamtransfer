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
			<?=SERVICE_ID;?>
		</div>

		<div class="col-md-4">
			<?=SERVICEEN;?>
		</div>	

		<div class="col-md-2">
			<?=CONNECTED;?>
		</div>		
		
		<div class="col-md-1">
			Driver Price
		</div>		
		
		<div class="col-md-1">
			Provision (%)
		</div>		
		
		<div class="col-md-1">
			<?= PRICE ?>
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

			<div class="col-md-2 extras active1" data-id="{{ID}}" data-name="{{ServiceEN}}" data-change="1" data-active="{{DriverExtras}}">
				{{yesNoSliderEdit DriverExtras 'DriverExtras' }}
			</div>

			<!-- DriverPrice -->
			<div class="col-md-1 extras" data-id="{{ID}}">
				<input type="text" name="DriverPrice" id="DriverPrice"  class="w10 show_hide" value="{{DriverPrice}}" style="width:100%;" >
			</div>			
			
			<!-- Provisoin -->
			<div class="col-md-1 extras" data-id="{{ID}}">
				<input type="text" name="Provision" id="Provision"  class="w10 show_hide" value="{{Provision}}" style="width:100%;" >
			</div>		
			
			<!-- Price -->
			<div class="col-md-1 extras" data-id="{{ID}}">
				<span class="price">{{Price}}</span>
			</div>

		</div>
		

	{{/each}}


	<script>
		$('.show_hide').each(function(){
			if ($(this).parent().parent().find('.active1').attr('data-active')==0) $(this).hide();
		});	
		
		$('.extras input').change(function(){
			
			var extrasid=$(this).parent().attr('data-id');
			var extrasname=$(this).parent().attr('data-name');
			var driverextras=$(this).val();				
			if ($(this).attr('name')=='DriverPrice') {
				
				var driverprice=$(this).val();
				var provision=$(this).parent().parent().find('#Provision').val();
				driverextras=1;
			}
			else if ($(this).attr('name')=='Provision') {
				var provision=$(this).val();
				var driverprice=$(this).parent().parent().find('#DriverPrice').val();
				driverextras=1;
			}	
			else {
				var driverprice=0;	
				var provision=0;	
			}	
			var base=window.rootbase;

			if (window.location.host=='localhost') base=base+'/jamtransfer';
			var link = base+'/plugins/DriverExtras/Save.php';
			var param = "ExtrasID="+extrasid+"&ExtrasName="+extrasname+"&DriverPrice="+driverprice+"&Provision="+provision+"&DriverExtras="+driverextras+'&callback=?';
			var $t = $(this);
			console.log(link+'?'+param);
			$.ajax({
				type: 'GET',
				url: link+'?'+param,
				async: false,
				contentType: "application/json",
				dataType: 'jsonp',
				success: function(data) {
					$t.parent().parent().find('.price').html(data.price);					
					if (data.driverextras==0) {
						$t.parent().parent().find('.show_hide').hide(500);
						$t.parent().parent().find('.show_hide').val(0);
						$t.parent().parent().find('.price').html('');
					}	
					if (data.driverextras==1) $t.parent().parent().find('.show_hide').show(500);
					toastr['success'](window.success);	
				}				
			});
		})	

	</script>


</script>
	
