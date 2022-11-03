
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

				<div class="row">
					<div class="col-md-2">
						<label for="ServiceDE"><?=SERVICE;?>{{Language}}</label>
					</div>
					<div class="col-md-10">
						<input type="text" name="Service{{Language}}" id="Service{{Language}}" class="w100" value="{{ServiceTR}}">
					</div>
				</div>

			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? /*if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deleteItem('{{ID}}', '<?= $inList ?>');">
    		<i class="ic-cancel-circle"></i> <?= DELETE ?>
    	</button>
    	</div>
    	<? } */?>

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
	
