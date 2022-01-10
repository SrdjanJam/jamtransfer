
<script type="text/x-handlebars-template" id="v4_SettingsEditTemplate">
<form id="v4_SettingsEditForm{{id}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_Settings('{{id}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Settings('{{id}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Settings('{{id}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Settings('{{id}}', '<?= $inList ?>');">
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
						<label for="id"><?=ID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="id" id="id" class="w100" value="{{id}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="userid"><?=USERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="userid" id="userid" class="w100" value="{{userid}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="setkey"><?=SETKEY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="setkey" id="setkey" class="w100" value="{{setkey}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="setval"><?=SETVAL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="setval" id="setval" class="w100" value="{{setval}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="settype"><?=SETTYPE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="settype" id="settype" class="w100" value="{{settype}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_Settings('{{id}}', '<?= $inList ?>');">
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
	