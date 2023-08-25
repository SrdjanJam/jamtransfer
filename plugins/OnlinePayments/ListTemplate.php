<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- Labels: -->
	<div class="row row-edit">
		
		<div class="col-md-1">
			<?=ID;?>
		</div>

		<div class="col-md-1">
			<?=GATEWAY;?>
		</div>	
		
		<div class="col-md-1">
			<?=ORDER_ID;?>
		</div>	

		<div class="col-md-1">
			<?=CUSTOMER_IP;?>
		</div>	

		<div class="col-md-2">
			<?=ORDER_NUMBER;?>
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

		<div class="col-md-1">
			<?=UPDATED;?>
		</div>		
				
	</div>
	<!-- --------------------------------- -->

	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile cursor-list" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
					<div class="col-md-1">
						<strong>{{ID}}</strong>
					</div>

					<div class="col-md-1">
						{{gateway}}
					</div>

					<div class="col-md-1">
						{{OrderID}}
					</div>

					<div class="col-md-1">
						{{CustomerIP}}
					</div>

					<div class="col-md-2">
						{{OrderNumber}}
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

					<div class="col-md-1">
						{{updated_at}}
					</div>				
					
			</div>
		</div>

	{{/each}}



</script>
	

