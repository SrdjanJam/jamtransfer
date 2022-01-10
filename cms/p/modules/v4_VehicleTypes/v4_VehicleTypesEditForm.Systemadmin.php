
<script type="text/x-handlebars-template" id="v4_VehicleTypesEditTemplate">
<form id="v4_VehicleTypesEditForm{{VehicleTypeID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NNEW ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?> - {{VehicleTypeName}}</h3>
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
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-4">
						<label for="VehicleTypeID"><?=VEHICLETYPEID;?></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="VehicleTypeID" id="VehicleTypeID" class="w100" value="{{VehicleTypeID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="VehicleTypeName"><?=VEHICLETYPENAME;?></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="VehicleTypeName" id="VehicleTypeName" class="w100" value="{{VehicleTypeName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="Min"><?=MIN;?></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="Min" id="Min" class="w100" value="{{Min}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="Max"><?=MAX;?></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="Max" id="Max" class="w100" value="{{Max}}">
					</div>
				</div>
			</div>

			<div class="col-md-6">
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
						<input type="text" name="Description" id="Description"
 class="w100" value="{{Description}}">
					</div>
				</div>
			</div>
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
	
