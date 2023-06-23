
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

				<div class="row">
					<div class="col-md-3">
						<label for="Type"><?=TYPE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Type" id="Type" class="w100" value="{{Type}}">
					</div>
				</div>				
				<div class="row">
					<div class="col-md-3">
						<label for="Value"><?=VALUE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Value" id="Value" class="w100" value="{{Value}}">
					</div>
				</div>				
				<div class="row">
					<div class="col-md-3">
						<label for="Description"><?=DESCRIPTION;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Description" id="Description" class="w100" value="{{Description}}">
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
	
