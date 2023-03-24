
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
					<div class="col-md-2">
						<label for="ID"><?=ID;?></label>
					</div>
					<div class="col-md-10">
						{{ID}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label for="DisplayOrder"><?=DISPLAYORDER;?></label>
					</div>
					<div class="col-md-10">
						<input type="text" name="DisplayOrder" id="DisplayOrder" class="w100" value="{{DisplayOrder}}" {{disabled}}>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label for="ServiceEN"><?=SERVICE;?></label>
					</div>
					<div class="col-md-10">
						<input type="text" name="ServiceEN" id="ServiceEN" class="w100" value="{{ServiceEN}}" {{disabled}}>
					</div>
				</div>

				<div class="row {{noEnglish}}">
					<div class="col-md-2">
						<label for="ServiceDE"><?=SERVICE;?>{{Language}}</label>
					</div>
					<div class="col-md-10">
						<input type="text" name="Service{{Language}}" id="Service{{Language}}" class="w100" value="{{ServiceTR}}">
					</div>
				</div>

			</div>
	    </div>
		    
</form>
</script>
	
