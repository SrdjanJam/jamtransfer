<script type="text/x-handlebars-template" id="v4_CountriesEditTemplate">
<form id="v4_CountriesEditForm{{CountryID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_Countries('{{CountryID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Countries('{{CountryID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Countries('{{CountryID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
						<label for="CountryNameEN"><?=COUNTRYNAME.LEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryNameEN" id="CountryNameEN" class="w100" value="{{CountryNameEN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDescEN"><?=COUNTRYDESC.LEN;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDescEN" id="CountryDescEN" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDescEN}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryNameRU"><?=COUNTRYNAME.LRU;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryNameRU" id="CountryNameRU" class="w100" value="{{CountryNameRU}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDescRU"><?=COUNTRYDESC.LRU;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDescRU" id="CountryDescRU" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDescRU}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryNameFR"><?=COUNTRYNAME.LFR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryNameFR" id="CountryNameFR" class="w100" value="{{CountryNameFR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDescFR"><?=COUNTRYDESC.LFR;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDescFR" id="CountryDescFR" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDescFR}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryNameDE"><?=COUNTRYNAME.LDE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryNameDE" id="CountryNameDE" class="w100" value="{{CountryNameDE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDescDE"><?=COUNTRYDESC.LDE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDescDE" id="CountryDescDE" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDescDE}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryNameIT"><?=COUNTRYNAME.LIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryNameIT" id="CountryNameIT" class="w100" value="{{CountryNameIT}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDescIT"><?=COUNTRYDESC.LIT;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDescIT" id="CountryDescIT" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDescIT}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryNameSE"><?=COUNTRYNAME.LSE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryNameSE" id="CountryNameSE" class="w100" value="{{CountryNameSE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDescSE"><?=COUNTRYDESC.LSE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDescSE" id="CountryDescSE" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDescSE}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryNameNO"><?=COUNTRYNAME.LNO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryNameNO" id="CountryNameNO" class="w100" value="{{CountryNameNO}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDescNO"><?=COUNTRYDESC.LNO;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDescNO" id="CountryDescNO" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDescNO}}</textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label for="CountryNameES"><?=COUNTRYNAME.LES;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryNameES" id="CountryNameES" class="w100" value="{{CountryNameES}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDescES"><?=COUNTRYDESC.LES;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDescES" id="CountryDescES" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDescES}}</textarea>
					</div>
				<div class="row">
					<div class="col-md-3">
						<label for="CountryNameNL"><?=COUNTRYNAME.LNL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryNameNL" id="CountryNameNL" class="w100" value="{{CountryNameNL}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDescNL"><?=COUNTRYDESC.LNL;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDescNL" id="CountryDescNL" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDescNL}}</textarea>
					</div>
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
	
