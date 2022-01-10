
<script type="text/x-handlebars-template" id="v4_ServicesCopyEditTemplate">
<form id="v4_ServicesCopyEditForm{{ServiceID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_ServicesCopy('{{ServiceID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_ServicesCopy('{{ServiceID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_ServicesCopy('{{ServiceID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_ServicesCopy('{{ServiceID}}', '<?= $inList ?>');">
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
						<label for="SiteID"><?=SITEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SiteID" id="SiteID" class="w100" value="{{SiteID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="OwnerID"><?=OWNERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="OwnerID" id="OwnerID" class="w100" value="{{OwnerID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ServiceID"><?=SERVICEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ServiceID" id="ServiceID" class="w100" value="{{ServiceID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SurCategory"><?=SURCATEGORY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SurCategory" id="SurCategory" class="w100" value="{{SurCategory}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SurID"><?=SURID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SurID" id="SurID" class="w100" value="{{SurID}}">
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
						<label for="VehicleID"><?=VEHICLEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleID" id="VehicleID" class="w100" value="{{VehicleID}}">
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
						<label for="VehicleAvailable"><?=VEHICLEAVAILABLE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleAvailable" id="VehicleAvailable" class="w100" value="{{VehicleAvailable}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Correction"><?=CORRECTION;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Correction" id="Correction" class="w100" value="{{Correction}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ServicePrice1"><?=SERVICEPRICE1;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ServicePrice1" id="ServicePrice1" class="w100" value="{{ServicePrice1}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ServicePrice2"><?=SERVICEPRICE2;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ServicePrice2" id="ServicePrice2" class="w100" value="{{ServicePrice2}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ServicePrice3"><?=SERVICEPRICE3;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ServicePrice3" id="ServicePrice3" class="w100" value="{{ServicePrice3}}">
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
						<label for="ServiceETA"><?=SERVICEETA;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ServiceETA" id="ServiceETA" class="w100" value="{{ServiceETA}}">
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
						<label for="LastChange"><?=LASTCHANGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="LastChange" id="LastChange" class="w100" value="{{LastChange}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_ServicesCopy('{{ServiceID}}', '<?= $inList ?>');">
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
	