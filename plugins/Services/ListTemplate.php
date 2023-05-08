<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- Header labels: -->
	<div class="row row-edit">
		<div class="col-md-12">
			<div class="col-md-1">
				<?=SERVICE_ID;?>
			</div>

			<div class="col-md-2">
				<?=ROUTENAME;?>
			</div>	

			<div class="col-md-2">
				<?=VEHICLETYPENAME;?>
			</div>

			<div class="col-md-2">
				<?=SERVICEPRICE1;?> --- Last Change
			</div>
			
			<!-- <div class="col-md-2">
				<?=DISCOUNT;?>
			</div> -->

			<div class="col-md-5">
				<?=SURCATEGORY;?>
			</div>
			
		</div>				
	</div>

	<!-- dynamically content: -->
	{{#each Item}}
	
		<div class="row {{color}} pad1em listTile listTitleEdit" 
		style="border-top:1px solid #ddd" 
		id="t_{{ServiceID}}">

			<div class="col-md-12">
				<input type="hidden" name="ServiceID" id="ServiceID" value="{{ServiceID}}"">

				<!-- ServiceID -->
				<div class="col-md-1">
					{{ServiceID}}
				</div>
				
				<!-- RouteName: -->
				<div class="col-md-2">
					{{RouteName}}
				</div>	
				
				<!-- VehicleTypeName: -->
				<div class="col-md-2">
					{{VehicleTypeName}}
				</div>
				
				<!-- ServicePrice1(Active Prace): -->				
				<div class="col-md-2">
					<b><input type="text" name="ServicePrice1"  id="ServicePrice1" value="{{ServicePrice1}}" style="width:120px;"></b>
					{{ServicePrice1}}
				</div>

				<!-- Discount: -->
				<!-- <div class="col-md-2">
					<input type="text" name="Discount" id="Discount" class="w100" value="{{Discount}}" style="width:120px;">
				</div> -->
			

				<!-- Price rules: -->
				<div class="col-md-5 surcategory" >
					<span>{{SurCategoryRB PriceRules 'SurCategory' '4' 'services' ServiceID}}</span>
				</div>
			</div>		
			
		</div>

	
	{{/each}}


	<script>
		$('input').change(function(){
			var base=window.rootbase;
			if (window.location.host=='localhost') base=base+'/jamtransfer';	
			var link = base+'/plugins/Services/Save.php';			
			var ServiceID=$('#ServiceID').val();
			var ServicePrice1=$('#ServicePrice1').val();
			var SurCategory = $('input[name="SurCategory"]:checked').val();
			var param='ServiceID='+ServiceID+'&ServicePrice1='+ServicePrice1+'&SurCategory='+SurCategory;
			console.log(link+'?'+param);
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
	
