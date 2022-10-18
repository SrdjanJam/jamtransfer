<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{id}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">

		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<button class="btn btn-warning" title="<?= CLOSE ?>" 
				onclick="return editCloseItem('{{id}}');">
				<i class="fa fa-close"></i>
				</button>

				<button class="btn btn-danger" title="<?= CANCEL ?>" 
				onclick="return deleteItem('{{id}}');">
				<i class="fa fa-ban"></i>
				</button>
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{id}}');">
			<i class="fa fa-save"></i>
			</button>
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-6 col-md-offset-3">
				
				<div class="row">
					<div class="col-md-3">
						<label for="id"><?=ID;?></label>
					</div>
					<div class="col-md-9">
						{{id}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="key"><?=KEY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="key" id="key" class="w100" value="{{key}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="text"><?=TEXT;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="text" id="text" class="w100">{{text}}</textarea>
					</div>
					
				</div>
				
				
			</div><!-- End of .box-body -->
	    </div> <!-- End of .row -->
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
