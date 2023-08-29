
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
				<!-- TITLE: -->
				<div class="row">
					<div class="col-md-2">
						<label for="Title"><?=TITLE;?></label>
					</div>
					<div class="col-md-10">
						<input type="text" name="Title" id="Title" class="w100" value="{{Title}}">
					</div>
				</div>
				<!-- URL: -->
				<div class="row">
					<div class="col-md-2">
						<label for="Url"><?=URL;?></label>
					</div>
					<div class="col-md-10">
						<input type="text" name="Url" id="Url" class="w100" value="{{Url}}">
					</div>
				</div>
				<!-- IMAGE: -->
				<div class="row">
					<div class="col-md-2">
						<label for="Image"><?=IMAGE;?></label>
					</div>
					<div class="col-md-10">
						<input type="text" name="Image" id="Image" class="w100" value="{{Image}}">
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
	
