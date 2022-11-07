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
				<?=SERVICEPRICE1;?>
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
					<input type="text" name="ServicePrice1" id="ServicePrice1" class="w100" value="{{ServicePrice1}}" style="width:120px;">
				</div>

				<!-- Discount: -->
				<!-- <div class="col-md-2">
					<input type="text" name="Discount" id="Discount" class="w100" value="{{Discount}}" style="width:120px;">
				</div> -->
				

				<!-- Price rules: -->
				<div class="col-md-5 surcategory" data-status="{{PriceRules2}}" data-id="{{ServiceID}}">
					<span class="show_hide">{{SurCategoryRB PriceRules 'SurCategory' '4' 'services' ServiceID}}</span>
				</div>

			</div>		

		</div>

	
	{{/each}}


</script>
	
