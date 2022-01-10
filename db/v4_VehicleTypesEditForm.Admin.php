
<script type="text/x-handlebars-template" id="v4_VehicleTypesEditTemplate">
<form id="v4_VehicleTypesEditForm{{VehicleTypeID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_VehicleTypes('{{VehicleTypeID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_VehicleTypes('{{VehicleTypeID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_VehicleTypes('{{VehicleTypeID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_VehicleTypes('{{VehicleTypeID}}', '<?= $inList ?>');">
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
						<label for="VehicleTypeID"><?=VEHICLETYPEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleTypeID" id="VehicleTypeID" class="w100" value="{{VehicleTypeID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleTypeName"><?=VEHICLETYPENAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleTypeName" id="VehicleTypeName" class="w100" value="{{VehicleTypeName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleTypeNameEN"><?=VEHICLETYPENAMEEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleTypeNameEN" id="VehicleTypeNameEN" class="w100" value="{{VehicleTypeNameEN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleTypeNameRU"><?=VEHICLETYPENAMERU;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleTypeNameRU" id="VehicleTypeNameRU" class="w100" value="{{VehicleTypeNameRU}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleTypeNameFR"><?=VEHICLETYPENAMEFR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleTypeNameFR" id="VehicleTypeNameFR" class="w100" value="{{VehicleTypeNameFR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleTypeNameDE"><?=VEHICLETYPENAMEDE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleTypeNameDE" id="VehicleTypeNameDE" class="w100" value="{{VehicleTypeNameDE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleTypeNameIT"><?=VEHICLETYPENAMEIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleTypeNameIT" id="VehicleTypeNameIT" class="w100" value="{{VehicleTypeNameIT}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Min"><?=MIN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Min" id="Min" class="w100" value="{{Min}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Max"><?=MAX;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Max" id="Max" class="w100" value="{{Max}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleClass"><?=VEHICLECLASS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleClass" id="VehicleClass" class="w100" value="{{VehicleClass}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Description"><?=DESCRIPTION;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Description" id="Description" rows="5" 
					class="textarea" cols="50" style="width:100%">{{Description}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DescriptionEN"><?=DESCRIPTIONEN;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="DescriptionEN" id="DescriptionEN" rows="5" 
					class="textarea" cols="50" style="width:100%">{{DescriptionEN}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DescriptionRU"><?=DESCRIPTIONRU;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="DescriptionRU" id="DescriptionRU" rows="5" 
					class="textarea" cols="50" style="width:100%">{{DescriptionRU}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DescriptionFR"><?=DESCRIPTIONFR;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="DescriptionFR" id="DescriptionFR" rows="5" 
					class="textarea" cols="50" style="width:100%">{{DescriptionFR}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DescriptionDE"><?=DESCRIPTIONDE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="DescriptionDE" id="DescriptionDE" rows="5" 
					class="textarea" cols="50" style="width:100%">{{DescriptionDE}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DescriptionIT"><?=DESCRIPTIONIT;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="DescriptionIT" id="DescriptionIT" rows="5" 
					class="textarea" cols="50" style="width:100%">{{DescriptionIT}}</textarea>
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_VehicleTypes('{{VehicleTypeID}}', '<?= $inList ?>');">
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
	