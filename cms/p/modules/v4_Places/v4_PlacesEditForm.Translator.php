
<script type="text/x-handlebars-template" id="v4_PlacesEditTemplate">
<form id="v4_PlacesEditForm{{PlaceID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NNEW ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?> - {{PlaceID}}</h3>
			<? } ?>
		</div>
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<? if ($inList=='true') { ?>
					<button class="btn" title="<?= CLOSE?>" 
					onclick="return editClosev4_Places('{{PlaceID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Places('{{PlaceID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Places('{{PlaceID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
						<label for="PlaceNameEN"><?=PLACENAME.LEN;?></label> 
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceNameEN" id="PlaceNameEN" class="w100" value="{{PlaceNameEN}}">
					</div>
				</div>
				<input type="hidden" name="PlaceNameENold" id="PlaceNameENold" value="{{PlaceNameEN}}">


				<div class="row">
					<div class="col-md-3">
						<label for="PlaceDescEN"><?=PLACEDESC.LEN;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="PlaceDescEN" id="PlaceDescEN" rows="5" 
					class="textarea" cols="50" style="width:100%">{{PlaceDescEN}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceNameRU"><?=PLACENAME.LRU;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceNameRU" id="PlaceNameRU" class="w100" value="{{PlaceNameRU}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceDescRU"><?=PLACEDESC.LRU;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="PlaceDescRU" id="PlaceDescRU" rows="5" 
					class="textarea" cols="50" style="width:100%">{{PlaceDescRU}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceNameFR"><?=PLACENAME.LFR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceNameFR" id="PlaceNameFR" class="w100" value="{{PlaceNameFR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceDescFR"><?=PLACEDESC.LFR;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="PlaceDescFR" id="PlaceDescFR" rows="5" 
					class="textarea" cols="50" style="width:100%">{{PlaceDescFR}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceNameDE"><?=PLACENAME.LDE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceNameDE" id="PlaceNameDE" class="w100" value="{{PlaceNameDE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceDescDE"><?=PLACEDESC.LDE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="PlaceDescDE" id="PlaceDescDE" rows="5" 
					class="textarea" cols="50" style="width:100%">{{PlaceDescDE}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceNameIT"><?=PLACENAME.LIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceNameIT" id="PlaceNameIT" class="w100" value="{{PlaceNameIT}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceDescIT"><?=PLACEDESC.LIT;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="PlaceDescIT" id="PlaceDescIT" rows="5" 
					class="textarea" cols="50" style="width:100%">{{PlaceDescIT}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceNameSE"><?=PLACENAME.LSE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceNameSE" id="PlaceNameSE" class="w100" value="{{PlaceNameSE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceDescSE"><?=PLACEDESC.LSE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="PlaceDescSE" id="PlaceDescSE" rows="5" 
					class="textarea" cols="50" style="width:100%">{{PlaceDescSE}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceNameNO"><?=PLACENAME.LNO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceNameNO" id="PlaceNameNO" class="w100" value="{{PlaceNameNO}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceDescNO"><?=PLACEDESC.LNO;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="PlaceDescNO" id="PlaceDescNO" rows="5" 
					class="textarea" cols="50" style="width:100%">{{PlaceDescNO}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceNameES"><?=PLACENAME.LES;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceNameES" id="PlaceNameES" class="w100" value="{{PlaceNameES}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceDescES"><?=PLACEDESC.LES;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="PlaceDescES" id="PlaceDescES" rows="5" 
					class="textarea" cols="50" style="width:100%">{{PlaceDescES}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceNameNL"><?=PLACENAME.LNL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceNameNL" id="PlaceNameNL" class="w100" value="{{PlaceNameNL}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceDescNL"><?=PLACEDESC.LNL;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="PlaceDescNL" id="PlaceDescNL" rows="5" 
					class="textarea" cols="50" style="width:100%">{{PlaceDescNL}}</textarea>
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
	
