
<script type="text/x-handlebars-template" id="v4_CouponsEditTemplate">
<form id="v4_CouponsEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_Coupons('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Coupons('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Coupons('{{ID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Coupons('{{ID}}', '<?= $inList ?>');">
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
						<label for="ID"><?=ID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ID" id="ID" class="w100" value="{{ID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CreatorID"><?=CREATORID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CreatorID" id="CreatorID" class="w100" value="{{CreatorID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Code"><?=CODE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Code" id="Code" class="w100" value="{{Code}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Discount"><?=DISCOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Discount" id="Discount" class="w100" value="{{Discount}}">
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
						<label for="ValidFrom"><?=VALIDFROM;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ValidFrom" id="ValidFrom" class="w100" value="{{ValidFrom}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ValidTo"><?=VALIDTO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ValidTo" id="ValidTo" class="w100" value="{{ValidTo}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TransferFromDate"><?=TRANSFERFROMDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TransferFromDate" id="TransferFromDate" class="w100" value="{{TransferFromDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TransferToDate"><?=TRANSFERTODATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TransferToDate" id="TransferToDate" class="w100" value="{{TransferToDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="LimitLocationID"><?=LIMITLOCATIONID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="LimitLocationID" id="LimitLocationID" class="w100" value="{{LimitLocationID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="WeekdaysOnly"><?=WEEKDAYSONLY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="WeekdaysOnly" id="WeekdaysOnly" class="w100" value="{{WeekdaysOnly}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ReturnOnly"><?=RETURNONLY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ReturnOnly" id="ReturnOnly" class="w100" value="{{ReturnOnly}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Active"><?=ACTIVE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Active" id="Active" class="w100" value="{{Active}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TimesUsed"><?=TIMESUSED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TimesUsed" id="TimesUsed" class="w100" value="{{TimesUsed}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_Coupons('{{ID}}', '<?= $inList ?>');">
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
	