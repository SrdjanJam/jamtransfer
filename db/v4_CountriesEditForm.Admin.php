
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
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Countries('{{CountryID}}', '<?= $inList ?>');">
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
						<label for="CountryID"><?=COUNTRYID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryID" id="CountryID" class="w100" value="{{CountryID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryName"><?=COUNTRYNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryName" id="CountryName" class="w100" value="{{CountryName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryNameEN"><?=COUNTRYNAMEEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryNameEN" id="CountryNameEN" class="w100" value="{{CountryNameEN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryNameRU"><?=COUNTRYNAMERU;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryNameRU" id="CountryNameRU" class="w100" value="{{CountryNameRU}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryNameFR"><?=COUNTRYNAMEFR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryNameFR" id="CountryNameFR" class="w100" value="{{CountryNameFR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryNameDE"><?=COUNTRYNAMEDE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryNameDE" id="CountryNameDE" class="w100" value="{{CountryNameDE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryNameIT"><?=COUNTRYNAMEIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryNameIT" id="CountryNameIT" class="w100" value="{{CountryNameIT}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDesc"><?=COUNTRYDESC;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDesc" id="CountryDesc" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDesc}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDescEN"><?=COUNTRYDESCEN;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDescEN" id="CountryDescEN" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDescEN}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDescRU"><?=COUNTRYDESCRU;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDescRU" id="CountryDescRU" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDescRU}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDescFR"><?=COUNTRYDESCFR;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDescFR" id="CountryDescFR" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDescFR}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDescDE"><?=COUNTRYDESCDE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDescDE" id="CountryDescDE" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDescDE}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryDescIT"><?=COUNTRYDESCIT;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="CountryDescIT" id="CountryDescIT" rows="5" 
					class="textarea" cols="50" style="width:100%">{{CountryDescIT}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryISO"><?=COUNTRYISO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryISO" id="CountryISO" class="w100" value="{{CountryISO}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryCode"><?=COUNTRYCODE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryCode" id="CountryCode" class="w100" value="{{CountryCode}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryCode3"><?=COUNTRYCODE3;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryCode3" id="CountryCode3" class="w100" value="{{CountryCode3}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PhonePrefix"><?=PHONEPREFIX;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PhonePrefix" id="PhonePrefix" class="w100" value="{{PhonePrefix}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Currency"><?=CURRENCY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Currency" id="Currency" class="w100" value="{{Currency}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_Countries('{{CountryID}}', '<?= $inList ?>');">
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
	