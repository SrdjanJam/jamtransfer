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

			<div class="col-md-2">
				<?=SURCATEGORY;?>
			</div>			
			
			<div class="col-md-1">
				<a href="plugins/Services/PriceList_<?= $_SESSION['UseDriverID'] ?>.csv"><i class="fa fa-download" aria-hidden="true"></i> Download</a>
			</div>	
			<div class="col-md-2">			
				</i><input id="uploaded" name="uploaded" type="file" class="form-control">
			</div>	
		</div>				
	</div>

	<!-- dynamically content: -->
	{{#each Item}}
	
		<div class="row {{color}} pad1em listTile listTitleEdit cursor-list" 
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
					<b><input type="text" name="ServicePrice1"  id="ServicePrice1" value="{{ServicePrice1}}" 
						style="width:120px;" data-id="{{ServiceID}}"></b>
					{{ServicePrice1}}
				</div>

				<!-- Discount: -->
				<!-- <div class="col-md-2">
					<input type="text" name="Discount" id="Discount" class="w100" value="{{Discount}}" style="width:120px;">
				</div> -->
			

				<!-- Price rules: -->
				<div class="col-md-5 surcategory" >
					<span data-id="{{ServiceID}}">{{SurCategoryRB PriceRules 'SurCategory' '4' 'services' ServiceID}}</span>
				</div>
			</div>		
			
		</div>

	
	{{/each}}


	<script>
		$('.listTile input').change(function(){
			var base=window.rootbase;
			if (window.location.host=='localhost') base=base+'/jamtransfer';	
			var link = base+'/plugins/Services/Save.php';		

			if ($(this).attr("name")=="ServicePrice1") {
				var ServiceID=$(this).attr("data-id");
				var ServicePrice1=$(this).val();
				var param='ServiceID='+ServiceID+'&ServicePrice1='+ServicePrice1;
			}
			if ($(this).attr("name")=="SurCategory") {
				var ServiceID=$(this).parent().parent().attr("data-id");
				var SurCategory = $(this).val();
				var param='ServiceID='+ServiceID+'&SurCategory='+SurCategory;
			}
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
		
		$('#uploaded').change(function(){
			var formData = new FormData();
			formData.append('file', $('#uploaded')[0].files[0]);
			var base=window.rootbase;			
			var link2 = base+'/plugins/Services/Upload.php';	
			$.ajax({
				url : link2,
				type : 'POST',
				data : formData,
				processData: false,  // tell jQuery not to process the data
				contentType: false,  // tell jQuery not to set contentType
				success : function(data) {
					console.log(data);
					if (data=='1') {
						toastr['success'](window.success);	
						function sleep() {
							location.reload();
						}
						setTimeout(sleep, 500);
					} else 	toastr['error'](window.unsuccess);	
			   }
			})	
		})	
		
	</script>
</script>
	
