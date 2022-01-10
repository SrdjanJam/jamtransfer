
<script type="text/x-handlebars-template" id="v4_PlaceTypesEditTemplate">
<form id="v4_PlaceTypesEditForm{{PlaceTypeID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_PlaceTypes('{{PlaceTypeID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_PlaceTypes('{{PlaceTypeID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_PlaceTypes('{{PlaceTypeID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
						<label for="PlaceTypeEN"><?=PLACETYPE.LEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceTypeEN" id="PlaceTypeEN" class="w100" value="{{PlaceTypeEN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceTypeRU"><?=PLACETYPE.LRU;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceTypeRU" id="PlaceTypeRU" class="w100" value="{{PlaceTypeRU}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceTypeFR"><?=PLACETYPE.LFR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceTypeFR" id="PlaceTypeFR" class="w100" value="{{PlaceTypeFR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceTypeDE"><?=PLACETYPE.LDE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceTypeDE" id="PlaceTypeDE" class="w100" value="{{PlaceTypeDE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceTypeIT"><?=PLACETYPE.LIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceTypeIT" id="PlaceTypeIT" class="w100" value="{{PlaceTypeIT}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceTypeSE"><?=PLACETYPE.LSE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceTypeSE" id="PlaceTypeSE" class="w100" value="{{PlaceTypeSE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceTypeNO"><?=PLACETYPE.LNO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceTypeNO" id="PlaceTypeNO" class="w100" value="{{PlaceTypeNO}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceTypeES"><?=PLACETYPE.LES;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceTypeES" id="PlaceTypeES" class="w100" value="{{PlaceTypeES}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceTypeNL"><?=PLACETYPE.LNL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceTypeNL" id="PlaceTypeNL" class="w100" value="{{PlaceTypeNL}}">
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

