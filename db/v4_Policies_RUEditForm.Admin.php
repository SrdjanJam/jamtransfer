
<script type="text/x-handlebars-template" id="v4_Policies_RUEditTemplate">
<form id="v4_Policies_RUEditForm{{OwnerID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_Policies_RU('{{OwnerID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Policies_RU('{{OwnerID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Policies_RU('{{OwnerID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Policies_RU('{{OwnerID}}', '<?= $inList ?>');">
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
						<label for="DateChanged"><?=DATECHANGED;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="DateChanged" id="DateChanged" rows="5" 
					class="textarea" cols="50" style="width:100%">{{DateChanged}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="BookingAdvance"><?=BOOKINGADVANCE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="BookingAdvance" id="BookingAdvance" class="w100" value="{{BookingAdvance}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DeclineTime"><?=DECLINETIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DeclineTime" id="DeclineTime" class="w100" value="{{DeclineTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CancelDays"><?=CANCELDAYS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CancelDays" id="CancelDays" class="w100" value="{{CancelDays}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CancelCharge"><?=CANCELCHARGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CancelCharge" id="CancelCharge" class="w100" value="{{CancelCharge}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Deposit"><?=DEPOSIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Deposit" id="Deposit" class="w100" value="{{Deposit}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AMEX"><?=AMEX;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AMEX" id="AMEX" class="w100" value="{{AMEX}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Visa"><?=VISA;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Visa" id="Visa" class="w100" value="{{Visa}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MasterCard"><?=MASTERCARD;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MasterCard" id="MasterCard" class="w100" value="{{MasterCard}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Diners"><?=DINERS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Diners" id="Diners" class="w100" value="{{Diners}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MeetingGeneral"><?=MEETINGGENERAL;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="MeetingGeneral" id="MeetingGeneral" rows="5" 
					class="textarea" cols="50" style="width:100%">{{MeetingGeneral}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MeetingAirport"><?=MEETINGAIRPORT;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="MeetingAirport" id="MeetingAirport" rows="5" 
					class="textarea" cols="50" style="width:100%">{{MeetingAirport}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MeetingFerry"><?=MEETINGFERRY;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="MeetingFerry" id="MeetingFerry" rows="5" 
					class="textarea" cols="50" style="width:100%">{{MeetingFerry}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MeetingBus"><?=MEETINGBUS;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="MeetingBus" id="MeetingBus" rows="5" 
					class="textarea" cols="50" style="width:100%">{{MeetingBus}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MeetingTrain"><?=MEETINGTRAIN;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="MeetingTrain" id="MeetingTrain" rows="5" 
					class="textarea" cols="50" style="width:100%">{{MeetingTrain}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Locked"><?=LOCKED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Locked" id="Locked" class="w100" value="{{Locked}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_Policies_RU('{{OwnerID}}', '<?= $inList ?>');">
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
	