
<script type="text/x-handlebars-template" id="v4_CustomQueryEditTemplate">
<form id="v4_CustomQueryEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_CustomQuery('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_CustomQuery('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_CustomQuery('{{ID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_CustomQuery('{{ID}}', '<?= $inList ?>');">
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
						<label for="customName"><?=CUSTOMNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="customName" id="customName" class="w100" value="{{customName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="customMail"><?=CUSTOMMAIL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="customMail" id="customMail" class="w100" value="{{customMail}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="customFrom"><?=CUSTOMFROM;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="customFrom" id="customFrom" class="w100" value="{{customFrom}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="customTo"><?=CUSTOMTO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="customTo" id="customTo" class="w100" value="{{customTo}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="customPDate"><?=CUSTOMPDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="customPDate" id="customPDate" class="w100" value="{{customPDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="customPTime"><?=CUSTOMPTIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="customPTime" id="customPTime" class="w100" value="{{customPTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="customPAddress"><?=CUSTOMPADDRESS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="customPAddress" id="customPAddress" class="w100" value="{{customPAddress}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="customDropoff"><?=CUSTOMDROPOFF;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="customDropoff" id="customDropoff" class="w100" value="{{customDropoff}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="customPax"><?=CUSTOMPAX;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="customPax" id="customPax" class="w100" value="{{customPax}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="customVehicle"><?=CUSTOMVEHICLE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="customVehicle" id="customVehicle" class="w100" value="{{customVehicle}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="customBabySeats"><?=CUSTOMBABYSEATS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="customBabySeats" id="customBabySeats" class="w100" value="{{customBabySeats}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="customChildSeats"><?=CUSTOMCHILDSEATS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="customChildSeats" id="customChildSeats" class="w100" value="{{customChildSeats}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="customExtras"><?=CUSTOMEXTRAS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="customExtras" id="customExtras" class="w100" value="{{customExtras}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="customNotes"><?=CUSTOMNOTES;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="customNotes" id="customNotes" class="w100" value="{{customNotes}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DateSent"><?=DATESENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DateSent" id="DateSent" class="w100" value="{{DateSent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TimeSent"><?=TIMESENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TimeSent" id="TimeSent" class="w100" value="{{TimeSent}}">
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
						<label for="Reply"><?=REPLY;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Reply" id="Reply" rows="5" 
					class="textarea" cols="50" style="width:100%">{{Reply}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ReplyUserID"><?=REPLYUSERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ReplyUserID" id="ReplyUserID" class="w100" value="{{ReplyUserID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ReplyDate"><?=REPLYDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ReplyDate" id="ReplyDate" class="w100" value="{{ReplyDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ReplyTime"><?=REPLYTIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ReplyTime" id="ReplyTime" class="w100" value="{{ReplyTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AssignedDriverID"><?=ASSIGNEDDRIVERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AssignedDriverID" id="AssignedDriverID" class="w100" value="{{AssignedDriverID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ConvertToBooking"><?=CONVERTTOBOOKING;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ConvertToBooking" id="ConvertToBooking" class="w100" value="{{ConvertToBooking}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_CustomQuery('{{ID}}', '<?= $inList ?>');">
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
	