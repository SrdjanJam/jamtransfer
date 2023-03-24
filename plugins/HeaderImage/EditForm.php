
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
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
						<label for="ID"><?=ID;?></label>
					</div>
					<div class="col-md-9">
						{{ID}}
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label for="ImgDesc"><?=DESCRIPTION;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ImgDesc" id="ImgDesc" class="w100" value="{{ImgDesc}}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label for="Image"><?=IMAGE;?></label>
					</div>
					<div class="col-md-6">
						<input type="text" name="Image" id="Image" class="w100" value="{{Image}}">
					</div>
					<div class="col-md-3">					
						<img height="100px" src="{{Image}}" alt="{{ImgDesc}}">					
					</div>					
				</div>
			</div>
	    </div>
		    

	<!-- Statuses and messages -->
</form>
</script>
	
