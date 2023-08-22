
<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">

	<div class="box-header">
		<div class="box-tools pull-right">
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<button class="btn btn-warning" title="<?= CLOSE?>" 
				onclick="return editCloseItem('{{ID}}');">
				<i class="fa fa-close"></i>
				</button>

				<button class="btn btn-danger" title="<?= CANCEL ?>" 
				onclick="return deleteItem('{{ID}}');">
				<i class="fa fa-ban"></i>
				</button>
			<? } ?>	

			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{ID}}');">
			<i class="fa fa-save"></i>
			</button>
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-6">
				<!-- ID: -->
				<div class="row">
					<div class="col-md-2">
						<label for="ID"><?=ID;?></label>
					</div>
					<div class="col-md-10">
						<input type="text" name="ID" id="ID" class="w100" value="{{ID}}">
					</div>
				</div>
				<!-- AGENT_ID: -->
				<div class="row">
					<div class="col-md-2">
						<label for="AgentID"><?=AGENT_ID;?></label>
					</div>
					<div class="col-md-10">
						<input type="text" name="AgentID" id="AgentID" class="w100" value="{{AgentID}}">
					</div>
				</div>
				<!-- ROUTE_ID: -->
				<div class="row">
					<div class="col-md-2">
						<label for="RouteID"><?=ROUTE_ID;?></label>
					</div>
					<div class="col-md-10">
						<input type="text" name="RouteID" id="RouteID" class="w100" value="{{RouteID}}">
					</div>
				</div>
				<!-- VEHICLE_TYPE_ID: -->
				<div class="row">
					<div class="col-md-2">
						<label for="VehicleTypeID"><?=VEHICLE_TYPE_ID;?></label>
					</div>
					<div class="col-md-10">
						<input type="text" name="VehicleTypeID" id="VehicleTypeID" class="w100" value="{{VehicleTypeID}}">
					</div>
				</div>
				<!-- PRICE: -->
				<div class="row">
					<div class="col-md-2">
						<label for="Price"><?=PRICE;?></label>
					</div>
					<div class="col-md-10">
						<input type="text" name="Price" id="Price" class="w100" value="{{Price}}">
					</div>
				</div>
			</div>	
	    </div>
	</div>	
</form>


	<script>
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});
	
	</script>
</script>
	
