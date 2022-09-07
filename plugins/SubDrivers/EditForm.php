<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{DriverID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<button class="btn btn-warning" title="<?= CLOSE?>" 
				onclick="return editCloseItem('{{DriverID}}');">
				<i class="fa fa-close"></i>
				</button>

				<button class="btn btn-danger" title="<?= CANCEL ?>" 
				onclick="return deleteItem('{{DriverID}}');">
				<i class="fa fa-ban"></i>
				</button>
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{DriverID}}');">
			<i class="fa fa-save"></i>
			</button>
		</div>
	</div>
	<div class="box-body ">
        <div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label for="DriverName"><?= NAME ?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverName" id="DriverName" class="w100" value="{{DriverName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverPassword"><?= NEW_PASSWORD ?></label>
					</div>
					<div class="col-md-9">
						<input type="hidden" name="DriverPassword"
							value="{{DriverPassword}}">
						<input type="text"  name="DriverPasswordNew" class="w100">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverEmail"><?= CO_EMAIL ?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverEmail" id="DriverEmail" class="w100" value="{{DriverEmail}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverTel"><?= TELEPHONE ?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverTel" id="DriverTel" class="w100" value="{{DriverTel}}">
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label for="Notes"><?= NOTESS ?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Notes" id="Notes" rows="5" 
					class="textarea" cols="50" style="width:100%">{{Notes}}</textarea>
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

