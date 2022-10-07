<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{VehicleID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<button class="btn btn-warning" title="<?= CLOSE?>" 
				onclick="return editCloseItem('{{VehicleID}}');">
				<i class="fa fa-close"></i>
				</button>

				<button class="btn btn-danger" title="<?= CANCEL ?>" 
				onclick="return deleteItem('{{VehicleID}}');">
				<i class="fa fa-ban"></i>
				</button>
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{VehicleID}}');">
			<i class="fa fa-save"></i>
			</button>
		</div>
	</div>
	<div class="box-body ">
        <div class="row">

			<div class="col-md-4">
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
						<label for="RaptorID">RaptorID</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="RaptorID" id="RaptorID" class="w100" value="{{RaptorID}}">				
					</div>
				</div>				
				<div class="row">
					<div class="col-md-2">
						<label for="Active">Active</label>
					</div>
					<div class="col-md-10">
						{{yesNoSliderEdit Active 'Active' }}
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
					class="textarea" cols="50" style="width:100%">{{VehicleDescription}}</textarea>
					</div>
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

