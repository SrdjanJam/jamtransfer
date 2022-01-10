
<script type="text/x-handlebars-template" id="v4_WorksheetEditTemplate">
<form id="v4_WorksheetEditForm{{WSID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_Worksheet('{{WSID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Worksheet('{{WSID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Worksheet('{{WSID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Worksheet('{{WSID}}', '<?= $inList ?>');">
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
						<label for="WSID"><?=WSID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="WSID" id="WSID" class="w100" value="{{WSID}}">
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
						<label for="MyDriverID"><?=MYDRIVERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MyDriverID" id="MyDriverID" class="w100" value="{{MyDriverID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverSignature"><?=DRIVERSIGNATURE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverSignature" id="DriverSignature" class="w100" value="{{DriverSignature}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="WSDate"><?=WSDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="WSDate" id="WSDate" class="w100" value="{{WSDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="WSTime"><?=WSTIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="WSTime" id="WSTime" class="w100" value="{{WSTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FromDate"><?=FROMDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FromDate" id="FromDate" class="w100" value="{{FromDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ToDate"><?=TODATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ToDate" id="ToDate" class="w100" value="{{ToDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CashWithdrawn"><?=CASHWITHDRAWN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CashWithdrawn" id="CashWithdrawn" class="w100" value="{{CashWithdrawn}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CashDeposit"><?=CASHDEPOSIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CashDeposit" id="CashDeposit" class="w100" value="{{CashDeposit}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="KmOut"><?=KMOUT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="KmOut" id="KmOut" class="w100" value="{{KmOut}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="KmIn"><?=KMIN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="KmIn" id="KmIn" class="w100" value="{{KmIn}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Notes"><?=NOTES;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Notes" id="Notes" rows="5" 
					class="textarea" cols="50" style="width:100%">{{Notes}}</textarea>
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
    	<button class="btn btn-default" onclick="return deletev4_Worksheet('{{WSID}}', '<?= $inList ?>');">
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
	