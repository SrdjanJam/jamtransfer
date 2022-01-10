<script type="text/x-handlebars-template" id="v4_PlacesEditTemplate">
<form id="v4_PlacesEditForm{{PlaceID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NEWW ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?> - {{PlaceNameEN}}</h3>
			<? } ?>
		</div>
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<? if ($inList=='true') { ?>
					<button class="btn btn-warning" title="<?= CLOSE?>" 
					onclick="return editClosev4_Places('{{PlaceID}}', '<?= $inList ?>');">
					<i class="ic-close"></i>
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
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Places('{{PlaceID}}', '<?= $inList ?>');">
				<i class="ic-print"></i>
				</button>
			<? } ?>	
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<div class="row hidden">
					<div class="col-md-3">
						<label for="PlaceID"><?=PLACEID;?></label>
					</div>
					<div class="col-md-9">
						{{PlaceID}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceCountry"><?=PLACECOUNTRY;?></label>
					</div>
					<div class="col-md-9">
						{{countrySelect PlaceCountry 'PlaceCountry' 'ID'}}
					</div>
				</div>

<!--				<div class="row">-->
<!--					<div class="col-md-3">-->
<!--						<label for="CountryNameEN"><?=COUNTRYNAMEEN;?></label>-->
<!--					</div>-->
<!--					<div class="col-md-9">-->
						<input type="hidden" name="CountryNameEN" id="CountryNameEN" class="w100" value="{{CountryNameEN}}">
<!--					</div>-->
<!--				</div>-->

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceNameEN"><?=PLACENAMEEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceNameEN" id="PlaceNameEN" class="w100" value="{{PlaceNameEN}}">
					</div>
				</div>
				<input type="hidden" name="PlaceNameENold" id="PlaceNameENold" value="{{PlaceNameEN}}"> 

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceNameSEO"><?=PLACENAMESEO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceNameSEO" id="PlaceNameSEO" class="w100" value="{{PlaceNameSEO}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceType"><?=PLACETYPE;?></label>
					</div>
					<div class="col-md-9">
						{{placeTypeSelect PlaceType 'PlaceType' }}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceCity"><?=PLACECITY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceCity" id="PlaceCity" class="w100" value="{{PlaceCity}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceAddress"><?=PLACEADDRESS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceAddress" id="PlaceAddress" class="w100" value="{{PlaceAddress}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceDesc"><?=PLACEDESC;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="PlaceDesc" id="PlaceDesc" rows="5" 
					class="textarea" cols="50" style="width:100%">{{PlaceDesc}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Island"><?=ISLAND;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSelect Island 'Island' }}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceActive"><?=PLACEACTIVE;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSelect PlaceActive 'PlaceActive' }}
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_Places('{{PlaceID}}', '<?= $inList ?>');">
    		<i class="ic-cancel-circle"></i> <?= DELETE ?>
    	</button>

		<button class="btn btn-default" onclick="deleteCache(2, {{PlaceID}})">
			<i class="fa fa-chain-broken"></i> <?= DELETE_CACHE ?>
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
	
	
		$("#PlaceNameEN").keyup(function(){
			var place = $("#PlaceNameEN").val();
			$("#PlaceNameSEO").val( getSlug( place , '+') );
		});
		
		$("#PlaceCountry").change(function(){
			$("#CountryNameEN").val( $("#PlaceCountry option:selected").text());
		});
	</script>
</script>

