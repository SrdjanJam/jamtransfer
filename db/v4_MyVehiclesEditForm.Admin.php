
<script type="text/x-handlebars-template" id="v4_MyVehiclesEditTemplate">
<form id="v4_MyVehiclesEditForm{{VehicleID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NNEW ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?> - {{ID}}</h3>
			<? } ?>
		</div>
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<? if ($inList=='true') { ?>
					<button class="btn" title="<?= CLOSE?>" 
					onclick="return editClosev4_MyVehicles('{{VehicleID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_MyVehicles('{{VehicleID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_MyVehicles('{{VehicleID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_MyVehicles('{{VehicleID}}', '<?= $inList ?>');">
				<i class="ic-print"></i>
				</button>
			<? } ?>	
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label for="VehicleID"><?=VEHICLEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleID" id="VehicleID" class="w100" value="{{VehicleID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="OwnerID"><?=OWNERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="OwnerID" id="OwnerID" class="w100" value="{{OwnerID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleName"><?=VEHICLENAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleName" id="VehicleName" class="w100" value="{{VehicleName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleTypeID"><?=VEHICLETYPEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleTypeID" id="VehicleTypeID" class="w100" value="{{VehicleTypeID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SurCategory"><?=SURCATEGORY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SurCategory" id="SurCategory" class="w100" value="{{SurCategory}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SurID"><?=SURID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SurID" id="SurID" class="w100" value="{{SurID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PriceKm"><?=PRICEKM;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PriceKm" id="PriceKm" class="w100" value="{{PriceKm}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ReturnDiscount"><?=RETURNDISCOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ReturnDiscount" id="ReturnDiscount" class="w100" value="{{ReturnDiscount}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleDescription"><?=VEHICLEDESCRIPTION;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="VehicleDescription" id="VehicleDescription" rows="5" 
					class="textarea" cols="50" style="width:100%">{{VehicleDescription}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleCapacity"><?=VEHICLECAPACITY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleCapacity" id="VehicleCapacity" class="w100" value="{{VehicleCapacity}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleImage"><?=VEHICLEIMAGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleImage" id="VehicleImage" class="w100" value="{{VehicleImage}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleImage2"><?=VEHICLEIMAGE2;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleImage2" id="VehicleImage2" class="w100" value="{{VehicleImage2}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleImage3"><?=VEHICLEIMAGE3;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleImage3" id="VehicleImage3" class="w100" value="{{VehicleImage3}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleImage4"><?=VEHICLEIMAGE4;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleImage4" id="VehicleImage4" class="w100" value="{{VehicleImage4}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AirCondition"><?=AIRCONDITION;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AirCondition" id="AirCondition" class="w100" value="{{AirCondition}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ChildSeat"><?=CHILDSEAT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ChildSeat" id="ChildSeat" class="w100" value="{{ChildSeat}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Music"><?=MUSIC;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Music" id="Music" class="w100" value="{{Music}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TV"><?=TV;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TV" id="TV" class="w100" value="{{TV}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="GPS"><?=GPS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="GPS" id="GPS" class="w100" value="{{GPS}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_MyVehicles('{{VehicleID}}', '<?= $inList ?>');">
    		<i class="ic-cancel-circle"></i> <?= DELETE ?>
    	</button>
    	</div>
    	<? } ?>

	</div>
</form>


	<script>

		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5({
				"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, //Italics, bold, etc. Default true
				"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": true, //Button which allows you to edit the generated HTML. Default false
				"link": true, //Button to insert a link. Default true
				"image": true, //Button to insert an image. Default true,
				"color": true //Button to change color of font 
				
		});
		
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});
	
	</script>
</script>
	