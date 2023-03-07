
<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{VehicleID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<input type="hidden" name="OwnerID" value="<?= s('UseDriverID')?>">
	<div class="box-header">


		<div class="box-tools pull-right">	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{AuthUserID}}');">
			<i class="fa fa-save"></i>
			</button>
		</div>
	</div>

	<div class="box-body ">

        <div class="row">

			<div class="col-md-4">
				<div class="row">
					<div class="col-md-3">
						<label for="VehicleCapacity"><?=VEHICLETYPEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleTypeID" id="VehicleTypeID" class="w100 form-control" value="">
					</div>
				</div>				
				<div class="row">
					<div class="col-md-3">
						<label for="VehicleCapacity"><?=VEHICLECAPACITY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleCapacity" id="VehicleCapacity" class="w100 form-control" value="">
					</div>
				</div>						
			</div>

			<div class="col-md-8">
				<div class="row">
					<div class="col-md-3">
						<label for="VehicleDescription"><?=VEHICLEDESCRIPTION;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="VehicleDescription" id="VehicleDescription" rows="5" 
					class="textarea form-control" cols="50" style="width:100%"></textarea>
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

