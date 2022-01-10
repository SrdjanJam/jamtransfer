
<script type="text/x-handlebars-template" id="v4_DriverPricesEditTemplate">
<form id="v4_DriverPricesEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_DriverPrices('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_DriverPrices('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_DriverPrices('{{ID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_DriverPrices('{{ID}}', '<?= $inList ?>');">
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
						<label for="DriverID"><?=DRIVERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverID" id="DriverID" class="w100" value="{{DriverID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FromName"><?=FROMNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FromName" id="FromName" class="w100" value="{{FromName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FromNameEN"><?=FROMNAMEEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FromNameEN" id="FromNameEN" class="w100" value="{{FromNameEN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FromNameRU"><?=FROMNAMERU;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FromNameRU" id="FromNameRU" class="w100" value="{{FromNameRU}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FromNameFR"><?=FROMNAMEFR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FromNameFR" id="FromNameFR" class="w100" value="{{FromNameFR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FromNameDE"><?=FROMNAMEDE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FromNameDE" id="FromNameDE" class="w100" value="{{FromNameDE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FromNameIT"><?=FROMNAMEIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FromNameIT" id="FromNameIT" class="w100" value="{{FromNameIT}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TerminalID"><?=TERMINALID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TerminalID" id="TerminalID" class="w100" value="{{TerminalID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ToName"><?=TONAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ToName" id="ToName" class="w100" value="{{ToName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ToNameEN"><?=TONAMEEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ToNameEN" id="ToNameEN" class="w100" value="{{ToNameEN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ToNameRU"><?=TONAMERU;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ToNameRU" id="ToNameRU" class="w100" value="{{ToNameRU}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ToNameFR"><?=TONAMEFR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ToNameFR" id="ToNameFR" class="w100" value="{{ToNameFR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ToNameDE"><?=TONAMEDE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ToNameDE" id="ToNameDE" class="w100" value="{{ToNameDE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ToNameIT"><?=TONAMEIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ToNameIT" id="ToNameIT" class="w100" value="{{ToNameIT}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DestinationID"><?=DESTINATIONID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DestinationID" id="DestinationID" class="w100" value="{{DestinationID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="RouteID"><?=ROUTEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="RouteID" id="RouteID" class="w100" value="{{RouteID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleTypeID"><?=VEHICLETYPEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleTypeID" id="VehicleTypeID" class="w100" value="{{VehicleTypeID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SinglePrice"><?=SINGLEPRICE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SinglePrice" id="SinglePrice" class="w100" value="{{SinglePrice}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ReturnPrice"><?=RETURNPRICE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ReturnPrice" id="ReturnPrice" class="w100" value="{{ReturnPrice}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ID"><?=ID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ID" id="ID" class="w100" value="{{ID}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_DriverPrices('{{ID}}', '<?= $inList ?>');">
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
	