
<script type="text/x-handlebars-template" id="v4_LabelsEditTemplate">
<form id="v4_LabelsEditForm{{LabelID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_Labels('{{LabelID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Labels('{{LabelID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Labels('{{LabelID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Labels('{{LabelID}}', '<?= $inList ?>');">
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
						<label for="LabelID"><?=PLACETYPEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="LabelID" id="LabelID" class="w100" value="{{LabelID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Label"><?=PLACETYPE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Label" id="Label" class="w100" value="{{Label}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="LabelEN"><?=PLACETYPEEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="LabelEN" id="LabelEN" class="w100" value="{{LabelEN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="LabelRU"><?=PLACETYPERU;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="LabelRU" id="LabelRU" class="w100" value="{{LabelRU}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="LabelFR"><?=PLACETYPEFR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="LabelFR" id="LabelFR" class="w100" value="{{LabelFR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="LabelDE"><?=PLACETYPEDE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="LabelDE" id="LabelDE" class="w100" value="{{LabelDE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="LabelIT"><?=PLACETYPEIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="LabelIT" id="LabelIT" class="w100" value="{{LabelIT}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_Labels('{{LabelID}}', '<?= $inList ?>');">
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
	