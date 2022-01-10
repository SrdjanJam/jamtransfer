<script type="text/x-handlebars-template" id="v4_VehicleTypesEditTemplate">
<form id="v4_VehicleTypesEditForm{{VehicleTypeID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NNEW ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?> - {{VehicleTypeName}}</h3>
			<? } ?>
		</div>
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<? if ($inList=='true') { ?>
					<button class="btn" title="<?= CLOSE?>" 
					onclick="return editClosev4_VehicleTypes('{{VehicleTypeID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_VehicleTypes('{{VehicleTypeID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_VehicleTypes('{{VehicleTypeID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-4">
						<label for="VehicleTypeNameEN"><?=VEHICLETYPENAME.LEN;?></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="VehicleTypeNameEN" id="VehicleTypeNameEN" class="w100" value="{{VehicleTypeNameEN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="VehicleTypeNameRU"><?=VEHICLETYPENAME.LRU;?></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="VehicleTypeNameRU" id="VehicleTypeNameRU" class="w100" value="{{VehicleTypeNameRU}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="VehicleTypeNameFR"><?=VEHICLETYPENAME.LFR;?></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="VehicleTypeNameFR" id="VehicleTypeNameFR" class="w100" value="{{VehicleTypeNameFR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="VehicleTypeNameDE"><?=VEHICLETYPENAME.LDE;?></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="VehicleTypeNameDE" id="VehicleTypeNameDE" class="w100" value="{{VehicleTypeNameDE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="VehicleTypeNameIT"><?=VEHICLETYPENAME.LIT;?></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="VehicleTypeNameIT" id="VehicleTypeNameIT" class="w100" value="{{VehicleTypeNameIT}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="VehicleTypeNameSE"><?=VEHICLETYPENAME.LSE;?></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="VehicleTypeNameSE" id="VehicleTypeNameSE" class="w100" value="{{VehicleTypeNameSE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="VehicleTypeNameNO"><?=VEHICLETYPENAME.LNO;?></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="VehicleTypeNameNO" id="VehicleTypeNameNO" class="w100" value="{{VehicleTypeNameNO}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="VehicleTypeNameES"><?=VEHICLETYPENAME.LES;?></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="VehicleTypeNameES" id="VehicleTypeNameES" class="w100" value="{{VehicleTypeNameES}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="VehicleTypeNameNL"><?=VEHICLETYPENAME.LNL;?></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="VehicleTypeNameNL" id="VehicleTypeNameNL" class="w100" value="{{VehicleTypeNameNL}}">
					</div>
				</div>

				<br>

				<div class="row">
					<div class="col-md-4">
						<label for="Description"><?=DESCRIPTION;?></label>
					</div>
					<div class="col-md-8">
						<textarea name="Description" id="Description" rows="5" 
						class="textarea" cols="50" style="width:100%">{{Description}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="DescriptionEN"><?=DESCRIPTIONEN;?></label>
					</div>
					<div class="col-md-8">
						<textarea name="DescriptionEN" id="DescriptionEN" rows="5" 
						class="textarea" cols="50" style="width:100%">{{DescriptionEN}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="DescriptionRU"><?=DESCRIPTIONRU;?></label>
					</div>
					<div class="col-md-8">
						<textarea name="DescriptionRU" id="DescriptionRU" rows="5" 
						class="textarea" cols="50" style="width:100%">{{DescriptionRU}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="DescriptionFR"><?=DESCRIPTIONFR;?></label>
					</div>
					<div class="col-md-8">
						<textarea name="DescriptionFR" id="DescriptionFR" rows="5" 
						class="textarea" cols="50" style="width:100%">{{DescriptionFR}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="DescriptionDE"><?=DESCRIPTIONDE;?></label>
					</div>
					<div class="col-md-8">
						<textarea name="DescriptionDE" id="DescriptionDE" rows="5" 
						class="textarea" cols="50" style="width:100%">{{DescriptionDE}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="DescriptionIT"><?=DESCRIPTIONIT;?></label>
					</div>
					<div class="col-md-8">
						<textarea name="DescriptionIT" id="DescriptionIT" rows="5" 
						class="textarea" cols="50" style="width:100%">{{DescriptionIT}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="DescriptionSE"><?=DESCRIPTIONSE;?></label>
					</div>
					<div class="col-md-8">
						<textarea name="DescriptionSE" id="DescriptionSE" rows="5" 
						class="textarea" cols="50" style="width:100%">{{DescriptionSE}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="DescriptionNO"><?=DESCRIPTIONNO;?></label>
					</div>
					<div class="col-md-8">
						<textarea name="DescriptionNO" id="DescriptionNO" rows="5" 
						class="textarea" cols="50" style="width:100%">{{DescriptionNO}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="DescriptionES"><?=DESCRIPTIONES;?></label>
					</div>
					<div class="col-md-8">
						<textarea name="DescriptionES" id="DescriptionES" rows="5" 
						class="textarea" cols="50" style="width:100%">{{DescriptionES}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="DescriptionNL"><?=DESCRIPTIONNL;?></label>
					</div>
					<div class="col-md-8">
						<textarea name="DescriptionNL" id="DescriptionNL" rows="5" 
						class="textarea" cols="50" style="width:100%">{{DescriptionNL}}</textarea>
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
	
