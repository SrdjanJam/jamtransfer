
<script type="text/x-handlebars-template" id="v4_VehicleTimeTableEditTemplate">
<form id="v4_VehicleTimeTableEditForm{{TaskID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_VehicleTimeTable('{{TaskID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_VehicleTimeTable('{{TaskID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_VehicleTimeTable('{{TaskID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_VehicleTimeTable('{{TaskID}}', '<?= $inList ?>');">
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
						<label for="OwnerID"><?=OWNERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="OwnerID" id="OwnerID" class="w100" value="{{OwnerID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="WSID"><?=WSID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="WSID" id="WSID" class="w100" value="{{WSID}}">
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
						<label for="TaskID"><?=TASKID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TaskID" id="TaskID" class="w100" value="{{TaskID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TaskDesc"><?=TASKDESC;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TaskDesc" id="TaskDesc" class="w100" value="{{TaskDesc}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TaskDetails"><?=TASKDETAILS;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="TaskDetails" id="TaskDetails" rows="5" 
					class="textarea" cols="50" style="width:100%">{{TaskDetails}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Extras"><?=EXTRAS;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Extras" id="Extras" rows="5" 
					class="textarea" cols="50" style="width:100%">{{Extras}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MyDriver"><?=MYDRIVER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MyDriver" id="MyDriver" class="w100" value="{{MyDriver}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="StartDate"><?=STARTDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="StartDate" id="StartDate" class="w100" value="{{StartDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="StartTime"><?=STARTTIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="StartTime" id="StartTime" class="w100" value="{{StartTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FlightNo"><?=FLIGHTNO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FlightNo" id="FlightNo" class="w100" value="{{FlightNo}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FlightTime"><?=FLIGHTTIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FlightTime" id="FlightTime" class="w100" value="{{FlightTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PickupDate"><?=PICKUPDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PickupDate" id="PickupDate" class="w100" value="{{PickupDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PickupTime"><?=PICKUPTIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PickupTime" id="PickupTime" class="w100" value="{{PickupTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PickupName"><?=PICKUPNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PickupName" id="PickupName" class="w100" value="{{PickupName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PickupPlace"><?=PICKUPPLACE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PickupPlace" id="PickupPlace" class="w100" value="{{PickupPlace}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PickupAddress"><?=PICKUPADDRESS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PickupAddress" id="PickupAddress" class="w100" value="{{PickupAddress}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DropName"><?=DROPNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DropName" id="DropName" class="w100" value="{{DropName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DropPlace"><?=DROPPLACE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DropPlace" id="DropPlace" class="w100" value="{{DropPlace}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DropAddress"><?=DROPADDRESS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DropAddress" id="DropAddress" class="w100" value="{{DropAddress}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PaxName"><?=PAXNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PaxName" id="PaxName" class="w100" value="{{PaxName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PaxGSM"><?=PAXGSM;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PaxGSM" id="PaxGSM" class="w100" value="{{PaxGSM}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PaxNotes"><?=PAXNOTES;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="PaxNotes" id="PaxNotes" rows="5" 
					class="textarea" cols="50" style="width:100%">{{PaxNotes}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AfterTask"><?=AFTERTASK;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AfterTask" id="AfterTask" class="w100" value="{{AfterTask}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="OrderDetailsID"><?=ORDERDETAILSID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="OrderDetailsID" id="OrderDetailsID" class="w100" value="{{OrderDetailsID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="KmStart"><?=KMSTART;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="KmStart" id="KmStart" class="w100" value="{{KmStart}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="KmEnd"><?=KMEND;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="KmEnd" id="KmEnd" class="w100" value="{{KmEnd}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Cash"><?=CASH;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Cash" id="Cash" class="w100" value="{{Cash}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Status"><?=STATUS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Status" id="Status" class="w100" value="{{Status}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Completition"><?=COMPLETITION;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Completition" id="Completition" class="w100" value="{{Completition}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverNotes"><?=DRIVERNOTES;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="DriverNotes" id="DriverNotes" rows="5" 
					class="textarea" cols="50" style="width:100%">{{DriverNotes}}</textarea>
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_VehicleTimeTable('{{TaskID}}', '<?= $inList ?>');">
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
	